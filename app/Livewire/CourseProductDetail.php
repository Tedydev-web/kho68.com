<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Course;
use App\Models\Wishlist;

class CourseProductDetail extends Component
{
    public $course;
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
        $this->course->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        // Reset the form
        $this->reset(['rating', 'comment']);

        // Reload reviews
        $this->reviews = $this->course->reviews;
    }
    public function closePopup()
    {
        // Set biến để ẩn popup
        $this->showPopup = false;

        // Xóa flash session
        session()->forget('message');
    }
    public function addToWishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Kiểm tra xem khóa học đã có trong danh sách yêu thích chưa
        $existingWishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->course->id)
            ->where('product_type', Course::class)
            ->first();

        if ($existingWishlistItem) {
            session()->flash('message', 'Khóa học đã có trong danh sách yêu thích!');
        } else {
            // Thêm khóa học vào wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $this->course->id,
                'product_type' => Course::class,
            ]);
            session()->flash('message', 'Đã thêm khóa học vào danh sách yêu thích!');
        }
    }
    public function mount($slug)
    {
        $this->course = Course::where('slug', $slug)->firstOrFail();
        $this->reviews = $this->course->reviews ?? [];

    }

    public function addToCart()
    {
        // Kiểm tra nếu user đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('course_product_id', $this->course->id)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $cartItem->update([
                'quantity' => $cartItem->quantity + $this->quantity,
                'price' => $this->course->sale_price ?: $this->course->price,
            ]);
        } else {
            // Nếu chưa có, tạo mới cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'course_product_id' => $this->course->id,
                'quantity' => $this->quantity,
                'price' => $this->course->sale_price ?: $this->course->price,
            ]);
        }

        // Tính tổng giỏ hàng
        $cart->update([
            'total' => $cart->items->sum(function ($item) {
                return $item->quantity * $item->price;
            }),
        ]);

        session()->flash('message', 'Khóa học đã được thêm vào giỏ hàng!');
    }

    public function render()
    {
        return view('livewire.course-product-detail', [
            'course' => $this->course
        ]);
    }
}
