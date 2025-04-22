<div>
    <section class="py-5 inner-section profile-part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="user-form-card">
                        <div class="user-form-title">
                            <h2>Đăng Nhập</h2>
                            <p>Vui lòng nhập thông tin đăng nhập</p>
                        </div>
                        <div class="user-form-group">
                            <form wire:submit.prevent="login" class="user-form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" wire:model="email" class="form-control" placeholder="Email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" wire:model="password" class="form-control"
                                           placeholder="Mật khẩu">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-button">
                                    <button type="submit">Đăng Nhập</button>
                                    @if(session()->has('error'))
                                        <span class="text-danger">{{ session('error') }}</span>
                                    @endif
                                </div>
                                <br>
                                <p>
                                    @if(Route::has('forget-password'))
                                        <a href="{{ route('forget-password') }}">Quên mật khẩu?</a>
                                    @endif
                                </p>
                            </form>
                        </div>
                    </div>
                    <div class="user-form-remind">
                        <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng Ký Ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
