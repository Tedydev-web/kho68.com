<div class="col-lg-3">

    @auth
        @if( auth()->user()->userDetail && auth()->user()->userDetail->role == 'admin' )
            <a class="sidebar_profile" href="/k68-admin">
                <h6><i class="fas fa-dashboard"></i> <span>Dashboard admin</span></h6>
            </a>
        @endif

        <a class="sidebar_profile {{ request()->routeIs('account') ? 'mobile-menu-active' : '' }}"
           href="{{ route('account') }}">
            <h6><i class="fas fa-user"></i> <span>Thông tin cá nhân</span></h6>
        </a>

        <a class="sidebar_profile {{ request()->routeIs('history-order') ? 'mobile-menu-active' : '' }}"
           href="{{ route('history-order') }}">
            <h6><i class="fa-solid fa-shield-halved"></i> <span>Đơn hàng đã mua</span></h6>
        </a>

        <a class="sidebar_profile {{ request()->routeIs('transactions') ? 'mobile-menu-active' : '' }}"
           href="{{ route('transactions') }}">
            <h6><i class="fa-solid fa-wallet"></i> <span>Biến động số dư</span></h6>
        </a>

        <a class="sidebar_profile {{ request()->routeIs('change-password') ? 'mobile-menu-active' : '' }}"
           href="{{ route('change-password') }}">
            <h6><i class="fa fa-key" aria-hidden="true"></i> <span>Thay đổi mật khẩu</span></h6>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a class="sidebar_profile" href="javascript:void(0);" onclick="logout()" style="cursor: pointer;">
            <h6><i class="fa-solid fa-right-from-bracket"></i>
                <span>Đăng Xuất</span>
            </h6>
        </a>
    @endauth

</div>

<script type="text/javascript">
    function logout() {
        Swal.fire({
            title: 'Xác nhận đăng xuất tài khoản',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Huỷ bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        })
    }
</script>
