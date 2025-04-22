<?php

namespace App\Jobs;

use App\Events\TestNotification;
use App\Events\TransactionSuccessEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\BankTransaction;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet; // Import model Wallet
use Exception;
use Illuminate\Support\Facades\Log;

class CheckBankTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 60;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 10; // You can set this to whatever delay is appropriate

    protected $transaction_code;
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction_code, $user_id)
    {
        $this->transaction_code = $transaction_code;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Lấy tất cả các giao dịch chưa đọc (is_read = false)
        $transactions = BankTransaction::where('is_read', false)->get();

        foreach ($transactions as $transaction) {
            // Kiểm tra nếu nội dung chuyển khoản khớp với transaction_code
            if (strpos($transaction->add_description, needle: $this->transaction_code) !== false) {
                // Gọi hàm xử lý khi giao dịch thành công
                $this->processSuccess($transaction);


            }
        }


    }

    /**
     * Xử lý khi tìm thấy giao dịch thành công.
     */
    protected function processSuccess(BankTransaction $transaction)
{
    try {
        // Ghi log khi tìm thấy giao dịch
        Log::info("Transaction found for user {$this->user_id}: {$transaction->ref_no}");

        // Đánh dấu giao dịch đã được đọc
        $transaction->update(['is_read' => true]);

        // Lấy thông tin người dùng
        $user = User::find($this->user_id);

        // Kiểm tra xem user đã có wallet hay chưa
        if ($user) {
            $wallet = $user->wallet;

            if (!$wallet) {
                // Nếu chưa có, tạo ví mới cho user
                $wallet = Wallet::create([
                    'user_id' => $user->id,
                    'balance' => 0, // Số dư ban đầu là 0
                ]);
            }

            // Cộng tiền vào ví người dùng
            // $wallet->addMoney($transaction->credit_amount);

            // Cập nhật trạng thái giao dịch trong bảng bank_transactions
            $transaction->update(['status' => 'completed']);

            // Tạo mới transaction với trạng thái "deposit"
            Transaction::create([
                'user_id' => $this->user_id,
                'wallet_id' => $wallet->id,
                'amount' => $transaction->credit_amount,
                'type' => 'deposit',
                'status' => 'completed', // Trạng thái giao dịch đã hoàn thành
                'transaction_code' => $this->transaction_code,
                'description' => 'Nạp tiền vào ví với mã: ' . $this->transaction_code,
            ]);

            // Phát sự kiện giao dịch thành công
            event(new TransactionSuccessEvent([
                'type' => 'success',
                'user' => $this->user_id,
                'content' => 'Nạp thành công ' . number_format(intval($transaction->credit_amount), 0, ',', '.') . ' VNĐ',
            ]));

        }

           } catch (\Exception $e) {
        // Ghi log khi xảy ra lỗi
        Log::error("Error in processing transaction for user {$this->user_id}: " . $e->getMessage());

        // Chạy lại job sau 10 giây
                 $this->release(5);

        // Ngăn không đánh dấu job là thất bại
        return;
    }

    // Dispatch job để kiểm tra lại sau 10 giây
    self::dispatch()->delay(5);
}


    /**
     * Xử lý khi job thất bại
     */
    public function failed(Exception $exception)
    {
        Log::error("CheckBankTransactionJob failed for user {$this->user_id}: {$exception->getMessage()}");
    }


}
