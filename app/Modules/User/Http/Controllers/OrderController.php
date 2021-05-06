<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderAddress;
use App\Http\Controllers\Controller;

class OrderController extends AppController
{
    public function pageOrder () {
        $cart = Cart::content();
        if ($cart->count() < 1) {
            return redirect()->route('home');
        }
		$total_product = Cart::count();
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
                'size' => [
                    'id' => $size->id,
                    'name' => $size->name
                ]
            ]
        ]);

        $content = Cart::content();

        return redirect()->back();
	}

    public function checkout(Request $request) {
        try{
            $params = $request->all();
            DB::beginTransaction();
            $carts = Cart::content();

            foreach ($carts as $cart) {
                $orderCreated = Order::create([
                    'user_id' => auth()->user()->id,
                    'code' => 0,
                    'fee_ship' => 0,
                    'total' => $cart->subtotal,
                    'status' => 'order'
                ]);
        
                OrderAddress::create([
                    'order_id' => $orderCreated->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->phone,
                    'address' => auth()->user()->address
                ]);
                
                if (isset($cart->options)) {
                    foreach ($cart->options as $item) {
                        OrderProduct::create([
                            'order_id' => $orderCreated->id,
                            'product_id' => $cart->id,
                            'quantity' => $cart->qty,
                            'price' => $cart->price,
                            'size_id' => $cart->options['size']['id'],
                            'size_name' => $cart->options['size']['name'] 
                        ]);
                    }
                }
            }
            DB::commit();
            Cart::destroy();
            return redirect()->route('home')->with('alert-success', 'Bạn đã đặt hàng thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-danger','Mua hàng thất bại!');
        }
        
    }
}
