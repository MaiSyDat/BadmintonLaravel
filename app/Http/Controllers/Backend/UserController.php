<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $config = $this->config();

        $query = User::query();

        // Nếu có từ khóa tìm kiếm
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%");
            });
        }

        $users = $query->paginate(15)->withQueryString(); // giữ lại query string khi phân trang

        return view('backend.user.index', compact('config', 'users'));
    }

    // Hiển thị form thêm mới user
    public function create()
    {
        $config = $this->config();
        return view('backend.user.create', compact('config'));
    }

    // Xử lý thêm user
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
            'gender' => 'nullable|integer',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ chấp nhận ảnh
            'role' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Kiểm tra email trùng lặp
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()
                ->withErrors(['email' => 'Email đã được sử dụng. Vui lòng chọn email khác.'])
                ->withInput();
        }

        if ($request->password !== $request->confirm_password) {
            return redirect()->back()
                ->withErrors(['confirm_password' => 'Mật khẩu không giống nhau.'])
                ->withInput();
        }

        // Lấy dữ liệu từ request và mã hóa mật khẩu
        $data = $request->only([
            'name',
            'email',
            'password',
            'gender',
            'birthday',
            'phone',
            'address',
            'role',
            'status',
        ]);
        $data['password'] = Hash::make($data['password']); // Mã hóa mật khẩu

        // Kiểm tra nếu có file ảnh
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName(); // Tạo tên file duy nhất
            $file->move(public_path('backend/img/user'), $filename); // Lưu ảnh vào thư mục public/backend/img/user
            $data['img'] = 'backend/img/user/' . $filename; // Ghi đường dẫn vào database
        }

        // Tạo người dùng mới
        $user = User::create($data);

        // Kiểm tra và thông báo kết quả
        if ($user) {
            return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công.');
        } else {
            return redirect()->back()->with('error', 'Thêm người dùng thất bại.');
            // return redirect()->route('user.index')->with('error', 'Thêm người dùng thất bại.');
        }
    }

    // Hiển thị form sửa user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $config = $this->config();
        return view('backend.user.edit', compact('config', 'user'));
    }

    // Xử lý cập nhật user
    public function update(Request $request, $id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại!');
        }

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'confirm_password' => 'nullable|min:6',
            'gender' => 'nullable|integer',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Kiểm tra email trùng lặp (trừ chính user hiện tại)
        if (User::where('email', $request->email)->where('id', '!=', $id)->exists()) {
            return redirect()->back()
                ->withErrors(['email' => 'Email đã được sử dụng. Vui lòng chọn email khác.'])
                ->withInput();
        }

        // Kiểm tra xác nhận mật khẩu (nếu có nhập mật khẩu mới)
        if ($request->filled('password') && $request->password !== $request->confirm_password) {
            return redirect()->back()
                ->withErrors(['confirm_password' => 'Mật khẩu không giống nhau.'])
                ->withInput();
        }

        // Lấy dữ liệu từ request
        $data = $request->only([
            'name',
            'email',
            'gender',
            'birthday',
            'phone',
            'address',
            'role',
            'status',
        ]);

        // Nếu có mật khẩu mới, mã hóa và cập nhật
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Xử lý cập nhật ảnh đại diện nếu có upload ảnh mới
        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu tồn tại
            if (!empty($user->img) && file_exists(public_path($user->img))) {
                unlink(public_path($user->img));
            }

            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('backend/img/user'), $filename);
            $data['img'] = 'backend/img/user/' . $filename;
        }

        // Cập nhật dữ liệu cho người dùng
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công!');
    }


    // Xóa user theo id
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công!');
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
}
