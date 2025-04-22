<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void
        {
            Schema::create('category_social_account_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->nullable();
                $table->foreignId('social_account_product_id')->constrained('social_account_products', 'id', 'fk_category_social_product')->onDelete('cascade')->nullable(); // Tên constraint ngắn hơn
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('category_social_account_product');
        }
    };
