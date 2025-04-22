<section class="py-5 inner-section profile-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="home-heading mb-3">
                    <h3><i class="fa-solid fa-triangle-exclamation m-2"></i> LƯU Ý THANH TOÁN ĐƠN HÀNG</h3>
                </div>
                <div class="account-card p-3">
                    <ul>
                        <li>Nhập đúng nội dung chuyển tiền: <b>{{ $transactionCode }}</b>.</li>
                        <li>Hệ thống sẽ cập nhật sau khi thanh toán.</li>
                        <li>Liên hệ BQT nếu gặp vấn đề.</li>
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
                            <li><a href="#tab-10" class="tab-link active" data-bs-toggle="tab">MBBank</a></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane fade active show" id="tab-10">
                    <div class="account-card">
                        <center class="py-3">
                            <img src="https://api.vietqr.io/MBBANK/{{ $bankAccount }}/{{ $total }}/{{ $transactionCode }}/qronly2.jpg?accountName={{ urlencode($accountName) }}"
                                width="300px" alt="QR Code">
                        </center>
                        <ul class="list-group">
                            <li class="list-group-item">Số tài khoản: <b style="color: green;">{{ $bankAccount }}</b>
                                <button onclick="copyToClipboard('{{ $bankAccount }}')" class="copy">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </li>
                            <li class="list-group-item" style="font-size:17px;">Nội dung chuyển khoản:
                                <b style="color: red;">{{ $transactionCode }}</b>
                                <button onclick="copyToClipboard('{{ $transactionCode }}')" class="copy">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </li>
                            <li class="list-group-item">Chủ tài khoản: <b>{{ $accountName }}</b></li>
                            <li class="list-group-item">Ngân hàng: <b>MBBank</b></li>
                        </ul>
                        <center><small>Nhập đúng nội dung chuyển khoản để hệ thống cập nhật đơn hàng tự động...</small></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function () {
            alert('Đã sao chép: ' + text);
        }, function () {
            alert('Không thể sao chép');
        });
    }
</script>
