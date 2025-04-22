<?php

namespace App\Jobs;

use App\Events\TransactionSuccessEvent;
use App\Models\Order;
use App\Models\BankTransaction;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class CheckOrderBank implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 100; // Số lần thử lại tối đa
    public $backoff = 10; // Thời gian chờ trước khi thử lại
    protected $transactionCode;
    protected $orderId;
    protected $userId; // Add user ID

    public function __construct($transactionCode, $orderId, $userId)
    {
        $this->transactionCode = $transactionCode;
        $this->orderId = $orderId;
        $this->userId = $userId; // Assign the user ID

    }

    public function handle()
    {
        try {
            $order = Order::find($this->orderId);

            // Kiểm tra tổng giá sau khi giảm giá
            if ($order && $order->total_after_discount == 0) {
                // Cập nhật trạng thái đơn hàng thành 'completed'
                $order->status = 'complete';
                $order->save();

                $wallet = Wallet::where('user_id', $this->userId)->firstOrFail();

                Transaction::create([
                    'user_id' => $this->userId,
                    'wallet_id' => $wallet->id,
                    'amount' => 0, // Hoặc giá trị khác tùy thuộc vào logic thanh toán
                    'type' => 'banking',
                    'status' => 'completed',
                    'transaction_code' => $this->transactionCode,
                    'description' => 'Thanh toán thành công cho đơn hàng #' . $this->orderId . ' với giá trị bằng 0.',
                ]);

                event(new TransactionSuccessEvent([
                    'type' => 'success',
                    'user' => $this->userId,
                    'content' => 'Thanh toán thành công đơn hàng ' . $this->orderId,
                    // 'content' => 'Thanh toán thành công',
                ]));

                Log::info("Order #{$this->orderId} đã được thanh toán thành công với tổng giá bằng 0.");

                return; // Kết thúc hàm nếu đơn hàng đã được đánh dấu là hoàn thành
            }

            // Lấy tất cả các giao dịch ngân hàng chưa được đọc
            $transactions = BankTransaction::where('is_read', false)->get();

            foreach ($transactions as $transaction) {
                if (strpos($transaction->add_description, $this->transactionCode) !== false) {
                    // Đánh dấu đã đọc
                    $transaction->update(['is_read' => true]);

                    // Cập nhật trạng thái đơn hàng thành 'completed'
                    $order = Order::find($this->orderId);
                    if ($order) {
                        if ($transaction->credit_amount >= $order->total_after_discount) {
                            $order->status = 'complete';
                            $order->save();

                            $wallet = Wallet::where('user_id', $this->userId)->firstOrFail();

                            Transaction::create([
                                'user_id' => $this->userId,
                                'wallet_id' => $wallet->id,
                                'amount' => $transaction->credit_amount,
                                'type' => 'banking',
                                'status' => 'completed',
                                'transaction_code' => $this->transactionCode,
                                'description' => 'Thanh toán qua ngân hàng cho đơn hàng #' . $this->orderId,
                            ]);


                            event(new TransactionSuccessEvent([
                                'type' => 'success',
                                'user' => $this->userId,
                                'content' => 'Thanh toán thành công đơn hàng ' . $this->orderId,
                                // 'content' => 'Thanh toán thành công',
                            ]));
                            // Log giao dịch thành công
                            Log::info("Order #{$this->orderId} đã được thanh toán qua ngân hàng.");
                        } else {
                            // Log or handle insufficient bank transaction amount
                            Log::warning("Transaction amount {$transaction->credit_amount} is less than order total {$order->total_after_discount} for Order #{$this->orderId}.");
                        }
                    }




                }
            }

            // Nếu không tìm thấy giao dịch, tiếp tục kiểm tra sau 10 giây
            $this->release($this->backoff); // Thử lại sau khi chờ thời gian chỉ định

        } catch (Exception $e) {
            // Ghi log lỗi nếu có lỗi xảy ra
            Log::error("Error in CheckOrderBank for Order #{$this->orderId}: " . $e->getMessage());
            // Chạy lại job sau 10 giây
            dd($e->getMessage());
            $this->release(5);

            // Ngăn không đánh dấu job là thất bại
            return;
        }
        self::dispatch()->delay(5);

    }
    public function failed(Exception $exception)
    {
        Log::error("CheckBankTransactionJob failed for user {$this->user_id}: {$exception->getMessage()}");
    }

}
