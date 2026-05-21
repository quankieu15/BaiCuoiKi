<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Partner\OrderController as PartnerOrderController;
use App\Http\Controllers\Partner\ServiceController as PartnerServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Khu vực không cần đăng nhập)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service/{id}', [HomeController::class, 'show'])->name('services.show');

Route::get('/tin-tuc', [PageController::class, 'tintuc'])->name('pages.tintuc');
Route::get('/gioi-thieu', [PageController::class, 'gioithieu'])->name('pages.gioithieu');
Route::get('/lien-he', [PageController::class, 'lienhe'])->name('pages.lienhe');

Route::post('/lien-he/send', [FeedbackController::class, 'store'])->name('pages.lienhe.send');


/*
|--------------------------------------------------------------------------
| 2. AUTH ROUTES (Bắt buộc phải đăng nhập)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |------------------------------------------
    | TRỌNG TÀI ĐIỀU HƯỚNG TRUNG GIAN (Xử lý đa năng)
    |------------------------------------------
    | Khi vào link '/dashboard', hệ thống tự bốc View tương ứng ra hiển thị 
    | mà không cần redirect lòng vòng, tránh triệt để lỗi đá văng Session.
    */
  Route::get('/dashboard', function () {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        if ($role === 'admin') {
            // Đổi từ app()->orderIndex() thành REDIRECT sang trang orders của admin
            return redirect()->route('admin.orders.index');
        }

        if ($role === 'partner') {
            // Đổi thành REDIRECT sang trang dashboard của partner
            return redirect()->route('partner.dashboard');
        }

        // Mặc định là khách hàng
        return redirect()->route('customer.dashboard');
    })->name('dashboard');


    /*
    |------------------------------------------
    | PROFILE (Dùng chung cho tất cả tài khoản)
    |------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |------------------------------------------
    | CUSTOMER AREA (Phân hệ Khách hàng)
    |------------------------------------------
    */
    Route::middleware('role:customer')->group(function () {

        Route::get('/dashboard/customer', [OrderController::class, 'userOrders'])
            ->name('customer.dashboard');

        Route::post('/orders/{id}/upload-proof', [OrderController::class, 'uploadProof'])
            ->name('orders.uploadProof');

        Route::post('/book/service/{id}', [HomeController::class, 'book'])
            ->name('services.book');

        Route::post('/services/{serviceId}/reviews', [ReviewController::class, 'store'])
            ->name('reviews.store');
    });


    /*
    |------------------------------------------
    | PARTNER AREA (Phân hệ Đối tác)
    |------------------------------------------
    */
    Route::middleware('role:partner')->prefix('partner')->group(function () {

        Route::get('/dashboard', [PartnerOrderController::class, 'partnerDashboard'])
            ->name('partner.dashboard');

        Route::delete('/services/bulk-delete', [PartnerServiceController::class, 'bulkDelete'])
            ->name('partner.services.bulkDelete');

        Route::resource('services', PartnerServiceController::class)->names([
            'index' => 'partner.services.index',
            'create' => 'partner.services.create',
            'store' => 'partner.services.store',
            'edit' => 'partner.services.edit',
            'update' => 'partner.services.update',
            'destroy' => 'partner.services.destroy',
        ]);

        Route::get('/orders', [PartnerOrderController::class, 'index'])
            ->name('partner.orders.index');

        Route::put('/orders/{id}/status', [PartnerOrderController::class, 'updateStatus'])
            ->name('partner.orders.updateStatus');

        Route::get('/feedbacks', [FeedbackController::class, 'partnerIndex'])
            ->name('partner.feedbacks.index');

        Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])
            ->name('partner.feedbacks.destroy');
    });


    /*
    |------------------------------------------
    | ADMIN AREA (Phân hệ Quản trị viên tối cao)
    |------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
Route::post('/reviews/{id}/toggle', [ReviewController::class, 'toggle'])
    ->name('admin.reviews.toggle');
        // Trang tổng quan chung của Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // Quản lý Đặt lịch/Đơn hàng (Trang này chứa file Blade mà ông vừa gửi)
        Route::get('/orders', [DashboardController::class, 'orderIndex'])
            ->name('admin.orders.index');

        Route::post('/orders/{id}/approve', [DashboardController::class, 'orderApprove'])
            ->name('admin.orders.approve');

        Route::post('/orders/{id}/cancel', [DashboardController::class, 'orderCancel'])
            ->name('admin.orders.cancel');

        Route::delete('/orders/{id}', [DashboardController::class, 'orderDestroy'])
            ->name('admin.orders.destroy');

        // Quản lý Thành viên/Người dùng
        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::patch('/users/{id}/role', [UserController::class, 'updateRole'])
            ->name('admin.users.updateRole');

        Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('admin.users.toggleStatus');

        // Kiểm duyệt Đánh giá của khách hàng
        Route::get('/reviews', [ReviewController::class, 'adminIndex'])
            ->name('admin.reviews.index');

        Route::post('/reviews/{id}/approve', [ReviewController::class, 'approve'])
            ->name('admin.reviews.approve');

        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])
            ->name('admin.reviews.destroy');

        // Quản lý Góp ý liên hệ
        Route::get('/feedbacks', [FeedbackController::class, 'adminIndex'])
            ->name('admin.feedbacks.index');

        Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])
            ->name('admin.feedbacks.destroy');
    });

});

require __DIR__.'/auth.php';