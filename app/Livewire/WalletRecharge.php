<?php

namespace App\Livewire;

use App\Events\TestNotification;
use App\Events\TransactionSuccessEvent;
use App\Jobs\CheckBankTransactionJob;
use App\Jobs\FetchBankTransactionJob;
use Livewire\Component;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class WalletRecharge extends Component
{
    public $amount; // Số tiền cần nạp
    public $transactions; // Lịch sử giao dịch của người dùng
    public $transactionCode; // Mã giao dịch
    public $bankAccount = '104567890'; // Số tài khoản ngân hàng
    public $accountName = 'TRAN LE HUY HOANG'; // Tên chủ tài khoản

    protected $rules = [
        'amount' => 'required|numeric|min:10000', // Yêu cầu số tiền tối thiểu 10,000 VND
    ];

    public function submit()
    {
        $this->validate();

        $wallet = Auth::user()->wallet;

        // Nếu người dùng chưa có ví, tạo ví mới
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => Auth::id(),
                'balance' => 0,
            ]);
        }

        // Tạo nội dung chuyển khoản (transaction code)
        $this->transactionCode = 'NAPTIEN' . Auth::id();

        // Tạo giao dịch nạp tiền với trạng thái 'pending'
        Transaction::create([
            'user_id' => Auth::id(),
            'wallet_id' => $wallet->id,
            'amount' => $this->amount,
            'type' => 'deposit',
            'status' => 'pending', // Đang chờ thanh toán
            'transaction_code' => $this->transactionCode,
            'description' => 'Nạp tiền vào ví với mã: ' . $this->transactionCode,
        ]);

        // Thông báo nội dung chuyển khoản cho người dùng
        session()->flash('message', 'Nạp tiền thành công. Nội dung chuyển khoản: ' . $this->transactionCode);

        // Reset số tiền
        $this->reset('amount');
    }

    public function mount()
    {
        // Tạo nội dung chuyển khoản khi trang được tải
        $this->transactionCode = 'NAPTIEN' . Auth::id();

        // Lấy tất cả giao dịch nạp tiền của người dùng hiện tại
        $this->transactions = Transaction::where('user_id', Auth::id())
            ->where('type', 'deposit')
            ->latest()
            ->get();

            FetchBankTransactionJob::dispatch();
            // Dispatch job để kiểm tra giao dịch


            $user_id = Auth::id();
            $this->transactionCode = 'NAPTIEN' . Auth::id();
            CheckBankTransactionJob::dispatch($this->transactionCode, $user_id);

            // event(new TransactionSuccessEvent([
            //     // 'type' => 'success',
            //     // 'user' => Auth::id(),
            //     // 'content' => 'Nạp thành công ' ,
            // ]));
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
        return view('livewire.wallet-recharge', [
            'transactions' => $this->transactions, // Truyền danh sách giao dịch vào view
            'transactionCode' => $this->transactionCode, // Truyền mã giao dịch vào view
            'bankAccount' => $this->bankAccount, // Truyền số tài khoản vào view
            'accountName' => $this->accountName, // Truyền tên chủ tài khoản vào view
        ]);
    }
}
