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
        Schema::create('social_account_products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tiêu đề sản phẩm
            $table->string('slug')->nullable(); // Slug sản phẩm
            $table->string('thumbnail')->nullable(); // Đường dẫn ảnh đại diện
            $table->integer('stock')->default(0); // Tồn kho
            $table->integer('sold')->default(0); // Đã bán
            $table->decimal('price', 10, 2)->nullable(); // Giá sản phẩm
            $table->text('short_content')->nullable(); // Nội dung ngắn gọn mô tả sản phẩm
            $table->longText('long_content')->nullable(); // Nội dung chi tiết sản phẩm
            $table->longText('data_account')->nullable(); // Nội dung chi tiết sản phẩm
            $table->timestamps();

            $table->foreignId('social_account_id')->constrained('social_accounts')->onDelete('cascade')->nullable(); // Khóa ngoại liên kết với social_accounts
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_account_products');
    }
};
