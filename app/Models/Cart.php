<?php

namespace App\Models;

class Cart
{
    public $items = [];
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct()
    {
        $this->items = session('cart') ? session('cart') : [];
        $this->totalQuantity = $this->getTotalQuantity();
        $this->totalPrice = $this->getTotalPrice();
    }

    public function add($product, $quantity = 1)
    {
        if (isset($this->items[$product->id])) {
            $this->items[$product->id]->quantity += $quantity; // Cộng thêm số lượng được chọn
        } else {
            $cart_Item = (object) [
                'id' => $product->id,
                'img' => $product->img,
                'name' => $product->name,
                'price' => $product->getDiscountedPrice(),
                'quantity' => $quantity,
            ];
            $this->items[$product->id] = $cart_Item;
        }

        $this->totalQuantity = $this->getTotalQuantity();
        $this->totalPrice = $this->getTotalPrice();

        session(['cart' => $this->items]);
    }


    public function update() {}

    public function delete($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            session(['cart' => $this->items]);
        }
    }

    public function clear() {}

    private function getTotalPrice()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }

    private function getTotalQuantity()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->quantity;
        }
        return $total;
    }
}
