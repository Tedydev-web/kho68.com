<?php

namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionHistory extends Component
{
    public $transactions;

    public function mount()
    {
        // Lấy tất cả giao dịch của người dùng
        $this->transactions = Transaction::where('user_id', Auth::id())->latest()->get();
    }

    public function render()
    {
        return view('livewire.transaction-history', [
            'transactions' => $this->transactions,
        ]);
    }
}
