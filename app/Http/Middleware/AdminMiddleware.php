<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['unauthorized' => 'Vui lòng đăng nhập trước!']);
        }

        $user = Auth::user();

        if ($user->phanquyen == 'admin' || $user->phanquyen == 'banhang') {
            return $next($request);
        }
        return redirect('/login')->withErrors(['unauthorized' => 'Bạn không có quyền truy cập!']);
    }
}
