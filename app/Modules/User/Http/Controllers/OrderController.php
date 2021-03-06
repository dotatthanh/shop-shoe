<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Size;
use App\Models\OrderProduct;
use App\Models\DiscountCode;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class OrderController extends AppController
{
    public function order () {
        $categories = Category::all();
        $cart = Cart::content();
        if ($cart->count() < 1) {
            return redirect()->route('home');
        }
		$total_product = Cart::count();
        $total_money = Cart::subtotal(0,",",".",".");
        $codeSale = DiscountCode::whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->first();

    	$data = [
    		'cart' => $cart,
    		'total_money' => $total_money,
    		'total_product' => $total_product,
            'categories' => $categories,
            'codeSale' => $codeSale,
    	];

		return view('user::web.order.index', $data);
	}

	public function addToCart (Request $request, $id) {
		$size = json_decode($request->size);
		$product = Product::findOrFail($id);

        if ($size->quantity == 0) {
            return redirect()->back()->with('alert-error', 'Sản phẩm đã hết hàng!');
        }

		$price = ($product->sale_price) ? $product->sale_price : $product->price;

        Cart::add([
            'id' => $id,
            'name' => $product->title,
            'qty' => 1,
            'price' => $price,
            'weight' => 0,
            'options' => [
                'size' => [
                    'name' => $size->name,
                    'id' => $size->id
                ],
                'product_id' => $product->id,
                'product_slug' => $product->slug,
            ]
        ]);

        $content = Cart::content();

        return redirect()->back()->with('alert-success', 'Đã thêm sản phẩm vào giỏ hàng!');
	}

    public function showCart() {
        $categories = Category::all();
        $carts = Cart::content();
        $total_product = Cart::count();

        $total = 0;
        foreach ($carts as $item) {
            $total += $item->qty*$item->price;
        }
        
        $data = [
            'categories' => $categories,
            'carts' => $carts,
            'total_product' => $total_product,
            'total' => $total,
        ];
        return view('user::web.cart.index', $data);
    }

    public function updateCart(Request $request, $rowId) {
        $quantity = $request->quantity;

        // SP trong gio
        $cart = Cart::get($rowId);
        // ID SP
        $product_id = $cart->id;
        // SL SP
        $quantity_product = Size::findOrFail($cart->options->size['id'])->quantity;

        if ($request->quantity > $quantity_product) {
            return response()->json([
                'code' => 400,
                'quantity_product' => $quantity_product,
            ]);
        }

        Cart::update($rowId, $quantity);

        $carts = Cart::content();
        $totalProduct = Cart::count();
        $total = 0;
        foreach ($carts as $item) {
            $total += $item->qty*$item->price;
        }
        $view = view('user::web.cart.includes.table', compact('carts', 'total'))->render();
        return response()->json([
            'code' => 200,
            'html' => $view,
            'totalProduct' => $totalProduct,
        ]);
    }

    public function removeProductInCart($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function checkout(Request $request) {
        try{
            $params = $request->all();
            DB::beginTransaction();
            $carts = Cart::content();
            $totalProduct = 0;

            foreach ($carts as $cart) {
                if (isset($params['code_sale'])) {
                    $percent = DiscountCode::where('code', $params['code_sale'])->first()->percent;
    
                    $totalProduct += $cart->price*$cart->qty - ($cart->price * $cart->qty * $percent / 100);
                } else {
                    $totalProduct += $cart->price * $cart->qty;
                }
            }

            $orderCreated = Order::create([
                'user_id' => auth()->user()->id,
                'code' => time(),
                'total' => $totalProduct,
                'status' => 'order'
            ]);

            foreach ($carts as $cart) {
                if (isset($cart->options)) {
                    OrderProduct::create([
                        'order_id' => $orderCreated->id,
                        'product_id' => $cart->id,
                        'quantity' => $cart->qty,
                        'price' => $cart->price,
                        'size_name' => $cart->options['size']['name'] 
                    ]);
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