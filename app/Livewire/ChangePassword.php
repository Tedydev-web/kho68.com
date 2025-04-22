<?php

    namespace App\Livewire;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Livewire\Component;
    use Illuminate\Validation\ValidationException;

    class ChangePassword extends Component
    {
        public $current_password;
        public $new_password;
        public $new_password_confirmation;

        public function updatePassword()
        {
            // Xác thực đầu vào
            $this->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user = Auth::user();

            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($this->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Mật khẩu hiện tại không đúng.',
                ]);
            }

            // Cập nhật mật khẩu mới
            $user->update([
                'password' => Hash::make($this->new_password),
            ]);

            Auth::logout();

            // Xóa session và tạo mới token
            session()->invalidate();
            session()->regenerateToken();

            // Gửi thông báo thành công
            session()->flash('message', 'Mật khẩu đã được thay đổi thành công. Vui lòng đăng nhập lại.');

            return redirect()->route('login');
        }

        public function render()
        {
            return view('livewire.change-password');
        }
    }
