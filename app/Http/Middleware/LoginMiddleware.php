<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Xử lý một yêu cầu đến.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Illuminate\Http\Request  $request - yêu cầu HTTP
     * @param  \Closure  $next - hàm closure để tiếp tục request
     * @return \Symfony\Component\HttpFoundation\Response - phản hồi HTTP
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::id() > 0) {
            // Nếu đã đăng nhập, chuyển hướng tới dashbroad.index
            return redirect()->route('dashboard.index');
        }
        // Tiếp tục xử lý yêu cầu
        return $next($request);
    }
}
