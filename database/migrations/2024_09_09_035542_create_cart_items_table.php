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
            Schema::create('cart_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade')->nullable(); // Khóa ngoại đến bảng carts
                $table->foreignId('wordpress_product_id')->constrained('wordpress_products')->onDelete('cascade')->nullable();
                $table->foreignId('social_account_product_id')->constrained('social_account_products')->onDelete('cascade')->nullable();
                $table->foreignId('course_product_id')->constrained('courses')->onDelete('cascade')->nullable();
                $table->foreignId('other_product_id')->constrained('other_products')->onDelete('cascade')->nullable();
                $table->integer('quantity')->unsigned(); // Số lượng sản phẩm
                $table->decimal('price', 10, 2)->nullable();  // Giá sản phẩm
                $table->decimal('subtotal', 10, 2)->storedAs('quantity * price'); // Tổng giá cho mỗi sản phẩm
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('cart_items');
        }
    };
