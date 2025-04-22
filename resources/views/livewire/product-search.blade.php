<div>
    <section class="section feature-part">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="home-heading mb-3 mt-3">
                        <h3>
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Kết quả tìm kiếm cho từ khóa '<strong style="color:red;">{{ $searchTerm }}</strong>'
                        </h3>
                        <input type="text" wire:model.live="searchTerm" placeholder="Tìm kiếm sản phẩm..." class="form-control mb-3"/>
                    </div>

                    {{-- SocialAccountProducts --}}
                    @if(!empty($socialAccountProducts))
                        <div class="row mb-3">
                            <h4>Sản phẩm Tài khoản mạng xã hội:</h4>
                            @foreach($socialAccountProducts as $product)
                                <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                                    <div class="product-box4">
                                        <div class="product-head-box4 d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="product-thumbnail">
                                            <h4 class="product-title">{{ $product->name }}</h4>
                                        </div>
                                        <div class="product-body-box4">
                                            <p>{!! $product->short_content !!}</p>
                                        </div>
                                        <div class="product-footer-box4">
                                            <div class="row">
                                                <div class="col-4 text-center border-end-box4">
                                                    <strong>Quốc gia</strong>
                                                </div>
                                                <div class="col-4 text-center border-end-box4">
                                                    <strong>Hiện có</strong>
                                                    <span class="badge bg-primary rounded-pill">{{ $product->stock }}</span>
                                                </div>
                                                <div class="col-4">
                                                    <div class="price-box4">
                                                        <strong>{{ number_format($product->attributes->first()->additional_price, 0, ',', '.') }}đ</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-buttons-box4">
                                            <a href="{{ route('social-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                                <i class="fa-solid fa-circle-info me-1"></i> Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    {{-- WordpressProducts --}}
                    @if(!empty($wordpressProducts))
                        <div class="row mb-3">
                            <h4>Sản phẩm Wordpress:</h4>
                            @foreach($wordpressProducts as $product)
                                <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                                    <div class="product-box4">
                                        <div class="product-head-box4 d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-thumbnail">
                                            <h4 class="product-title">{{ $product->name }}</h4>
                                        </div>
                                        <div class="product-body-box4">
                                            <p>{!! $product->short_content !!}</p>
                                        </div>
                                        <div class="product-footer-box4">
                                            <div class="price-box4">
                                                @if($product->sale_price)
                                                    <span style="text-decoration: line-through; color: grey;">
                                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                                    </span>
                                                    <strong style="color: red;">
                                                        {{ number_format($product->sale_price, 0, ',', '.') }}đ
                                                    </strong>
                                                @else
                                                    <strong>{{ number_format($product->price, 0, ',', '.') }}đ</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-buttons-box4">
                                            <a href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                                <i class="fa-solid fa-circle-info me-1"></i> Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    {{-- OtherProducts --}}
                    @if(!empty($otherProducts))
                        <div class="row mb-3">
                            <h4>Sản phẩm Khác:</h4>
                            @foreach($otherProducts as $product)
                                <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                                    <div class="product-box4">
                                        <div class="product-head-box4 d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="product-thumbnail">
                                            <h4 class="product-title">{{ $product->name }}</h4>
                                        </div>
                                        <div class="product-footer-box4">
                                            <strong>{{ number_format($product->price, 0, ',', '.') }}đ</strong>
                                        </div>
                                        <div class="product-buttons-box4">
                                            <a href="{{ route('other-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                                <i class="fa-solid fa-circle-info me-1"></i> Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    {{-- Courses --}}
                    @if(!empty($courses))
                        <div class="row mb-3">
                            <h4>Khóa học:</h4>
                            @foreach($courses as $course)
                                <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                                    <div class="product-box4">
                                        <div class="product-head-box4 d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="product-thumbnail">
                                            <h4 class="product-title">{{ $course->title }}</h4>
                                        </div>
                                        <div class="product-footer-box4">
                                            @if($course->sale_price)
                                                <span style="text-decoration: line-through; color: grey;">
                                                    {{ number_format($course->price, 0, ',', '.') }}đ
                                                </span>
                                                <strong style="color: red;">
                                                    {{ number_format($course->sale_price, 0, ',', '.') }}đ
                                                </strong>
                                            @else
                                                <strong>{{ number_format($course->price, 0, ',', '.') }}đ</strong>
                                            @endif
                                        </div>
                                        <div class="product-buttons-box4">
                                            <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}" class="btn more-btn-box4">
                                                <i class="fa-solid fa-circle-info me-1"></i> Xem chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if(empty($socialAccountProducts) && empty($wordpressProducts) && empty($otherProducts) && empty($courses))
                        <p>Không tìm thấy kết quả nào.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        .product-thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }
        .product-head-box4 {
            height: 82px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .product-body-box4 {
            height: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .product-footer-box4 {
            height: 83px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</div>
