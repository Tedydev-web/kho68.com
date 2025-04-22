<div>
    <section class="py-5 inner-section profile-part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="user-form-card">
                        <div class="user-form-title">
                            <h2>Đăng ký tài khoản</h2>
                            <p>Vui lòng nhập thông tin đăng ký</p>
                        </div>
                        <div class="user-form-group">
                            <form wire:submit.prevent="register" class="user-form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="username"
                                           placeholder="Tài khoản đăng nhập">
                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" wire:model="email"
                                           placeholder="Địa chỉ Email">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" wire:model="password"
                                           placeholder="Mật khẩu">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" wire:model="password_confirmation"
                                           placeholder="Nhập lại mật khẩu">
                                    @error('password_confirmation') <span
                                        class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-button">
                                    <button type="submit">Đăng Ký</button>
                                    <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng Nhập</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
