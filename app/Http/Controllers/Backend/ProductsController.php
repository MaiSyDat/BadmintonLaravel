<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(15);
        $config = $this->config();
        $products = Product::with('category')->get();
        return view('backend.products.index', compact(
            'config',
            'products'
        ));
    }

    private function config()
    {
        return [
            'js' => [
                "backend/vendor/jquery/jquery.min.js",
                "backend/vendor/bootstrap/js/bootstrap.bundle.min.js",
                "backend/vendor/jquery-easing/jquery.easing.min.js",
                "backend/js/sb-admin-2.min.js",
                "backend/vendor/chart.js/Chart.min.js",
                "backend/js/demo/chart-area-demo.js",
                "backend/js/demo/chart-pie-demo.js",
            ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Categories::all();
        $config = $this->config();
        return view('backend.products.create', compact('config', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'sale' => 'nullable|integer',
            'hot' => 'nullable|integer',
            'description' => 'required|string',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories_id' => 'required|exists:categories,id',
        ]);

        // Xử lý ảnh
        $imagePath = null;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'backend/img/products/' . $imageName;
            $image->move(public_path('backend/img/products'), $imageName);
        }

        // Lưu sản phẩm vào database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'hot' => $request->hot ?? 0,
            'description' => $request->description,
            'content' => $request->content,
            'img' => $imagePath,
            'status' => $request->status ?? 1,
            'total_pay' => 0,
            'categories_id' => $request->categories_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Lấy sản phẩm theo ID
        $categories = Categories::all();
        $config = $this->config();

        return view('backend.products.edit', compact('product', 'categories', 'config'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'sale' => 'nullable|integer',
            'hot' => 'nullable|integer',
            'description' => 'required|string',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories_id' => 'required|exists:categories,id',
        ]);

        // Xử lý ảnh mới nếu có upload
        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->img && file_exists(public_path($product->img))) {
                unlink(public_path($product->img));
            }

            // Lưu ảnh mới
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'backend/img/products/' . $imageName;
            $image->move(public_path('backend/img/products'), $imageName);

            $product->img = $imagePath;
        }

        // Cập nhật thông tin sản phẩm
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'hot' => $request->hot ?? 0,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->status ?? 1,
            'categories_id' => $request->categories_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        //
        $products = Product::find($id);
        $products->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
