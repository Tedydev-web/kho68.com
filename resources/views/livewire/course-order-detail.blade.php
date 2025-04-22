<div class="mt-4">
    <section class="inner-section" style="margin-bottom:40px;">
        <div class="container">
            <div class="home-heading mb-3">
                <h3><i class="fa-solid fa-circle-info m-2"></i> CHI TIẾT ĐƠN HÀNG (#{{ $orderId }})</h3>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card pt-3">
                        <!-- Thông tin khóa học -->
                        <h3 class="details-name">Khóa học: {{ $course->title }}</h3>
                        <div class="details-meta">
                            <p>
                                <!-- Kiểm tra nếu có giá giảm thì hiển thị cả giá gốc và giá giảm -->
                                @if($course->sale_price)
                                    <label class="label-text feat">
                                        Giá gốc:
                                        <strong style="text-decoration: line-through;">
                                            {{ number_format($course->price, 0, ',', '.') }}đ
                                        </strong>
                                    </label>
                                    <label class="label-text order">
                                        Giá giảm:
                                        <strong>{{ number_format($course->sale_price, 0, ',', '.') }}đ</strong>
                                    </label>
                                @else
                                    <!-- Nếu không có giá giảm, chỉ hiển thị giá gốc -->
                                    <label class="label-text feat">
                                        Giá khóa học:
                                        <strong>{{ number_format($course->price, 0, ',', '.') }}đ</strong>
                                    </label>
                                @endif
                            </p>
                        </div>
                        @if (strlen($course->image) > 7)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}" style="height: 200px !important; object-fit: cover;">
                    @else
                        @php
                            $media = \App\Models\Media::find($course->image); // Lấy media từ ID
                        @endphp
                        @if ($media)
                            <x-curator-glider style="height: 200px !important; object-fit: cover;" class="object-cover w-auto" :media="$course->image" glide="" :srcset="['1024w','640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                        @else
                            <p>Media not found.</p> <!-- Thông báo nếu không tìm thấy media -->
                        @endif
                    @endif

                    <p class="details-desc">{!!  $course->short_description !!}</p>
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
                        <!-- Danh sách các bài học trong khóa học -->
                        <h4>Danh sách bài học:</h4>
                        <div class="table-scroll table-wrapper">
                            <table class="table fs-sm text-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-left">Tên bài học</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modules as $module)
                                    <tr style="vertical-align: middle;">
                                        <td class="text-left">{{ $module->title }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" wire:click="downloadFile({{ $module->id }})" wire:loading.attr="disabled">
                                                <span wire:loading.remove wire:target="downloadFile({{ $module->id }})">
                                                    <i class="fa-solid fa-download"></i> Tải video
                                                </span>
                                                <span wire:loading wire:target="downloadFile({{ $module->id }})">
                                                    <i class="fas fa-spinner fa-spin"></i> Đang tải...
                                                </span>
                                            </button>
                                            @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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
    </section>
</div>
