<div class="row mb-5">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-lg-12 mb-5" id="category15">
                <div class="home-heading mb-3">
                    <h3 style="justify-content: space-between">
                        Tài khoản mạng xã hội
                    </h3>
                </div>

                <div class="row">
                    @foreach($latestSocialAccounts as $account)
                    <div class="prod-item col-sm-6 col-md-4 col-xl-3">
                        <div class="product-box4">
                            <div class="product-head-box4">
                                <img style="height: 100%;height: 50px;object-fit: cover;" src="{{ Storage::url($account->thumbnail) }}" alt="{{ $account->name }}" />
                                <a href="{{ route('course-product-detail', ['slug' => $account->slug]) }}">
                                    <h4 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $account->name }}</h4>
                                </a>
                            </div>
                            <div class="product-footer-box4">
                                <div class="row">
                                    <div class="col-8 d-flex" style="flex-direction: column; justify-content: center">
                                        <div class="price-box4" style="text-align: center">
                                            <strong>{{ number_format($account->attributes->first()->additional_price, 0, ',', '.') }}
                                                đ
                                                - {{ number_format($account->attributes->last()->additional_price, 0, ',', '.') }}
                                                đ</strong>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('social-product-detail', ['slug' => $account->slug]) }}" class="btn more-btn-box4">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
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