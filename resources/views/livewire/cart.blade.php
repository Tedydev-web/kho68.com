<div>
    <section class="bg-light my-5">
        <div class="container">
            <div class="row">
                <!-- giỏ hàng -->
                <div class="col-lg-9">
                    <div class="card border shadow-0">
                        <div class="m-4">
                            <h4 class="card-title mb-4">Giỏ hàng của bạn</h4>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Giá Tổng</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                @if($item->type === 'wordpress' || $item->type === 'social' || $item->type === 'other')
                                                    {{ $item->product->name ?? $item->product->title ?? 'Không rõ tên sản phẩm' }}
                                                    @if($item->type === 'social' && $item->attribute)
                                                        ({{ $item->attribute->attribute_name }})
                                                    @endif
                                                @elseif($item->type === 'course')
                                                    {{ $item->product->name ?? $item->product->title ?? 'Không rõ tiêu đề khóa học' }}
                                                @else
                                                    Không rõ sản phẩm
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->price) }}đ</td>
                                            <td width="20%">
                                                <input type="number" min="1" value="{{ $item->quantity }}" wire:change="updateQuantity({{ $item->id }}, $event.target.value)" class="form-control text-center quantity-input">
                                            </td>
                                            <td class="product-total"><b>{{ number_format($item->quantity * $item->price) }}đ</b></td>
                                            <td class="align-middle">
                                                <button wire:click="deleteItem({{ $item->id }})" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-x"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <style>
                                /* Cải thiện cách hiển thị trên màn hình nhỏ */


                            </style>
                        </div>
                    </div>
                    <button wire:click="clearCart" class="btn btn-danger mt-3">Xóa giỏ hàng
                    </button>
                </div>
                <!-- giỏ hàng -->
                <!-- tóm tắt -->
                <div class="col-lg-3">
                    <div class="card mb-3 border shadow-0">
                        <div class="card-body">
                            <form wire:submit.prevent="checkDiscount">
                                <div class="form-group">
                                    <label class="form-label">Bạn có mã giảm giá?</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border" wire:model="discountCodeInput" placeholder="Mã giảm giá">
                                        <button type="submit" class="btn btn-light border">Áp dụng</button>
                                    </div>
                                </div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">{{ session('message') }}</div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="card shadow-0 border">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Tổng giá:</p>
                                <p class="mb-2">{{ number_format($cart->total) }} đ</p>
                            </div>

                            @if ($cart->discount_code)
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Mã giảm giá:</p>
                                    <p class="mb-2 text-success">{{ $cart->discount_code }}</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">
                                        Giảm giá:
                                    </p>
                                    <p class="mb-2 text-success">
                                        @if ($cart->discount_type == 'percentage')
                                            -{{ $cart->discount_amount }}%
                                                <?php $discountValue = ($cart->total * $cart->discount_amount) / 100; ?>
                                        @else
                                            -{{ number_format($cart->discount_amount, 2) }} đ
                                                <?php $discountValue = $cart->discount_amount; ?>
                                        @endif
                                    </p>
                                </div>
                            @endif




                            <hr>

                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Tổng thanh toán:</p>
                                <p class="mb-2 fw-bold">
                                    @if ($cart->discount_code)
                                        {{-- Tính tổng thanh toán, nếu giảm giá lớn hơn tổng giá thì hiển thị 0 --}}
                                        {{ number_format(max($cart->total - $discountValue, 0)) }} đ
                                    @else
                                        {{ number_format($cart->total) }} đ
                                    @endif
                                </p>
                            </div>


                            <div class="mt-3">
                                <a href="{{ route('checkout') }}" class="btn btn-success w-100 shadow-0 mb-2"> Thanh toán </a>
                                <a href="#" class="btn btn-light w-100 border mt-2"> Quay lại cửa hàng </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tóm tắt -->
            </div>
        </div>
    </section>
</div>
