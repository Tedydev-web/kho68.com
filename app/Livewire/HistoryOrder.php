<?php

    namespace App\Livewire;

    use Livewire\Component;
    use Livewire\WithPagination;
    use App\Models\Order;
    use Illuminate\Support\Facades\Auth;

    class HistoryOrder extends Component
    {
        use WithPagination;

        public $trans_id;
        public $time;
        public $shortByDate;
        public $limit = 10;
        public $fromDate;
        public $toDate;

        // Cập nhật các giá trị khi có thay đổi
        public function updated($propertyName)
        {
            if (in_array($propertyName, ['trans_id', 'fromDate', 'toDate', 'shortByDate'])) {
                $this->resetPage(); // Đặt lại phân trang khi có thay đổi
            }
        }

        public function render()
        {
            // Khởi tạo query
            $query = Order::where('user_id', Auth::id());

            // Lọc theo Mã đơn hàng (transaction ID)
            if ($this->trans_id) {
                $query->where('id', 'like', '%' . $this->trans_id . '%');
            }

            // Lọc theo ngày (fromDate - toDate)
            if ($this->fromDate && $this->toDate) {
                $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
            }

            // Lọc theo shortByDate
            if ($this->shortByDate) {
                if ($this->shortByDate == 1) {
                    // Lọc hôm nay
                    $query->whereDate('created_at', now());
                } elseif ($this->shortByDate == 2) {
                    // Lọc tuần này
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($this->shortByDate == 3) {
                    // Lọc tháng này
                    $query->whereMonth('created_at', now()->month);
                }
            }

            // Lấy kết quả với phân trang
            $orders = $query->orderBy('created_at', 'desc')->paginate($this->limit);

            return view('livewire.history-order', ['orders' => $orders]);
        }
    }
