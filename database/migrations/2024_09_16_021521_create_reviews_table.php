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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('comment');               // The review comment
            $table->unsignedTinyInteger('rating'); // Rating, e.g., from 1 to 5
            $table->unsignedBigInteger('user_id'); // The reviewer (user) ID
            $table->morphs(name: 'reviewable');          // Polymorphic relationship columns
            $table->timestamps();

            // Foreign key for the user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
