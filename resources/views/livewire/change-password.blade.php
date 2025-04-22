<section class="py-5 inner-section profile-part">
    <div class="container">
        <div class="row content-reverse">
            @include('livewire.partials._sidebar-account')
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>Thay đổi mật khẩu</h4>
                            </div>
                            <div class="account-content">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <p class="mb-3 text-muted">
                                    Thay đổi mật khẩu đăng nhập của bạn là một cách dễ dàng để giữ an toàn cho tài khoản
                                    của bạn. </p>
                                <div class="row">
                                    <form wire:submit.prevent="updatePassword">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Mật khẩu hiện tại</label>
                                                <input type="password" id="current_password" class="form-control"
                                                       wire:model="current_password">
                                                @error('current_password') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Mật khẩu mới</label>
                                                <input type="password" id="new_password" class="form-control"
                                                       wire:model="new_password">
                                                @error('new_password') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group"><label class="form-label">Nhập lại mật khẩu
                                                    mới</label>
                                                <input type="password" id="new_password_confirmation"
                                                       class="form-control" wire:model="new_password_confirmation">
                                            </div>
                                        </div>
                                        <center>
                                            <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
