<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Mail\VerifyAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Mail;

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
            return redirect()->route('home.index');
        }
        return view('Backend.Auth.Login');
    }

    // Hàm xử lý đăng nhập
    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index')->with('success', 'Đăng nhập thành công.');
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
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $data = $request->only(['email', 'name']);
        $data['password'] = bcrypt($request->password);

        if ($acc = User::create($data)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('auth.admin')->with('success', 'Vui lòng kiểm tra email để xác thực tài khoản.');
        }
        return redirect()->route('auth.register')->with('error', 'Đăng ký thất bại.');
    }

    public function verify($email)
    {
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => now()]);
        return redirect()->route('auth.admin')->with('success', 'Đăng ký thành công.');
    }


    // Hàm xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index');
    }
}
