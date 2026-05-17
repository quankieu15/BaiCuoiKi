<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $blueprint) {
            // Kiểm tra nếu chưa có cột location thì tự động thêm vào
            if (!Schema::hasColumn('hotels', 'location')) {
                $blueprint->string('location')->nullable()->after('name');
            }
            // Kiểm tra nếu chưa có cột description thì tự động thêm vào luôn
            if (!Schema::hasColumn('hotels', 'description')) {
                $blueprint->text('description')->nullable()->after('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['location', 'description']);
        });
    }
};