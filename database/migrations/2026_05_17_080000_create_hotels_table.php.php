<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên khách sạn
            $table->string('address'); // Địa chỉ
            $table->text('description')->nullable(); // Mô tả khách sạn
            $table->string('image')->nullable(); // Ảnh đại diện khách sạn
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};