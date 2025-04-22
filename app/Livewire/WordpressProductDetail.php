<?php

    namespace App\Livewire;

    use App\Models\CartItem;
    use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\WordpressProduct;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class WordpressProductDetail extends Component
    {
        public $product;
        public $quantity = 1; // Số lượng mặc định là 1
        public $showPopup = true; // Khởi tạo popup hiện lên
        public $rating;
        public $comment;
        public $reviews;
        public $selectedImageId; // Thêm thuộc tính để lưu ID ảnh đã chọn

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
        public function mount($slug)
        {
            $this->product = WordpressProduct::where('slug', $slug)->firstOrFail();
            $this->reviews = $this->product->reviews;
            $this->selectedImageId = $this->product->image; // Khởi tạo với ảnh mặc định


        }

    public function selectImage($imageId)
    {
        $this->selectedImageId = $imageId; // Cập nhật ID ảnh đã chọn
    }
        public function addToWishlist()
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
            $existingWishlistItem = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->where('product_type', WordpressProduct::class)
                ->first();

            if ($existingWishlistItem) {
                session()->flash('message', 'Sản phẩm đã có trong danh sách yêu thích!');
            } else {
                // Thêm sản phẩm vào wishlist
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $this->product->id,
                    'product_type' => WordpressProduct::class,
                ]);
                session()->flash('message', 'Đã thêm sản phẩm vào danh sách yêu thích!');
            }
        }
        public function addToCart()
        {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('wordpress_product_id', $this->product->id)
                ->first();

            $price = $this->product->sale_price ?? $this->product->price; // Sử dụng giá sale nếu có

            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $this->quantity,
                    'price' => $price, // Cập nhật với giá sale
                ]);
            } else {
                // Nếu chưa có, tạo mới cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'wordpress_product_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'price' => $price, // Sử dụng giá sale nếu có
                ]);
            }

            // Tính tổng giỏ hàng
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
            return view('livewire.wordpress-product-detail', [
                'product' => $this->product
            ]);
        }
    }
