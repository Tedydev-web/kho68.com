<?php

    namespace App\Livewire\Auth;

    use Livewire\Component;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Mail;
    use App\Models\User;
    use App\Models\UserDetail;
    use Illuminate\Support\Str;
    use Illuminate\Auth\Events\Registered;

    class Register extends Component
    {
        public $username;
        public $email;
        public $password;
        public $password_confirmation;
        public $ip_address;

        protected $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|email|ends_with:@gmail.com|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ];

        public function mount()
        {
            $this->ip_address = request()->ip();
        }

        public function register()
        {
            $this->validate();

            $user = User::create([
                'name' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            UserDetail::create([
                'user_id' => $user->id,
                'username' => $this->username,
                'ip_address' => $this->ip_address,
                'role' => 'customer', // Default role
            ]);

            return redirect()->route('login')->with('message', 'Registered successfully!');
        }

        public function render()
        {
            return view('livewire.auth.register');
        }
    }
