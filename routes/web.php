<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;

// ==========================================
// THƯ MỤC CÔNG CỘNG (KHÔNG CẦN ĐĂNG NHẬP)
// ==========================================
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/service/{id}', [\App\Http\Controllers\HomeController::class, 'show'])->name('services.show');

// ==========================================
// KHU VỰC BẮT BUỘC ĐĂNG NHẬP (AUTH)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // Quản lý thông tin cá nhân chung
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Xem danh sách đơn hàng công việc của Admin/Partner (Dùng chung cũ nếu có)
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // === KHU VỰC CỦA KHÁCH HÀNG (Customer) ===
    Route::middleware('role:customer')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'myOrders'])->name('dashboard');
        Route::post('/book/service/{id}', [\App\Http\Controllers\HomeController::class, 'book'])->name('services.book');
        Route::post('/services/{serviceId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('/orders/{id}/upload-proof', [\App\Http\Controllers\HomeController::class, 'uploadProof'])->name('orders.uploadProof');
    });

    // === KHU VỰC CỦA ĐỐI TÁC (Partner) ===
    Route::middleware('role:partner')->prefix('partner')->group(function () {
        // 🌟 ĐÃ FIX: Gọi sang hàm partnerDashboard trong Controller vừa sửa lúc nãy
        Route::get('/dashboard', [\App\Http\Controllers\Partner\OrderController::class, 'partnerDashboard'])->name('partner.dashboard');

        // Quản lý danh sách dịch vụ (Tour / Xe / Vé)
        Route::resource('services', \App\Http\Controllers\Partner\ServiceController::class)->names([
            'index' => 'partner.services.index',
            'create' => 'partner.services.create',
            'store' => 'partner.services.store',
            'edit' => 'partner.services.edit',
            'update' => 'partner.services.update',
            'destroy' => 'partner.services.destroy',
        ]);

        // Đơn đặt lịch (Booking) từ khách hàng đổ về của Partner
        Route::get('/orders', [\App\Http\Controllers\Partner\OrderController::class, 'index'])->name('partner.orders.index');
        Route::put('/orders/{id}/status', [\App\Http\Controllers\Partner\OrderController::class, 'updateStatus'])->name('partner.orders.updateStatus');
    });

    // === KHU VỰC CỦA ADMIN ===
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Trang chủ quản trị
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Các route quản lý và xử lý đơn đặt lịch của Admin
        Route::get('/orders', [\App\Http\Controllers\Admin\DashboardController::class, 'orderIndex'])->name('admin.orders.index');
        Route::post('/orders/{id}/approve', [\App\Http\Controllers\Admin\DashboardController::class, 'orderApprove'])->name('admin.orders.approve');
        Route::post('/orders/{id}/cancel', [\App\Http\Controllers\Admin\DashboardController::class, 'orderCancel'])->name('admin.orders.cancel');
        Route::delete('/orders/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'orderDestroy'])->name('admin.orders.destroy');
        
        // Các route quản lý và kiểm duyệt đánh giá
        Route::get('/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');
        Route::post('/reviews/{id}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
    });
}); // Dấu đóng chuẩn của group('auth')

require __DIR__.'/auth.php';