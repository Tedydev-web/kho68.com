<div>
    <style>
        header, nav, footer {
            display: none;
        }

        iframe {
            width: 100%;
            height: 100vh;
        }

        .type-item {
            padding: 15px;
            cursor: pointer;
            font-weight: normal;
        }

        .type-item.current {
            font-weight: bold;
        }

        .iframe-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Chiều cao toàn màn hình */
        }

        /* Áp dụng transition để có hiệu ứng mượt */
        iframe {
            transition: all 0.5s ease;
        }
    </style>
    <div class="w-100 d-flex pt-3 pb-3"
         style="flex-direction: row; flex-wrap: nowrap; justify-content: space-evenly; align-items: center; background-color: var(--primary);">
        <a class="type-item current pd-15" data-type="desktop" style="color: #fff">
            <i class="fa fa-desktop fa-icon"></i>
            <b>Desktop</b>
        </a>
        <a class="type-item pd-15 fa-icon" data-type="tablet" style="color: #fff">
            <i class="fa fa-tablet fa-rotate-270"></i>
            <b>Tablet</b>
        </a>
        <a class="type-item pd-15 fa-icon" data-type="mobile" style="color: #fff">
            <i class="fa fa-mobile"></i>
            <b>Mobile</b>
        </a>
    </div>
    @if($product->demo)
        <div class="iframe-container">
            <iframe id="frame" src="{{ $product->demo }}"></iframe>
        </div>
    @else
        <p>Demo không có sẵn.</p>
    @endif
    <script>
        document.querySelectorAll('.type-item').forEach(function (item) {
            item.addEventListener('click', function () {
                // Loại bỏ class current khỏi tất cả các nút
                document.querySelectorAll('.type-item').forEach(function (btn) {
                    btn.classList.remove('current');
                });

                // Thêm class current cho nút được chọn
                this.classList.add('current');

                // Lấy kiểu thiết bị từ data-type
                const type = this.getAttribute('data-type');
                const iframe = document.getElementById('frame');

                // Cập nhật kích thước iframe tùy theo loại thiết bị
                switch (type) {
                    case 'desktop':
                        iframe.style.width = '100%';
                        iframe.style.height = '100vh';
                        break;
                    case 'tablet':
                        iframe.style.width = '768px'; // Kích thước tablet
                        iframe.style.height = '100vh';
                        break;
                    case 'mobile':
                        iframe.style.width = '375px'; // Kích thước mobile
                        iframe.style.height = '667px';
                        break;
                }
            });
        });
    </script>
</div>
