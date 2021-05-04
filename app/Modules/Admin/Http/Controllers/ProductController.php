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
class ProductController extends AppController
{
    public function index() {
        $products = Product::paginate(10);

        $data = [
            'products' => $products,
        ];

        return view('admin::product.index', $data);
    }

    public function create() {
        $brands = Brand::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        $data = [
            'brands' => $brands,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ];
        return view('admin::product.create', $data);
    }

    public function store(Request $request) {
        dd($request->all());
        DB::beginTransaction();
        try {
            $product = Product::create([
                'brand_id' => $request->brand_id,
                'category_id' => 1,
                'supplier_id' => $request->supplier_id,
                'sku' => $request->sku,
                'title' => $request->title,
                'slug' => $request->slug,
                'image' => $request->avatar,
                'description' => $request->description,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'status' => 1,
            ]);

            foreach ($request->categories as $category_id) {
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category_id,
                ]);
            }

            foreach ($request->images as $url) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $url,
                ]);
            }

            // foreach ($request->sizes as $size) {
            //     Size::create([
            //         'product_id' => $product->id,
            //         'name' => $url,
            //         'quantity' => $url,
            //     ]);
            // }

            DB::commit();
            return redirect()->route('admin.product.index')->with('alert-success', 'Thêm sản phẩm thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm sản phẩm thất bại!');
        }

    }

    public function edit() {
        return view('admin::product.edit');
    }

    public function update(Request $request, $id) {
        $params = $request->all();
        dd($params);
    }
}
