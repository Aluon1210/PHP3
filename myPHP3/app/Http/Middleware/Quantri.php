<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Quantri
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || (string) (Auth::user()->role ?? 'user') !== 'admin') {
            return redirect('/dang-nhap')->withErrors(['email' => 'Bạn không có quyền truy cập trang quản trị.']);
        }
        return $next($request);
    }
}