<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryMenu extends Component
{
    public $categories;

    public function mount()
    {
//        $this->categories = Category::with('children')->whereNull('parent_id')->get();
        $this->categories = Category::with(['children' => function ($query) {
            $query->where('status', 'active');
        }])->whereNull('parent_id')->where('status', 'active')->get();
    }

    public function render()
    {
        return view('livewire.category-menu');
    }
}
