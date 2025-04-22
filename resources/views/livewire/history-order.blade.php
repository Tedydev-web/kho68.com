<div>
    <section class="py-5 inner-section profile-part">
        <div class="container">
            <div class="row content-reverse">
                @include('livewire.partials._sidebar-account')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="account-card pt-3">
                                <form action="#" method="GET">
                                    <div class="row form-row" style="
                                    align-items: end;
                                ">
                                        <!-- Mã đơn hàng -->
                                        <div class="col-lg col-md-4 col-6 form-group">
                                            <input class="form-control mb-2" type="text" wire:model.live="trans_id"
                                                   placeholder="Mã đơn hàng">
                                        </div>

                                        <!-- Từ ngày -->
                                        <div class="col-lg col-md-4 col-6 form-group">
                                            <label for="fromDate" class="form-label">Từ ngày</label>
                                            <input type="date" wire:model.live="fromDate" id="fromDate"
                                                   class="form-control mb-2" placeholder="Chọn ngày bắt đầu">
                                        </div>

                                        <!-- Đến ngày -->
                                        <div class="col-lg col-md-4 col-6 form-group">
                                            <label for="toDate" class="form-label">Đến ngày</label>
                                            <input type="date" wire:model.live="toDate" id="toDate"
                                                   class="form-control mb-2" placeholder="Chọn ngày kết thúc">
                                        </div>

                                        <!-- Nút Tìm kiếm -->
                                        <div class="col-lg col-md-4 col-6 form-group">
                                            <button class="shop-widget-btn mb-2"><i class="fas fa-search"></i><span>Tìm kiếm</span>
                                            </button>
                                        </div>

                                        <!-- Nút Bỏ lọc -->
                                        <div class="col-lg col-md-4 col-6 form-group">
                                            <button type="button" wire:click="$set('trans_id', '')"
                                                    class="shop-widget-btn mb-2">
                                                <i class="far fa-trash-alt"></i><span>Bỏ lọc</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="top-filter">
                                        <div class="filter-show">
                                            <label class="filter-label">Hiển thị :</label>
                                            <select wire:model.live="limit" class="form-select filter-select">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="filter-short">
                                            <label class="filter-label">Lọc theo ngày:</label>
                                            <select wire:model.live="shortByDate" class="form-select filter-select">
                                                <option value="">Tất cả</option>
                                                <option value="1">Hôm nay</option>
                                                <option value="2">Tuần này</option>
                                                <option value="3">Tháng này</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-scroll table-wrapper">
                                    <table class="table fs-sm text-nowrap table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Mã đơn</th>
                                                <th class="text-center">Tổng tiền</th>
                                                <th class="text-center">Trạng thái</th>
                                                <th class="text-center">Thanh toán</th>
                                                <th class="text-center">Thời gian</th>
                                                <th class="text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            @if($order->status === 'complete'   )
                                                <tr style="vertical-align: middle;">
                                                    <td class="text-center">{{ $order->id }}</td>
                                                 <td class="text-center">
    {{ number_format($order->total_after_discount !== null ? $order->total_after_discount : $order->total, 0, ',', '.') }} VND
</td>

                                                    <td class="text-center">Đã thanh toán</td>
                                                    <td class="text-center">{{ $order->payment_method ?: 'Chưa thanh toán' }}</td>
                                                    <td class="text-center">{{ $order->created_at }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info btn-sm" href="{{ route('order-detail', $order->id) }}"><i class="fa-solid fa-eye"></i> Xem chi tiết</a>
                                                        <br>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach


                                            @foreach($orders as $order)
                                               @if($order->status != 'complete')
                                                <tr>
                                                    <td class="text-center">{{ $order->id }}</td>
                                                 <td class="text-center">
    {{ number_format($order->total_after_discount !== null ? $order->total_after_discount : $order->total, 0, ',', '.') }} VND
</td>

                                                    <td class="text-center">{{ ucfirst($order->status) }}</td>
                                                    <td class="text-center">{{ $order->payment_method ?: 'Chưa thanh toán' }}</td>
                                                    <td class="text-center">{{ $order->created_at }}</td>
                                                    <td class="text-center">
                                                        @if($order->status === 'pending')
                                                            <!-- Nút Thanh Toán nếu trạng thái là 'pending' -->
                                                            <a class="btn btn-success btn-sm"
                                                               href="bank/process/{{ $order->id }}" type="button">
                                                                <i class="fa-solid fa-credit-card"></i> Thanh Toán
                                                            </a>
                                                        @else

                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                                <!-- Custom Pagination Controls -->
                                <div class="pagination-wrapper mt-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <!-- Previous Page Link -->
                                            @if ($orders->onFirstPage())
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&laquo;</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" wire:click="previousPage" rel="prev"
                                                       aria-label="Previous">&laquo;</a>
                                                </li>
                                            @endif

                                            <!-- Pagination Elements -->
                                            @foreach ($orders->links()->elements[0] as $page => $url)
                                                @if ($page == $orders->currentPage())
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                           wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            <!-- Next Page Link -->
                                            @if ($orders->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" wire:click="nextPage" rel="next"
                                                       aria-label="Next">&raquo;</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&raquo;</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .page-link {
            line-height: 100%;

        }

        .pagination a, .pagination span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #f8f8f8;
        }

        .pagination .active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination .disabled span {
            background-color: #f1f1f1;
            color: #888;
            cursor: not-allowed;
        }

        /* Pagination links */
        .pagination a, .pagination span {
            padding: 10px 15px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        /* Hover effects for links */
        .pagination a:hover {
            background-color: #f0f0f0;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        /* Active page styling */
        .pagination .active span {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* Disabled page styling */
        .pagination .disabled span {
            background-color: #f1f1f1;
            color: #888;
            cursor: not-allowed;
        }

        /* Special effect when clicking pagination links */
        .pagination a:active {
            transform: scale(0.95);
        }

        /* Adding a gradient hover effect */
        .pagination a:hover::before {
            content: '';
            position: absolute;
            left: -75px;
            top: -75px;
            width: 150px;
            height: 150px;
            background: rgba(0, 123, 255, 0.2);
            border-radius: 50%;
            transition: all 0.5s ease-out;
            z-index: -1;
        }

        .pagination a:hover::after {
            content: '';
            position: absolute;
            right: -75px;
            bottom: -75px;
            width: 150px;
            height: 150px;
            background: rgba(0, 123, 255, 0.2);
            border-radius: 50%;
            transition: all 0.5s ease-out;
            z-index: -1;
        }

        /* Adding a bounce effect on hover */
        .pagination a:hover {
            animation: bounce 0.4s ease;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }
    </style>
</div>
