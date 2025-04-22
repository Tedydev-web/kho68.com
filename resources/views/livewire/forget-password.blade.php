<div>
    <section class="py-5 inner-section profile-part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="user-form-card">
                        <div class="user-form-title">
                            <h2>Đặt lại mật khẩu</h2>
                            <p>Vui lòng nhập thông tin để đặt lại mật khẩu</p>
                        </div>
                        <div class="user-form-group">
                            <form class="user-form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="number" class="form-control" placeholder="OTP">
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-secondary w-100">Nhận OTP</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Mật khẩu mới">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Xác nhận mật khẩu">
                                </div>
                                <div class="form-button">
                                    <button type="submit">Xác nhận</button>
                                    @if(session()->has('error'))
                                        <span class="text-danger">{{ session('error') }}</span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
