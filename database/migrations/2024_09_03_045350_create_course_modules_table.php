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
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable(); // Khóa ngoại đến bảng courses
            $table->string('title', 255); // Tiêu đề của bài học
            $table->text('content')->nullable(); // Nội dung bài học
            $table->string('video_url', 255)->nullable(); // Link video bài học
            $table->integer('video_count')->default(0); // Số lượng video trong phần học
            $table->string('download_link', 255)->nullable(); // Link tải tài liệu bài học
            $table->unsignedInteger('order')->default(0); // Thứ tự bài học
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_modules');
    }
};
