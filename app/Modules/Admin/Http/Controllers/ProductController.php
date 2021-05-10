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

        if ($request->has('search')) {
            $query = $query->where(function ($q) use ($request) {
                $q->orWhere('title', 'like', '%'.$request->search.'%')
                    ->orWhere('slug', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->has('price_min') || $request->has('price_max')) {
			$price_min = $request->price_min;
			$price_max = $request->price_max;

			if ($price_min && !$price_max) {
				$query = $query->where('price', '>=', $price_min);
			} elseif ($price_max && !$price_min) {
				$query = $query->where('price', '<=', $price_max);
			} elseif ($price_min && $price_max) {
				$query = $query->whereBetween('price', [$price_min, $price_max]);
			}
		}

        if ($request->has('status')) {
            $query = $query->join('sizes', 'sizes.product_id', 'products.id');
            if ($request->status === 1 || $request->status === '1') {
                $query = $query->where('sizes.quantity', '>', 0);
            }

            if ($request->status === 0 || $request->status === '0') {
                $query = $query->where('sizes.quantity', '=', 0);
            }
        }
        
        $products = $query->with('sizes')->where('status', 'active')->orderBy('price', 'asc')->paginate(PAGE_LIMIT);

        $data = [
            'products' => $products,
            'search' => $request->search,
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
            return redirect()->route('admin.product.index')->with('alert-success', 'Thêm sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm sản phẩm thất bại!');
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
            return redirect()->route('admin.product.index')->with('alert-success', 'Cập nhật sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Cập nhật sản phẩm thất bại!');
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
            return redirect()->route('admin.product.index')->with('alert-success', 'Xóa sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Xóa sản phẩm thất bại!');
        }
    }
}
