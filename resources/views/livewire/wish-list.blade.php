<div>
    <section class="mt-5 inner-section profile-part">
        <div class="container">
            <div class="row content-reverse">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="account-card">
                                <h4 class="account-title">Danh sách sản phẩm yêu thích</h4>
                                <div class="table-scroll">
                                    <table class="table fs-sm text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Kho hàng</th>
                                            <th class="text-center">Giá</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wishlists as $wishlist)
                                            <tr>
                                                <td>
                                                    <h6 class="feature-name">
                                                        @if($wishlist->product_type === 'App\Models\SocialAccountProduct')
                                                            <a href="{{ route('social-product-detail', ['slug' => $wishlist->product->slug]) }}">
                                                                {{ $wishlist->product->name }}
                                                            </a>
                                                        @elseif($wishlist->product_type === 'App\Models\WordpressProduct')
                                                            <a href="{{ route('wordpress-product-detail', ['slug' => $wishlist->product->slug]) }}">
                                                                {{ $wishlist->product->name }}
                                                            </a>
                                                        @elseif($wishlist->product_type === 'App\Models\Course')
                                                            <a href="{{ route('course-product-detail', ['slug' => $wishlist->product->slug]) }}">
                                                                {{ $wishlist->product->title }}
                                                            </a>
                                                        @elseif($wishlist->product_type === 'App\Models\OtherProduct')
                                                            <a href="{{ route('other-product-detail', ['slug' => $wishlist->product->slug]) }}">
                                                                {{ $wishlist->product->name }}
                                                            </a>
                                                        @endif
                                                    </h6>
                                                </td>
                                                <td class="text-center">
                                                    <label class="label-text feat">
                                                        <b>{{ $wishlist->product->stock ?? 'N/A' }}</b>
                                                    </label>
                                                </td>
                                                <td class="text-right">
                                                    <b style="color:red;">
                                                        {{ $this->getPrice($wishlist->product) }}
                                                    </b>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger" wire:click="removeFromWishlist({{ $wishlist->id }})">
                                                        <i class="icofont-trash"></i> Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($wishlists->isEmpty())
                                    <p>Danh sách yêu thích trống.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
