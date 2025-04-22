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
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('posting_date');
            $table->string('transaction_date');
            $table->string('account_no');
            $table->decimal('credit_amount', 15, 2)->default(0);
            $table->decimal('debit_amount', 15, 2)->default(0);
            $table->string('currency', 10)->default('VND');
            $table->text('description')->nullable();
            $table->text('add_description')->nullable();
            $table->decimal('available_balance', 15, 2)->default(0);
            $table->string('beneficiary_account')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('ben_account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ben_account_no')->nullable();
            $table->string('due_date')->nullable();
            $table->string('doc_id')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('pos')->nullable();
            $table->string('tracing_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
