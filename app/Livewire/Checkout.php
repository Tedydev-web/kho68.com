<?php

namespace App\Livewire;

use App\Events\TransactionSuccessEvent;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $paymentMethod = 'bank'; // Mặc định thanh toán qua ngân hàng
    public $shippingPrice = 50000; // Ví dụ: phí vận chuyển mặc định
    public $discountAmount = 0;
    public $discountType = '';
    public $discountCode = '';
    public $walletBalance = 0; // Khởi tạo biến để lưu số dư ví
    public $fullName;
    public $email;
    public $phone;
    public $address;
    public function mount()
    {
        $cart = Auth::user()->cart; // Sử dụng quan hệ cart đã định nghĩa trong User
        $this->walletBalance = Auth::user()->wallet ? Auth::user()->wallet->balance : 0; // Lấy số dư ví

        if ($cart) {
            $this->cartItems = collect($cart->items); // Lấy các mục trong giỏ hàng
            foreach ($this->cartItems as $item) {
                if ($item->wordpress_product_id) {
                    $item->product = \App\Models\WordpressProduct::find($item->wordpress_product_id);
                    $item->type = 'wordpress';
                } elseif ($item->social_account_product_id) {
                    $item->product = \App\Models\SocialAccountProduct::find($item->social_account_product_id);
                    $item->attribute = \App\Models\SocialAccountProductAttribute::find($item->attribute_id); // Lấy tên thuộc tính
                    $item->type = 'social';
                } elseif ($item->course_product_id) {
                    $item->product = \App\Models\Course::find($item->course_product_id);
                    $item->type = 'course';
                } elseif ($item->other_product_id) {
                    $item->product = \App\Models\OtherProduct::find($item->other_product_id);
                    $item->type = 'other';
                }
            }
            $this->total = $cart->total; // Tổng giá trị giỏ hàng

            // Thêm logic cho giảm giá
            if ($cart->discount_code) {
                $this->discountAmount = $cart->discount_amount;
                $this->discountType = $cart->discount_type; // Thêm loại giảm giá
                $this->discountCode = $cart->discount_code ; // Thêm loại giảm giá
            } else {
                $this->discountAmount = 0;
                $this->discountType = null;
            }

            // Xử lý giảm giá theo loại
            if ($this->discountType == 'percentage') {
                $this->discountAmount = $this->total * ($this->discountAmount / 100);
            }
        }

        $userDetail = Auth::user()->userDetail;
        if ($userDetail) {
            $this->fullName = $userDetail->fullname;
            $this->phone = $userDetail->phone;
            $this->address = $userDetail->address;
            $this->email = Auth::user()->email;
            // $this->address = $userDetail->address ?? ''; // Nếu có trường địa chỉ
        }

    }


    public function submitOrder()
    {
        $user = Auth::user();

        // Tính toán giá trị giảm giá
        $discountAmount = $this->discountAmount ?? 0; // Nếu không có giá trị giảm giá, mặc định là 0
        $totalAfterDiscount = max(0, $this->total - $discountAmount); // Đảm bảo giá trị không âm

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $this->total,
            'status' => 'pending', // Đặt trạng thái là 'pending' vì chưa thanh toán
            'payment_method' => $this->paymentMethod,
            'discount_amount' => $discountAmount, // Lưu số tiền giảm giá
            'discount_code' => $this->discountCode, // Lưu mã giảm giá
            'discount_type' => $this->discountType, // Lưu loại giảm giá
            'total_after_discount' => $totalAfterDiscount, // Lưu tổng sau khi giảm giá
        ]);

        // Lưu các mục trong giỏ hàng vào bảng order_items
        foreach ($this->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'social_account_product_id' => $item->social_account_product_id,
                'wordpress_product_id' => $item->wordpress_product_id,
                'course_product_id' => $item->course_product_id,
                'other_product_id' => $item->other_product_id,
                'attribute_id' => $item->attribute_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ]);
        }

        $cart = $user->cart;
        if ($cart) {
            $cart->items()->delete();  // Xóa tất cả các mục trong giỏ hàng
            $cart->delete();           // Xóa luôn giỏ hàng nếu cần
        }

        // Xử lý thanh toán
        if ($this->paymentMethod == 'bank') {
            return redirect()->route(route: 'bank.process', parameters: ['orderId' => $order->id]);
        } elseif ($this->paymentMethod == 'wallet') {
            $this->handleWalletPayment($order);
        }
    }

    // Hàm xử lý thanh toán qua số dư tài khoản
    private function handleWalletPayment($order)
    {
        $user = Auth::user();

        // Tính tổng số tiền sau khi áp dụng giảm giá
        $discountAmount = $this->discountAmount ?? 0; // Lấy giá trị giảm giá, mặc định là 0 nếu không có
        $totalAmount = max(0, $this->total - $discountAmount); // Đảm bảo không âm

        // Kiểm tra xem người dùng có đủ số dư không
        if ($user->wallet && $user->wallet->balance >= $totalAmount) {
            // Trừ số dư
            $user->wallet->balance -= $totalAmount;
            $user->wallet->save();

            // Đánh dấu đơn hàng hoàn thành
            $order->status = 'complete';
            $order->save();

            // Tạo bản ghi giao dịch
            \App\Models\Transaction::create([
                'user_id' => $user->id,
                'wallet_id' => $user->wallet->id,
                'amount' => $totalAmount,
                'type' => 'withdraw',
                'status' => 'completed',
                'transaction_code' => uniqid('txn_'), // Hoặc sử dụng mã giao dịch thực tế nếu có
                'description' => 'Thanh toán cho đơn hàng ID ' . $order->id,
            ]);

            event(new TransactionSuccessEvent([
                'type' => 'success',
                'user' => $user->id,
                'content' => 'Thanh toán thành công ' . number_format(intval($totalAmount), 0, ',', '.') . ' VNĐ',
            ]));

            // Chuyển hướng đến trang xác nhận đơn hàng thành công
            return redirect()->route('history-order');
        } else {
            // Nếu số dư không đủ, hiển thị thông báo lỗi
            session()->flash('error', 'Số dư của bạn không đủ để thanh toán.');
        }
    }


    public function render()
    {
        return view('livewire.checkout', [
            'cartItems' => $this->cartItems,
            'total' => $this->total,
            'walletBalance' => $this->walletBalance,
        ]);
    }
}
