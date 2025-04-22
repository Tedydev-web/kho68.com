<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Wallet;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction)
    {
        $wallet = Wallet::find($transaction->wallet_id);

        // Lấy tất cả giao dịch của ví này
        $transactions = Transaction::where('wallet_id', $wallet->id)
                                   ->where('status', 'completed')
                                   ->get();

        // Khởi tạo lại số dư
        $wallet->balance = 0;

        // Lặp qua từng giao dịch để tính toán lại số dư
        foreach ($transactions as $trans) {
            if ($trans->type === 'deposit') {
                // Cộng tiền nếu là giao dịch nạp tiền
                $wallet->balance += $trans->amount;
            } elseif ($trans->type === 'withdraw') {
                // Trừ tiền nếu là giao dịch rút tiền
                $wallet->balance -= $trans->amount;
            }
        }

        // Lưu lại số dư cập nhật
        $wallet->save();
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
