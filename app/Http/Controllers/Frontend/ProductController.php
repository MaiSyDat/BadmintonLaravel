<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use App\Models\products_img;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $categories = Categories::All();
        $products = Product::where('status', 1)
            ->orderByDesc('id')
            ->paginate(12);
        return view('Frontend.Product.product', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::where('status', 1)->findOrFail($id);

        $discountedProducts = Product::where('sale', '>', 20)
            ->orderByDesc('sale')
            ->limit(4)
            ->get();

        $featuredProducts = Product::orderByDesc('total_pay')
            ->limit(8)
            ->get();
        $img_product = products_img::where('product_id', $id)->get();

        return view('Frontend.Product.productDetail', compact('product', 'featuredProducts', 'discountedProducts', 'img_product'));
    }
}
