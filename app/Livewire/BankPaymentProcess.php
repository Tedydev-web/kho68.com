<?php

namespace App\Livewire;

use App\Events\TestNotification;
use App\Models\Order;
use App\Jobs\CheckOrderBank;
use App\Jobs\FetchBankTransactionJob;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BankPaymentProcess extends Component
{
    public $order;
    public $bankAccount = '104567890'; // Số tài khoản ngân hàng
    public $accountName = 'TRAN LE HUY HOANG'; // Tên chủ tài khoản
    public $transactionCode; // Mã giao dịch thanh toán
    public $total; // Tổng tiền cần thanh toán

    public function mount($orderId)
    {
        FetchBankTransactionJob::dispatch();

        $this->order = Order::findOrFail($orderId);
        $this->transactionCode = 'THANHTOANDONHANG' . $orderId;
        $this->total = $this->order->total_after_discount; // Lấy tổng tiền từ đơn hàng

        // Dispatch job to check bank transactions and update the order status
        CheckOrderBank::dispatch($this->transactionCode, $orderId, Auth::user()->id);
    }
    public function notifi () {
        // Dispatch the event with the post data
 event(new TestNotification([
    'author' => 'ádfasdf',
    'title' => 'ádfasfd',
]));
    }
    public function render()
    {
        return view('livewire.bank-payment-process', [
            'order' => $this->order,
            'bankAccount' => $this->bankAccount,
            'accountName' => $this->accountName,
            'transactionCode' => $this->transactionCode,
            'total' => $this->total, // Truyền tổng tiền vào view
        ]);
    }
}
