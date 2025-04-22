<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id')->nullable(); // Khóa ngoại đến bảng categories (nếu có)
                $table->string('name', 255); // Tên sản phẩm
                $table->string('slug', 255)->nullable(); // Slug sản phẩm
                $table->text('short_content')->nullable(); // Mô tả ngắn sản phẩm
                $table->text('long_content')->nullable(); // Mô tả dài sản phẩm
                $table->decimal('price', 10, 2)->nullable(); // Giá sản phẩm
                $table->decimal('sale_price', 10, 2)->nullable(); // Giá khuyến mãi
                $table->integer('stock')->unsigned()->nullable(); // Số lượng tồn kho
                $table->string('type')->nullable(); // Loại sản phẩm
                $table->enum('status', ['active', 'inactive', 'draft'])->default('active'); // Trạng thái sản phẩm
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('products');
        }
    };
