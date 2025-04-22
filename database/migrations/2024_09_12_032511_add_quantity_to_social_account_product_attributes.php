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
        Schema::table('social_account_product_attributes', function (Blueprint $table) {
            $table->integer('quantity')->default(0); // Thêm cột quantity với giá trị mặc định là 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_account_product_attributes', function (Blueprint $table) {
            $table->dropColumn('quantity'); // Xóa cột quantity nếu rollback

        });
    }
};
