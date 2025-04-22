<?php

    namespace App\Livewire;

    use Livewire\Component;
    use App\Models\WebsiteSetting;

    class PrivacyPolicy extends Component
    {
        public $privacyPolicy;

        public function mount()
        {
            $this->privacyPolicy = WebsiteSetting::first()->privacy_policy;
        }

        public function render()
        {
            return view('livewire.privacy-policy');
        }
    }
