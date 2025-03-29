<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải admin
        if (!Auth::check() || Auth::user()->role != 0) {
            return redirect()->route('home.index')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request); // Cho phép tiếp tục request nếu là admin
    }
}
