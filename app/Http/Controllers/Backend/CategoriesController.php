<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::paginate(15);
        $config = $this->config();

        return view('backend.categories.index', compact(
            'config',
            'categories'
        ));
    }

    private function config()
    {
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                "backend/vendor/jquery/jquery.min.js",
                "backend/vendor/bootstrap/js/bootstrap.bundle.min.js",
                "backend/vendor/jquery-easing/jquery.easing.min.js",
                "backend/js/sb-admin-2.min.js",
                "backend/vendor/chart.js/Chart.min.js",
                "backend/js/demo/chart-area-demo.js",
                "backend/js/demo/chart-pie-demo.js",
                "backend/vendor/datatables/jquery.dataTables.min.js",
                "backend/vendor/datatables/dataTables.bootstrap4.min.js",
                "backend/s/demo/datatables-demo.js",
            ],

            'css' => [
                'backend/css/plugins/switchery/switchery.css'
            ]
        ];
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $config = $this->config();
        return view('backend.categories.create', compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);


        // Lấy dữ liệu từ request và mã hóa mật khẩu
        $data = $request->only([
            'name',
            'status',
        ]);

        // Tạo mới
        $categories = Categories::create($data);

        // Kiểm tra và thông báo kết quả
        if ($categories) {
            return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công.');
        } else {
            return redirect()->back()->with('error', 'Thêm danh mục thất bại.');
            // return redirect()->route('categories.index')->with('error', 'Thêm người dùng thất bại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $Categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categories = Categories::findOrFail($id);
        $config = $this->config();
        return view('backend.categories.edit', compact('config', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $Categories, $id)
    {
        //
        $categories = Categories::find($id);
        if (!$categories) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $data = $request->only([
            'name',
            'status',
        ]);
        $categories->update($data);
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $Categories, $id)
    {
        //
        $categories = Categories::find($id);
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
    }
}
