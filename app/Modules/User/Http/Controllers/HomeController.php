<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductCategory;
use Cart;

class HomeController extends AppController
{
    public function index () {
		$products = Product::limit(4)->get();
		$productHots = Product::where('is_hot', PRODUCT_HOT)->limit(4)->get();
		$newProducts = Product::where('is_new', NEW_PRODUCT)->limit(4)->get();
		$categories = Category::all();
		$total_product = Cart::count();

    	$data = [
    		'products' => $products,
    		'productHots' => $productHots,
    		'newProducts' => $newProducts,
    		'categories' => $categories,
    		'total_product' => $total_product,
    	];
		return view('user::web.home', $data);
	}

	public function category (Request $request, $slug) {
		$categories = Category::all();
		
		if ($slug == 'san-pham-ban-chay') {
			$category['title'] = 'Sản phẩm bán chạy';
			$query = Product::where('is_hot', 1);
		}
		elseif ($slug == 'san-pham-moi') {
			$category['title'] = 'Sản phẩm mới';
			$query = Product::where('is_new', 1);
		}
		else {
			$category = Category::where('slug', $slug)->first();
			$productIds = ProductCategory::where('category_id', $category->id)->get()->pluck('product_id');
			$query = Product::whereIn('id', $productIds);
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

		$products = $query->paginate(8);

		$data = [
    		'products' => $products,
    		'category' => $category,
    		'search' => $request->search,
    		'categories' => $categories
    	];

		return view('user::web.product.index', $data);
	}

	public function productDetail ($slug, $id) {
		$categories = Category::all();
		$product = Product::findOrFail($id);
		$products = Product::inRandomOrder()->limit(5)->get();
		$total_product = Cart::count();

		$data = [
			'product' => $product,
			'products' => $products,
			'total_product' => $total_product,
			'categories' => $categories
		];

		return view('user::web.product..product-detail', $data);
	}

	
}
