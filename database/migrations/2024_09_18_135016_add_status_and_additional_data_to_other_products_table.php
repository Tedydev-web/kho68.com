<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('other_products', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Thêm cột status với giá trị mặc định là 'inactive'
            $table->longText('additional_data')->nullable(); // Thêm cột additional_data dạng longText
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('other_products', function (Blueprint $table) {
            $table->dropColumn('status'); // Xóa cột status nếu rollback
            $table->dropColumn('additional_data'); // Xóa cột additional_data nếu rollback
        });
    }
};
