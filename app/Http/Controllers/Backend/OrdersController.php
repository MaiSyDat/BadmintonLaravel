<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function index()
    {
        $orders = Orders::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('Backend.Orders.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show($id)
    {
        $order = Orders::with(['details.product', 'user'])->findOrFail($id);
        return view('Backend.Orders.show', compact('order'));
    }

    // Cập nhật trạng thái giao hàng
    public function updateTransport(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->status_transport = $request->status_transport;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái giao hàng thành công!');
    }
}
