<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use App\Models\products_img;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Product::with('category');

        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%");
            });
        }

        $products = $query->paginate(15)->withQueryString();
        $config = $this->config();

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
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'sale' => 'nullable|integer',
            'hot' => 'nullable|integer',
            'description' => 'required|string',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Chỉ 1 ảnh đại diện
            'categories_id' => 'required|exists:categories,id',
            'detail_imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Nhiều ảnh chi tiết
        ]);

        // Xử lý ảnh đại diện
        $thumbnail = null;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = $image->getClientOriginalName();
            $thumbnail = 'backend/img/products/' . $imageName;
            $image->move(public_path('backend/img/products'), $imageName);
        }

        // Tạo sản phẩm trong database
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'hot' => $request->hot ?? 0,
            'description' => $request->description,
            'content' => $request->content,
            'img' => $thumbnail,
            'status' => $request->status ?? 1,
            'total_pay' => 0,
            'categories_id' => $request->categories_id,
        ]);

        if (!$product) {
            return back()->with('error', 'Lưu sản phẩm thất bại!');
        }

        // Xử lý ảnh chi tiết
        if ($request->hasFile('detail_imgs')) {
            foreach ($request->file('detail_imgs') as $image) {
                $imageName = $image->getClientOriginalName();
                $imagePath = 'backend/img/products/details/' . $imageName;
                $image->move(public_path('backend/img/products/details'), $imageName);

                // Lưu vào bảng `products_imgs`
                products_img::create([
                    'product_id' => $product->id,
                    'name' => basename($imagePath),
                    'path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Lấy sản phẩm theo ID
        $categories = Categories::all();
        $config = $this->config();

        // Lấy danh sách ảnh chi tiết của sản phẩm
        $productImages = products_img::where('product_id', $id)->get();
        return view('backend.products.edit', compact('product', 'categories', 'config', 'productImages'));
    }

    /**
     * Update sản phẩm có nhiều ảnh
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
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categories_id' => 'required|exists:categories,id',
            'detail_imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // XÓA ẢNH CHI TIẾT ĐƯỢC CHỌN XÓA**
        if ($request->has('deleted_images')) {
            $deletedImages = explode(',', $request->deleted_images);

            foreach ($deletedImages as $imageId) {
                $image = products_img::find($imageId);

                if ($image) {
                    $imagePath = public_path($image->path);

                    // Kiểm tra xem path có tồn tại và là file không
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        try {
                            unlink($imagePath);
                        } catch (\Exception $e) {
                            \Log::error("Không thể xóa ảnh: " . $imagePath . " - " . $e->getMessage());
                        }
                    }

                    $image->delete();
                }
            }
        }

        // CẬP NHẬT ẢNH ĐẠI DIỆN (NẾU CÓ)**
        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu có
            if ($product->img && file_exists(public_path($product->img))) {
                unlink(public_path($product->img));
            }

            // Lưu ảnh mới
            $imageName = $request->img->getClientOriginalName();
            $request->img->move(public_path('backend/img/products'), $imageName);
            $product->img = 'backend/img/products/' . $imageName;
        }

        // CẬP NHẬT SẢN PHẨM**
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'hot' => $request->hot ?? 0,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->status ?? 1,
            'categories_id' => $request->categories_id,
            'img' => $product->img,
        ]);

        // THÊM ẢNH CHI TIẾT (NẾU CÓ)**
        if ($request->hasFile('detail_imgs')) {
            foreach ($request->file('detail_imgs') as $detail_img) {
                $detailImageName = $detail_img->getClientOriginalName();
                $detail_img->move(public_path('backend/img/products/details'), $detailImageName);

                // Thêm ảnh chi tiết vào bảng `products_imgs`
                products_img::create([
                    'product_id' => $product->id,
                    'name' => $detailImageName, // Cung cấp giá trị cho trường `name`
                    'path' => 'backend/img/products/details/' . $detailImageName,
                ]);
            }
        }


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
