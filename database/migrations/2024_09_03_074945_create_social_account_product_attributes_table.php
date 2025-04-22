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
        Schema::create('social_account_product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('social_product_id')->constrained('social_account_products')->onDelete('cascade')->nullable(); // Khóa ngoại liên kết với bảng social_products
            $table->string('attribute_name'); // Tên thuộc tính (VD: "Đã nuôi 1 năm")
            $table->decimal('additional_price', 10, 2)->default(0); // Giá tiền phụ thêm cho thuộc tính này
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_account_product_attributes');
    }
};
