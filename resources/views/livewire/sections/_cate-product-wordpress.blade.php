{{-- Wordpress Products --}}
@if(!collect($wordpressProducts)->isEmpty())
    {{-- <h2 class="text-center">Sản phẩm Wordpress</h2> --}}
    <div class="row">
        @foreach($wordpressProducts as $product)
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
                        <h4 style="text-align: center; width: 100%; padding: 0; font-weight: normal">{{ $product->name }}</h4>
                    </div>
                    <div class="product-footer-box4">
                        <div class="row">
                            <div class="col-12">
                                <div class="price-box4" style="text-align: center">
                                    <strong>{{ number_format($product->sale_price ?: $product->price, 0, ',', '.') }}
                                        VND</strong>
                                    @if($product->sale_price)
                                        <span class="text-muted">
                                                                <s>{{ number_format($product->price, 0, ',', '.') }} VND</s>
                                                            </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="product-buttons-box4">
                        <a href="{{ route('wordpress-product-detail', ['slug' => $product->slug]) }}" class="btn more-btn-box4">
                            <i class="fa-solid fa-circle-info me-1"></i>Xem chi tiết
                        </a>
                        <button wire:click="addToCartWordpressProduct({{ $product->id }})" type="button" class="btn buy-btn-box4">
                            <i class="fa-solid fa-cart-shopping me-1"></i>Mua Ngay
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
