<div class="mt-4">
    <section class="inner-section" style="margin-bottom:40px;">
        <div class="container">
            <div class="home-heading mb-3">
                <h3><i class="fa-solid fa-circle-info m-2"></i> CHI TIẾT ĐƠN HÀNG (#{{ $otherProduct->id }})</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card pt-3">
                        <h3 class="details-name">Sản phẩm: {{ $otherProduct->name }}</h3>
                        <div class="details-meta">
                            <p>
                                <label class="label-text feat">Số lượng mua: <strong>-</strong></label>
                                <label class="label-text order">Giá:
                                    <strong>{{ number_format($otherProduct->price, 0, ',', '.') }}đ</strong></label>
                            </p>
                        </div>
                        <button class="btn btn-primary" onclick="window.open('{{ $otherProduct->demo_link }}')">Demo</button>

                        <button class="btn btn-primary" wire:click="downloadFile" wire:loading.attr="disabled">
                            <span wire:loading.remove>Tải về file</span>
                            <span wire:loading>Tải về...</span>
                        </button>
                        @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                        <div class="mt-4">
                            <h4>Mô tả sản phẩm</h4>
                            <div>{!! $otherProduct->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
