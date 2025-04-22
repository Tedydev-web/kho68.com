<header class="header-part">
    <div class="container">
        <div class="header-content">
            <div class="header-media-group">
                <button class="header-user"><i class="fa-solid fa-bars"></i></button>
                <a wire:navigate href="/">
                    <img src="{{ asset('assets/storage/images/kho682.png') }}" alt="logo"></a>
                <button class="header-src"><i class="fas fa-search"></i></button>
            </div>
            <a wire:navigate href="{{ route('home') }}" class="header-logo"><img
                    src="{{ asset('assets/storage/images/kho682.png') }}" alt="logo"></a>
            <form class="header-form" method="GET" action="{{ route('search') }}">
                <input type="text" name="searchTerm" value="{{ request('searchTerm') }}"
                       placeholder="Tìm kiếm sản phẩm...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>

            <div class="header-widget-group">
                @auth
                    <a href="{{ route('cart') }}" class="header-widget" title="Giỏ hàng">
                        <i class="fa-solid fa-cart-arrow-down"></i>
                    </a>
                    <a href="{{ route('wishlist') }}" class="header-widget" title="Sản phẩm yêu thích">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="{{ route('wallet.recharge') }}" class="header-widget" title="Nạp tiền">
                        <i class="fa-solid fa-building-columns"></i>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<nav class="navbar-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-content">
                    <ul class="navbar-list">
                        @livewire('category-menu')
                    </ul>
                    <div class="navbar-info-group">
                        @auth
                            <div class="navbar-info">
                                <div class="btn-group" role="group">
                                    @if (Route::currentRouteName() != 'account')
                                        <a href="{{ route('account') }}" type="button" class="btn btn-danger mb-3">
                                            <i class="fa-solid fa-user" style="font-size: 15px; color: #fff"></i> Tài
                                            khoản
                                            của tôi
                                        </a>
                                    @endif

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="javascript:void(0);" onclick="logout()" type="button"
                                       class="btn btn-secondary mb-3">
                                        <i class="fa-solid fa-right-from-bracket" style="font-size: 15px;"></i> Đăng
                                        xuất
                                    </a>
                                </div>
                                <script type="text/javascript">
                                    function logout() {
                                        Swal.fire({
                                            title: 'Xác nhận đăng xuất tài khoản'
                                            , text: ""
                                            , icon: 'warning'
                                            , showCancelButton: true
                                            , confirmButtonColor: '#3085d6'
                                            , cancelButtonColor: '#d33'
                                            , confirmButtonText: 'Đồng ý'
                                            , cancelButtonText: 'Huỷ bỏ'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('logout-form').submit();
                                            }
                                        })
                                    }

                                </script>
                            </div>
                        @else
                            <div class="navbar-info">
                                <a href="{{ route('login') }}" type="button" class="btn btn-primary">
                                    <i class="fa-solid fa-right-to-bracket" style="font-size: 15px; color: #fff"></i>
                                    Đăng nhập
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- ================= MOBILE =================== --}}
@php
    $mobile_categories = App\Models\Category::with('children')->where('status', 'active')->get();
@endphp
<aside class="nav-sidebar " id="mobile-menu">

    <div class="nav-header">
        <a wire:navigate href="{{ route('home') }}"><img src="{{ asset('assets/storage/images/kho682.png') }}"
                                                         alt="logo"></a>
        <button class="nav-close"><i class="icofont-close"></i></button>
    </div>
    <div class="nav-content">
        <div class="nav-btn">
            @auth
                <a href="{{ route('account') }}" class="btn btn-inline">
                    <i class="fa fa-unlock-alt"></i> <span>Tài khoản của tôi</span></a>
            @else
                <a href="{{ route('login') }}" class="btn btn-inline">
                    <i class="fa fa-unlock-alt"></i> <span>Đăng nhập</span></a>
            @endauth
        </div>
        <ul class="nav-list">
            <li><a class="nav-link" href="{{ route('home') }}"><i class="icofont-home"></i>Trang chủ</a></li>

            <li>
                <a class="nav-link dropdown-link"><i class="fa-solid fa-cart-shopping"></i>Sản phẩm</a>
                <ul class="dropdown-list">
                    @foreach($mobile_categories as $category)
                        @if (is_null($category->parent_id))
                            <li>
                                <a class="nav-link {{ $category->children->count() ? 'dropdown-arrow' : '' }}"
                                   href="{{ route('category-products', ['slug' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>

                                @if($category->children->count())
                                    <ul class="dropdown-position-list" style="display: none;">
                                        @foreach($category->children as $child)
                                            @if ($child->status === 'active')
                                                <li>
                                                    <a class="nav-link {{ $child->children->count() ? 'dropdown-arrow' : '' }}"
                                                       href="{{ route('category-products', ['slug' => $child->slug]) }}">
                                                        {{ $child->name }}
                                                    </a>
                                                    @if($child->children->count())
                                                        <ul class="dropdown-position-list" style="display: none;">
                                                            @foreach($child->children as $grandchild)
                                                                @if ($grandchild->status === 'active')
                                                                    <li>
                                                                        <a href="{{ route('category-products', ['slug' => $grandchild->slug]) }}">{{ $grandchild->name }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>

            <li><a class="nav-link dropdown-link" href="{{ route('wallet.recharge') }}"><i
                        class="fa-solid fa-building-columns"></i>Nạp tiền</a></li>

            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li><a class="nav-link" href="javascript:void(0);" onclick="logout()"><i class="icofont-logout"></i>Đăng
                        Xuất</a></li>
            @endauth

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
                    });
                }
            </script>
        </ul>
        <div class="nav-info-group">
            <div class="nav-info"><i class="icofont-ui-touch-phone"></i>
                <p><span>0988888XXX</span></p>
            </div>
            <div class="nav-info"><i class="icofont-ui-email"></i>
                <p><span>admin@domain.com</span></p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownLinks = document.querySelectorAll('#mobile-menu .dropdown-link'); // Scope to mobile menu

            dropdownLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent default action

                    // Find the next dropdown-list
                    const dropdownList = this.nextElementSibling;

                    if (dropdownList) {
                        // Toggle the display of the dropdown-list
                        const isVisible = dropdownList.style.display === 'block';
                        dropdownList.style.display = isVisible ? 'none' : 'block';

                        // Close all other dropdowns
                        // dropdownLinks.forEach(otherLink => {
                        //     if (otherLink !== this) {
                        //         const otherDropdownList = otherLink.nextElementSibling;
                        //         if (otherDropdownList) {
                        //             otherDropdownList.style.display = 'none';
                        //         }
                        //     }
                        // });
                    }
                });
            });

            // Event for child category links
            const dropdownPositionLinks = document.querySelectorAll('#mobile-menu .dropdown-position-list'); // Scope to mobile menu

            dropdownPositionLinks.forEach(positionLink => {
                const parentLink = positionLink.previousElementSibling;
                parentLink.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent default action

                    // Toggle display for child categories
                    const subDropdownList = positionLink;
                    subDropdownList.style.display = subDropdownList.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Close dropdowns if clicked outside
            document.addEventListener('click', function (e) {
                const isDropdownLink = e.target.classList.contains('dropdown-link');
                const isMobileMenu = e.target.closest('#mobile-menu'); // Check if click is within mobile menu
                if (!isDropdownLink && !isMobileMenu) {
                    dropdownLinks.forEach(link => {
                        const dropdownList = link.nextElementSibling;
                        if (dropdownList) {
                            dropdownList.style.display = 'none';
                        }
                    });
                    dropdownPositionLinks.forEach(positionLink => {
                        positionLink.style.display = 'none';
                    });
                }
            });

            // Hide all child dropdowns on initial load
            dropdownPositionLinks.forEach(positionLink => {
                positionLink.style.display = 'none'; // Ensure child categories are hidden by default
            });
        });
    </script>

    <style>
        #mobile-menu .dropdown-position-list {
            display: none; /* Keep it hidden by default */
            margin-left: 15px; /* Adjust the value to your preference */
        }

        #mobile-menu .dropdown-position-list li {
            list-style-type: none; /* Optional: Remove bullet points */
        }

        #mobile-menu li .dropdown-position-list {
            top: 0px !important;
            position: relative;
            visibility: visible;
            opacity: 1;
        }
    </style>
</aside>
