<section class="section feature-part">
    <div class="container">

{{--         <div class="owl-carousel owl-theme mt-5" style="border-radius: 10px"> --}}
{{--             <div class="item" style="border-radius: 10px"> --}}
{{--                 <img style="border-radius: 10px" src="https://gamikey.com/wp-content/uploads/2024/07/Banner-Gemini-1-1024x512.jpg" alt="Slide 1" class="img-fluid"> --}}
{{--             </div> --}}
{{--             <div class="item" style="border-radius: 10px"> --}}
{{--                 <img style="border-radius: 10px" src="https://gamikey.com/wp-content/uploads/2023/04/Canva-1024x512.jpg.webp" alt="Slide 2" class="img-fluid"> --}}
{{--             </div> --}}
{{--             <div class="item" style="border-radius: 10px"> --}}
{{--                 <img style="border-radius: 10px" src="https://gamikey.com/wp-content/uploads/2024/05/Banner-Telegram-1024x512.jpg" alt="Slide 3" class="img-fluid"> --}}
{{--             </div> --}}
{{--         </div> --}}
        @livewire('partials.banner-slider')

        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true, // Lặp lại các slide
                    margin: 10, // Khoảng cách giữa các item
                    nav: true, // Hiển thị nút điều hướng
                    dots: true, // Hiển thị dấu chấm chỉ định slide
                    autoplay: true, // Tự động chạy slide
                    autoplayTimeout: 3000, // Thoi gian giờ chạy slide
                    autoplayHoverPause: true
                    , navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"]
                    , responsiveClass: true
                    , responsive: { // Thiết lập responsive cho các kích thước màn hình
                        0: {
                            items: 1, // 1 item hiển thị trên màn hình nhỏ
                            nav: false
                        }
                        , 600: {
                            items: 2, // 2 item hiển thị trên màn hình vừa
                            nav: false
                        }
                        , 1000: {
                            items: 3, // 3 item hiển thị trên màn hình lớn
                            nav: true
                        }
                    }
                });
            });

        </script>
        <style>
            /* Tùy chỉnh các mũi tên điều hướng */
            .owl-nav {
                position: absolute;
                top: 50%;
                width: 100%;
                display: flex;
                justify-content: space-between;
                transform: translateY(-50%);
            }

            .owl-nav button {
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 18px;
                cursor: pointer;
            }

            .owl-nav button:hover {
                background-color: rgba(0, 0, 0, 0.7);
            }

            Mũi tên ở màn hình nhỏ sẽ ẩn @media (max-width: 999px) {
                .owl-nav {
                    display: none;
                }
            }

        </style>

        <div class="row mb-5 mt-5">
            {{-- Wordpress bán chạy --}}
            @include('livewire.sections._home-popular-wordpress')

            {{-- Khóa học online --}}
            @include('livewire.sections._home-new-course')

            {{-- Clone Facebook --}}
            @include('livewire.sections._home-new-social')

        </div>
</section>
