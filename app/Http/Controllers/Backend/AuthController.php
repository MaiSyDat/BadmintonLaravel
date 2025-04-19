<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;

class AuthController extends Controller
{
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
            return redirect()->intended('/user')->with('success', 'Đăng nhập thành công.');
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
        ], [
            'email.unique' => 'Email này đã được sử dụng!',
            'email.required' => 'Vui lòng nhập email.',
            'name.required' => 'Vui lòng nhập tên.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp.',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu.',
        ]);


        $data = $request->only(['email', 'name']);
        $data['password'] = bcrypt($request->password);

        if ($acc = User::create($data)) {
            FacadesMail::to($acc->email)->send(new VerifyAccount($acc));
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
        return redirect()->route('auth.admin');
    }

    public function showChangePasswordForm()
    {
        return view('Backend.Auth.chanePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới phải từ 6 ký tự',
            'new_password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        // Lưu mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công');
    }

    public function showForgotPasswordForm()
    {
        return view('Backend.Auth.forgotPassword');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        ], [
            'email.exists' => 'Email này chưa đăng ký tài khoản!'
        ]);

        $user = User::where('email', $request->email)->first();
        $token = \Str::random(40);
        PasswordResetToken::where('email', $request->email)->delete();

        $tokenData = [
            'email' => $request->email,
            'token' => $token,
        ];

        if (PasswordResetToken::create($tokenData)) {
            FacadesMail::to($request->email)->send(new ForgotPassword($user, $token));
            return redirect()->route('auth.admin')->with('success', 'Vui lòng kiểm tra email để lấy lại mật khẩu.');
        }
        return redirect()->back()->with('error', 'Vui lòng thử lại.');
    }

    public function showResetPasswordForm($token)
    {
        $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();
        $email = $tokenData->email;

        return view('Backend.Auth.resetPassword', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|exists:password_reset_tokens,token',
            'password' => 'required|confirmed|min:6',
        ], [
            'email.exists' => 'Email này không tồn tại!',
            'token.exists' => 'Token không hợp lệ!',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp!',
        ]);

        $tokenData = PasswordResetToken::where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (!$tokenData) {
            return redirect()->back()->with('error', 'Token hoặc email không hợp lệ.');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('auth.admin')->with('success', 'Đổi mật khẩu thành công.');
    }
}
