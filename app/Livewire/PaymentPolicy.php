<?php

    namespace App\Livewire;

    use App\Models\WebsiteSetting;
    use Livewire\Component;

    class PaymentPolicy extends Component
    {
        public $paymentPolicy;

        public function mount()
        {
            $this->paymentPolicy = WebsiteSetting::first()->payment_policy;
        }

        public function render()
        {
            return view('livewire.payment-policy');
        }
    }
