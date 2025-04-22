<div>
    <section class="py-5 inner-section profile-part">
        <div class="container">
            <div class="row content-reverse">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="account-card p-4 shadow-sm rounded">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">{{ session('message') }}</div>
                                @endif
                                <h4 class="account-title mb-4">Giỏ hàng</h4>
                                @if($cart)
                                    <p><strong>Tổng tiền: {{ number_format($cart->total) }} đ</strong></p>
                                    <button wire:click="clearCart" class="btn btn-danger mb-3">Xóa tất cả sản phẩm
                                    </button>
                                @else
                                    <p><strong>Giỏ hàng rỗng</strong></p>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-striped text-center fs-sm mb-0">
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá tiền</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cartItems as $item)
                                            <tr>
                                                <td class="align-middle">
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

                                                <td class="align-middle">{{ number_format($item->price) }} đ</td>
                                                <td class="align-middle">
                                                    <input type="number" min="1" value="{{ $item->quantity }}"
                                                           wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                                                           class="form-control text-center quantity-input">
                                                </td>
                                                <td class="align-middle"><b>{{ number_format($item->quantity * $item->price) }}
                                                    đ</b>
                                                </td>
                                                <td class="align-middle">
                                                    <button wire:click="deleteItem({{ $item->id }})"
                                                            class="btn btn-sm btn-outline-danger">
                                                        Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">

                                    <div class="row mt-4">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('checkout') }}" class="  btn btn-danger mb-3 btn-lg">
                                                Thanh toán
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CSS for styling -->
    <style>
        .account-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
        }

        .account-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .quantity-input {
            width: 70px;
            margin: 0 auto;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .btn-outline-danger {
            padding: 5px 10px;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 30px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .table-scroll {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 15px;
        }

        .alert {
            margin-bottom: 1rem;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }
    </style>
</div>
