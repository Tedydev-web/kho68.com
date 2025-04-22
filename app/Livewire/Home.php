<?php

    namespace App\Livewire;

    use App\Models\WordpressProduct;
    use App\Models\OtherProduct;
    use App\Models\Course;
    use App\Models\SocialAccountProduct;
    use App\Models\Cart;
    use App\Models\CartItem;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Component;

    class Home extends Component
    {
        public $topWordpressProducts;
        public $keyProducts;
        public $latestCourses;
        public $latestSocialAccounts;

        public function mount()
        {
            // Lấy ra 8 sản phẩm bán chạy thuộc category chứa từ 'wordpress'
            $this->topWordpressProducts = WordpressProduct::whereHas('category', function ($query) {
                $query->where('name', 'like', '%wordpress%')
                    ->orWhere('name', 'like', '%theme%')
                    ->orWhere('name', 'like', '%plugin%');
            })
//                ->where('sold', '>=', 20)
                ->orderBy('sold', 'desc')
                ->take(8)
                ->get();

            // Lấy ra 4 sản phẩm khác thuộc category chứa từ 'key'
            $this->keyProducts = OtherProduct::whereHas('category', function ($query) {
                $query->where('name', 'like', '%key%');
            })
                ->latest()
                ->take(4)
                ->get();

            // Lấy ra 4 khóa học mới nhất
            $this->latestCourses = Course::latest()
                ->take(4)
                ->get();

            // Lấy ra 4 social account mới nhất
            $this->latestSocialAccounts = SocialAccountProduct::latest()
                ->take(4)
                ->get();
        }

        public function addToCart($productId)
        {
            // Kiểm tra nếu user đã đăng nhập
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Lấy sản phẩm
            $product = WordpressProduct::findOrFail($productId);

            // Tính giá sử dụng giá khuyến mãi nếu có, nếu không thì dùng giá gốc
            $price = $product->sale_price ?: $product->price;

            // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('wordpress_product_id', $product->id)
                ->first();

            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1,
                    'price' => $price,
                ]);
            } else {
                // Nếu chưa có, tạo mới cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'wordpress_product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $price,
                ]);
            }

            // Tính tổng giỏ hàng
            $cart->update([
                'total' => $cart->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
            ]);

            // Chuyển hướng tới trang thanh toán
            return redirect()->route('checkout');
        }

        public function addToCartOtherProduct($productId)
        {
            // Kiểm tra nếu user đã đăng nhập
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Lấy sản phẩm
            $otherProduct = OtherProduct::findOrFail($productId);

            // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('other_product_id', $otherProduct->id)
                ->first();

            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1,
                    'price' => $otherProduct->price,
                ]);
            } else {
                // Nếu chưa có, tạo mới cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'other_product_id' => $otherProduct->id,
                    'quantity' => 1,
                    'price' => $otherProduct->price,
                ]);
            }

            // Cập nhật tổng giỏ hàng
            $cart->update([
                'total' => $cart->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
            ]);

            // Chuyển hướng tới trang thanh toán
            return redirect()->route('checkout');
        }

        public function addToCartCourse($courseId)
        {
            // Kiểm tra nếu user đã đăng nhập
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Lấy khóa học
            $course = Course::findOrFail($courseId);

            // Tính giá sử dụng giá khuyến mãi nếu có, nếu không thì dùng giá gốc
            $price = $course->sale_price ?: $course->price;

            // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Kiểm tra xem khóa học đã có trong giỏ hàng chưa
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('course_product_id', $course->id)
                ->first();

            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1,
                    'price' => $price,
                ]);
            } else {
                // Nếu chưa có, tạo mới cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'course_product_id' => $course->id,
                    'quantity' => 1,
                    'price' => $price,
                ]);
            }

            // Cập nhật tổng giỏ hàng
            $cart->update([
                'total' => $cart->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
            ]);

            // Chuyển hướng tới trang thanh toán
            return redirect()->route('checkout');
        }

        public function addToCartSocialAccount($productId)
        {
            // Kiểm tra nếu user đã đăng nhập
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Lấy sản phẩm và attribute đầu tiên
            $product = SocialAccountProduct::findOrFail($productId);
            $attribute = $product->attributes->first();

            // Tìm giỏ hàng của user hoặc tạo mới nếu chưa có
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa với attribute đầu tiên
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('social_account_product_id', $product->id)
                ->where('attribute_id', $attribute->id)
                ->first();

            if ($cartItem) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1,
                    'price' => $attribute->additional_price, // Sử dụng giá của attribute đầu tiên
                ]);
            } else {
                // Nếu chưa có, tạo mới cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'social_account_product_id' => $product->id,
                    'attribute_id' => $attribute->id, // Lưu attribute đầu tiên
                    'quantity' => 1,
                    'price' => $attribute->additional_price,
                ]);
            }

            // Cập nhật tổng giỏ hàng
            $cart->update([
                'total' => $cart->items->sum(function ($item) {
                    return $item->quantity * $item->price;
                }),
            ]);

            // Chuyển hướng tới trang thanh toán
            return redirect()->route('checkout');
        }

        public function render()
        {
            return view('livewire.home', [
                'topWordpressProducts' => $this->topWordpressProducts,
                'keyProducts' => $this->keyProducts,
                'latestCourses' => $this->latestCourses,
                'latestSocialAccounts' => $this->latestSocialAccounts,
            ]);
        }
    }
