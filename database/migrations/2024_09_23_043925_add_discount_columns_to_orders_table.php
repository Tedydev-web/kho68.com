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
            $table->decimal('discount_amount', 8, 2)->nullable(); // Số tiền giảm
            $table->string('discount_code')->nullable(); // Mã giảm giá
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable(); // Loại giảm giá
            $table->decimal('total_after_discount', 10, 2)->nullable(); // Tổng sau giảm giá
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['discount_amount', 'discount_code', 'discount_type', 'total_after_discount']);
        });
    }
};
