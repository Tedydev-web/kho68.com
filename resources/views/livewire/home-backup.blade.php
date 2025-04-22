<section class="section feature-part">
    <div class="container">

        <div class="owl-carousel owl-theme mt-5" style="border-radius: 10px">
            <div class="item" style="border-radius: 10px">
                <img style="border-radius: 10px" src="https://gamikey.com/wp-content/uploads/2024/07/Banner-Gemini-1-1024x512.jpg" alt="Slide 1" class="img-fluid">
            </div>
            <div class="item" style="border-radius: 10px">
                <img style="border-radius: 10px" src="https://gamikey.com/wp-content/uploads/2023/04/Canva-1024x512.jpg.webp" alt="Slide 2" class="img-fluid">
            </div>
            <div class="item" style="border-radius: 10px">
                <img style="border-radius: 10px" src="https://gamikey.com/wp-content/uploads/2024/05/Banner-Telegram-1024x512.jpg" alt="Slide 3" class="img-fluid">
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true, // Lặp lại các slide
                    margin: 10, // Khoảng cách giữa các item
                    nav: true, // Hiển thị nút điều hướng
                    dots: true, // Hiển thị dấu chấm chỉ định slide
                    autoplay: true, // Tự động chạy slide
                    autoplayTimeout: 3000, // Thoi gian giờ chạy slide
                    autoplayHoverPause: true
                    , navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"]
                    , responsiveClass: true
                    , responsive: { // Thiết lập responsive cho các kích thước màn hình
                        0: {
                            items: 1, // 1 item hiển thị trên màn hình nhỏ
                            nav: false
                        }
                        , 600: {
                            items: 2, // 2 item hiển thị trên màn hình vừa
                            nav: false
                        }
                        , 1000: {
                            items: 3, // 3 item hiển thị trên màn hình lớn
                            nav: true
                        }
                    }
                });
            });

        </script>
        <style>
            /* Tùy chỉnh các mũi tên điều hướng */
            .owl-nav {
                position: absolute;
                top: 50%;
                width: 100%;
                display: flex;
                justify-content: space-between;
                transform: translateY(-50%);
            }

            .owl-nav button {
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 18px;
                cursor: pointer;
            }

            .owl-nav button:hover {
                background-color: rgba(0, 0, 0, 0.7);
            }

            Mũi tên ở màn hình nhỏ sẽ ẩn @media (max-width: 999px) {
                .owl-nav {
                    display: none;
                }
            }

        </style>

        {{-- Top item --}}
        <div class="row mb-5 mt-5">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="home-heading mb-3" style="text-align: center">
                            <h3 style="justify-content: space-between">
                                Top items Wordpress bán chạy
                                {{-- <span style="font-weight: normal; font-size: small"><a type="button" class="btn btn-primary">Xem thêm <i class="fa-solid fa-arrow-right"></i></a></span> --}}
                            </h3>
                        </div>
                        <div class="row">
                            @foreach($topWordpressProducts as $product)
                            <div class="prod-item col-sm-3 col-md-3">
                                <div class="product-box4">
                                    <div class="product-head-box4">
                                        <img style="height: 100%;height: 50px;object-fit: cover;" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" />
                                        <a href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}">
                                            <h4 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $product->name }}</h4>
                                        </a>
                                    </div>
                                    <div class="product-footer-box4">
                                        <div class="row">
                                            <div class="col-6 d-flex" style="flex-direction: column; justify-content: center">
                                                <div class="price-box4" style="text-align: center">
                                                    @if($product->sale_price)
                                                    <span style="text-decoration: line-through; color: grey;">
                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                    </span>
                                                    <strong style="color: red;">
                                                        {{ number_format($product->sale_price, 0, ',', '.') }}đ
                                                    </strong>
                                                    @else
                                                    <strong>
                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                    </strong>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                            {{-- @foreach($topWordpressProducts as $product)--}}
                            {{-- <div class="prod-item col-sm-6 col-md-6 col-xl-3 mb-3">--}}
                            {{-- <div class="product-box4">--}}
                            {{-- <div class="product-head-box4" style="flex-direction: column">--}}
                            {{-- <a style="color: black"--}}
                            {{-- href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}"><img--}} {{--                                                    style="height: 100%;height: 200px;object-fit: cover;"--}} {{--                                                    src="{{ Storage::url($product->image) }}"--}} {{--                                                    style="height: 100%"/>--}} {{--                                                <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">--}} {{--                                                    {{ $product->name }}--}} {{--                                                </h4>--}} {{--                                            </a>--}} {{--                                        </div>--}} {{--                                        <div class="product-footer-box4">--}} {{--                                            <div class="row">--}} {{--                                                <div class="col-12">--}} {{--                                                    <div class="price-box4" style="text-align: center">--}} {{--                                                        @if($product->sale_price)--}} {{--                                                            <span style="text-decoration: line-through; color: grey;">--}} {{--                                                                {{ number_format($product->price, 0, ',', '.') }}đ--}} {{--                                                            </span>--}} {{--                                                            <strong style="color: red;">--}} {{--                                                                {{ number_format($product->sale_price, 0, ',', '.') }}đ--}} {{--                                                            </strong>--}} {{--                                                        @else--}} {{--                                                            <strong>--}} {{--                                                                {{ number_format($product->price, 0, ',', '.') }}đ--}} {{--                                                            </strong>--}} {{--                                                        @endif--}} {{--                                                    </div>--}} {{--                                                </div>--}} {{--                                            </div>--}} {{--                                        </div>--}} {{--                                        <div class="product-buttons-box4">--}} {{--                                            <a href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}"--}} {{--                                               class="btn more-btn-box4">--}} {{--                                                <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết--}} {{--                                            </a>--}} {{--                                            <button wire:click="addToCart({{ $product->id }})" type="button" --}} {{--                                                    class="btn buy-btn-box4">--}} {{--                                                <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay--}} {{--                                            </button>--}} {{--                                        </div>--}} {{--                                    </div>--}} {{--                                </div>--}} {{--                            @endforeach--}} </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Key phần mềm --}}
            {{-- <div class="row mb-5"> --}}
            {{-- <div class="col-xl-12"> --}}
            {{-- <div class="row"> --}}
            {{-- <div class="col-lg-12 mb-5"> --}}
            {{-- <div class="home-heading mb-3" style="text-align: center"> --}}
            {{-- <h3 style="justify-content: space-between"> --}}
            {{-- Key phần mềm bán chạy --}}
            {{-- <span style="font-weight: normal; font-size: small"><a type="button" --}}
            {{-- class="btn btn-primary">Xem thêm <i --}}
            {{-- class="fa-solid fa-arrow-right"></i></a></span> --}}
            {{-- </h3> --}}
            {{-- </div> --}}
            {{-- <div class="row"> --}}
            {{-- @foreach($keyProducts as $product) --}}
            {{-- <div class="prod-item col-sm-6 col-md-6 col-xl-3 mb-3"> --}}
            {{-- <div class="product-box4 "> --}}
            {{-- <div class="product-head-box4" style="flex-direction: column"> --}}
            {{-- <img style="height: 100%;height: 200px;object-fit: cover;" --}}
            {{-- src="{{ Storage::url($product->thumbnail) }}" --}}
            {{-- style="height: 100%"/> --}}
            {{-- <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal"> --}}
            {{-- {{ $product->name }} --}}
            {{-- </h4> --}}
            {{-- </div> --}}
            {{-- <div class="product-footer-box4"> --}}
            {{-- <div class="row"> --}}
            {{-- <div class="col-12"> --}}
            {{-- <div class="price-box4" style="text-align: center"> --}}
            {{-- <strong>{{ number_format($product->price, 0, ',', '.') }} --}}
            {{-- đ</strong> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- <div class="product-buttons-box4"> --}}
            {{-- <a href="{{ route('other-product-detail', ['slug' => $product->slug]) }}" --}}
            {{-- class="btn more-btn-box4"> --}}
            {{-- <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết --}}
            {{-- </a> --}}
            {{-- <button wire:click="addToCartOtherProduct({{ $product->id }})" type="button" --}}
            {{-- class="btn buy-btn-box4"> --}}
            {{-- <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay --}}
            {{-- </button> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- @endforeach --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}

            {{-- Khóa học online --}}
            <div class="row mb-5">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <div class="home-heading mb-3">
                                <h3 style="justify-content: space-between">
                                    Khóa học online phổ biến
                                    {{-- <span style="font-weight: normal; font-size: small"><a type="button" class="btn btn-primary">Xem thêm <i class="fa-solid fa-arrow-right"></i></a></span> --}}
                                </h3>
                            </div>
                            <div class="row">
                                @foreach($latestCourses as $course)
                                <div class="prod-item col-sm-3 col-md-3">
                                    <div class="product-box4">
                                        <div class="product-head-box4">
                                            <img style="height: 100%;height: 50px;object-fit: cover;" src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" />
                                            <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}">
                                                <h4 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $course->title }}</h4>
                                            </a>
                                        </div>
                                        <div class="product-footer-box4">
                                            <div class="row">
                                                <div class="col-6 d-flex" style="flex-direction: column; justify-content: center">
                                                    <div class="price-box4" style="text-align: center">
                                                        @if($course->sale_price)
                                                        <span style="text-decoration: line-through; color: grey;">
                                                            {{ number_format($course->price, 0, ',', '.') }}đ
                                                        </span>
                                                        <strong style="color: red;">
                                                            {{ number_format($course->sale_price, 0, ',', '.') }}đ
                                                        </strong>
                                                        @else
                                                        <strong>
                                                            {{ number_format($course->price, 0, ',', '.') }}đ
                                                        </strong>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}" class="btn more-btn-box4">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                {{-- @foreach($latestCourses as $course)--}}
                                {{-- <div class="prod-item col-sm-6 col-md-6 col-xl-3 mb-3">--}}
                                {{-- <div class="product-box4">--}}
                                {{-- <div class="product-head-box4" style="flex-direction: column">--}}
                                {{-- <img--}}
                                {{-- style="height: 100%;height: 200px;object-fit: cover; aspect-ratio: 16/9"--}}
                                {{-- src="{{ Storage::url($course->image) }}" style="height: 100%"/>--}}
                                {{-- <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">--}}
                                {{-- {{ $course->title }}--}}
                                {{-- </h4>--}}
                                {{-- </div>--}}
                                {{-- <div class="product-footer-box4">--}}
                                {{-- <div class="row">--}}
                                {{-- <div class="col-12">--}}
                                {{-- <div class="price-box4" style="text-align: center">--}}
                                {{-- @if($course->sale_price)--}}
                                {{-- <span style="text-decoration: line-through; color: grey;">--}}
                                {{-- {{ number_format($course->price, 0, ',', '.') }}đ--}}
                                {{-- </span>--}}
                                {{-- <strong style="color: red;">--}}
                                {{-- {{ number_format($course->sale_price, 0, ',', '.') }}đ--}}
                                {{-- </strong>--}}
                                {{-- @else--}}
                                {{-- <strong>--}}
                                {{-- {{ number_format($course->price, 0, ',', '.') }}đ--}}
                                {{-- </strong>--}}
                                {{-- @endif--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                {{-- <div class="product-buttons-box4">--}}
                                {{-- <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}"--}}
                                {{-- class="btn more-btn-box4">--}}
                                {{-- <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết--}}
                                {{-- </a>--}}
                                {{-- <button wire:click="addToCartCourse({{ $course->id }})" type="button"--}}
                                {{-- class="btn buy-btn-box4">--}}
                                {{-- <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay--}}
                                {{-- </button>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}
                                {{-- @endforeach--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Clone Facebook --}}
            <div class="row mb-5">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-12 mb-5" id="category15">
                            <div class="home-heading mb-3">
                                <h3 style="justify-content: space-between">
                                    Tài khoản mạng xã hội
                                    {{-- <span style="font-weight: normal; font-size: small"><a type="button" class="btn btn-primary">Xem thêm <i class="fa-solid fa-arrow-right"></i></a></span> --}}
                                </h3>
                            </div>
                            {{-- <div class="row"> --}}
                            {{-- @foreach($latestSocialAccounts as $account) --}}
                            {{-- <div class="prod-item col-sm-6 col-md-6 col-xl-3 mb-3"> --}}
                            {{-- <div class="product-box4"> --}}
                            {{-- <div class="product-head-box4"> --}}
                            {{-- <img style="height: 100%;height: 50px;object-fit: cover;" --}}
                            {{-- src="{{ asset('storage/' . $account->thumbnail) }}" --}}
                            {{-- alt="{{ $account->name }}"/> --}}
                            {{-- <h4>{{ $account->name }}</h4> --}}
                            {{-- </div> --}}
                            {{-- <div class="product-body-box4"> --}}
                            {{-- <p><i class="fa-solid"></i> {!! $account->short_content !!}</p> --}}
                            {{-- </div> --}}
                            {{-- <div class="product-footer-box4"> --}}
                            {{-- <div class="row"> --}}
                            {{-- <div class="col-4 text-center border-end-box4"> --}}
                            {{-- <strong>Quốc gia</strong> --}}
                            {{-- <img src="https://flagcdn.com/w160/vn.png" alt="product"> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-4 text-center border-end-box4"> --}}
                            {{-- <strong>Còn hàng</strong> --}}
                            {{-- <span --}}
                            {{-- class="badge bg-primary rounded-pill">{{ $account->stock }}</span> --}}
                            {{-- </div> --}}
                            {{-- <div class="col-4"> --}}
                            {{-- <div class="price-box4"> --}}
                            {{-- <strong>{{ number_format($account->attributes->first()->additional_price, 0, ',', '.') }} --}}
                            {{-- đ</strong> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- <div class="product-buttons-box4"> --}}
                            {{-- <a href="{{ route('social-product-detail', ['slug' => $account->slug]) }}" --}}
                            {{-- class="btn more-btn-box4"> --}}
                            {{-- <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết --}}
                            {{-- </a> --}}
                            {{-- <button wire:click="addToCartSocialAccount({{ $account->id }})" --}}
                            {{-- type="button" class="btn buy-btn-box4"> --}}
                            {{-- <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay --}}
                            {{-- </button> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- @endforeach --}}
                            {{-- </div> --}}
                            <div class="row">
                                @foreach($latestSocialAccounts as $account)
                                <div class="prod-item col-sm-3 col-md-3">
                                    <div class="product-box4">
                                        <div class="product-head-box4">
                                            <img style="height: 100%;height: 50px;object-fit: cover;" src="{{ Storage::url($account->thumbnail) }}" alt="{{ $account->name }}" />
                                            <a href="{{ route('course-product-detail', ['slug' => $account->slug]) }}">
                                                <h4 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $account->name }}</h4>
                                            </a>
                                        </div>
                                        <div class="product-footer-box4">
                                            <div class="row">
                                                <div class="col-6 d-flex" style="flex-direction: column; justify-content: center">
                                                    <div class="price-box4" style="text-align: center">
                                                        <strong>{{ number_format($account->attributes->first()->additional_price, 0, ',', '.') }}
                                                            đ
                                                            - {{ number_format($account->attributes->last()->additional_price, 0, ',', '.') }}
                                                            đ</strong>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('social-product-detail', ['slug' => $account->slug]) }}" class="btn more-btn-box4">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                {{-- @foreach($latestSocialAccounts as $account)
                                <div class="prod-item col-sm-6 col-md-6">
                                    <div class="product-box4">
                                        <div class="product-head-box4">
                                            <img style="height: 100%;height: 50px;object-fit: cover;" src="{{ Storage::url($account->thumbnail) }}" alt="{{ $account->name }}" />
                                            <h4>{{ $account->name }}</h4>
                                        </div>
                                        <div class="product-footer-box4">
                                            <div class="row">
                                                <div class="col-6 d-flex" style="flex-direction: column; justify-content: center">
                                                    <div class="price-box4 text-center">
                                                        <strong>{{ number_format($account->attributes->first()->additional_price, 0, ',', '.') }}
                                                            đ
                                                            - {{ number_format($account->attributes->last()->additional_price, 0, ',', '.') }}
                                                            đ</strong>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('social-product-detail', ['slug' => $account->slug]) }}" class="btn more-btn-box4">
                                                        <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-buttons-box4">
                                            <button wire:click="addToCartSocialAccount({{ $account->id }})" type="button" class="btn buy-btn-box4">
                                                <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
