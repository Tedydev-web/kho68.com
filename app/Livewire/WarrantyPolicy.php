<?php

    namespace App\Livewire;

    use Livewire\Component;
    use App\Models\WebsiteSetting;

    class WarrantyPolicy extends Component
    {
        public $warrantyPolicy;

        public function mount()
        {
            $this->warrantyPolicy = WebsiteSetting::first()->warranty_policy;
        }

        public function render()
        {
            return view('livewire.warranty-policy');
        }
    }
