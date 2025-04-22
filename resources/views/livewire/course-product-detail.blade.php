<div>
    <section class="inner-section" style="margin:40px 0 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" id="col1" style="margin-bottom:20px;">
                    <div class="details-gallery mb-1">
                        <ul class="details-preview">
                            <li>
                                @if (strlen($course->thumbnail) > 7)
                                <img src="{{ $course->image ? asset('storage/' . $course->image) : 'default-image.jpg' }}" alt="product">

                            @else
                                @php
                                    $media = \App\Models\Media::find($course->image); // Lấy media từ ID
                                @endphp
                                @if ($media)
                                        <x-curator-glider
                                        style="    height: 200px !important;
                                                    object-fit: cover;"
                                            class="object-cover w-auto"
                                            :media="$course->image"
                                            glide=""
                                            :srcset="['1024w','640w']"
                                            sizes="(max-width: 1200px) 100vw, 1024px"
                                        />
                                @else
                                    <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                                @endif
                            @endif
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-8" id="col2">
                    <div class="details-content">
                        <h3 class="details-name">{{ $course->title }}</h3>

                        <!-- Course Metadata -->
                        <div class="details-meta" style="
                        display: flex;
                        flex-direction: column;
                        justify-content: start;
                        align-items: start;
                    ">
                            <label wire:click="addToWishlist" class="label-text order" style="cursor: pointer">
                                <i class="fas fa-heart"></i> Yêu thích
                            </label>
                            <p>
                                <label style="color: black;" class="label-text">Thời gian:
                                    <strong>{{ $course->duration }}</strong>
                                </label>
                            </p>
                            <p>
                                <label style="color: black;" class="label-text">Giảng viên:
                                    <strong>{{ $course->instructor }}</strong>
                                </label>
                            </p>
                            <p>
                                <label style="color: black;" class="label-text">Cấp độ:
                                    <strong>{{ $course->level }}</strong>
                                </label>
                            </p>
                            <p>
                                <label style="color: black;" class="label-text">Lượt xem:
                                    <strong>{{ number_format($course->views) }} lượt</strong>
                                </label>
                            </p>
                            <p>
                                <label class="label-text" style="color: black;"> Trạng thái:
                                    @if($course->status === 'active')
                                    <strong style="color: green;">Đang mở</strong>
                                    @else
                                    <strong style="color: red;">Tạm ngừng</strong>
                                    @endif
                                </label>

                            </p>
                        </div>

                        <!-- Price Section -->
                        <h3 class="details-price">
                            @if ($course->sale_price && $course->sale_price > 0)
                            <span class="original-price">{{ number_format($course->price, 0, ',', '.') }}đ</span><br>
                            <span class="sale-price">{{ number_format($course->sale_price, 0, ',', '.') }}đ</span>
                            @else
                            <span>{{ number_format($course->price, 0, ',', '.') }}đ</span>
                            @endif
                        </h3>
                        <style>
                            .sale-price {
                                color: red;
                                font-weight: bold;
                            }

                            .original-price {
                                text-decoration: line-through;
                                color: grey !important;
                            }

                        </style>

                        <!-- Short Description -->
                        <p class="details-desc">
                            {!! $course->short_description !!}
                        </p>

                        @include('livewire.partials._share-social')

                        <!-- Buttons for Buy Now and Add to Cart -->
                        <div class="row">
                            <div class="col-lg-6">
                                <button class="btn-buy mb-2"><i class="fa-solid fa-cart-shopping"></i> MUA NGAY</button>
                            </div>
                            <div class="col-lg-6">
                                <button wire:click="addToCart" class="btn-more">
                                    <span>Thêm vào giỏ hàng</span>
                                </button>

                                <!-- Popup Message -->
                                @if (session()->has('message'))
                                <div id="popup-message" class="popup-message">
                                    {{ session('message') }}
                                    <span wire:click="closePopup" class="close-icon" style="cursor: pointer;">&#10006;</span>
                                </div>
                                <style>
                                    .popup-message {
                                        position: fixed;
                                        top: 20px;
                                        right: 20px;
                                        background-color: #4CAF50;
                                        color: white;
                                        padding: 16px;
                                        border-radius: 5px;
                                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                                        z-index: 1000;
                                        transition: opacity 0.5s ease-in-out;
                                        cursor: pointer;
                                    }

                                    .popup-message.hide {
                                        opacity: 0;
                                    }

                                </style>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Course Details Tabs -->
    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">Chi tiết</a></li>
                        <li><a href="#tab-content" class="tab-link" data-bs-toggle="tab">Nội dung bài học</a></li>
                        <li><a href="#tab-reviews" class="tab-link  " data-bs-toggle="tab">Đánh giá sản phẩm</a></li>

                    </ul>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-desc">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <div>
                                {!! $course->long_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-frame">
                            <div class="container mt-3">
                                <div class="accordion" id="accordionModules">
                                    @foreach($course->modules as $module)
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="heading{{ $module->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $module->id }}" aria-expanded="false" aria-controls="collapse{{ $module->id }}">
                                                {{ $module->title }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $module->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $module->id }}" data-bs-parent="#accordionModules">
                                            <div class="accordion-body">
                                                <div class="module-content">
                                                    {!! $module->content !!}
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
                                    <small class="text-muted">Đã đánh giá
                                        vào {{ $review->created_at->format('d/m/Y') }}</small>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .accordion-button {
                    background-color: #f7f7f7;
                    color: #333;
                    font-weight: bold;
                    font-size: 16px;
                    padding: 15px;
                }

                .accordion-button:hover {
                    background-color: #e2e6ea;
                }

                .accordion-item {
                    border: none;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                .accordion-body {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 0 0 8px 8px;
                    animation: fadeIn 0.4s ease-in-out;
                }

                .module-content {
                    font-size: 14px;
                    color: #555;
                }

                .video-section {
                    margin-top: 15px;
                }

                .download-link a {
                    background-color: #007bff;
                    color: #fff;
                    border-radius: 4px;
                    padding: 10px 15px;
                    text-decoration: none;
                }

                .download-link a:hover {
                    background-color: #0056b3;
                }

                @keyframes fadeIn {
                    0% {
                        opacity: 0;
                        transform: translateY(-10px);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

            </style>

        </div>
    </section>
</div>
