<?php

namespace App\Livewire;

use App\Models\WordpressProduct;
use Livewire\Component;

class WordpressProductDemo extends Component
{
    public $product;

    public function mount($slug)
    {
        $this->product = WordpressProduct::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.wordpress-product-demo');
    }
}
