<div class="container mt-5">

    <div class="row">
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body">
                    <ol class="activity-checkout mb-0 px-4 mt-3">
                        <form wire:submit.prevent="submitOrder">

                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Thông tin thanh toán</h5>
                                        <div class="mb-3">
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-name">Họ và
                                                                tên</label>
                                                            <input type="text" wire:model="fullName"
                                                                   class="form-control" id="billing-name"
                                                                   placeholder="Nhập họ tên" wire:model="fullname"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-email-address">Địa
                                                                chỉ email</label>
                                                            <input type="email" wire:model="email" class="form-control"
                                                                   id="billing-email-address" placeholder="Nhập email"
                                                                   wire:model="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Số điện
                                                                thoại</label>
                                                            <input type="text" wire:model="phone" class="form-control"
                                                                   id="billing-phone" placeholder="Nhập số điện thoại"
                                                                   wire:model="phone" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="billing-address">Địa chỉ</label>
                                                    <textarea wire:model="address" class="form-control"
                                                              id="billing-address" rows="3"
                                                              placeholder="Nhập địa chỉ đầy đủ" required></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label">Quốc gia</label>
                                                            <select class="form-control form-select" title="Quốc gia"
                                                                    wire:model="country">
                                                                <option value="0">Chọn quốc gia</option>
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">Quần đảo Samoa thuộc Mỹ</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-4 mb-lg-0">
                                                            <label class="form-label" for="billing-city">Thành
                                                                phố</label>
                                                            <input type="text" wire:model="city" class="form-control"
                                                                   id="billing-city" placeholder="Nhập thành phố"
                                                                   required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-0">
                                                            <label class="form-label" for="zip-code">Mã bưu
                                                                chính</label>
                                                            <input type="text" wire:model="zipCode" class="form-control"
                                                                   id="zip-code" placeholder="Nhập mã bưu chính">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Payment Method -->

                                            </div>

                                            <style>
                                                .hidden-radio {
                                                    position: absolute;
                                                    opacity: 0;
                                                    width: 0;
                                                    height: 0;
                                                }

                                                .payment-label {
                                                    display: flex;
                                                    align-items: center;
                                                    cursor: pointer;
                                                    padding: 10px;
                                                    border: 1px solid #ddd;
                                                    border-radius: 5px;
                                                    transition: background-color 0.3s, border-color 0.3s;
                                                }

                                                .payment-label:hover {
                                                    background-color: #f0f0f0;
                                                }

                                                .payment-image {
                                                    width: 50px;
                                                    height: 50px;
                                                    margin-right: 10px;
                                                }

                                                input[type="radio"]:checked + .payment-label {
                                                    background-color: #d1e7ff;
                                                    border-color: #0071dc;
                                                }

                                                .payment-label[disabled] {
                                                    cursor: not-allowed;
                                                    opacity: 0.5;
                                                }
                                            </style>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="checkout-item">
                                <div class="avatar checkout-icon p-1">
                                    <div class="avatar-title rounded-circle">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                </div>
                                <div class="feed-item-list">
                                    <div>
                                        <h5 class="font-size-16 mb-1">Thông tin thanh toán</h5>
                                    </div>
                                    <div>
                                        <h5 class="font-size-14 mb-3">Phương thức thanh toán :</h5>
                                        <div class="row">
                                            <div class="form-group mt-4">
                                                <label for="paymentMethod">Phương thức thanh toán</label>
                                                <div class="radio-group" style="display: flex; gap: 20px;">
                                                    <div class="radio-option"
                                                         style="display: flex; align-items: center;">
                                                        <input type="radio" id="paymentMethodBank" name="paymentMethod"
                                                               wire:model="paymentMethod" value="bank"
                                                               class="hidden-radio" required>
                                                        <label for="paymentMethodBank" class="payment-label">
                                                            <img
                                                                src="https://play-lh.googleusercontent.com/eropcks-sakGkOkCHQzpd87FKK4efHTLY5b93H2FwNLjoPnPcAMSzOHsm3s6lguSgw"
                                                                alt="Bank Payment" class="payment-image">
                                                            Thanh toán qua ngân hàng
                                                        </label>
                                                    </div>
                                                    <div class="radio-option"
                                                         style="display: flex; align-items: center;">
                                                        <input type="radio" id="paymentMethodWallet"
                                                               name="paymentMethod" wire:model="paymentMethod"
                                                               value="wallet"
                                                               class="hidden-radio" {{ ($total - $discountAmount) <= 0 ? '' : ($walletBalance >= ($total - $discountAmount) ? '' : 'disabled') }}>
                                                        <label for="paymentMethodWallet" class="payment-label"
                                                               style="{{ ($total - $discountAmount) <= 0 ? '' : ($walletBalance < ($total - $discountAmount) ? 'opacity: 0.5; pointer-events: none;' : '') }}">
                                                            <img
                                                                src="https://img.icons8.com/ios-filled/50/000000/wallet--v1.png"
                                                                alt="Wallet Payment" class="payment-image">
                                                            Sử dụng số dư trong tài khoản
                                                        </label>
                                                    </div>


                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success mt-3">Xác nhận thanh toán
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </form>

                    </ol>
                </div>
            </div>


            <div class="row my-4">
                <div class="col">
                    <a href="{{url('/')}}" class="btn btn-link text-muted">
                        <i class="mdi mdi-arrow-left me-1"></i> Tiếp tục mua hàng </a>
                </div> <!-- end col -->
                <div class="col">

                </div> <!-- end col -->
            </div> <!-- end row-->
        </div>
        <div class="col-xl-4">
            <div class="card checkout-order-summary">
                <div class="card-body">
                    <div class="p-3 bg-light mb-3">
                        <h5 class="font-size-16 mb-0">Tóm tắt đơn hàng</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0 table-nowrap">
                            <thead>
                            <tr>
                                <th class="border-top-0" style="width: 70px;" scope="col">Sản phẩm</th>
                                <th class="border-top-0" scope="col">Mô tả sản phẩm</th>
                                <th class="border-top-0" scope="col" style="width: 120px;">Giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <th scope="row">
                                        <img style="object-fit: cover; width: 70px; height: auto"
                                             src="{{ asset('storage/' . ($item->product->image ?? $item->product->thumbnail ?? 'default-image.jpg')) }}"
                                             alt="product-img"
                                             title="product-img"
                                             class="avatar-lg rounded">

                                    </th>
                                    <td>
                                        <h5 class="font-size-16">
                                            <a href="#" class="text-dark"
                                               style="display: inline-block; max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: normal; line-height: 1.5;"
                                               onclick="showFullText('{{ $item->product->name ?? $item->product->title }}'); return false;"
                                               title="{{ $item->product->name ?? $item->product->title }}">
                                                {{ $item->product->name ?? $item->product->title }}
                                                x <i>{{ $item->quantity }}</i>
                                            </a>
                                        </h5>

                                        <!-- Modal for full text -->
{{--                                         <div id="fullTextModal" --}}
{{--                                              style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; box-shadow:0 0 10px rgba(0,0,0,0.5); z-index:1000;"> --}}
{{--                                             <p id="fullTextContent"></p> --}}
{{--                                             <button onclick="closeModal()">Close</button> --}}
{{--                                         </div> --}}


                                        <style>
                                            .text-truncate {
                                                display: -webkit-box;
                                                -webkit-box-orient: vertical;
                                                -webkit-line-clamp: 2; /* Adjust this for the number of lines */
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                            }
                                        </style>


                                    </td>
                                    <td>{{ number_format($item->price) }} đ</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-3">
                        <!-- Bảng 2: Tổng hợp -->
                        <table class="table table-centered mb-0 table-nowrap">
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    <p class="font-bold font-size-14 m-0">Tổng phụ :</p>
                                </td>
                                <td>
                                    {{ number_format($total) }}đ
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <p class="font-bold font-size-14 m-0">Giảm giá :</p>
                                </td>
                                <td>
                                    @if ($discountType == 'percentage')
                                        {{ number_format($discountAmount) }}đ
                                    @elseif ($discountType == 'fixed')
                                        {{ number_format($discountAmount) }}đ
                                    @else
                                        0đ
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <p class="font-bold font-size-14 m-0">Thuế ước tính :</p>
                                </td>
                                <td>
                                    0đ
                                </td>
                            </tr>

                            <tr class="bg-light">
                                <td colspan="2">
                                    <p class="font-bold font-size-14 m-0">Tổng cộng:</p>
                                </td>
                                <td>
                                    @php
                                        $finalTotal = $total - $discountAmount;
                                    @endphp

                                    <b>{{ number_format($finalTotal > 0 ? $finalTotal : 0) }}đ</b>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
    <style>
        body {
            margin-top: 20px;
            background-color: #f1f3f7;
        }

        .card {
            margin-bottom: 24px;
            -webkit-box-shadow: 0 2px 3px #e4e8f0;
            box-shadow: 0 2px 3px #e4e8f0;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            /*border: 1px solid #eff0f2;*/
            /*border-radius: 1rem;*/
        }

        .activity-checkout {
            list-style: none
        }

        .activity-checkout .checkout-icon {
            position: absolute;
            top: -4px;
            left: -24px
        }

        .activity-checkout .checkout-item {
            position: relative;
            padding-bottom: 24px;
            padding-left: 35px;
            border-left: 2px solid #f5f6f8
        }

        .activity-checkout .checkout-item:first-child {
            border-color: var(--primary)
        }

        .activity-checkout .checkout-item:first-child:after {
            background-color: var(--primary)
        }

        .activity-checkout .checkout-item:last-child {
            border-color: transparent
        }

        .activity-checkout .checkout-item.crypto-activity {
            margin-left: 50px
        }

        .activity-checkout .checkout-item .crypto-date {
            position: absolute;
            top: 3px;
            left: -65px
        }


        .avatar-xs {
            height: 1rem;
            width: 1rem
        }

        .avatar-sm {
            height: 2rem;
            width: 2rem
        }

        .avatar {
            height: 3rem;
            width: 3rem
        }

        .avatar-md {
            height: 4rem;
            width: 4rem
        }

        .avatar-lg {
            height: 5rem;
            width: 5rem
        }

        .avatar-xl {
            height: 6rem;
            width: 6rem
        }

        .avatar-title {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background-color: var(--primary);
            color: #fff;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            font-weight: 500;
            height: 100%;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 100%
        }

        .avatar-group {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding-left: 8px
        }

        .avatar-group .avatar-group-item {
            margin-left: -8px;
            border: 2px solid #fff;
            border-radius: 50%;
            -webkit-transition: all .2s;
            transition: all .2s
        }

        .avatar-group .avatar-group-item:hover {
            position: relative;
            -webkit-transform: translateY(-2px);
            transform: translateY(-2px)
        }

        .card-radio {
            background-color: #fff;
            border: 2px solid #eff0f2;
            border-radius: .75rem;
            padding: .5rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block
        }

        .card-radio:hover {
            cursor: pointer
        }

        .card-radio-label {
            display: block
        }

        .edit-btn {
            width: 35px;
            height: 35px;
            line-height: 40px;
            text-align: center;
            position: absolute;
            right: 25px;
            margin-top: -50px
        }

        .card-radio-input {
            display: none
        }

        .card-radio-input:checked + .card-radio {
            border-color: var(--primary) !important
        }


        .font-size-16 {
            font-size: 16px !important;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        a {
            text-decoration: none !important;
        }


        .form-control {
            display: block;
            width: 100%;
            padding: 0.47rem 0.75rem;
            font-size: .875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #545965;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e2e5e8;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.75rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }

        .edit-btn {
            width: 35px;
            height: 35px;
            line-height: 40px;
            text-align: center;
            position: absolute;
            right: 25px;
            margin-top: -50px;
        }

        .ribbon {
            position: absolute;
            right: -26px;
            top: 20px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            padding: 1px 22px;
            font-size: 13px;
            font-weight: 500
        }


    </style>
</div>
