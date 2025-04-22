<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\WebsiteSetting;

class Footer extends Component
{
    public $websiteSetting;
    public $logoUrl;

    public function mount()
    {
        // Lấy thông tin cài đặt website từ database
        $this->websiteSetting = WebsiteSetting::with('logoImage')->first();

        // Kiểm tra và gán URL logo nếu có
        if ($this->websiteSetting && $this->websiteSetting->logoImage) {
            $this->logoUrl = asset('storage/' . $this->websiteSetting->logoImage->path);
        } else {
            $this->logoUrl = asset('assets/default-logo.png');
        }
    }

    public function render()
    {
        return view('livewire.partials.footer', ['logoUrl' => $this->logoUrl]);
    }
}
