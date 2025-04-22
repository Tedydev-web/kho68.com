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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(); // Khóa ngoại đến bảng categories
            $table->string('title', 255); // Tên khóa học
            $table->string('slug', 255)->nullable(); // Slug khóa học
            $table->text('short_description')->nullable(); // Mô tả ngắn về khóa học
            $table->text('long_description')->nullable(); // Mô tả chi tiết khóa học
            $table->decimal('price', 10, 2); // Giá khóa học
            $table->decimal('sale_price', 10, 2)->nullable(); // Giá khuyến mãi
            $table->unsignedBigInteger('image', 255)->nullable(); // Ảnh đại diện khóa học
            $table->string('instructor', 255)->nullable(); // Tên người hướng dẫn
            $table->text('duration')->nullable(); // Thời lượng khóa học (tính bằng phút hoặc giờ)
            $table->string('level', 255)->nullable(); // Cấp độ khóa học (beginner, intermediate, advanced)
            $table->integer('video_count')->default(0); // Số lượng video trong khóa học
            $table->string('download_link', 255)->nullable(); // Link tải xuống tài liệu hoặc video khóa học
            $table->string('video_url', 255)->nullable(); // URL video học (có thể là YouTube hoặc dịch vụ khác)
            $table->unsignedBigInteger('views')->default(0)->nullable(); // Lượt xem khóa học
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft'); // Trạng thái khóa học
            $table->timestamps();

            $table->foreign('image')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
