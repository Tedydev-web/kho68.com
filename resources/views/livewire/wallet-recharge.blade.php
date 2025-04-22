<section class="py-5 inner-section profile-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="home-heading mb-3">
                    <h3><i class="fa-solid fa-triangle-exclamation m-2"></i> LƯU Ý NẠP TIỀN </h3>
                </div>
                <div class="account-card p-3">
                    <ul>
                        <li>Nhập đúng nội dung chuyển tiền.</li>
                        <li>Cộng tiền trong vài giây.</li>
                        <li>Liên hệ BQT nếu nhập sai nội dung chuyển.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <style>
                            .tab-link {
                                font-size: 22px;
                            }
                            .nav-tabs li {
                                padding: -3px 30px;
                            }
                            .nav-tabs li .active {
                                padding: 2px 30px;
                                border: 1px solid #ccc;
                            }
                        </style>
                        <ul class="nav nav-tabs">
                            <li><a href="#tab-10" class="tab-link active" data-bs-toggle="tab">VCB</a></li>
                            <li><a href="#tab-14" class="tab-link" data-bs-toggle="tab">ACB</a></li>
                            <li><a href="#tab-15" class="tab-link" data-bs-toggle="tab">MBBank</a></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade active show" id="tab-10">
                    <div class="account-card">
                        <center class="py-3">
                            <!-- API VietQR URL -->
                            <img src="https://api.vietqr.io/MBBANK/{{ $bankAccount }}/0/{{ $transactionCode }}/qronly2.jpg?accountName={{ urlencode($accountName) }}"
                                width="300px">
                        </center>
                        <ul class="list-group">
                            <li class="list-group-item">Số tài khoản: <b id="copySTK10" style="color: green;">{{ $bankAccount }}</b>
                                <button onclick="copy()" class="copy" data-clipboard-target="#copySTK10">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </li>
                            <li class="list-group-item" style="font-size:17px;">Nội dung chuyển khoản:
                                <b id="copyNoiDung10" style="color: red;">{{ $transactionCode }}</b>
                                <button onclick="copy()" class="copy" data-clipboard-target="#copyNoiDung10">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </li>
                            <li class="list-group-item">Chủ tài khoản: <b>{{ $accountName }}</b></li>
                            <li class="list-group-item">Ngân hàng: <b>MBBank</b></li>
                        </ul>
                        <center><small>Nhập đúng nội dung chuyển khoản để hệ thống cộng tiền tự động...</small></center>
                    </div>
                </div>
                <!-- Các ngân hàng khác có thể được thêm tương tự -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="home-heading mb-3">
                        <h3><i class="fa-solid fa-clock-rotate-left m-2"></i> LỊCH SỬ NẠP TIỀN </h3>
                    </div>
                    <div class="account-card pt-3">
                        <div class="table-scroll">
                            <table class="table fs-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Thời gian</th>
                                        <th class="text-center">Ngân hàng</th>
                                        <th>Nội dung chuyển khoản</th>
                                        <th class="text-right">Số tiền nạp</th>
                                        <th class="text-right">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td><b>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</b></td>
                                            <td class="text-center"><b>{{ $transaction->bank_name }}</b></td>
                                            <td>{{ $transaction->transaction_code }}</td>
                                            <td class="text-right"><b style="color: green;">{{ number_format($transaction->amount, 0, ',', '.') }} VND</b></td>
                                            <td class="fw-bold text-{{ $transaction->status == 'completed' ? 'success' : 'danger' }} text-center">
                                                <b>{{ $transaction->status == 'completed' ? 'Đã thanh toán' : 'Chờ thanh toán' }}</b>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
