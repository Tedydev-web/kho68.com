<div>
    <section class="py-5 inner-section profile-part">
        <div class="container">
            <div class="row content-reverse">
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                @include('livewire.partials._sidebar-account')
                <div class="col-lg-9">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="account-card">
                                <h4 class="account-title">Biến động số dư</h4>
                                <div class="chart-container mb-4">
                                    <canvas id="balanceChart" width="400" height="200"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
           var ctx = document.getElementById('balanceChart').getContext('2d');

var totalDeposits = @json($totalDeposits); // Tổng tiền nạp
var totalWithdraws = @json($totalWithdraws); // Tổng tiền rút
var dates = @json($dates); // Ngày giao dịch

new Chart(ctx, {
    type: 'line',
    data: {
        labels: dates, // Ngày giao dịch
        datasets: [
            {
                label: 'Tổng nạp',
                data: totalDeposits, // Dữ liệu tổng nạp
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            },
            {
                label: 'Tổng rút',
                data: totalWithdraws, // Dữ liệu tổng rút
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }
        ]
    },
    options: {
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
        }
    }
});
    </script>

                                <form action="#" method="GET">
                                    <div class="row form-row" style="align-items: end;">
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

                                        <!-- Nút Bỏ lọc -->
                                        <div class="col-lg col-md-4 col-6 form-group">
                                            <button type="button" wire:click="resetFilters" class="shop-widget-btn mb-2">
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
                                    <table class="table text-nowrap fs-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th width="20%">Thời gian</th>
                                                <th class="text-center">Số dư ban đầu</th>
                                                <th class="text-center">Số dư thay đổi</th>
                                                <th class="text-center">Số dư hiện tại</th>
                                                <th>Lý do</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->created_at }}</td>
                                                    @if ($transaction->type !== 'banking')
                                                        <td class="text-right"><b
                                                                style="color: green;">{{ number_format($transaction->initial_balance, 0, ',', '.') }}đ</b>
                                                        </td>
                                                        <td class="text-right">
                                                            <b
                                                                style="color: {{ $transaction->type === 'deposit' ? 'green' : 'red' }};">
                                                                {{ number_format($transaction->amount, 0, ',', '.') }}đ
                                                            </b>
                                                        </td>
                                                        <td class="text-right"><b
                                                                style="color: blue;">{{ number_format($transaction->current_balance, 0, ',', '.') }}đ</b>
                                                        </td>
                                                    @else
                                                        <td class="text-right">-</td>
                                                        <td class="text-right">
                                                            <b
                                                                style="color: {{ $transaction->type === 'deposit' ? 'green' : 'red' }};">
                                                                {{ number_format($transaction->amount, 0, ',', '.') }}đ
                                                            </b>
                                                        </td>
                                                        <td class="text-right">-</td>
                                                    @endif
                                                    <td><small>{{ $transaction->description }}</small></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                             

                                </div>

                                <!-- Pagination -->
                                <div class="pagination-wrapper mt-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <!-- Previous Page Link -->
                                            @if ($transactions->onFirstPage())
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
                                            @foreach ($transactions->links()->elements[0] as $page => $url)
                                                @if ($page == $transactions->currentPage())
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
                                            @if ($transactions->hasMorePages())
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
                                <!-- End Pagination -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

.pagination .page-link:hover {
    background-color: #cc0404;
}

.pagination .page-item.active .page-link {
    background-color: #9c0404;
    color: white;
    border-color: #9c0404;
}

.pagination .disabled span {
    background-color: #f1f1f1;
    color: #888;
    cursor: not-allowed;
}

.pagination a, .pagination span {
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
}

.pagination a:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.pagination a:active {
    transform: scale(0.95);
}

        </style>
    </section>
</div>
