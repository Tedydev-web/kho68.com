<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'balance',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hàm thêm tiền vào tài khoản
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Thêm tiền vào ví
    public function addMoney($amount)
    {
        $this->balance += $amount;
        $this->save();

        // Tạo giao dịch nạp tiền
        Transaction::create([
            'user_id' => $this->user_id,
            'wallet_id' => $this->id,
            'amount' => $amount,
            'type' => 'deposit',
            'status' => 'completed',
            'transaction_code' => 'TXN-' . strtoupper(uniqid()), // Mã giao dịch duy nhất
            'description' => 'Nạp tiền vào tài khoản',
        ]);
    }

    // Rút tiền từ ví
    public function withdrawMoney($amount)
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->save();

            // Tạo giao dịch rút tiền
            Transaction::create([
                'user_id' => $this->user_id,
                'wallet_id' => $this->id,
                'amount' => $amount,
                'type' => 'withdraw',
                'status' => 'completed',
                'transaction_code' => 'TXN-' . strtoupper(uniqid()),
                'description' => 'Rút tiền khỏi tài khoản',
            ]);
        } else {
            // Tạo giao dịch thất bại nếu số dư không đủ
            Transaction::create([
                'user_id' => $this->user_id,
                'wallet_id' => $this->id,
                'amount' => $amount,
                'type' => 'withdraw',
                'status' => 'failed',
                'transaction_code' => 'TXN-' . strtoupper(uniqid()),
                'description' => 'Số dư không đủ để rút tiền',
            ]);
        }
    }
}
