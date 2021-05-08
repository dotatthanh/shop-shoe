<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Controllers\Controller;

class OrderController extends AppController
{
    public function order () {
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
                    'total' => $cart->subtotal,
                    'status' => 'order'
                ]);
                
                if (isset($cart->options)) {
                    foreach ($cart->options as $item) {
                        OrderProduct::create([
                            'order_id' => $orderCreated->id,
                            'product_id' => $cart->id,
                            'quantity' => $cart->qty,
                            'price' => $cart->price,
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
