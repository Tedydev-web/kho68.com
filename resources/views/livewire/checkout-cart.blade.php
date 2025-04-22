<div>
    <h1>Trang Thanh Toán</h1>

    <form>
        <!-- Thông tin người mua -->
        <div>
            <label for="name">Họ và Tên</label>
            <input type="text" id="name">

        </div>

        <div>
            <label for="address">Địa chỉ</label>
            <input type="text" id="address">

        </div>

        <div>
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone">

        </div>

        <!-- Chọn phương thức thanh toán -->
        <div>
            <label for="payment_method">Phương thức thanh toán</label>
            <select id="payment_method">
                <option value="">Chọn phương thức</option>
                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="online">Thanh toán online</option>
            </select>
        </div>

        <table>
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>Name</td>
                <td>12</td>
                <td>1431434đ</td>
            </tr>

            </tbody>
        </table>

        <h2>Tổng: 324324234đ</h2>

        <button type="submit">Thanh Toán</button>

    </form>
</div>
