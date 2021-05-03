<?php

namespace App\Modules\Web\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index () {
		return view('web::web.index');
	}

	public function category () {
		return view('web::web.category');
	}

	public function productDetail () {
		return view('web::web.productDetail');
	}

	public function order () {
		return view('web::web.order');
	}
}
