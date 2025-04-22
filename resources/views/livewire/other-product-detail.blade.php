<div style="margin: 50px 0 0 0">
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" id="col1" style="margin-bottom:20px;">
                    <div class="details-gallery mb-1">
                        <ul class="details-preview slick-initialized slick-slider">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 369px;">
                                    <li class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 369px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;" tabindex="0">




                                        @if (strlen($otherProduct->thumbnail) > 7)
                                        <img src="{{ Storage::url($otherProduct->thumbnail) }}" alt="{{ $otherProduct->name }}">


                                    @else
                                        @php
                                            $media = \App\Models\Media::find($otherProduct->thumbnail); // Lấy media từ ID
                                        @endphp
                                        @if ($media)
                                                <x-curator-glider
                                                style="    height: 200px !important;
                                                            object-fit: cover;"
                                                    class="object-cover w-auto"
                                                    :media="$otherProduct->thumbnail"
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
                        {{-- @if($otherProduct->gallery)--}}
                        {{-- <ul class="details-thumb slick-initialized slick-slider">--}}
                        {{-- <div class="slick-list draggable">--}}
                        {{-- <div class="slick-track"--}}
                        {{-- style="opacity: 1; width: 74px; transform: translate3d(0px, 0px, 0px);">--}}
                        {{-- @foreach($otherProduct->gallery as $image)--}}
                        {{-- <li class="slick-slide slick-current slick-active" data-slick-index="0"--}}
                        {{-- aria-hidden="false" style="width: 58px;" tabindex="0">--}}
                        {{-- <img--}}
                        {{-- src="{{ Storage::url($image) }}"--}}
                        {{-- alt="Gallery Image">--}}
                        {{-- </li>--}}
                        {{-- @endforeach--}}
                        {{-- </div>--}}
                        {{-- </div>--}}
                        {{-- </ul>--}}
                        {{-- @endif--}}
                    </div>
                </div>

                <div class="col-lg-8" id="col2">
                    <div class="details-content">
                        <h3 class="details-name">{{ $otherProduct->name }}</h3>
                        <div class="details-meta">
                            <p>
                                <label class="label-text order">Tình trạng: <strong>
                                        Còn hàng</strong></label>
                                <label wire:click="addToWishlist" class="label-text order ">
                                    <i class="fas fa-heart"></i> Yêu thích
                                </label>
                            </p>
                        </div>
                        <h3 class="details-price">
                            <span>{{ number_format($otherProduct->price) }} VND</span>
                        </h3>
                        {{-- <p class="details-desc"> --}}
                        {{-- - Key kích hoạt bản quyền Window 10 bản Pro.<br> --}}
                        {{-- - Kích hoạt 1 thiết bị máy tính. Theo mainboard của máy. --}}
                        {{-- </p> --}}
                        @include('livewire.partials._share-social')
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn-buy mb-2"><i class="fa-solid fa-cart-shopping"></i>
                                        MUA NGAY
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <button wire:click="addToCart" class="btn-more">
                                        <span>Thêm vào giỏ hàng</span>
                                    </button>
                                    @if (session()->has('message'))
                                    <script>
                                        console.log('first')

                                    </script>
                                    <div id="popup-message" class="popup-message">
                                        {{ session('message') }}
                                        <span wire:click="closePopup" class="close-icon" style="cursor: pointer;">&#10006;</span>
                                    </div>


                                    @endif
                                </div>
                            </div>

                            <style>
                                .popup-message {
                                    position: fixed;
                                    top: 20px;
                                    right: 20px;
                                    background-color: #4CAF50;
                                    /* Màu nền */
                                    color: white;
                                    /* Màu chữ */
                                    padding: 16px;
                                    border-radius: 5px;
                                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                                    z-index: 1000;
                                    transition: opacity 0.5s ease-in-out;
                                    /* Hiệu ứng mờ dần */
                                    cursor: pointer;
                                    /* Hiển thị con trỏ để biết người dùng có thể click */
                                }

                                .popup-message.hide {
                                    opacity: 0;
                                    /* Mờ dần khi ẩn */
                                }

                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <style>
        .popup-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            /* Màu nền */
            color: white;
            /* Màu chữ */
            padding: 16px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: opacity 0.5s ease-in-out;
            /* Hiệu ứng mờ dần */
            cursor: pointer;
            /* Hiển thị con trỏ để biết người dùng có thể click */
        }

        .popup-message.hide {
            opacity: 0;
            /* Mờ dần khi ẩn */
        }

    </style>
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">Chi tiết</a></li>
                        <li><a href="#tab-reviews" class="tab-link" data-bs-toggle="tab">Đánh giá sản phẩm</a></li>

                    </ul>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-desc">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <div>
                                <div>
                                    {!! $otherProduct->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                                star.addEventListener('change', function() {
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
                                            @for ($i = $review->rating; $i < 5; $i++) <i class="fas fa-star text-secondary"></i>
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

        </div>
    </section>
</div>
