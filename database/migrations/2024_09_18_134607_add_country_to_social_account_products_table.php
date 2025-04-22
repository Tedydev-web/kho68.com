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
            $table->string('country')->nullable()->after('data_account'); // Thêm cột country sau cột data_account
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_account_products', function (Blueprint $table) {
            $table->dropColumn('country'); 
        });
    }
};
