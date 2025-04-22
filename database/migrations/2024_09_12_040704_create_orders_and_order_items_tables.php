<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersAndOrderItemsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tạo bảng orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID của người dùng
            $table->decimal('total', 10, 2); // Tổng giá trị đơn hàng
            $table->string('status')->default('pending'); // Trạng thái đơn hàng (pending, processing, completed, etc.)
            $table->string('payment_method')->nullable(); // Phương thức thanh toán
            $table->timestamp('payment_date')->nullable(); // Ngày thanh toán
            $table->timestamps();

            // Thiết lập khóa ngoại cho user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

        // Tạo bảng order_items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // ID đơn hàng
            $table->unsignedBigInteger('social_account_product_id')->nullable(); // ID sản phẩm mạng xã hội
            $table->unsignedBigInteger('wordpress_product_id')->nullable(); // ID sản phẩm WordPress
            $table->unsignedBigInteger('course_product_id')->nullable(); // ID khóa học
            $table->unsignedBigInteger('attribute_id')->nullable(); // ID thuộc tính sản phẩm
            $table->unsignedBigInteger('other_product_id')->nullable(); // ID các sản phẩm khác
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->decimal('price', 10, 2); // Giá mỗi sản phẩm
            $table->decimal('subtotal', 10, 2); // Tổng tiền cho mục này (quantity * price)
            $table->timestamps();

            // Thiết lập khóa ngoại cho order_id
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
}
