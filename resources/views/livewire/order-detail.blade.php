<section class="inner-section mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="home-heading mb-3">
                    <h3><i class="fa-solid fa-cart-shopping m-2"></i> LỊCH SỬ ĐƠN HÀNG </h3>
                </div>
                <div class="account-card pt-3">
                    <div class="table-scroll table-wrapper">
                        <table class="table fs-sm text-nowrap table-hover  mb-0">
                            <thead>
                            <tr>
                                {{--                                 <th class="text-center"> --}}
                                {{--                                     <input type="checkbox" class="form-check-input" name="check_all" --}}
                                {{--                                            id="check_all_checkbox" value="option1"> --}}
                                {{--                                 </th> --}}
                                <th class="text-center" width="3%">Mã đơn hàng</th>
                                <th class="text-center">Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thanh toán</th>
                                <th class="text-center">Ghi chú cá nhân</th>
                                <th class="text-center">Thời gian</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr style="vertical-align: middle;">
                                    {{--                                     <td class="text-center"> --}}
                                    {{--                                         <input type="checkbox" class="form-check-input checkbox" --}}
                                    {{--                                                data-id="{{ $item->id }}" name="checkbox" value="{{ $item->id }}"> --}}
                                    {{--                                     </td> --}}

                                    <td class="text-center">{{ $order->id }}</td>
                                    <td class="text-left">
                                        <strong>
                                            @if($item->courseProduct)
                                                {{ $item->courseProduct->title }}
                                            @elseif($item->socialAccountProduct)
                                                {{ $item->socialAccountProduct->name }}
                                            @elseif($item->wordpressProduct)
                                                {{ $item->wordpressProduct->name }}
                                            @elseif($item->otherProduct)
                                                {{ $item->otherProduct->name }}
                                            @endif
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-danger">{{ number_format($item->price, 0, ',', '.') }}đ</span>
                                    </td>
                                    <td class="text-center">
                                        <textarea class="saveNote" rows="1" data-id="{{ $item->id }}"></textarea>
                                    </td>
                                    <td class="text-center">
                                        <strong data-toggle="tooltip" data-placement="bottom"
                                                title="{{ $order->created_at->diffForHumans() }}"><small>{{ $order->created_at }}</small></strong>
                                    </td>
                                    <td class="text-center">
                                        @if($item->courseProduct)
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('course-order-detail', ['id' => $item->courseProduct->id]) }}"><i
                                                    class="fa-solid fa-eye"></i> Chi tiết</a>
                                        @elseif($item->socialAccountProduct)
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('social-order-detail', ['id' => $item->socialAccountProduct->id]) }}"><i
                                                    class="fa-solid fa-eye"></i> Chi tiết</a>
                                        @elseif($item->wordpressProduct)
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('wordpress-order-detail', ['id' => $item->wordpressProduct->id]) }}"><i
                                                    class="fa-solid fa-eye"></i> Chi tiết</a>
                                        @elseif($item->otherProduct)
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('other-product-order-detail', ['id' => $item->otherProduct->id]) }}"><i
                                                    class="fa-solid fa-eye"></i> Chi tiết</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
