<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Http\Controllers\Controller;

class OrderController extends AppController
{
    public function index(Request $request)
    {
        $orders = Order::with('user', 'order_products', 'order_products.product')->paginate(PAGE_LIMIT);

        if ($request->search) {
            $orders = Order::where('total', 'like', '%'.$request->search.'%')->paginate(PAGE_LIMIT);
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
        $order->status = 'cancel';
        $order->save();

        return redirect()->route('admin.order.index')->with('alert-success', 'Hủy đơn hàng thành công!');
    }
}
