<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hàm khởi tạo (constructor), có thể sử dụng để khai báo middleware hoặc cấu hình ban đầu.
    public function __construct()
    {
        // Ví dụ: $this->middleware('auth');
    }

    // Hàm hiển thị trang đăng nhập
    public function index()
    {
        if (Auth::id() > 0) {
            return redirect()->route('dashboard.index');
        }
        // Trả về view đăng nhập nằm trong thư mục resources/views/Backend/Auth/Login.blade.php
        return view('Backend.Auth.Login');
    }

    // Hàm xử lý đăng nhập
    public function login(AuthRequest $request)
    {
        // Thông tin xác thực
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Kiểm tra xác thực
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra nếu user không phải admin (role ≠ 1)
            if ($user->role != 0) {
                Auth::logout(); // Đăng xuất user không hợp lệ
                return redirect()->route('auth.admin')->with('error', 'Bạn không phải admin.');
            }

            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công.');
        }

        return redirect()->route('auth.admin')->with('error', 'Email hoặc mật khẩu không chính xác.');
    }

    // Hàm xử lý đăng ký
    public function register(Request $request)
    {
        return view('Backend.Auth.Register');
    }

    public function check_register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $data = $request->all('email', 'name');
        $data['password'] = bcrypt($request['password']);
        if (User::create($data)) {
            return redirect()->route('auth.admin')->with('success', 'Đăng ký thành công.');
        }
        return redirect()->route('auth.register')->with('error', 'Đăng ký thất bại.');
    }

    // Hàm xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}
