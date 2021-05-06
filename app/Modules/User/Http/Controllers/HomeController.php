<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;

class HomeController extends AppController
{
    public function index () {
    	$total_product = Cart::count();

    	$data = [
    		'total_product' => $total_product,
    	];
		return view('user::web.index', $data);
	}

	public function category () {
		$total_product = Cart::count();

		$data = [
    		'total_product' => $total_product,
    	];

		return view('user::web.category', $data);
	}

	public function productDetail ($id) {
		$total_product = Cart::count();
		$product = Product::findOrFail($id);
		$products = Product::inRandomOrder()->limit(5)->get();

		$data = [
			'product' => $product,
			'products' => $products,
			'total_product' => $total_product,
		];

		return view('user::web.product-detail', $data);
	}

	
}
