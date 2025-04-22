<div>
    <hr>
    <footer class="footer-part">
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="footer-widget">
                        <a class="footer-logo" href="{{ route('home') }}">
                            <img src="{{ $logoUrl }}" alt="logo">
                        </a>
                        <p class="footer-desc">{{ $websiteSetting->site_description ?? '' }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="footer-widget contact">
                        <h3 class="footer-title">Liên hệ</h3>
                        <ul class="footer-contact">
                            <li><i class="icofont-ui-email"></i>
                                <p>{{ $websiteSetting->email ?? 'admin@kho68.com' }}</p>
                            </li>
                            <li><i class="icofont-ui-touch-phone"></i>
                                <p>{{ $websiteSetting->support_phone ?? '09xxx' }}</p>
                            </li>
                            <li><i class="icofont-location-pin"></i>
                                <p>{{ $websiteSetting->address ?? 'Địa chỉ không có sẵn' }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="footer-widget">
                        <h3 class="footer-title">Liên kết</h3>
                        <div class="footer-links">
                            <ul>
                                <li><a href="{{ route('payment.policy') }}">Chính sách thanh toán</a></li>
                                <li><a href="{{ route('warranty.policy') }}">Chính sách bảo hành</a></li>
                                <li><a href="{{ route('privacy.policy') }}">Chính sách bảo mật</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
