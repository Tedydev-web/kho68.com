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
        Schema::table('social_account_products', function (Blueprint $table) {
            $table->dropForeign(['social_account_id']); // Xóa khóa ngoại
            $table->dropColumn('social_account_id'); // Xóa cột
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_account_products', function (Blueprint $table) {
            $table->foreignId('social_account_id')->constrained('social_accounts')->onDelete('cascade')->nullable(); // Thêm lại cột và khóa ngoại nếu rollback
        });
    }
};
