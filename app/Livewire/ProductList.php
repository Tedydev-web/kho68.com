<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SocialAccount;
use App\Models\Course;
use App\Models\OtherProduct;
use App\Models\WordpressProduct;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SocialAccountProduct;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public $categorySlug;
    public $categoryName;
    public $socialAccounts = [];
    public $courses = [];
    public $otherProducts = [];
    public $wordpressProducts = [];
    public $childCategories = []; // Lưu danh sách các danh mục con
    public $searchTerm = '';  // Biến để lưu giá trị tìm kiếm

    public $priceRangeMin = 0;  // Biến để lưu khoảng giá
    public $priceRangeMax = 1000000;  // Biến để lưu khoảng giá
    public $sortBy = '';
    public function mount($slug)
    {
        $this->categorySlug = $slug;
        $this->loadProducts();
    }
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['searchTerm', 'priceRangeMin', 'priceRangeMax', 'sortBy'])) {
            $this->loadProducts();
        }
    }

    public function loadProducts()
    {
        $category = Category::where('slug', $this->categorySlug)->first();

        if ($category) {
            $this->categoryName = $category->name;

            // Kiểm tra xem danh mục có chứa danh mục con không
            $this->childCategories = $category->children()->get();

            // Lọc danh mục con và sản phẩm trong đó
            foreach ($this->childCategories as $childCategory) {

                // SocialAccountProducts (assume SocialAccountProduct represents products)
                $socialAccountProductsQuery = $childCategory->socialAccountProducts();
                if ($this->searchTerm) {
                    $socialAccountProductsQuery->where('social_account_products.name', 'like', '%' . $this->searchTerm . '%');
                }
                if ($this->priceRangeMin && $this->priceRangeMax) {
                    $socialAccountProductsQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
                }
                if ($this->sortBy === 'name_asc') {
                    $socialAccountProductsQuery->orderBy('name', 'asc');
                } elseif ($this->sortBy === 'name_desc') {
                    $socialAccountProductsQuery->orderBy('name', 'desc');
                } elseif ($this->sortBy === 'price_asc') {
                    $socialAccountProductsQuery->orderBy('price', 'asc');
                } elseif ($this->sortBy === 'price_desc') {
                    $socialAccountProductsQuery->orderBy('price', 'desc');
                }
                // Áp dụng tương tự cho các query của Courses, OtherProducts, và WordpressProducts

                $childCategory->socialAccountProducts = $socialAccountProductsQuery->get();

                // Courses
                $coursesQuery = $childCategory->courses();
                if ($this->searchTerm) {
                    $coursesQuery->where('title', 'like', '%' . $this->searchTerm . '%');
                }
                if ($this->priceRangeMin && $this->priceRangeMax) {
                    $coursesQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
                }
                if ($this->sortBy === 'name_asc') {
                    $coursesQuery->orderBy('title', 'asc');
                } elseif ($this->sortBy === 'name_desc') {
                    $coursesQuery->orderBy('title', 'desc');
                } elseif ($this->sortBy === 'price_asc') {
                    $coursesQuery->orderBy('price', 'asc');
                } elseif ($this->sortBy === 'price_desc') {
                    $coursesQuery->orderBy('price', 'desc');
                }
                // Áp dụng tương tự cho các query của Courses, OtherProducts, và WordpressProducts

                $childCategory->courses = $coursesQuery->get();

                // OtherProducts
                $otherProductsQuery = $childCategory->otherProducts();
                if ($this->searchTerm) {
                    $otherProductsQuery->where('name', 'like', '%' . $this->searchTerm . '%');
                }
                if ($this->priceRangeMin && $this->priceRangeMax) {
                    $otherProductsQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
                }
                if ($this->sortBy === 'name_asc') {
                    $otherProductsQuery->orderBy('name', 'asc');
                } elseif ($this->sortBy === 'name_desc') {
                    $otherProductsQuery->orderBy('name', 'desc');
                } elseif ($this->sortBy === 'price_asc') {
                    $otherProductsQuery->orderBy('price', 'asc');
                } elseif ($this->sortBy === 'price_desc') {
                    $otherProductsQuery->orderBy('price', 'desc');
                }
                // Áp dụng tương tự cho các query của Courses, OtherProducts, và WordpressProducts

                $childCategory->otherProducts = $otherProductsQuery->get();

                // WordpressProducts
                $wordpressProductsQuery = $childCategory->wordpressProducts();
                if ($this->searchTerm) {
                    $wordpressProductsQuery->where('name', 'like', '%' . $this->searchTerm . '%');
                }
                if ($this->priceRangeMin && $this->priceRangeMax) {
                    $wordpressProductsQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
                }
                if ($this->sortBy === 'name_asc') {
                    $wordpressProductsQuery->orderBy('name', 'asc');
                } elseif ($this->sortBy === 'name_desc') {
                    $wordpressProductsQuery->orderBy('name', 'desc');
                } elseif ($this->sortBy === 'price_asc') {
                    $wordpressProductsQuery->orderBy('price', 'asc');
                } elseif ($this->sortBy === 'price_desc') {
                    $wordpressProductsQuery->orderBy('price', 'desc');
                }
                // Áp dụng tương tự cho các query của Courses, OtherProducts, và WordpressProducts

                $childCategory->wordpressProducts = $wordpressProductsQuery->get();
            }
            // Lấy và lọc sản phẩm cho SocialAccounts
            $socialAccountsQuery = SocialAccount::where('category_id', $category->id)->with([
                'products' => function ($query) {
                    if ($this->searchTerm) {
                        $query->where('name', 'like', '%' . $this->searchTerm . '%');
                    }
                    // Chỉ lọc theo khoảng giá nếu cả priceRangeMin và priceRangeMax có giá trị
                    if ($this->priceRangeMin !== null && $this->priceRangeMax !== null) {
                        $query->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
                    }
                }
            ]);
            $this->socialAccounts = $socialAccountsQuery->get();

            // Lấy và lọc sản phẩm cho Courses
            $coursesQuery = Course::where('category_id', $category->id);
            if ($this->searchTerm) {
                $coursesQuery->where('title', 'like', '%' . $this->searchTerm . '%');
            }
            if ($this->priceRangeMin !== null && $this->priceRangeMax !== null) {
                $coursesQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
            }
            $this->courses = $coursesQuery->get();

            // Lấy và lọc sản phẩm cho OtherProducts
            $otherProductsQuery = OtherProduct::where('category_id', $category->id);
            if ($this->searchTerm) {
                $otherProductsQuery->where('name', 'like', '%' . $this->searchTerm . '%');
            }
            if ($this->priceRangeMin !== null && $this->priceRangeMax !== null) {
                $otherProductsQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
            }
            $this->otherProducts = $otherProductsQuery->get();

            // Lấy và lọc sản phẩm cho WordpressProducts
            $wordpressProductsQuery = WordpressProduct::where('category_id', $category->id);
            if ($this->searchTerm) {
                $wordpressProductsQuery->where('name', 'like', '%' . $this->searchTerm . '%');
            }
            if ($this->priceRangeMin !== null && $this->priceRangeMax !== null) {
                $wordpressProductsQuery->whereBetween('price', [$this->priceRangeMin, $this->priceRangeMax]);
            }
            $this->wordpressProducts = $wordpressProductsQuery->get();
        } else {
            $this->socialAccounts = [];
            $this->courses = [];
            $this->otherProducts = [];
            $this->wordpressProducts = [];
            $this->childCategories = [];
        }
    }




    // Thêm sản phẩm Wordpress vào giỏ hàng
    public function addToCartWordpressProduct($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = WordpressProduct::findOrFail($productId);
        $price = $product->sale_price ?: $product->price;

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('wordpress_product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + 1, 'price' => $price]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'wordpress_product_id' => $product->id,
                'quantity' => 1,
                'price' => $price,
            ]);
        }

        $cart->update(['total' => $cart->items->sum(fn($item) => $item->quantity * $item->price)]);
        return redirect()->route('checkout');
    }

    // Thêm sản phẩm khác vào giỏ hàng
    public function addToCartOtherProduct($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = OtherProduct::findOrFail($productId);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('other_product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + 1, 'price' => $product->price]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'other_product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        $cart->update(['total' => $cart->items->sum(fn($item) => $item->quantity * $item->price)]);
        return redirect()->route('checkout');
    }

    // Thêm khóa học vào giỏ hàng
    public function addToCartCourse($courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $course = Course::findOrFail($courseId);
        $price = $course->sale_price ?: $course->price;

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('course_product_id', $course->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + 1, 'price' => $price]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'course_product_id' => $course->id,
                'quantity' => 1,
                'price' => $price,
            ]);
        }

        $cart->update(['total' => $cart->items->sum(fn($item) => $item->quantity * $item->price)]);
        return redirect()->route('checkout');
    }

    // Thêm sản phẩm Social Account vào giỏ hàng
    public function addToCartSocialAccount($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = SocialAccountProduct::findOrFail($productId);
        $attribute = $product->attributes->first();

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('social_account_product_id', $product->id)
            ->where('attribute_id', $attribute->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + 1, 'price' => $attribute->additional_price]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'social_account_product_id' => $product->id,
                'attribute_id' => $attribute->id,
                'quantity' => 1,
                'price' => $attribute->additional_price,
            ]);
        }

        $cart->update(['total' => $cart->items->sum(fn($item) => $item->quantity * $item->price)]);
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.category-products', [
            'socialAccounts' => $this->socialAccounts,
            'courses' => $this->courses,
            'otherProducts' => $this->otherProducts,
            'wordpressProducts' => $this->wordpressProducts,
            'childCategories' => $this->childCategories,
        ]);
    }
}
