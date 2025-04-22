<?php

 namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SocialAccountProduct;
use App\Models\SocialAccountProductAttribute;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SocialProductDetail extends Component
{
    public $product;

    public $selectedAttributeId; // Lưu attribute được chọn
    public $quantity = 1; // Số lượng mặc định là 1
    public $price; // Lưu giá của sản phẩm với attribute đã chọn
    public $stock; // Lưu tình trạng tồn kho
    public $attributeQuantity; // Số lượng của attribute được chọn
    public $showPopup = true; // Khởi tạo popup hiện lên
    public $rating;
public $comment;
public $reviews;
    public function closePopup()
    {
        // Set biến để ẩn popup
        $this->showPopup = false;

        // Xóa flash session
        session()->forget('message');
    }
    public function mount($slug)
    {
        // Lấy thông tin sản phẩm dựa trên slug
        $this->product = SocialAccountProduct::with(['attributes', 'categories'])
                            ->where('slug', $slug)
                            ->firstOrFail(); // Nếu không tìm thấy sản phẩm sẽ trả về lỗi 404

        // Nếu có thuộc tính, chọn thuộc tính đầu tiên
        if ($this->product->attributes->isNotEmpty()) {
            $firstAttribute = $this->product->attributes->first();
            $this->selectedAttributeId = $firstAttribute->id;
            $this->price = $firstAttribute->additional_price;
            $this->attributeQuantity = $firstAttribute->quantity; // Lấy số lượng của attribute đầu tiên
        } else {
            // Nếu không có thuộc tính, dùng giá sản phẩm chính
            $this->price = $this->product->price;
            $this->attributeQuantity = 0; // Không có thuộc tính thì
        }

        // Tính tổng tồn kho của tất cả các thuộc tính
        $this->stock = $this->product->attributes->sum('quantity');
        $this->reviews = $this->product->reviews;
    }

    public function setSelectedAttribute($attributeId)
    {
        $this->selectedAttributeId = $attributeId;
        $attribute = SocialAccountProductAttribute::find($attributeId);
        $this->price = $attribute->additional_price;
        $this->attributeQuantity = $attribute->quantity;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa với cùng attribute (nếu có)
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('social_account_product_id', $this->product->id)
            ->where('attribute_id', $this->selectedAttributeId) // Thêm kiểm tra attribute
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng với cùng attribute, cập nhật số lượng
            $cartItem->update([
                'quantity' => $cartItem->quantity + $this->quantity,
                'price' => $this->price, // Cập nhật giá của attribute
            ]);
        } else {
            // Nếu chưa có, tạo mới cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'social_account_product_id' => $this->product->id,
                'attribute_id' => $this->selectedAttributeId, // Lưu attribute_id
                'quantity' => $this->quantity,
                'price' => $this->price,
            ]);
        }

        $cart->update([
            'total' => $cart->items->sum(function ($item) {
                return $item->quantity * $item->price;
            }),
        ]);

        session()->flash('message', 'Sản phẩm đã được thêm vào giỏ hàng!');
        $this->dispatch('productAddedToCart', ['message' => 'Sản phẩm đã được thêm vào giỏ hàng!']);

    }
    public function addToWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
        $existingWishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->where('product_type', SocialAccountProduct::class)
            ->first();

        if ($existingWishlistItem) {
            session()->flash('message', 'Sản phẩm đã có trong danh sách yêu thích!');
        } else {
            // Thêm sản phẩm vào wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'product_type' => SocialAccountProduct::class,
            ]);
            session()->flash('message', 'Đã thêm sản phẩm vào danh sách yêu thích!');
        }

        $this->dispatch('wishlistUpdated', ['message' => 'Sản phẩm đã được thêm vào danh sách yêu thích!']);
    }
    public function render()
    {
        return view('livewire.social-product-detail', [
            'product' => $this->product,
            'attributes' => $this->product->attributes,
            'categories' => $this->product->categories, // Các danh mục liên quan
            'selectedAttributeId' => $this->selectedAttributeId,
            'price' => $this->price, // Giá sản phẩm dựa trên attribute
            'stock' => $this->stock, // Tồn kho của các thuộc tính
            'attributeQuantity' => $this->attributeQuantity, // Số lượng của attribute đã chọn
        ]);
    }
    public function submitReview()
{
    $this->validate([
        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|string',
    ]);

    // Save the review to the database
    $this->product->reviews()->create([
        'user_id' => auth()->id(),
        'rating' => $this->rating,
        'comment' => $this->comment,
    ]);

    // Reset the form
    $this->reset(['rating', 'comment']);

    // Reload reviews
    $this->reviews = $this->product->reviews;
}
}
