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
        Schema::table('website_settings', function (Blueprint $table) {
            $table->integer('download_limit')->default(5); // Default limit can be set as needed
            $table->integer('timeframe_hours')->default(24); // Default timeframe can be set as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn(['download_limit', 'timeframe_hours']);

        });
    }
};
