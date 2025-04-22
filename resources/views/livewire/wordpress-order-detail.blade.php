<div class="mt-4">
    <section class="inner-section" style="margin-bottom:40px;">
        <div class="container">
            <div class="home-heading mb-3">
                <h3><i class="fa-solid fa-circle-info m-2"></i> CHI TIẾT ĐƠN HÀNG (#{{ $product->id }})</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card pt-3">
                        <!-- Thông tin sản phẩm -->
                        <div class="details-meta">
                            <p><strong>Tên sản phẩm:</strong> {{ $product->name }}</p>
                            <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }}đ</p>
                        </div>

                        <hr>

                        <!-- Mô tả sản phẩm -->
                        <h3 class="details-name">Sản phẩm: <a href="#" class="">{{ $product->name }}</a></h3>
                        <p class="details-desc">{!! $product->long_content  !!}</p>

                        <!-- Các nút chức năng -->
                        <a href="{{ $product->demo }}" target="_blank" rel="noopener noreferrer">
                            <button class="btn btn-primary">Xem bản Demo</button>
                        </a>

                        <!-- Nút tải xuống -->
                        <button class="btn btn-primary" wire:click="downloadFile" id="download-btn">
                            <!-- Đổi text dựa trên trạng thái -->
                            <span wire:loading.remove wire:target="downloadFile">
                                @if($isDownloading)
                                    Đang tải...
                                @else
                                    Tải xuống file
                                @endif
                            </span>
                            <span wire:loading wire:target="downloadFile">Đang tải...</span>
                        </button>
                        @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                        <hr>

                        <!-- Tổng giá trị đơn hàng -->
                        <div class="details-meta">
                            <p><strong>Tổng giá trị đơn hàng:</strong> {{ number_format($product->price, 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Lắng nghe các sự kiện từ Livewire để thay đổi trạng thái nút
    document.addEventListener('livewire:load', function () {
        Livewire.on('startDownload', function () {
            document.getElementById('download-btn').disabled = true;
        });

        Livewire.on('downloadComplete', function () {
            document.getElementById('download-btn').disabled = false;
        });
    });
</script>
