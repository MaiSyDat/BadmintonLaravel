<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product, Cart $cart)
    {
        $quantity = (int)$request->input('quantity', 1);
        $cart->add($product, $quantity);

        if ($request->input('action') === 'buy_now') {
            return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm và chuyển đến giỏ hàng');
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    public function index()
    {
        $cart = new Cart();
        return view('Frontend.Cart.index', compact('cart'));
    }

    public function updateCart($id, $quantity)
    {
        $cart = new Cart();

        if (isset($cart->items[$id])) {
            if ($quantity > 0) {
                $cart->items[$id]->quantity = $quantity;
            } else {
                unset($cart->items[$id]);
            }

            session(['cart' => $cart->items]);
        }

        return redirect()->back();
    }

    public function deleteCart($id, Cart $cart)
    {
        $cart->delete($id);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công');
    }
}
