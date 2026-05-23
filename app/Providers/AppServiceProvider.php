<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan; // Thêm dòng này để gọi được lệnh Artisan

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tự động tạo bảng dữ liệu khi ứng dụng chạy trên Render (Production)
        if (config('app.env') === 'production') {
            try {
                Artisan::call('migrate', ['--force' => true]);
                
                // Nếu dự án cần chạy Seeder mẫu thì bỏ comment dòng dưới này nhé:
                // Artisan::call('db:seed', ['--force' => true]);
                
            } catch (\Exception $e) {
                // Ghi log lại nếu có lỗi xảy ra để không làm sập giao diện web
                \Log::error("Auto-migrate failed: " . $e->getMessage());
            }
        }
    }
}