<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('hotel_service', function (Blueprint $table) {
        $table->id();
        
        // Tạo khóa ngoại kết nối sang bảng services (Tour)
        // Nếu Tour bị xóa, các dòng liên kết của Tour đó trong bảng này cũng tự động xóa theo (onDelete cascade)
        $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
        
        // Tạo khóa ngoại kết nối sang bảng hotels (Khách sạn)
        // Nếu Khách sạn bị xóa, liên kết cũng tự động biến mất theo
        $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_service');
    }
};
