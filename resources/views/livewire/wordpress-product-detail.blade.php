<div>
    <section class="inner-section" style="margin: 40px 0 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" id="col1" style="margin-bottom:20px;">
                    <div class="details-gallery mb-1">
                        <ul class="details-preview slick-initialized slick-slider">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; width: 369px; margin:0;">
                                    <li class="slick-slide slick-current slick-active" data-slick-index="0"
                                        aria-hidden="false"
                                        style="width: 369px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;"
                                        tabindex="0">




                                        @if (strlen($selectedImageId) > 7)
                                        <img id="main-image" src="{{ Storage::url($selectedImageId) }}" alt="{{ $product->name }}">
                                    @else
                                        @php
                                            $media = \App\Models\Media::find($selectedImageId); // Lấy media từ ID
                                        @endphp
                                        @if ($media)
                                            <x-curator-glider
                                                style="height: 200px !important; object-fit: cover;"
                                                class="object-cover w-auto"
                                                :media="$selectedImageId"
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
                        @if($product->gallery && is_array($product->gallery))
                        <ul class="details-thumb slick-initialized slick-slider" style="overflow-x: auto; white-space: nowrap;">
                            <div class="slick-list draggable">
                                <div class="slick-track" style="opacity: 1; display: flex; margin: 0; overflow-x: scroll;">
                                    @foreach($product->gallery as $imageId)
                                        @if($imageId) <!-- Kiểm tra nếu media tồn tại -->
                                            <li class="slick-slide" data-slick-index="{{ $loop->index }}"
                                                aria-hidden="false" style="width: 58px; display: inline-block;" tabindex="0"
                                                wire:click="selectImage('{{ $imageId }}')"> <!-- Gán sự kiện click -->

                                                <x-curator-glider
                                                    style="height: 58px !important; object-fit: cover; width: 70px !important;"
                                                    class="object-cover w-auto"
                                                    :media="$imageId"
                                                    glide=""
                                                    :srcset="['1024w','640w']"
                                                    sizes="(max-width: 58px) 58px, 58px"
                                                />
                                            </li>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </ul>
                    @endif
                        <style>
                     .details-thumb    .slick-track {
    opacity: 1;
    display: flex;
    margin: 0;
    overflow-x: auto;
    scrollbar-width: thin; /* Firefox */
    -ms-overflow-style: none; /* Ẩn thanh cuộn trong IE và Edge */
    scrollbar-width: none; /* Ẩn thanh cuộn trong Firefox */
}

.etails-thumb .slick-track::-webkit-scrollbar {
    height: 8px; /* Chiều cao của thanh cuộn */
}

.details-thumb .slick-track::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.5); /* Màu của phần tay cầm thanh cuộn */
    border-radius: 4px; /* Bo tròn cho phần tay cầm */
}

.details-thumb .slick-track::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0, 0, 0, 0.8); /* Màu khi hover */
}

.details-thumb .slick-track::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1); /* Màu nền của thanh cuộn */
    border-radius: 4px; /* Bo tròn cho nền */
}

                        </style>

                    </div>
                </div>

                <div class="col-lg-8" id="col2">
                    <div class="details-content">
                        <h3 class="details-name">{{ $product->name }}</h3>
                        <label wire:click="addToWishlist" class="label-text order" style="cursor: pointer;">
                            <i class="fas fa-heart"></i> Yêu thích
                        </label>
                        <h3 class="details-price">
                            @if($product->sale_price)
                                <span class="sale-price">{{ number_format($product->sale_price, 0, ',', '.') }} đ</span>
                                <small><del class="original-price">{{ number_format($product->price, 0, ',', '.') }} đ</del></small>
                            @else
                                <span>{{ number_format($product->price, 0, ',', '.') }} đ</span>
                            @endif
                        </h3>

                        <p class="details-desc">
                            Phiên bản: {{ $product->version }}
                            {{--                                 <br>Changelog Xem ngay --}}
                            <br>Ngày cập nhật: {{ $product->updated_at->format('d/m/Y') }}
                        </p>
                        <p class="details-desc">
                            <a href="{{ route('wordpress-product-demo', ['slug' => $product->slug]) }}" target="_blank">
                                <button type="button" class="btn btn-primary">Xem demo</button>
                            </a>

                        </p>
                        @include('livewire.partials._share-social')
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn-buy mb-2"><i class="fa-solid fa-credit-card"></i>
                                        Thanh toán ngay
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-6">
                                        <button wire:click="addToCart" class="btn-more">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>Thêm vào giỏ hàng</span>
                                        </button>
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
                                </div>

                            </div>
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
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">Chi tiết</a></li>
                        <li><a href="#tab-reviews" class="tab-link  " data-bs-toggle="tab">Đánh giá sản phẩm</a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-desc">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <div>
                                <div>
                                    {!! $product->long_content !!}
                                </div>
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
                                                <input hidden wire:model="rating" type="radio" id="star1" name="rating"
                                                       value="1"/>
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 1) text-warning @else text-secondary @endif"
                                                   id="icon1"></i>
                                            </label>

                                            <label for="star2" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star2" name="rating"
                                                       value="2"/>
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 2) text-warning @else text-secondary @endif"
                                                   id="icon2"></i>
                                            </label>

                                            <label for="star3" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star3" name="rating"
                                                       value="3"/>
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 3) text-warning @else text-secondary @endif"
                                                   id="icon3"></i>
                                            </label>

                                            <label for="star4" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star4" name="rating"
                                                       value="4"/>
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 4) text-warning @else text-secondary @endif"
                                                   id="icon4"></i>
                                            </label>

                                            <label for="star5" class="cursor-pointer">
                                                <input hidden wire:model="rating" type="radio" id="star5" name="rating"
                                                       value="5"/>
                                                <i class="fas fa-star block w-8 h-8 @if($rating >= 5) text-warning @else text-secondary @endif"
                                                   id="icon5"></i>
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
                                        <textarea wire:model="comment" id="comment" class="form-control"
                                                  rows="4"></textarea>
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
                                        <small class="text-muted">Đã đánh giá
                                            vào {{ $review->created_at->format('d/m/Y') }}</small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        window.addEventListener('show-alert', event => {
            alert(event.detail.message);
        });
    </script>

</div>
