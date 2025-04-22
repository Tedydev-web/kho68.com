<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist as WishListModel;

class WishList extends Component
{
    public $wishlists;

    public function mount()
    {
        $this->wishlists = WishListModel::with(['product'])->where('user_id', Auth::id())->get();
    }

    public function removeFromWishlist($id)
    {
        WishListModel::where('id', $id)->where('user_id', Auth::id())->delete();
        $this->mount(); // Cập nhật lại danh sách sau khi xóa
    }

    public function getPrice($product)
    {
        // Nếu là sản phẩm có giá giảm (sale_price)
        if (isset($product->sale_price) && $product->sale_price > 0) {
            return number_format($product->sale_price, 0, ',', '.') . 'đ';
        }

        // Nếu là SocialAccountProduct, tính giá thấp nhất từ các thuộc tính
        if (get_class($product) === 'App\Models\SocialAccountProduct') {
            $minPrice = $product->attributes()->min('additional_price');
            return number_format($minPrice ?? $product->price, 0, ',', '.') . 'đ';
        }

        // Mặc định trả về giá bình thường nếu không có giá giảm
        return number_format($product->price ?? 0, 0, ',', '.') . 'đ';
    }

    public function render()
    {
        return view('livewire.wish-list', [
            'wishlists' => $this->wishlists
        ]);
    }
}
