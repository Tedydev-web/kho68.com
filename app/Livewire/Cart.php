<?php

    namespace App\Livewire;

    use Livewire\Component;
    use App\Models\Cart as CartModel;
    use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Course;
    use App\Models\Product;
    use App\Models\SocialAccountProduct;
    use App\Models\OtherProduct;
    use Illuminate\Support\Facades\Auth;

    class Cart extends Component
    {
        public $cart;
        public $discountCodeInput;
        public $discountAmountInput = 0; // Giá trị giảm giá

        public function checkDiscount()
        {
            // Tìm kiếm mã giảm giá dựa trên mã nhập vào
            $coupon = Coupon::where('code', $this->discountCodeInput)->first();

            if ($coupon) {
                // Kiểm tra xem mã giảm giá có còn hiệu lực không
                if ($coupon->start_date <= now() && $coupon->end_date >= now()) {
                    // Kiểm tra xem giỏ hàng đã có mã giảm giá chưa
                    if ($this->cart->discount_code) {
                        session()->flash('message', 'Mã giảm giá cũ (' . $this->cart->discount_code . ') đã được thay thế!');
                    }

                    // Lưu thông tin mã giảm giá vào giỏ hàng nhưng không thay đổi `total`
                    $this->cart->discount_code = $coupon->code;
                    $this->cart->discount_amount = $coupon->discount_amount;
                    $this->cart->discount_type = $coupon->discount_type;

                    // Chỉ lưu thông tin về mã giảm giá mà không thay đổi `total`
                    $this->cart->save();

                    session()->flash('message', 'Mã giảm giá hợp lệ: ' . $this->cart->discount_code . ' đã được áp dụng thành công!');
                } else {
                    session()->flash('error', 'Mã giảm giá đã hết hạn!');
                }
            } else {
                session()->flash('error', 'Mã giảm giá không hợp lệ!');
            }
        }

        // Hàm tính toán giảm giá
        private function calculateDiscount($amount, $type)
        {
            if ($type == 'percentage') {
                return ($this->cart->total * ($amount / 100));
            }

            return $amount; // Giảm giá cố định
        }


        public function mount()
        {
            // Kiểm tra nếu người dùng đã đăng nhập, lấy giỏ hàng hiện tại
            if (Auth::check()) {
                $this->cart = CartModel::firstOrCreate([
                    'user_id' => Auth::id(),
                ]);
            }
        }

        public function deleteItem($itemId)
        {
            $cartItem = CartItem::find($itemId);
            if ($cartItem) {
                $cartItem->delete();
                // Update cart total
                $this->cart->total = $this->cart->items->sum(fn($item) => $item->quantity * $item->price);
                $this->cart->save();

                session()->flash('message', 'Đã xóa sản phẩm!');
            }
        }

        public function clearCart()
        {
            $this->cart->items()->delete();
            $this->cart->total = 0;
            $this->cart->save();

            session()->flash('message', 'Đã xóa tất cả sản phẩm!');
        }

        public function updateQuantity($itemId, $quantity)
        {
            $cartItem = CartItem::find($itemId);
            if ($cartItem && $quantity > 0) {
                $cartItem->quantity = $quantity;
                $cartItem->save();

                // Update cart total
                $this->cart->total = $this->cart->items->sum(fn($item) => $item->quantity * $item->price);
                $this->cart->save();

                session()->flash('message', 'Đã cập nhật giỏ hàng!');
            }
        }

        public function addToCart($productId, $quantity = 1, $type = 'wordpress')
        {
            $model = $this->getModelByType($type);
            $product = $model::findOrFail($productId);

            // Check if the product already exists in the cart
            $cartItem = $this->cart->items()->where($type . '_product_id', $product->id)->first();

            if ($cartItem) {
                // If exists, update quantity
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // If not, create a new cart item
                $this->cart->items()->create([
                    $type . '_product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'type' => $type,
                ]);
            }

            // Update the cart total
            $this->cart->total = $this->cart->items->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $this->cart->save();

            session()->flash('message', 'Sản phẩm đã được thêm vào giỏ hàng!');
        }

        private function getModelByType($type)
        {
            $models = [
                'wordpress' => \App\Models\WordpressProduct::class,
                'course' => \App\Models\Course::class,
                'social' => \App\Models\SocialAccountProduct::class,
                'other' => \App\Models\OtherProduct::class,
            ];

            return $models[$type];
        }

//        public function render()
//        {
//            return view('livewire.cart', [
//                'cartItems' => $this->cart ? $this->cart->items : [],
//            ]);
//        }
//        public function addToCart($productId, $quantity = 1)
//        {
//            $product = Product::findOrFail($productId);
//
//            $cartItem = $this->cart->items()->where('product_id', $product->id)->first();
//
//            if ($cartItem) {
//                $cartItem->quantity += $quantity;
//                $cartItem->save();
//            } else {
//                $this->cart->items()->create([
//                    'product_id' => $product->id,
//                    'quantity' => $quantity,
//                    'price' => $product->price,
//                ]);
//            }
//
//            $this->cart->total = $this->cart->items->sum(function ($item) {
//                return $item->quantity * $item->price;
//            });
//            $this->cart->save();
//
//            session()->flash('message', 'Sản phẩm đã được thêm vào giỏ hàng!');
//        }

//        public function addCourseToCart($courseId, $quantity = 1)
//        {
//            $course = Course::findOrFail($courseId);
//
//            $cartItem = $this->cart->items()->where('course_product_id', $course->id)->first();
//
//            if ($cartItem) {
//                $cartItem->quantity += $quantity;
//                $cartItem->save();
//            } else {
//                $this->cart->items()->create([
//                    'course_product_id' => $course->id,
//                    'quantity' => $quantity,
//                    'price' => $course->price,
//                ]);
//            }
//
//            $this->cart->total = $this->cart->items->sum(function ($item) {
//                return $item->quantity * $item->price;
//            });
//            $this->cart->save();
//
//            session()->flash('message', 'Khóa học đã được thêm vào giỏ hàng!');
//        }

        public function render()
        {
            $cartItems = $this->cart ? $this->cart->items : [];

            // Lấy tên sản phẩm dựa trên loại sản phẩm
            foreach ($cartItems as $item) {
                if ($item->wordpress_product_id) {
                    $item->product = \App\Models\WordpressProduct::find($item->wordpress_product_id);
                    $item->type = 'wordpress';
                } elseif ($item->social_account_product_id) {
                    $item->product = \App\Models\SocialAccountProduct::find($item->social_account_product_id);
                    $item->attribute = \App\Models\SocialAccountProductAttribute::find($item->attribute_id); // Lấy tên thuộc tính
                    $item->type = 'social';
                } elseif ($item->course_product_id) {
                    $item->product = \App\Models\Course::find($item->course_product_id);
                    $item->type = 'course';
                } elseif ($item->other_product_id) {
                    $item->product = \App\Models\OtherProduct::find($item->other_product_id);
                    $item->type = 'other';
                }
            }

            return view('livewire.cart', [
                'cartItems' => $cartItems,
                'discountCode' => $this->cart->discount_code,
                'discountAmount' => $this->cart->discount_amount,
            ]);
        }

    }
