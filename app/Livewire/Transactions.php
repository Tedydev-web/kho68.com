<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transactions extends Component
{
    use WithPagination;

    public $trans_id = '';
    public $fromDate = '';
    public $toDate = '';
    public $limit = 10;
    public $shortByDate = '';

    public function resetFilters()
    {
        $this->trans_id = '';
        $this->fromDate = '';
        $this->toDate = '';
        $this->limit = 10;
        $this->shortByDate = '';
    }
    public function render()
    {
        // Lấy ID của người dùng đã đăng nhập
        $userId = Auth::user()->id;
        $query = Transaction::where('user_id', $userId); // Lọc theo user_id

        // Lọc theo mã đơn hàng
        if (!empty($this->trans_id)) {
            $query->where('transaction_code', 'like', '%' . $this->trans_id . '%');
        }

        // Lọc theo ngày bắt đầu và kết thúc
        if (!empty($this->fromDate)) {
            $query->whereDate('created_at', '>=', $this->fromDate);
        }
        if (!empty($this->toDate)) {
            $query->whereDate('created_at', '<=', $this->toDate);
        }

        // Lọc theo ngày trong hôm nay, tuần này, tháng này
        if ($this->shortByDate == '1') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($this->shortByDate == '2') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->shortByDate == '3') {
            $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
        }

        // Phân trang
        $transactions = $query->paginate($this->limit);

        // Tính toán số dư ban đầu và số dư hiện tại cho mỗi giao dịch
        $transactionsWithBalance = $transactions->map(function ($transaction) use ($userId) {
            // Chỉ tính toán cho các giao dịch loại deposit và withdraw
            if ($transaction->type === 'banking') {
                return $transaction;
            }

            $previousTransactions = Transaction::where('user_id', $userId)
                ->where('created_at', '<', $transaction->created_at)
                ->whereIn('type', ['deposit', 'withdraw']) // Lọc loại deposit và withdraw
                ->orderBy('created_at', 'desc') // Để lấy giao dịch gần nhất
                ->get();

            $initialBalance = $previousTransactions->reduce(function ($carry, $prevTransaction) {
                return $carry + ($prevTransaction->type === 'deposit' ? $prevTransaction->amount : -$prevTransaction->amount);
            }, 0);

            $currentBalance = $initialBalance + ($transaction->type === 'deposit' ? $transaction->amount : -$transaction->amount);

            $transaction->initial_balance = $initialBalance;
            $transaction->current_balance = $currentBalance;

            return $transaction;
        });

        // Chuyển đổi lại bộ sưu tập để phân trang
        $transactions->getCollection()->transform(function ($transaction) use ($transactionsWithBalance) {
            return $transactionsWithBalance->firstWhere('id', $transaction->id);
        });
        // Tổng hợp nạp và rút theo ngày cho user hiện tại
        $groupedTransactions = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(CASE WHEN type = "deposit" THEN amount ELSE 0 END) as total_deposit'),
            DB::raw('SUM(CASE WHEN type = "withdraw" THEN amount ELSE 0 END) as total_withdraw')
        )
        ->where('user_id', $userId) // Lọc theo user_id
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Lấy tổng nạp và rút riêng biệt
        $totalDeposits = $groupedTransactions->pluck('total_deposit');
        $totalWithdraws = $groupedTransactions->pluck('total_withdraw');
        $dates = $groupedTransactions->pluck('date')->map(function ($date) {
            return date('d/m/Y', strtotime($date));
        });

        return view('livewire.transactions', [
            'transactions' => $transactions,
            'totalDeposits' => $totalDeposits, // Tổng nạp
            'totalWithdraws' => $totalWithdraws, // Tổng rút
            'dates' => $dates, // Dữ liệu thời gian
        ]);
    }

}
