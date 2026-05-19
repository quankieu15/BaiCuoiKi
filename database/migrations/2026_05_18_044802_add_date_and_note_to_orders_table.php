<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->date('booking_date')->nullable()->after('quantity'); // Cột ngày đặt
        $table->text('note')->nullable()->after('status');           // Cột ghi chú khách hàng
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['booking_date', 'note']);
    });
}
};
