<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. TRANG CHỦ CÔNG CỘNG
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/service/{id}', [\App\Http\Controllers\HomeController::class, 'show'])->name('services.show');


// 2. KHU VỰC BẮT BUỘC ĐĂNG NHẬP (AUTH)
Route::middleware('auth')->group(function () {
    
    // Quản lý thông tin cá nhân chung
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === KHU VỰC CỦA KHÁCH HÀNG (Customer) ===
    Route::middleware('role:customer')->group(function () {
        // Đã gộp chuẩn: Lấy dữ liệu đơn hàng và hiển thị lịch sử
        Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'myOrders'])->name('dashboard');
        Route::post('/book/service/{id}', [\App\Http\Controllers\HomeController::class, 'book'])->name('services.book');
    });

    // === KHU VỰC CỦA ĐỐI TÁC (Partner) ===
    Route::middleware('role:partner')->prefix('partner')->group(function () {
        Route::get('/dashboard', function () {
            return view('partner-dashboard');
        })->name('partner.dashboard');

        // Quản lý danh sách dịch vụ (Tour / Khách sạn)
        Route::resource('services', \App\Http\Controllers\Partner\ServiceController::class)->names([
            'index' => 'partner.services.index',
            'create' => 'partner.services.create',
            'store' => 'partner.services.store',
            'edit' => 'partner.services.edit',
            'update' => 'partner.services.update',
            'destroy' => 'partner.services.destroy',
        ]);

        // Quản lý đơn đặt lịch (Booking) từ khách hàng đổ về
        Route::get('/orders', [\App\Http\Controllers\Partner\OrderController::class, 'index'])->name('partner.orders.index');
        Route::post('/orders/{id}/status', [\App\Http\Controllers\Partner\OrderController::class, 'updateStatus'])->name('partner.orders.status');
    });

   // === KHU VỰC CỦA ADMIN ===
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Gọi thẳng qua DashboardController để nạp các biến thống kê số liệu
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    });
});

require __DIR__.'/auth.php';