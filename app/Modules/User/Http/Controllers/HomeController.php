<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
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

	public function pageOrder () {
		$total_product = Cart::count();
    	$cart = Cart::content();
        $total_money = Cart::subtotal(0,",",".",".");

    	$data = [
    		'cart' => $cart,
    		'total_money' => $total_money,
    		'total_product' => $total_product,
    	];

		return view('user::web.order', $data);
	}

	public function order (Request $request) {
		// if(Cart::count() < 1)
  //       {
  //           return redirect()->back()->with('notificationOrderFail', 'Đặt hàng thất bại! Giỏ hàng của bạn chưa có sản phẩm!');
  //       }
  //       else
  //       {
  //           $customer = Customer::create($request->all());

  //           $content = Cart::content();
  //           $test = array();
  //           foreach ($content as $key) {
  //               $order = new Order;
  //               $order -> book_id = $key->id;
  //               $order -> customer_id = $customer->id;
  //               $order -> price = $key->price;
  //               $order -> amount = $key->qty;
  //               $order -> save();

  //               $book = Book::find($key->id);
  //               $book->amount = $book->amount - $key->qty;
  //               $book->save();
  //           }

  //           Cart::destroy();
            
  //           return redirect()->back()->with('notificationOrder', 'Đặt hàng thành công! Cảm ơn quý khách hàng đã tin tưởng và sử dụng dịch vụ của chúng tôi');;
  //       }







		// $total_product = Cart::count();
  //   	$cart = Cart::content();
  //       $total_money = Cart::subtotal(0,",",".",".");

  //   	$data = [
  //   		'cart' => $cart,
  //   		'total_money' => $total_money,
  //   		'total_product' => $total_product,
  //   	];

		// return view('user::web.order', $data);
	}

	public function addToCart (Request $request, $id) {
		$size = json_decode($request->size);
		$product = Product::findOrFail($id);

		$price = ($product->sale_price) ? $product->sale_price : $product->price;

        Cart::add([
            'id' => $id,
            'name' => $product->title,
            'qty' => 1,
            'price' => $price,
            'weight' => 0,
            'options' => [
                'size' => $size->name
            ]
        ]);

        $content = Cart::content();

        return redirect()->back();
	}
}
