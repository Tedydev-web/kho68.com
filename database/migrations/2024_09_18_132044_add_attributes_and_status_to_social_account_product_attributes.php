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
            $table->longText('account_data')->nullable(); // Lưu mảng chuỗi dữ liệu tài khoản
            $table->enum('status', ['inactive', 'active', 'draft'])->default('inactive'); // Enum cho status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_account_product_attributes', function (Blueprint $table) {
            //
        });
    }
};
