<section class="py-5 inner-section profile-part">
    <div class="container">
        <div class="row content-reverse">
            @include('livewire.partials._sidebar-account')
            <div class="col-lg-9">
                @auth
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="account-card">
                                <h4 class="account-title">Ví của tôi</h4>
                                <div class="my-wallet">
                                    <p>Số dư hiện tại</p>
                                    <h3>{{ number_format($balance, 0, ',', '.') }}đ</h3>
                                </div>
                                <div class="wallet-card-group">
                                    <div class="wallet-card">
                                        <p>Tổng tiền nạp</p>
                                        <h3>{{ number_format($totalDeposited, 0, ',', '.') }}đ</h3>
                                    </div>
                                    <div class="wallet-card">
                                        <p>Đã sử dụng</p>
                                        <h3>{{ number_format($totalUsed, 0, ',', '.') }}đ</h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="account-card">
                                <div class="account-title">
                                    <h4>Hồ sơ của bạn</h4>
                                    <div class="row" style="gap: 5px">
                                        <button class="col btn-cancel-info-account"
                                                style="background-color: gray; display:none;"
                                                onclick="cancelChanges()">Hủy
                                        </button>
                                        <button class="col btn-save-info-account" style="display:none;"
                                                wire:click="saveChanges">Lưu thông tin
                                        </button>
                                    </div>
                                </div>
                                <div class="account-content">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Tên đăng nhập</label>
                                                <input type="text" class="form-control"
                                                       value="{{ auth()->user()->userDetail->username }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label">Địa chỉ Email</label>
                                                <input type="email" class="form-control"
                                                       value="{{ auth()->user()->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group"><label class="form-label">Số điện
                                                    thoại/Zalo/Telegram</label>
                                                <input type="text" class="form-control" wire:model.defer="phone"
                                                       value="{{ auth()->user()->userDetail->phone }}"
                                                       oninput="checkChanges()" id="phoneInput">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group"><label class="form-label">Họ và Tên</label>
                                                <input type="text" class="form-control" wire:model.defer="fullname"
                                                       value="{{ auth()->user()->userDetail->fullname }}"
                                                       oninput="checkChanges()" id="fullnameInput">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group"><label class="form-label">Địa chỉ IP</label>
                                                <input type="text" class="form-control"
                                                       value="{{ auth()->user()->userDetail->ip_address }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group"><label class="form-label">Đăng nhập gần nhất</label>
                                                <input type="text" class="form-control" value="2022-04-28 19:52:56"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-12">
                                            <div class="form-group"><label class="form-label">Địa chỉ</label>
                                                <input type="text" class="form-control" wire:model.defer="address"
                                                       value="{{ auth()->user()->userDetail->address }}"
                                                       oninput="checkChanges()" id="addressInput">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    const originalPhone = document.getElementById('phoneInput').value;
    const originalFullname = document.getElementById('fullnameInput').value;
    const originalAddress = document.getElementById('addressInput').value;

    function checkChanges() {
        const currentPhone = document.getElementById('phoneInput').value;
        const currentFullname = document.getElementById('fullnameInput').value;
        const currentAddress = document.getElementById('addressInput').value;

        if (currentPhone !== originalPhone || currentFullname !== originalFullname ||currentAddress !== originalAddress) {
            document.querySelector('.btn-cancel-info-account').style.display = 'block';
            document.querySelector('.btn-save-info-account').style.display = 'block';
        } else {
            document.querySelector('.btn-cancel-info-account').style.display = 'none';
            document.querySelector('.btn-save-info-account').style.display = 'none';
        }
    }

    function cancelChanges() {
        document.getElementById('phoneInput').value = originalPhone;
        document.getElementById('fullnameInput').value = originalFullname;
        document.getElementById('addressInput').value = originalAddress;
        checkChanges();
    }
</script>
