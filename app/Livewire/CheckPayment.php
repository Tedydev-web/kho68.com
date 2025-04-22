<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Order;

class CheckPayment extends Component
{
    public $vnp_ResponseCode;
    public $orderId;
    public $orderStatus;

    public function mount()
    {
        // Lấy các tham số từ URL trả về của VNPAY
        $vnp_ResponseCode = Request::get('vnp_ResponseCode');
        $vnp_TxnRef = Request::get('vnp_TxnRef'); // Mã đơn hàng
        $vnp_Amount = Request::get('vnp_Amount') / 100; // Số tiền (đã chia lại cho 100)

        // Kiểm tra mã phản hồi từ VNPAY
        if ($vnp_ResponseCode == '00') {
            // Thanh toán thành công
            $this->orderStatus = 'success';

            // Cập nhật trạng thái đơn hàng
            $order = Order::find($vnp_TxnRef);
            if ($order) {
                $order->status = 'completed';
                $order->total = $vnp_Amount;
                $order->save();
            }
        } else {
            // Thanh toán thất bại
            $this->orderStatus = 'failed';
        }
    }

    public function render()
    {
        return view('livewire.check-payment', [
            'orderStatus' => $this->orderStatus
        ]);
    }
}
