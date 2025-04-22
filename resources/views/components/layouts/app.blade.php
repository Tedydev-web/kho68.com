<!doctype html>
<html class="h-100">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ config()->get('app.name') ?? 'KHO 68' }}</title>
    <meta name="description" content="Hệ thống bán nguyên liệu ADS tự động, uy tín, giá rẻ..."/>
    <meta name="keywords" content="">
    <meta name="copyright" content="CMSNT.CO"/>
    <meta name="author" content="CMSNT.CO"/>
    <meta property="og:url" content="index.html">
    <meta property="og:site_name" content="index.html"/>
    <meta property="og:title" content="DEMO SHOPCLONE7"/>
    <meta property="og:type" content="website"/>
    <meta property="og:image"
          content="assets/storage/images/image_IYA.png"/>
    <meta property="og:image:secure"
          content="assets/storage/images/image_IYA.png"/>
    <meta name="twitter:title" content="DEMO SHOPCLONE7"/>
    <meta name="twitter:image"
          content="assets/storage/images/image_IYA.png"/>
    <meta name="twitter:image:alt" content="DEMO SHOPCLONE7"/>
    <link rel="icon" type="image/png" href="assets/storage/images/favicon_JEI.png"/>
    <style>
        :root {
            --primary: #cc0404;
            --primary1: #9c0404;
        }
    </style>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('client/fonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('client/fonts/icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/fonts/fontawesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/vendor/venobox/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/vendor/slickslider/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/vendor/niceselect/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/user-auth.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- sweetalert2 -->
    <link class="main-stylesheet" href="{{ asset('sweetalert2/default.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('sweetalert2/sweetalert2.js') }}"></script>

    <!-- Cute Alert -->
    <link class="main-stylesheet" href="{{ asset('cute-alert/style.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('cute-alert/cute-alert.js') }}"></script>

    <!-- Simple Notify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css"/>
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Flatpickr and Notyf -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Custom Styles and Scripts -->
    <link rel="stylesheet" href="{{ asset('mod/css/main3f56.css') }}">
    <script src="{{ asset('mod/js/main.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('client/css/wallet.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Product Details Stylesheet -->
    <link rel="stylesheet" href="{{ asset('client/css/product-details.css') }}">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{--     OWL Carousel --}}
    <link rel="stylesheet" href="{{ asset('client/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    @livewireStyles
</head>

<script>
    function showMessage(message, type) {
        const commonOptions = {
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 'outline',
            position: 'right top'
        };

        const options = {
            success: {
                status: 'success',
                title: 'Thành công!',
                text: message,
            },
            error: {
                status: 'error',
                title: 'Thất bại!',
                text: message,
            }
        };
        new Notify(Object.assign({}, commonOptions, options[type]));
    }

</script>

<style>
    body {
        font-family: 'Saira Semi Condensed', sans-serif;
    }

    html {
        scroll-behavior: smooth;
    }

    .feature-content {
        padding-left: 0px;
        border-left: none;
    }

    .product-disable::before {
        position: absolute;
        content: "Hết hàng";
        top: 89%;
        left: 50%;
        z-index: 2;
        width: 100%;
        font-size: 15px;
        font-weight: 400;
        padding: 0px;
        text-align: center;
        text-transform: uppercase;
        text-shadow: var(--primary-tshadow);
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: var(--white);
        background: rgba(224, 152, 22, 0.9);
    }
</style>


<body>
<div class="backdrop"></div>
<a class="backtop" href="#"><i class="fa-sharp fa-solid fa-chevron-up"></i></a>

{{--@include('livewire.partials._header-top')--}}
@include('livewire.partials._header')

{{--@yield('content')--}}

{{ $slot }}

{{--@include('livewire.partials._menu-right')--}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('toast-success', function (event) {
            toastr.success(event.message);
        });

        Livewire.on('toast-error', function (event) {
            toastr.error(event.message);
        });
    });

</script>

<script>
    function changeLanguage() {
        var id = document.getElementById("changeLanguage").value;
        $.ajax({
            url: "https://zshopclone7.cmsnt.net/ajaxs/client/update.php",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'changeLanguage',
                id: id
            },
            success: function (respone) {
                if (respone.status == 'success') {
                    location.reload();
                } else {
                    cuteAlert({
                        type: "error",
                        title: "Error",
                        message: respone.msg,
                        buttonText: "Okay"
                    });
                }
            },
            error: function () {
                alert(html(response));
                history.back();
            }
        });
    }
</script>
<script>
    function changeCurrency() {
        var id = document.getElementById("changeCurrency").value;
        $.ajax({
            url: "https://zshopclone7.cmsnt.net/ajaxs/client/update.php",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'changeCurrency',
                id: id
            },
            success: function (respone) {
                if (respone.status == 'success') {
                    location.reload();
                } else {
                    cuteAlert({
                        type: "error",
                        title: "Error",
                        message: respone.msg,
                        buttonText: "Okay"
                    });
                }
            },
            error: function () {
                alert(html(response));
                history.back();
            }
        });
    }
</script>


{{--@include('livewire.partials._footer')--}}
@livewire('partials.footer')

<!-- Vendor Scripts -->
<script src="{{ asset('client/vendor/bootstrap/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('client/vendor/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('client/vendor/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('client/vendor/countdown/countdown.min.js') }}"></script>
<script src="{{ asset('client/vendor/niceselect/nice-select.min.js') }}"></script>
<script src="{{ asset('client/vendor/slickslider/slick.min.js') }}"></script>
<script src="{{ asset('client/vendor/venobox/venobox.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom Scripts -->
<script src="{{ asset('client/js/nice-select.js') }}"></script>
<script src="{{ asset('client/js/countdown.js') }}"></script>
<script src="{{ asset('client/js/accordion.js') }}"></script>
<script src="{{ asset('client/js/venobox.js') }}"></script>
<script src="{{ asset('client/js/slick.js') }}"></script>
<script src="{{ asset('client/js/main.js') }}"></script>
<script src="{{ asset('client/owlcarousel/assets/owl.carousel.js') }}"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('bfb528bfe72756d0a69e', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('notification');

    const currentUserId = @json(Auth::id());

    channel.bind('test.notification', function (data) {
        if (data.user === currentUserId) {
            Swal.fire({
                icon: 'success',
                title: 'Thông báo mới',
                text: data.content || 'Bạn có một thông báo mới!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        }
    });
</script>

<script src="cdn.jsdelivr.net/npm/notyf%403/notyf.min.js"></script>

@livewireScripts
</body>
</html>
