<div>
    <section class="py-5 inner-section">
        <div class="container">
            <h2>Kết quả thanh toán</h2>
            <div class="row">
                <div class="col-12">
                    @if($orderStatus == 'success')
                        <p class="alert alert-success">Thanh toán thành công! Đơn hàng của bạn đã được ghi nhận.</p>
                    @else
                        <p class="alert alert-danger">Thanh toán thất bại! Vui lòng thử lại.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
