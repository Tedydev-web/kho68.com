<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'posting_date',
        'transaction_date',
        'account_no',
        'credit_amount',
        'debit_amount',
        'currency',
        'description',
        'add_description',
        'available_balance',
        'beneficiary_account',
        'ref_no',
        'ben_account_name',
        'bank_name',
        'ben_account_no',
        'due_date',
        'doc_id',
        'transaction_type',
        'pos',
        'tracing_type',
        'is_read', // Thêm cột is_read vào fillable
    ];
}
