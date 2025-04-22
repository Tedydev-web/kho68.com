<?php

    namespace App\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use Illuminate\Support\Facades\DB;
    use App\Models\User;
    use App\Models\UserDetail;

    class Account extends Component
    {
        public $phone;
        public $fullname;
        public $address;
        public $balance;
        public $totalDeposited;
        public $totalUsed;
        public function mount()
        {
            $user = auth()->user();

            // Kiểm tra nếu userDetail tồn tại
            if ($user && $user->userDetail) {
                $this->phone = $user->userDetail->phone;
                $this->fullname = $user->userDetail->fullname;
            } else {
                // Nếu userDetail không tồn tại, đặt các giá trị mặc định
                $this->phone = '';
                $this->fullname = '';
            }

            if (!Auth::check()) {
                return redirect()->route('login');
            }
            if ($user) {
                $wallet = $user->wallet;

                if ($wallet) {
                    // Lấy số dư hiện tại
                    $this->balance = $wallet->balance;

                    // Tính tổng tiền nạp (giao dịch có type = 'deposit')
                    $this->totalDeposited = Transaction::where('wallet_id', $wallet->id)
                        ->where('type', 'deposit')
                        ->where('status', 'completed')
                        ->sum('amount');

                    // Tính tổng tiền đã sử dụng (giao dịch có type = 'withdraw')
                    $this->totalUsed = Transaction::where('wallet_id', $wallet->id)
                        ->where('type', 'withdraw')
                        ->where('status', 'completed')
                        ->sum('amount');
                } else {
                    // Nếu không có ví thì đặt các giá trị mặc định
                    $this->balance = 0;
                    $this->totalDeposited = 0;
                    $this->totalUsed = 0;
                }

                if (!Auth::check()) {
                    return redirect()->route('login');
                }
            }
        }

        public function saveChanges()
        {
            $user = auth()->user();

            // Kiểm tra nếu userDetail tồn tại trước khi cập nhật
            if ($user && $user->userDetail) {
                $user->userDetail->update([
                    'phone' => $this->phone,
                    'fullname' => $this->fullname,
                    'address' => $this->address,
                ]);

                session()->flash('message', 'Thông tin đã được cập nhật thành công.');
            } else {
                // Xử lý nếu userDetail không tồn tại (tạo mới hoặc thông báo lỗi)
                session()->flash('error', 'Thông tin người dùng không tồn tại.');
            }
        }

        public function render()
        {
            return view('livewire.account');
        }
    }
