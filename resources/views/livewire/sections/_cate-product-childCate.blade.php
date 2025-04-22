{{-- Hiển thị các danh mục con --}}
@if($childCategories->isNotEmpty())
    @foreach($childCategories as $childCategory)
        <div class="mb-5">
            <h3 class="text-center">{{ $childCategory->name }}</h3>

            {{-- Đếm số lượng sản phẩm đã hiển thị --}}
            @php $totalProductsDisplayed = 0; @endphp

            {{-- Social Account Products --}}
            <div class="row">
                @foreach($childCategory->socialAccountProducts->take(12) as $product)
                    @php
                        $firstAttribute = $product->attributes->first();
                        $price = $firstAttribute ? $firstAttribute->additional_price : $product->price;
                    @endphp
                    <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                        <div class="product-box4">
                            <div class="product-head-box4" style="flex-direction: column">
                                @if (strlen($product->thumbnail) > 7)
                                    <img style="height: 200px !important; object-fit: cover;" src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                                @else
                                    @php
                                        $media = \App\Models\Media::find($product->thumbnail); // Lấy media từ ID
                                    @endphp
                                    @if ($media)
                                        <x-curator-glider style="    height: 200px !important;
                                                                            object-fit: cover;" class="object-cover w-auto" :media="$product->thumbnail" glide="" :srcset="['1024w','640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                                    @else
                                        <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                                    @endif
                                @endif
                                <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">
                                    {{ $product->name }}
                                </h4>
                            </div>
                            <div class="product-footer-box4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="price-box4" style="text-align: center">
                                            <strong>{{ number_format($price, 0, ',', '.') }}
                                                VND</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons-box4">
                                <a href="{{ route('social-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                    <i class="fa-solid fa-circle-info me-1"></i>Xem chi
                                    tiết
                                </a>
                                <button wire:click="addToCartSocialAccount({{ $product->id }})" type="button" class="btn buy-btn-box4">
                                    <i class="fa-solid fa-cart-shopping me-1"></i>Mua
                                    Ngay
                                </button>
                            </div>
                        </div>
                    </div>
                    @php $totalProductsDisplayed++; @endphp
                @endforeach
            </div>

            {{-- Wordpress Products --}}
            <div class="row">
                @foreach($childCategory->wordpressProducts->take(12) as $product)
                    <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                        <div class="product-box4">
                            <div class="product-head-box4" style="flex-direction: column">
                                @if (strlen($product->image) > 7)
                                    <img style="height: 200px !important; object-fit: cover;" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                @else
                                    @php
                                        $media = \App\Models\Media::find($product->image); // Lấy media từ ID
                                    @endphp
                                    @if ($media)
                                        <x-curator-glider style="    height: 200px !important;
                                                                            object-fit: cover;" class="object-cover w-auto" :media="$product->image" glide="" :srcset="['1024w','640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                                    @else
                                        <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                                    @endif
                                @endif
                                <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">
                                    {{ $product->name }}
                                </h4>
                            </div>
                            <div class="product-footer-box4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="price-box4" style="text-align: center">
                                            <strong>{{ number_format($product->sale_price ?: $product->price, 0, ',', '.') }}
                                                VND</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons-box4">
                                <a href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                    <i class="fa-solid fa-circle-info me-1"></i>Xem chi
                                    tiết
                                </a>
                                <button wire:click="addToCartWordpressProduct({{ $product->id }})" type="button" class="btn buy-btn-box4">
                                    <i class="fa-solid fa-cart-shopping me-1"></i>Mua
                                    Ngay
                                </button>
                            </div>
                        </div>
                    </div>
                    @php $totalProductsDisplayed++; @endphp
                @endforeach
            </div>

            {{-- Courses --}}
            <div class="row">
                @foreach($childCategory->courses->take(12) as $course)
                    <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                        <div class="product-box4">
                            <div class="product-head-box4" style="flex-direction: column">
                                @if (strlen($course->image) > 7)
                                    <img style="height: 200px !important; object-fit: cover;" src="{{ Storage::url($course->image) }}" alt="{{ $course->name }}">
                                @else
                                    @php
                                        $media = \App\Models\Media::find($course->image); // Lấy media từ ID
                                    @endphp
                                    @if ($media)
                                        <x-curator-glider style="    height: 200px !important; object-fit: cover;" class="object-cover w-auto" :media="$course->image" glide="" :srcset="['1024w','640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                                    @else
                                        <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                                    @endif
                                @endif
                               
                                <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">{{ $course->title }}</h4>
                            </div>
                            <div class="product-footer-box4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="price-box4" style="text-align: center">
                                            <strong>{{ number_format($course->sale_price ?: $course->price, 0, ',', '.') }}
                                                VND</strong>
                                            @if($course->sale_price)
                                                <span class="text-muted">
                                                                    <s>{{ number_format($course->price, 0, ',', '.') }} VND</s>
                                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons-box4">
                                <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}" class="btn more-btn-box4">
                                    <i class="fa-solid fa-circle-info me-1"></i>Xem chi
                                    tiết
                                </a>
                                <button wire:click="addToCartCourse({{ $course->id }})" type="button" class="btn buy-btn-box4">
                                    <i class="fa-solid fa-cart-shopping me-1"></i>Mua
                                    Ngay
                                </button>
                            </div>
                        </div>
                    </div>
                    @php $totalProductsDisplayed++; @endphp
                @endforeach
            </div>

            {{-- Other Products --}}
            <div class="row">
                @foreach($childCategory->otherProducts->take(12) as $product)
                    <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                        <div class="product-box4">
                            <div class="product-head-box4" style="flex-direction: column">
                                @if (strlen($product->thumbnail) > 7)
                                    <img style="height: 200px !important; object-fit: cover;" src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                                @else
                                    @php
                                        $media = \App\Models\Media::find($product->thumbnail); // Lấy media từ ID
                                    @endphp
                                    @if ($media)
                                        <x-curator-glider style="    height: 200px !important;
                                                                                     object-fit: cover;" class="object-cover w-auto" :media="$product->thumbnail" glide="" :srcset="['1024w','640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                                    @else
                                        <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                                    @endif
                                @endif
                                <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">{{ $product->name }}</h4>
                            </div>
                            <div class="product-footer-box4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="price-box4" style="text-align: center">
                                            <strong>{{ number_format($product->price, 0, ',', '.') }}
                                                VND</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons-box4">
                                <a href="{{ route('other-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                    <i class="fa-solid fa-circle-info me-1"></i>Xem chi
                                    tiết
                                </a>
                                <button wire:click="addToCartOtherProduct({{ $product->id }})" type="button" class="btn buy-btn-box4">
                                    <i class="fa-solid fa-cart-shopping me-1"></i>Mua
                                    Ngay
                                </button>
                            </div>
                        </div>
                    </div>
                    @php $totalProductsDisplayed++; @endphp
                @endforeach
            </div>

            {{-- Button "Xem thêm" --}}
            <div class="text-center">
                @if($totalProductsDisplayed >= 12)
                    <a href="{{ route('category-products', ['slug' => $childCategory->slug]) }}" class="btn-more-new mb-3">
                        Xem thêm
                    </a>
                @endif
            </div>
        </div>
    @endforeach

@endif
