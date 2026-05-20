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
        // 1. Chưa đăng nhập thì tiễn về trang login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // 🚀 2. BẢO HIỂM CHÉO (QUAN TRỌNG NHẤT): 
        // Nếu user đăng nhập thực tế trong DB là 'admin' nhưng đang bị hệ thống đẩy lạc sang các route khác (không có tiền tố admin)
        if ($user->role === 'admin' && !$request->is('admin*')) {
            return redirect()->route('admin.dashboard');
        }

        // Tương tự cho partner nếu đi lạc
        if ($user->role === 'partner' && !$request->is('partner*')) {
            return redirect()->route('partner.dashboard');
        }

        // 3. Nếu đang đi đúng khu vực của mình (Ví dụ: Admin vào route 'admin/*') -> Cho qua cửa!
        if ($user->role === $role) {
            return $next($request);
        }

        // 4. Nếu cố tình vào khu vực của người khác mà không đúng phận sự -> Chặn đứng 403
        abort(403, 'Bạn không có quyền truy cập vào khu vực này.');
    }
}