<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Nếu chưa đăng nhập -> Tiễn khách về trang login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // 2. KIỂM TRA QUYỀN TRUY CẬP: 
        // Nếu Role của User trong DB trùng khớp với Role yêu cầu của Route -> Cho qua cửa!
        if ($user->role === $role) {
            return $next($request);
        }

        // 3. Nếu cố tình râu ông nọ cắm cằm bà kia (Admin vào Customer hoặc ngược lại) -> Chặn đứng 403 luôn
        abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
    }
}