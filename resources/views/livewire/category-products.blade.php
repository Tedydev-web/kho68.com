<section class="section feature-part">
    <div class="container">
        <div class="mb-5"></div>

        {{-- Danh sách sản phẩm theo danh mục --}}
        <div class="row mb-5">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="home-heading mb-3" style="text-align: center">
                            <h3 style="justify-content: center">
                                Danh mục: <b>{{ $categoryName }}</b>
                            </h3>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-3">
                                @include('livewire.partials._sidebar')
                            </div>

                            <div class="col-12 col-md-12 col-lg-9">
                                <div class="sort-container">
                                    <label for="sort-by">Sắp xếp:</label>
                                    <select wire:model.live="sortBy" id="sort-by" class="form-control">
                                        <option value="">Mặc định</option>
                                        <option value="name_asc">A-Z</option>
                                        <option value="name_desc">Z-A</option>
                                        <option value="price_asc">Giá từ thấp tới cao</option>
                                        <option value="price_desc">Giá từ cao đến thấp</option>
                                    </select>
                                </div>

                                <style>
                                    .sort-container {
                                        display: flex;
                                        justify-content: flex-end;
                                        /* Căn về bên phải */
                                        align-items: center;
                                        /* Căn giữa theo chiều dọc */
                                        margin-bottom: 15px;
                                    }

                                    .sort-container label {
                                        margin-right: 10px;
                                        /* Khoảng cách giữa nhãn và select */
                                        font-weight: bold;
                                        font-size: 14px;
                                    }

                                    .sort-container select {
                                        width: auto;
                                        padding: 8px 16px;
                                        /* Tăng kích thước padding cho select */
                                        border-radius: 5px;
                                        /* Bo góc nhẹ */
                                        border: 1px solid #ced4da;
                                        /* Màu viền mềm mại */
                                        font-size: 14px;
                                        background-color: #f8f9fa;
                                        /* Màu nền nhẹ */
                                        transition: border-color 0.3s ease-in-out;
                                    }

                                    .sort-container select:focus {
                                        border-color: #80bdff;
                                        /* Thay đổi màu viền khi focus */
                                        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
                                        /* Hiệu ứng đổ bóng khi focus */
                                    }

                                    .sort-container select:hover {
                                        border-color: #343a40;
                                        /* Thay đổi màu viền khi hover */
                                    }

                                </style>

                                @include('livewire.sections._cate-product-social')

                                @include('livewire.sections._cate-product-courses')

                                @include('livewire.sections._cate-product-other')

                                @include('livewire.sections._cate-product-wordpress')

                                @include('livewire.sections._cate-product-childCate')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
