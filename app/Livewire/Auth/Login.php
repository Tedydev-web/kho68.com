<?php

    namespace App\Livewire\Auth;

use App\Events\TestNotification;
use Illuminate\Support\Facades\Validator;
    use Livewire\Component;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;
    use App\Models\UserDetail;
    use App\Models\User;
    use Illuminate\Http\Request;

    class Login extends Component
    {
        public $email;
        public $password;

        protected $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        public function mount()
        {
            if (Auth::check()) {
                return redirect()->route('account');
            }
        }

        public function login()
        {
            $this->validate();

            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                session()->regenerate();

                return redirect()->route('account');
            }

            session()->flash('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin.');
        }

        public function render()
        {
            return view('livewire.auth.login');
        }
    }
