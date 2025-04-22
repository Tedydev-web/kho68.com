<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateOtherProductsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('other_products', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Tên sản phẩm
                $table->string('slug')->unique()->nullable(); // Slug tự động tạo từ name
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->nullable(); // Liên kết với bảng categories
                $table->string('thumbnail')->nullable(); // Ảnh đại diện
                $table->json('gallery')->nullable(); // Bộ sưu tập ảnh (lưu dưới dạng JSON)
                $table->string('type')->nullable(); // Loại sản phẩm
                $table->longText('description')->nullable(); // Mô tả sản phẩm
                $table->string('demo_link')->nullable(); // Link demo sản phẩm
                $table->string('download_link')->nullable(); // Link tải về sản phẩm
                $table->decimal('price', 10, 2)->nullable(); // Giá sản phẩm
                $table->integer('stock')->default(0); // Số lượng tồn kho
                $table->integer('sold_quantity')->default(0)->nullable(); // Số lượng đã bán
                $table->longText('system_requirements')->nullable(); // Yêu cầu hệ thống (nếu có)
                $table->timestamps(); // Tạo hai trường created_at và updated_at
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('other_products');
        }
    }
