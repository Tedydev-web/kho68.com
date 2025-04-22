<div class="mt-4">
    <section class="inner-section" style="margin-bottom:40px;">
        <div class="container">
            <div class="home-heading mb-3">
                <h3><i class="fa-solid fa-circle-info m-2"></i> CHI TIẾT ĐƠN HÀNG (#{{ $socialAccountProduct->id }})</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card pt-3">
                        <h3 class="details-name">Sản phẩm: {{ $socialAccountProduct->name }}</h3>
                        <div class="details-meta">
                            <p>
                                <label class="label-text feat">Số lượng mua: <strong>1</strong></label>
                                <label class="label-text order">Giá: <strong>{{ number_format($socialAccountProduct->price, 0, ',', '.') }}đ</strong></label>
                            </p>
                        </div>
                        <p class="details-desc">{!!  $socialAccountProduct->long_content !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card pt-3">
                        <div class="table-scroll table-wrapper">
                            <table class="table fs-sm text-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tài khoản</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="vertical-align: middle;">
                                        <td class="text-center">
                                            <textarea class="form-control" id="copySocialAccount" rows="3" readonly>{{ $socialAccountProduct->data_account }}</textarea>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm" onclick="copyToClipboard('#copySocialAccount')"><i class="fa-solid fa-copy"></i> Copy</button>
                                            <button class="btn btn-info btn-sm" wire:click="downloadData"><i class="fa-solid fa-download"></i> Tải về .txt</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function copyToClipboard(selector) {
        const textarea = document.querySelector(selector);
        textarea.select();
        document.execCommand('copy');
        alert('Đã copy tài khoản!');
    }
</script>
