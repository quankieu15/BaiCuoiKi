<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Thêm cột liên kết khách sạn ở đây (cho phép null và tự xóa liên kết nếu khách sạn bị xóa)
            $table->foreignId('hotel_id')->nullable()->constrained('hotels')->onDelete('set null');
            
            $table->string('title'); 
            $table->text('description'); 
            $table->decimal('price', 12, 2); 
            $table->string('location'); 
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};