<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index () {
		return view('user::web.index');
	}

	public function category () {
		return view('user::web.category');
	}

	public function productDetail () {
		return view('user::web.product-detail');
	}

	public function order () {
		return view('user::web.order');
	}
}
