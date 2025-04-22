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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->decimal('amount', 15, 2); // Số tiền
            $table->string('type'); // Loại giao dịch: 'deposit' hoặc 'withdraw'
            $table->string('status')->default('pending'); // Trạng thái: 'pending', 'completed', 'failed'
            $table->string('transaction_code'); // Mã giao dịch duy nhất
            $table->text('description')->nullable(); // Mô tả giao dịch
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
