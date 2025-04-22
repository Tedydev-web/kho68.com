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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('discount_code')->nullable(); // Mã giảm giá đang áp dụng
            $table->decimal('discount_amount', 10, 2)->default(0); // Số tiền giảm giá
            $table->string('discount_type')->nullable(); // Loại giảm giá (phần trăm/cố định)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['discount_code', 'discount_amount', 'discount_type']);

        });
    }
};
