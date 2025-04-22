<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SocialAccountProduct;
use App\Models\WordpressProduct;
use App\Models\OtherProduct;
use App\Models\Course;

class ProductSearch extends Component
{
    public $searchTerm = ''; // Mặc định là rỗng

    public $socialAccountProducts = [];
    public $wordpressProducts = [];
    public $otherProducts = [];
    public $courses = [];

    // Bind searchTerm to the query string
    protected $queryString = ['searchTerm'];

    public function updatedSearchTerm()
    {
        // Perform search when searchTerm is updated
        $this->searchProducts();
    }

    public function mount()
    {
        // Perform search on mount if there's a search term
        $this->searchProducts();
    }

    public function searchProducts()
    {
        // Kiểm tra nếu searchTerm rỗng, hiển thị tất cả sản phẩm
        if (empty($this->searchTerm)) {
            // Lấy tất cả sản phẩm khi searchTerm rỗng
            $this->socialAccountProducts = SocialAccountProduct::all();
            $this->wordpressProducts = WordpressProduct::all();
            $this->otherProducts = OtherProduct::all();
            $this->courses = Course::all();
        } else {
            // Tìm kiếm sản phẩm dựa trên searchTerm
            $this->socialAccountProducts = SocialAccountProduct::where('name', 'like', '%' . $this->searchTerm . '%')->get();
            $this->wordpressProducts = WordpressProduct::where('name', 'like', '%' . $this->searchTerm . '%')->get();
            $this->otherProducts = OtherProduct::where('name', 'like', '%' . $this->searchTerm . '%')->get();
            $this->courses = Course::where('title', 'like', '%' . $this->searchTerm . '%')->get();
        }
    }

    public function render()
    {
        return view('livewire.product-search', [
            'socialAccountProducts' => $this->socialAccountProducts,
            'wordpressProducts' => $this->wordpressProducts,
            'otherProducts' => $this->otherProducts,
            'courses' => $this->courses,
        ]);
    }
}
