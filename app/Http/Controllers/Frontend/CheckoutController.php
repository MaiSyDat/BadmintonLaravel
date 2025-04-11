<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\orders;
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

        try {
            $totalQuantity = 0;
            $totalPrice = 0;

            foreach ($cart as $item) {
                $totalQuantity += $item->quantity;
                $totalPrice += $item->quantity * $item->price;
            }

            $order = orders::create([
                'user_id' => Auth::id(),
                'note' => $request->input('note'),
                'total_quantity' => $totalQuantity,
                'status_payment' => 0,
                'status_transport' => 0,
                'total_discount' => 0,
                'total_price' => $totalPrice,
            ]);

            foreach ($cart as $productId => $item) {
                // Tạo chi tiết đơn hàng
                orders_detail::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'status' => 0,
                    'quantity' => $item->quantity,
                    'total_price' => $item->quantity * $item->price,
                ]);

                // Cập nhật total_pay cho sản phẩm
                $product = Product::find($productId);
                if ($product) {
                    $product->increment('total_pay', $item->quantity);
                }
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('checkout.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
