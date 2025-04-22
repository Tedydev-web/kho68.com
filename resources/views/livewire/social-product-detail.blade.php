<div style="margin: 50px 0 0 0">
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" id="col1" style="margin-bottom:20px;">
                    <div class="details-gallery mb-1">
                        <ul class="details-preview slick-initialized slick-slider">
                            <div class="slick-list draggable">
                                <div class="slick-track">
                                    <li class="slick-slide slick-current slick-active">
                                                                        @if (strlen($product->thumbnail) > 7)
                                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">

                                                                    @else
                                                                        @php
                                                                            $media = \App\Models\Media::find($product->thumbnail); // Lấy media từ ID
                                                                        @endphp
                                                                        @if ($media)
                                                                                <x-curator-glider
                                                                                style="    height: 200px !important;
                                                                                            object-fit: cover;"
                                                                                    class="object-cover w-auto"
                                                                                    :media="$product->thumbnail"
                                                                                    glide=""
                                                                                    :srcset="['1024w','640w']"
                                                                                    sizes="(max-width: 1200px) 100vw, 1024px"
                                                                                />
                                                                        @else
                                                                            <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                                                                        @endif
                                                                    @endif
                                    </li>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8" id="col2">
                    <div class="details-content">
                        <h3 class="details-name">{{ $product->name }}</h3>
                        <div class="details-meta">
                            <p>
                                <label class="label-text order">Tình trạng: <strong>{{ $stock > 0 ? 'Còn hàng' : 'Hết hàng' }}</strong></label>
                            </p>
                            <label wire:click="addToWishlist" class="label-text order ">
                                <i class="fas fa-heart"></i> Yêu thích
                            </label>
                        </div>
                        <h3 class="details-price">
                            <span>{{ number_format($price, 0, ',', '.') }}đ</span>
                        </h3>
                        <p>Số lượng còn lại: <strong>{{ $attributeQuantity }}</strong></p> <!-- Hiển thị số lượng của attribute đã chọn -->

                        <p class="details-desc">
                            {!! $product->short_content !!}
                        </p>

                        @if ($product->attributes->isNotEmpty())
                        <div class="card" style="
                        margin-bottom: 2rem;
                    ">
                            <div class="card-header">
                                <h5>Danh sách tùy chọn  </h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group attribute-list">
                                    @foreach ($product->attributes as $attribute)
                                        <li class="list-group-item attribute-item d-flex justify-content-between align-items-center
                                            @if($selectedAttributeId === $attribute->id) selected @endif"
                                            wire:click="setSelectedAttribute({{ $attribute->id }})">
                                            <span class="attribute-name">{{ $attribute->attribute_name }}</span>
                                            <span class="badge badge-primary badge-pill attribute-price">

                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @include('livewire.partials._share-social')

                        <div class="row">
                            <div class="col-lg-6">
                                <button class="btn-buy mb-2"
                                    @if($selectedAttributeId === null || $stock <= 0) disabled @endif>
                                    <i class="fa-solid fa-cart-shopping"></i> MUA NGAY
                                </button>
                            </div>
                            <div class="col-lg-6">
                                <button wire:click="addToCart" class="btn-more"
                                    @if($selectedAttributeId === null || $stock <= 0) disabled @endif>
                                    <span>Thêm vào giỏ hàng</span>
                                </button>

                            </div>
                        </div>

                        @if (session()->has('message'))
                        <script>
                            console.log('first')
                        </script>
                        <div id="popup-message" class="popup-message">
                            {{ session('message') }}
                            <span wire:click="closePopup" class="close-icon" style="cursor: pointer;">&#10006;</span>
                        </div>


                        @endif



                    <style>
                        .popup-message {
                            position: fixed;
                            top: 20px;
                            right: 20px;
                            background-color: #4CAF50; /* Màu nền */
                            color: white; /* Màu chữ */
                            padding: 16px;
                            border-radius: 5px;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                            z-index: 1000;
                            transition: opacity 0.5s ease-in-out; /* Hiệu ứng mờ dần */
                            cursor: pointer; /* Hiển thị con trỏ để biết người dùng có thể click */
                        }

                        .popup-message.hide {
                            opacity: 0; /* Mờ dần khi ẩn */
                        }
                    </style>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">Chi tiết</a></li>
                        <li><a href="#tab-content" class="tab-link" data-bs-toggle="tab">Nội dung</a></li>
                        <li><a href="#tab-reviews" class="tab-link" data-bs-toggle="tab">Đánh giá</a></li> <!-- Thêm tab đánh giá -->
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <!-- Tab chi tiết -->
                <div class="tab-pane fade show active" id="tab-desc">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-details-frame">
                                <div>
                                    {!! $product->long_content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab nội dung -->
                <div class="tab-pane fade" id="tab-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-details-frame">
                                <div>
                                    <!-- Nội dung khác của sản phẩm -->
                                    {!! $product->short_content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab đánh giá -->
                <div class="tab-pane fade" id="tab-reviews">
                 <div class="product-details-frame">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Đánh giá sản phẩm</h4>

                            <!-- Review Form -->
                            <div class="review-form">
                                <form wire:submit.prevent="submitReview">
                                    <div class="form-group">
                                        <label for="rating">Đánh giá của bạn</label>
                                        <div class="flex items-center" id="rating-stars">
                                            <label for="star1" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 1) text-warning @else text-secondary @endif" id="icon1"></i>
                                            </label>

                                            <label for="star2" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 2) text-warning @else text-secondary @endif" id="icon2"></i>
                                            </label>

                                            <label for="star3" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 3) text-warning @else text-secondary @endif" id="icon3"></i>
                                            </label>

                                            <label for="star4" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 4) text-warning @else text-secondary @endif" id="icon4"></i>
                                            </label>

                                            <label for="star5" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 5) text-warning @else text-secondary @endif" id="icon5"></i>
                                            </label>
                                        </div>

                                        <script>
                                            document.querySelectorAll('input[name="rating"]').forEach((star) => {
                                                star.addEventListener('change', function () {
                                                    let selectedRating = this.value;
                                                    updateStars(selectedRating);
                                                });
                                            });

                                            function updateStars(rating) {
                                                for (let i = 1; i <= 5; i++) {
                                                    const icon = document.getElementById('icon' + i);
                                                    if (i <= rating) {
                                                        icon.classList.remove('text-secondary');
                                                        icon.classList.add('text-warning');
                                                    } else {
                                                        icon.classList.remove('text-warning');
                                                        icon.classList.add('text-secondary');
                                                    }
                                                }
                                            }
                                        </script>

                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Nhận xét của bạn</label>
                                        <textarea wire:model="comment" id="comment" class="form-control" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Gửi đánh giá</button>
                                </form>
                            </div>

                            <!-- Review List -->
                            <div class="review-list mt-5">
                                @foreach($reviews as $review)
                                    <div class="review-item mb-4">
                                        <h5>{{ $review->user->name }}</h5>
                                        <div class="rating">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                            @for ($i = $review->rating; $i < 5; $i++)
                                                <i class="fas fa-star text-secondary"></i>
                                            @endfor
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                        <small class="text-muted">Đã đánh giá vào {{ $review->created_at->format('d/m/Y') }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                 </div>
                </div>


                <style>
                    .review-form {
                        background-color: #f8f9fa;
                        padding: 20px;
                        border-radius: 8px;
                        margin-bottom: 30px;
                    }

                    .review-list .review-item {
                        border-bottom: 1px solid #dee2e6;
                        padding-bottom: 10px;
                    }

                    .rating i {
                        font-size: 16px;
                    }
                </style>
            </div>
        </div>
    </section>


    <style>
        .attribute-item {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.attribute-item:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
}

.attribute-item.selected {
    background-color: #28a745;
    color: white;
    border-color: #28a745;
    transform: scale(1.02); /* Thêm hiệu ứng zoom nhỏ để dễ thấy */
    transition: transform 0.2s ease, background-color 0.2s ease;
}

    </style>
</div>
