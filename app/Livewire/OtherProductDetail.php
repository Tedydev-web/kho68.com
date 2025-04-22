<?php

    namespace App\Livewire;

    use App\Models\Cart;
    use App\Models\CartItem;
    use App\Models\OtherProduct;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;
    use App\Models\Wishlist;

    class OtherProductDetail extends Component
    {
        public $otherProduct;
        public $quantity = 1; // Số lượng mặc định là 1
        public $showPopup = true; // Khởi tạo popup hiện lên
        public $rating;
        public $comment;
        public $reviews;
        public function submitReview()
        {
            $this->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'required|string',
            ]);

            // Save the review to the database
            $this->otherProduct->reviews()->create([
                'user_id' => auth()->id(),
                'rating' => $this->rating,
                'comment' => $this->comment,
            ]);

            // Reset the form
            $this->reset(['rating', 'comment']);

            // Reload reviews
            $this->reviews = $this->otherProduct->reviews;
        }
        public function mount($slug)
        {
            $this->otherProduct = OtherProduct::where('slug', $slug)->firstOrFail();
        $this->reviews = $this->otherProduct->reviews ?? [];

        }
        public function addToWishlist()
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
            $existingWishlistItem = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->otherProduct->id)
                ->where('product_type', OtherProduct::class)
                ->first();

            if ($existingWishlistItem) {
                session()->flash('message', 'Sản phẩm đã có trong danh sách yêu thích!');
            } else {
                // Thêm sản phẩm vào wishlist
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $this->otherProduct->id,
                    'product_type' => OtherProduct::class,
                ]);
                session()->flash('message', 'Đã thêm sản phẩm vào danh sách yêu thích!');
            }
        }

        public function addToCart()
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('other_product_id', $this->otherProduct->id)
                ->first();

            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $this->quantity,
                    'price' => $this->otherProduct->price,
                ]);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'other_product_id' => $this->otherProduct->id,
                    'quantity' => $this->quantity,
                    'price' => $this->otherProduct->price,
                ]);
            }

            $cart->update([
                'total' => $cart->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
            ]);

            session()->flash('message', 'Sản phẩm đã được thêm vào giỏ hàng.');
        }

        public function closePopup()
        {
            // Set biến để ẩn popup
            $this->showPopup = false;

            // Xóa flash session
            session()->forget('message');
        }

        public function render()
        {
            return view('livewire.other-product-detail');
        }
    }
