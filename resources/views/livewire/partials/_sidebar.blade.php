{{-- ============ DESKTOP ============ --}}
<div class="sidebar-pr desktop-only">
    <div class="filter-container">
        <!-- Input tìm kiếm theo tên -->
        <div class="filter-item">
            <label for="search" class="filter-label">Tìm kiếm sản phẩm:</label>
            <input type="text" id="search" wire:model.live="searchTerm"
                   placeholder="Nhập tên sản phẩm" class="filter-input"/>
        </div>
    </div>

    <div class="filter-container">
        <!-- Select lọc theo tên -->
        <div class="filter-item">
            <label for="category" class="filter-label">Bộ lọc:</label>
            <select id="category" wire:model="category" class="filter-input">
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
                <option value="low_to_high">Giá từ thấp tới cao</option>
                <option value="high_to_low">Giá từ cao tới thấp</option>
                <option value="best_selling">Sản phẩm bán chạy</option>
                <option value="newest">Sản phẩm mới nhất</option>
                <option value="promotion">Sản phẩm khuyến mãi</option>
            </select>
        </div>
    </div>

    <div class="filter-container">
        <!-- Select lọc theo khoảng giá -->
        <div class="filter-item">
            <label for="priceRange" class="filter-label">Chọn khoảng giá:</label>
            <div class="dual-range-container">
                <input type="range" id="priceRangeMin" class="filter-dual-range" min="0"
                       max="10000000" step="100000" wire:model.live="priceRangeMin">
                <input type="range" id="priceRangeMax" class="filter-dual-range" min="0"
                       max="10000000" step="100000" wire:model.live="priceRangeMax">
            </div>
            <div class="price-range-values">
                <span id="minPrice">Từ: {{ number_format($priceRangeMin) }} VND</span>
                <span id="maxPrice">Đến: {{ number_format($priceRangeMax) }} VND</span>
            </div>
        </div>
    </div>

    <div class="filter-container product-latest desktop-only">
        <!-- Hiển thị 5 sản phẩm mới nhất -->
        <div class="filter-item">
            <label class="filter-label">Sản phẩm mới nhất:</label>
            <div class="product-list">
                <?php
                    for ($i = 1; $i <= 5; $i++) {
                        $productName = 'Sản phẩm mới nhất demo show ' . $i;
                        $productPrice = 500000 * $i;
                        $productImage = 'http://localhost:8000/storage/Wordpress/01J86MJAZR7EX379HDK8ZYJPXP.webp';

                        echo '
                    <div class="product-item">
                        <img src="' . $productImage . '" alt="' . $productName . '" class="product-image">
                        <div class="product-info">
                            <h4 class="product-name">' . $productName . '</h4>
                            <p class="product-price">' . number_format($productPrice) . ' đ</p>
                        </div>
                    </div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>

{{-- ============ MOBILE ============ --}}
<!-- Nút mở bộ lọc trên mobile -->
<div class="mobile-filter-toggle mobile-only">
    <button id="toggleFilter" class="filter-toggle-button">Hiển thị tùy chọn</button>
</div>

<!-- Sidebar trên mobile, sẽ được ẩn và chỉ hiển thị khi nhấn nút -->
<div class="sidebar-pr mobile-only mobile-sidebar" id="mobileSidebar">
    <div class="filter-container">
        <!-- Input tìm kiếm theo tên -->
        <div class="filter-item">
            <label for="search" class="filter-label">Tìm kiếm sản phẩm:</label>
            <input type="text" id="search" wire:model.live="searchTerm"
                   placeholder="Nhập tên sản phẩm" class="filter-input"/>
        </div>
    </div>

    <div class="filter-container">
        <!-- Select lọc theo tên -->
        <div class="filter-item">
            <label for="category" class="filter-label">Bộ lọc:</label>
            <select id="category" wire:model="category" class="filter-input">
                <option value="az">A-Z</option>
                <option value="za">Z-A</option>
                <option value="low_to_high">Giá từ thấp tới cao</option>
                <option value="high_to_low">Giá từ cao tới thấp</option>
                <option value="best_selling">Sản phẩm bán chạy</option>
                <option value="newest">Sản phẩm mới nhất</option>
                <option value="promotion">Sản phẩm khuyến mãi</option>
            </select>
        </div>
    </div>

    <div class="filter-container">
        <!-- Select lọc theo khoảng giá -->
        <div class="filter-item">
            <label for="priceRange" class="filter-label">Chọn khoảng giá:</label>
            <div class="dual-range-container">
                <input type="range" id="priceRangeMin" class="filter-dual-range" min="0"
                       max="10000000" step="100000" wire:model.live="priceRangeMin">
                <input type="range" id="priceRangeMax" class="filter-dual-range" min="0"
                       max="10000000" step="100000" wire:model.live="priceRangeMax">
            </div>
            <div class="price-range-values">
                <span id="minPrice">Từ: {{ number_format($priceRangeMin) }} VND</span>
                <span id="maxPrice">Đến: {{ number_format($priceRangeMax) }} VND</span>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    /* Desktop styles */
    .desktop-only {
        display: block;
    }

    .mobile-only {
        display: none;
    }

    /* Mobile styles */
    @media screen and (max-width: 992px) {
        .desktop-only {
            display: none;
        }

        .mobile-only {
            display: block;
        }

        .mobile-sidebar {
            display: none;
        }

        .filter-toggle-button {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
    }

    .product-list {
        display: flex;
        flex-direction: column;
    }

    .product-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .product-image {
        width: 50px;
        height: 50px;
        border-radius: 5px;
        margin-right: 15px;
    }

    .product-info {
        /*flex: 1;*/
    }

    .product-name {
        font-size: 18px;
        color: #333;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 16px;
        color: var(--primary);
    }

    .filter-container {
        background-color: #f8f8f8;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 20px auto;
    }

    .filter-item {
        margin-bottom: 20px;
    }

    .filter-label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        display: block;
    }

    .filter-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .dual-range-container {
        position: relative;
        width: 100%;
        height: 30px;
        margin-top: 10px;
    }

    .filter-dual-range {
        position: absolute;
        width: 100%;
        height: 30px;
        background: transparent;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 2;
    }

    .filter-dual-range::-webkit-slider-thumb {
        pointer-events: auto;
        position: relative;
        z-index: 3;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background-color: var(--primary);
        cursor: pointer;
        -webkit-appearance: none;
    }

    .filter-dual-range::-moz-range-thumb {
        pointer-events: auto;
        position: relative;
        z-index: 3;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background-color: var(--primary);
        cursor: pointer;
    }

    .dual-range-container:before {
        content: '';
        position: absolute;
        height: 8px;
        background-color: #ddd;
        top: 50%;
        transform: translateY(-50%);
        left: 0;
        right: 0;
        z-index: 1;
        border-radius: 5px;
    }

    .dual-range-container:after {
        content: '';
        position: absolute;
        height: 8px;
        background-color: var(--primary);
        top: 50%;
        transform: translateY(-50%);
        left: calc( {{ ($priceRangeMin / 10000000) * 100 }}%);
        right: calc( {{ 100 - ($priceRangeMax / 10000000) * 100 }}%);
        z-index: 2;
        border-radius: 5px;
    }

    .price-range-values {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }
</style>
<script>
    document.getElementById('toggleFilter').addEventListener('click', function () {
        const sidebar = document.getElementById('mobileSidebar');
        sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });
</script>
