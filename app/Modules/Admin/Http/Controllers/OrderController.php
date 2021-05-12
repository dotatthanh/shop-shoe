<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Size;
use App\Models\OrderProduct;
use App\Http\Controllers\Controller;

class OrderController extends AppController
{
    public function index(Request $request)
    {
        $orders = Order::with('user', 'order_products', 'order_products.product')->paginate(10);

        if ($request->search) {
            $orders = Order::join('users', 'users.id', 'orders.user_id')
                ->where('total', 'like', '%'.$request->search.'%')
                ->orWhere('users.name', 'like', '%'.$request->search.'%')
                ->orWhere('users.phone', 'like', '%'.$request->search.'%')
                ->orWhere('users.address', 'like', '%'.$request->search.'%')
                ->paginate(10);
        }

        $data = [
            'orders' => $orders,
            'search' => $request->search,
        ];

        return view ('admin::order.index', $data);
    }

    public function destroy($id)
    {
        Order::destroy($id);

        return redirect()->route('admin.order.index')->with('alert-success', 'Xóa đơn hàng thành công!');
    }

    public function changeStatus(Request $request, $order_id) {
        $order = Order::findOrFail($order_id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'code' => 200,
            'message' => 'success',
        ]);
    }

    public function cancel($order_id) {
        $order = Order::findOrFail($order_id);
        $orderProducts  = OrderProduct::where('order_id', $order_id)->get()->toArray();
        $order->status = 'cancel';
        $order->save();

        foreach ($orderProducts as $product) {
            $size = Size::where('name', $product['size_name'])->first();
            $incrementQuantity = (int)$size->quantity + (int)$product['quantity'];

            $size->update([
                'quantity' => $incrementQuantity
            ]); 
        }

        return redirect()->route('admin.order.index')->with('alert-success', 'Hủy đơn hàng thành công!');
    }
}
