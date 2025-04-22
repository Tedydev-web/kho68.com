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
        Schema::create('wordpress_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(); // Khóa ngoại đến bảng categories (nếu có)
            $table->string('name', 255); // Tên sản phẩm
            $table->string('slug', 255)->nullable(); // Slug sản phẩm
            $table->string('image', 255)->nullable(); // Ẩnh đại diện
            $table->json('gallery')->nullable(); // Album hình ảnh (dạng JSON)
            $table->string('sku', 255)->unique()->nullable(); // Mã sản phẩm
            $table->string('type', 255)->nullable(); // Loại sản phẩm (Plugin/Theme/...)
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft'); // Trạng thái sản phẩm
            $table->text('version')->nullable(); // Version sản phẩm
            $table->text('short_content')->nullable(); // Mô tả ngắn sản phẩm
            $table->text('long_content')->nullable(); // Mô tả dài sản phẩm
            $table->decimal('price', 10, 2)->nullable(); // Giá sản phẩm
            $table->decimal('sale_price', 10, 2)->nullable(); // Giá khuyến mãi
            $table->string('sold', 255)->nullable(); // Số lượng đã bán
            $table->string('demo', 255)->nullable(); // Link demo sản phẩm
            $table->string('download_link', 255)->nullable(); // Link tải xuống sản phẩm
            $table->string('system_requirements', 255)->nullable(); // Yêu cầu hệ thống
            $table->string('license_key', 255)->nullable(); // Mã license sản phẩm
            $table->date('license_expiration_date')->nullable(); // Ngày hết hạn license
            $table->unsignedBigInteger('views')->default(0); // Lượt xem sản phẩm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wordpress_products');
    }
};
