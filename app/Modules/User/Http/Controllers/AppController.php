<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use View;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function __construct() {
        $total_product = Cart::count();
    	$cart = Cart::content();
        $total_money = Cart::subtotal(0,",",".",".");

        View::share('total_product', $total_product);
        View::share('cart', $cart);
        View::share('total_money', $total_money);
    }
}
