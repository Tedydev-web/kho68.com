{{-- Social Accounts --}}
@if(!collect($socialAccounts)->isEmpty())
    <h2 class="text-center">Tài khoản xã hội</h2>
    <div class="row">
        @foreach($socialAccounts as $socialAccount)
            @foreach($socialAccount->products as $product)
                <div class="prod-item col-sm-6 col-md-4 col-xl-4 mb-3">
                    <div class="product-box4">
                        <div class="product-head-box4" style="flex-direction: column">
                            @if (filter_var($product->thumbnail, FILTER_VALIDATE_URL))
                                <img style="height: 200px !important; object-fit: cover;" src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                            @else
                                @php
                                    $media = \App\Models\Media::find($product->thumbnail); // Lấy media từ ID
                                @endphp
                                @if ($media)
                                    <div class="w-64 aspect-video">
                                        <x-curator-glider class="object-cover w-auto" :media="$media->id" <!-- ID của media -->
                                        glide=""
                                        fallback="{{ $media->getUrl() }}"
                                        <!-- URL dự phòng nếu không có Glide -->
                                        :srcset="['1024w','640w']"
                                        <!-- Các kích thước mong muốn -->
                                        sizes="(max-width: 1200px) 100vw, 1024px"
                                        />
                                    </div>
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
                                        @php
                                            // Lấy attribute đầu tiên của sản phẩm nếu có
                                            $firstAttribute = $product->attributes->first();
                                            $price = $firstAttribute ? $firstAttribute->additional_price : $product->price;
                                        @endphp
                                        <strong>{{ number_format($price, 0, ',', '.') }}
                                            VND</strong>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-buttons-box4">
                            <a href="{{ route('social-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                                <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết
                            </a>
                            <button wire:click="addToCartSocialAccount({{ $product->id }})" type="button" class="btn buy-btn-box4">
                                <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endif
