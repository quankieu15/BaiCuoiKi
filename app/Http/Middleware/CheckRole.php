<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kiểm tra nếu chưa đăng nhập hoặc quyền không khớp với danh sách được phép
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
        }

        return $next($request);
    }
}