<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index () {
		return view('user::web.index');
	}

	public function category () {
		return view('user::web.category');
	}

	public function productDetail ($id) {
		$product = Product::findOrFail($id);
		$products = Product::inRandomOrder()->limit(5)->get();

		$data = [
			'product' => $product,
			'products' => $products,
		];

		return view('user::web.product-detail', $data);
	}

	public function order () {
		return view('user::web.order');
	}
}
