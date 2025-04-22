<?php

    namespace App\Livewire\Partials;

    use App\Models\Banner;
    use Livewire\Component;

    class BannerSlider extends Component
    {
        public $banners;

        public function mount()
        {
            // Lấy danh sách các banner đang hoạt động (status = 'active')
            $this->banners = Banner::with('media')->where('status', 'active')->get();
        }

        public function render()
        {
            return view('livewire.partials.banner-slider');
        }
    }
