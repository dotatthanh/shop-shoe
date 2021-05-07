<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use Cart;

class HomeController extends AppController
{
    public function index () {
    	// $total_product = Cart::count();
		$products = Product::limit(4)->get();
		$productHots = Product::limit(4)->get();
		$newProducts = Product::limit(4)->get();
		$categories = Category::all();

    	$data = [
    		'products' => $products,
    		'productHots' => $productHots,
    		'newProducts' => $newProducts,
    		'categories' => $categories,
    	];
		return view('user::web.index', $data);
	}

	public function category (Request $request, $slug) {
		$category = Category::where('slug', $slug)->first();

		$productIds = ProductCategory::where('category_id', $category->id)->get()->pluck('product_id');

		$query = Product::whereIn('id', $productIds);

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
    	];

		return view('user::web.category', $data);
	}

	public function productDetail ($slug, $id) {
		$product = Product::findOrFail($id);
		$products = Product::inRandomOrder()->limit(5)->get();

		$data = [
			'product' => $product,
			'products' => $products,
		];

		return view('user::web.product-detail', $data);
	}

	
}
