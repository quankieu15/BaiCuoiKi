<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    // Đổi ...$roles thành $role (nhận đích danh 1 chuỗi quyền)
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Kiểm tra nếu chưa đăng nhập hoặc role trong DB khác với role yêu cầu ở Route
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
        }

        return $next($request);
    }
}