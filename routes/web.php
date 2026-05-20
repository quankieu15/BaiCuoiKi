<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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
| PUBLIC ROUTES
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
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |------------------------------------------
    | DASHBOARD ROUTER (FIX CHÍNH)
    |------------------------------------------
    */
    Route::get('/dashboard', function () {

        $user = auth()->user();
        $role = strtolower(trim($user->role));

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'partner') {
            return redirect()->route('partner.dashboard');
        }

        return redirect()->route('customer.dashboard');

    })->name('dashboard');


    /*
    |------------------------------------------
    | PROFILE (ALL USERS)
    |------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |------------------------------------------
    | CUSTOMER AREA
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
    | PARTNER AREA
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
    | ADMIN AREA
    |------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::patch('/users/{id}/role', [UserController::class, 'updateRole'])
            ->name('admin.users.updateRole');

        Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('admin.users.toggleStatus');

        Route::get('/orders', [DashboardController::class, 'orderIndex'])
            ->name('admin.orders.index');

        Route::post('/orders/{id}/approve', [DashboardController::class, 'orderApprove'])
            ->name('admin.orders.approve');

        Route::post('/orders/{id}/cancel', [DashboardController::class, 'orderCancel'])
            ->name('admin.orders.cancel');

        Route::delete('/orders/{id}', [DashboardController::class, 'orderDestroy'])
            ->name('admin.orders.destroy');

        Route::get('/reviews', [ReviewController::class, 'adminIndex'])
            ->name('admin.reviews.index');

        Route::post('/reviews/{id}/approve', [ReviewController::class, 'approve'])
            ->name('admin.reviews.approve');

        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])
            ->name('admin.reviews.destroy');

        Route::get('/feedbacks', [FeedbackController::class, 'adminIndex'])
            ->name('admin.feedbacks.index');

        Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])
            ->name('admin.feedbacks.destroy');
    });

});

require __DIR__.'/auth.php';