{{-- Courses --}}
@if(!collect($courses)->isEmpty())
    <div class="row">
        @foreach($courses as $course)
            <div class="prod-item col-sm-6 col-md-4 col-xl-3">
                <div class="product-box4">
                    <div class="product-head-box4">
                        <img style="height: 100%;height: 50px;object-fit: cover;" src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" />
                        <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}">
                            <h4 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $course->title }}</h4>
                        </a>
                    </div>
                    <div class="product-footer-box4">
                        <div class="row">
                            <div class="col-8 d-flex" style="flex-direction: column; justify-content: center">
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
                            <div class="col-4">
                                <a href="{{ route('course-product-detail', ['slug' => $course->slug]) }}" class="btn more-btn-box4">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
