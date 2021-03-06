<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Size;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\ProductRequest;

class ProductController extends AppController
{
    public function index(Request $request) {
        $query = Product::query();
        $suppliers = Supplier::all();

        if ($request->has('search')) {
            $query = $query->where(function ($q) use ($request) {
                $q->orWhere('title', 'like', '%'.$request->search.'%')
                    ->orWhere('slug', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->has('supplier') && $request->supplier) {
            $query = $query->where('supplier_id', $request->supplier);
        }

        if ($request->has('price') && $request->price) {
			$price = $request->price;

            if ($price == '<1000000') {
                $query = $query->where('price', '<', 1000000);
            } else {
                $priceSplice = explode('_', $price);
                if (count($priceSplice) > 1) {
                    $priceMin = $priceSplice[0];
                    $priceMax = $priceSplice[1];
                    $query = $query->whereBetween('price', [$priceMin, $priceMax]);
                }
            }
		}

        if ($request->has('status')) {
            if ($request->status === 1 || $request->status === '1') {
                $query = $query->get()->filter(function($item) {
                    return $item->size > 0;
                });
                if ($query->isEmpty()) {
                    $query = Product::query()->where('id', 0);
                }
                else {
                    $query = $query->toQuery();
                }
            }

            if ($request->status === 0 || $request->status === '0') {
                $query = $query->get()->filter(function($item) {
                    return $item->size == 0;
                });

                if ($query->isEmpty()) {
                    $query = Product::query()->where('id', 0);
                }
                else {
                    $query = $query->toQuery();
                }
            }
        }

        $products = $query->with('sizes')->where('status', 'active')->orderBy('price', 'asc')->paginate(PAGE_LIMIT);

        $data = [
            'products' => $products,
            'search' => $request->search,
            'suppliers' => $suppliers,
        ];

        return view('admin::product.index', $data);
    }

    public function create() {
        $brands = Brand::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        $data = [
            'dataEdit' => [],
            'brands' => $brands,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ];
        return view('admin::product.create', $data);
    }

    public function store(ProductRequest $request) {
        $params = $request->all();
        DB::beginTransaction();
        try {
            $product = Product::create([
                'brand_id' => $params['brand_id'],
                'supplier_id' => $params['supplier_id'],
                'sku' => $params['sku'],
                'title' => $params['title'],
                'slug' => $params['slug'],
                'image' => $params['image'],
                'description' => $params['description'],
                'price' => $params['price'],
                'sale_price' => $params['sale_price'],
                'is_hot' => isset($params['is_hot']) ? PRODUCT_HOT : 0,
                'is_new' => isset($params['is_new']) ? NEW_PRODUCT : 0,
                'status' => 'active',
            ]);

            foreach ($params['categories'] as $category_id) {
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category_id,
                ]);
            }

            foreach ($request['images'] as $url) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $url,
                ]);
            }

            foreach ($params['sizes'] as $key => $size) {
                Size::create([
                    'product_id' => $product->id,
                    'name' => $params['sizes'][$key],
                    'quantity' => $params['quantities'][$key],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with('alert-success', 'Th??m s???n ph???m th??nh c??ng!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Th??m s???n ph???m th???t b???i!');
        }
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        $product_images = ProductImage::where('product_id', $id)->get()->pluck('url');
        $product_categorie_ids = ProductCategory::where('product_id', $id)->pluck('category_id')->toArray();
        $product_sizes = Size::where('product_id', $id)->get()->toArray();

        $viewData = [
            'dataEdit' => $product,
            'brands' => $brands,
            'categories' => $categories,
            'suppliers' => $suppliers,
            'product_images' => $product_images,
            'product_categorie_ids' => $product_categorie_ids,
            'product_sizes' => $product_sizes,
        ];
        return view('admin::product.edit', $viewData);
    }

    public function update(Request $request, $id) {
        $params = $request->all();
        $product = Product::findOrFail($id);
        DB::beginTransaction();
        try {
            $product->update([
                'brand_id' => $params['brand_id'],
                'supplier_id' => $params['supplier_id'],
                'sku' => $params['sku'],
                'title' => $params['title'],
                'slug' => $params['slug'],
                'image' => $params['image'],
                'description' => $params['description'],
                'price' => $params['price'],
                'sale_price' => $params['sale_price'],
                'is_hot' => isset($params['is_hot']) ? PRODUCT_HOT : 0,
                'is_new' => isset($params['is_new']) ? NEW_PRODUCT : 0,
                'status' => 'active',
            ]);

            if (isset($params['categories'])) {
                ProductCategory::where('product_id', $id)->delete();
                foreach ($params['categories'] as $category_id) {
                    ProductCategory::create([
                        'product_id' => $id,
                        'category_id' => $category_id,
                    ]);
                }
            }

            if (isset($params['images'])) {
                ProductImage::where('product_id', $id)->delete();
                foreach ($params['images'] as $url) {
                    ProductImage::create([
                        'product_id' => $id,
                        'url' => $url,
                    ]);
                }
            }

            if (isset($params['sizes'])) {
                Size::where('product_id', $id)->delete();
                foreach ($params['sizes'] as $key => $size) {
                    Size::create([
                        'product_id' => $id,
                        'name' => $params['sizes'][$key],
                        'quantity' => $params['quantities'][$key],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.product.index')->with('alert-success', 'C???p nh???t s???n ph???m th??nh c??ng!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'C???p nh???t s???n ph???m th???t b???i!');
        }
    }

    public function delete(Request $request, $id) {
        $product = Product::findOrFail($id);
        DB::beginTransaction();
        try {
            $product->update([
                'status' => 'deleted',
            ]);

            DB::commit();
            return redirect()->route('admin.product.index')->with('alert-success', 'X??a s???n ph???m th??nh c??ng!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'X??a s???n ph???m th???t b???i!');
        }
    }
}
