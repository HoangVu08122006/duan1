<h1>Thêm Booking mới</h1>

<form action="index.php?act=booking&action=add" method="POST">
    <!-- Chọn Tour -->
    <div class="mb-3">
        <label for="id_tour">Tour:</label>
        <select name="id_tour" id="id_tour" class="form-control" required>
            <option value="">-- Chọn Tour --</option>
            <?php foreach($tours as $t): ?>
                <option 
                    value="<?= $t['id_tour'] ?>" 
                    data-gia="<?= $t['gia_co_ban'] ?>">
                    <?= htmlspecialchars($t['ten_tour']) ?> 
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Ngày khởi hành -->
    <div class="mb-3">
        <label for="ngay_khoi_hanh">Ngày khởi hành:</label>
        <input type="date" name="ngay_khoi_hanh" id="ngay_khoi_hanh" class="form-control" required>
    </div>

    <!-- Ngày kết thúc -->
    <div class="mb-3">
        <label for="ngay_ket_thuc">Ngày kết thúc:</label>
        <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control" required>
    </div>

    <!-- Giá cơ bản -->
    <div class="mb-3">
    <label for="gia_co_ban">Giá cơ bản (VNĐ):</label>
    <input type="number" name="gia_co_ban" id="gia_co_ban" class="form-control" min="0" required>
</div>


    <!-- Số lượng khách -->
    <div class="mb-3">
        <label for="so_luong_khach">Số lượng khách:</label>
        <input type="number" name="so_luong_khach" id="so_luong_khach" class="form-control" min="1" required>
    </div>

    <!-- Tổng tiền -->
    <div class="mb-3">
        <label for="tong_tien">Tổng tiền:</label>
        <input type="text" id="tong_tien" name="tong_tien" class="form-control" readonly>
    </div>

    <!-- Thông tin khách -->
    <div class="mb-3">
        <label for="ho_ten">Tên khách đặt:</label>
        <input type="text" name="ho_ten" id="ho_ten" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3">
        <label for="gioi_tinh">Giới tính:</label>
        <select name="gioi_tinh" id="gioi_tinh" class="form-control" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="ghi_chu">Ghi chú:</label>
        <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Thêm Booking</button>
    <a href="index.php?act=booking" class="btn btn-secondary">Quay lại</a>
</form>



<script>
const giaCoBanInput = document.getElementById('gia_co_ban');
const soLuongInput = document.getElementById('so_luong_khach');
const tongTienInput = document.getElementById('tong_tien');

function tinhTongTien() {
    const giaCoBan = parseFloat(giaCoBanInput.value || 0);
    const soLuong = parseInt(soLuongInput.value) || 0;
    const tongTien = giaCoBan * soLuong;
    tongTienInput.value = tongTien.toLocaleString('vi-VN') + ' VNĐ';
}

giaCoBanInput.addEventListener('input', tinhTongTien);
soLuongInput.addEventListener('input', tinhTongTien);



</script>





<style>
form {
    max-width: 700px;
    margin: 40px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #0d6efd;
    font-weight: 600;
}

form label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #333;
}

form input,
form select,
form textarea {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 10px 12px;
    transition: all 0.3s;
}

form input:focus,
form select:focus,
form textarea:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px rgba(13,110,253,0.2);
    outline: none;
}

form button,
form a.btn {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s;
}

form button.btn-success:hover {
    background-color: #198754;
}

form a.btn-secondary:hover {
    background-color: #6c757d;
    color: #fff;
}

.mb-3 {
    margin-bottom: 20px !important;
}

@media (max-width: 768px) {
    form {
        padding: 20px;
        margin: 20px;
    }
}
</style>
