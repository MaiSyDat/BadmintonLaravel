<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\orders_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cart = new Cart();
        return view('Frontend.Checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        $user = Auth::user();
        if (!$user->phone || !$user->address || !$user->name) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
            ], [
                'name.required' => 'Vui lòng nhập họ tên.',
                'email.required' => 'Vui lòng nhập email.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'address.required' => 'Vui lòng nhập địa chỉ.',
            ]);
        }

        // Cập nhật thông tin người dùng nếu thiếu
        if (!$user->phone || !$user->address || !$user->name) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);
        }

        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalQuantity += $item->quantity;
            $totalPrice += $item->quantity * $item->price;
        }

        $order = orders::create([
            'user_id' => $user->id,
            'note' => $request->input('note'),
            'total_quantity' => $totalQuantity,
            'status_payment' => 0,
            'status_transport' => 0,
            'total_discount' => 0,
            'total_price' => $totalPrice,
        ]);

        foreach ($cart as $productId => $item) {
            orders_detail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'status' => 0,
                'quantity' => $item->quantity,
                'total_price' => $item->quantity * $item->price,
            ]);

            $product = Product::find($productId);
            if ($product) {
                $product->increment('total_pay', $item->quantity);
            }
        }

        DB::commit();
        session()->forget('cart');

        return redirect()->route('checkout.success', ['id' => $order->id])
            ->with('success', 'Đặt hàng thành công!');
    }


    public function showOrder($id)
    {
        $order = orders::with(['details.product'])->findOrFail($id);

        return view('Frontend.Checkout.success', compact('order'));
    }
}
