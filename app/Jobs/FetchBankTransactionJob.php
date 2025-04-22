<?php

namespace App\Jobs;

use App\Events\TestNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\BankTransaction;

class FetchBankTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5; // Số lần thử lại khi job thất bại

    public function __construct()
    {
        //
    }

    public function handle()
    {

        $apiUrl = 'https://api.web2m.com/historyapimb/2508robloX*/104567890/3F3C181D-4455-EB63-CF92-F92B7CD0627B';

        try {
            $response = Http::get($apiUrl);
            $transactions = $response->json();

            foreach ($transactions['data'] as $transaction) {
                // Kiểm tra nếu ref_no đã tồn tại thì không thêm nữa
                if (BankTransaction::where('ref_no', $transaction['refNo'])->exists()) {
                    continue;
                }

                // Nếu không có ref_no trong DB thì tạo bản ghi mới
                BankTransaction::create([
                    'posting_date' => $transaction['postingDate'],
                    'transaction_date' => $transaction['transactionDate'],
                    'account_no' => $transaction['accountNo'],
                    'credit_amount' => $transaction['creditAmount'],
                    'debit_amount' => $transaction['debitAmount'],
                    'currency' => $transaction['currency'],
                    'description' => $transaction['description'],
                    'add_description' => $transaction['addDescription'],
                    'available_balance' => $transaction['availableBalance'],
                    'beneficiary_account' => $transaction['beneficiaryAccount'],
                    'ref_no' => $transaction['refNo'],
                    'ben_account_name' => $transaction['benAccountName'],
                    'bank_name' => $transaction['bankName'],
                    'ben_account_no' => $transaction['benAccountNo'],
                    'transaction_type' => $transaction['transactionType'],
                    'is_read' => false,
                    'pos' => $transaction['pos'],
                    'tracing_type' => $transaction['tracingType'],
                ]);
            }
        } catch (\Exception $e) {
            // Ghi lại lỗi nếu cần
            \Log::error("FetchBankTransactionJob failed: {$e->getMessage()}");
            // Thử lại job sau 10 giây
            $this->release(10);
        }

        // Tự động lên lịch để job chạy lại sau 5 phút
        self::dispatch()->delay(now()->addSeconds(10));
    }

    public function failed(\Exception $exception)
    {
        \Log::error("FetchBankTransactionJob failed permanently: {$exception->getMessage()}");
    }
}
