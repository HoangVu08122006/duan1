<h1>Sửa Booking</h1>

<form action="index.php?act=booking&action=edit&id=<?= $booking['id_dat_tour'] ?>" method="POST">
    <!-- Chọn Tour -->
    <div class="mb-3">
        <label for="id_tour">Tour:</label>
        <select name="id_tour" id="id_tour" class="form-control" required>
            <option value="">-- Chọn Tour --</option>
            <?php foreach($tours as $t): ?>
                <option 
                    value="<?= $t['id_tour'] ?>" 
                    data-gia="<?= $t['gia_co_ban'] ?>" 
                    <?= ($booking['id_tour'] == $t['id_tour']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t['ten_tour']) ?> 
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Ngày khởi hành -->
    <div class="mb-3">
        <label for="ngay_khoi_hanh">Ngày khởi hành:</label>
        <input type="date" name="ngay_khoi_hanh" id="ngay_khoi_hanh" class="form-control"
               value="<?= date('Y-m-d', strtotime($booking['ngay_khoi_hanh'])) ?>" required>
    </div>

    <!-- Ngày kết thúc -->
    <div class="mb-3">
        <label for="ngay_ket_thuc">Ngày kết thúc:</label>
        <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control"
               value="<?= date('Y-m-d', strtotime($booking['ngay_ket_thuc'])) ?>" required>
    </div>

    <!-- Giá cơ bản -->
    <div class="mb-3">
        <label for="gia_co_ban">Giá cơ bản (VNĐ/người):</label>
        <input type="number" name="gia_co_ban" id="gia_co_ban" class="form-control" min="0"
               value="<?= htmlspecialchars($booking['gia_co_ban']) ?>" required>
    </div>

    <!-- Nhà xe -->
    <div class="mb-3">
        <label for="id_nha_xe">Nhà xe:</label>
        <select name="id_nha_xe" id="id_nha_xe" class="form-control">
            <option value="">-- Chọn Nhà xe --</option>
            <?php foreach($nhaXeList as $nx): ?>
                <option value="<?= $nx['id_nha_xe'] ?>" <?= ($booking['id_nha_xe'] == $nx['id_nha_xe']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($nx['ten_nha_xe']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Số lượng khách -->
    <div class="mb-3">
        <label for="so_luong_khach">Số lượng khách:</label>
        <input type="number" name="so_luong_khach" id="so_luong_khach" class="form-control" min="1"
               value="<?= htmlspecialchars($booking['so_luong_khach']) ?>" required>
    </div>

    <?php $khachChinh = $booking['khachList'][0] ?? []; ?>
    <div class="mb-3">
        <label for="ho_ten">Tên khách đặt:</label>
        <input type="text" name="ho_ten" id="ho_ten" class="form-control"
               value="<?= htmlspecialchars($khachChinh['ho_ten'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control"
               value="<?= htmlspecialchars($khachChinh['so_dien_thoai'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label for="gioi_tinh">Giới tính:</label>
        <select name="gioi_tinh" id="gioi_tinh" class="form-control" required>
            <option value="Nam" <?= (($khachChinh['gioi_tinh'] ?? '') == 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= (($khachChinh['gioi_tinh'] ?? '') == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
        </select>
    </div>

    <!-- Tổng tiền -->
    <!-- Tổng tiền -->
<div class="mb-3">
    <label for="tong_tien">Tổng tiền:</label>
    <input type="number" name="tong_tien" id="tong_tien" class="form-control" min="0" step="1000"
           value="<?= htmlspecialchars($booking['tong_tien']) ?>" required>
    <small id="tong_tien_display" style="font-weight:600;color:#27ae60;"></small>
</div>


    <!-- Ngày đặt -->
    <div class="mb-3">
        <label for="ngay_dat">Ngày đặt:</label>
        <input type="date" name="ngay_dat" id="ngay_dat" class="form-control"
               value="<?= date('Y-m-d', strtotime($booking['ngay_dat'])) ?>" required>
    </div>

    <!-- Ghi chú -->
    <div class="mb-3">
        <label for="ghi_chu">Ghi chú:</label>
        <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="3"><?= htmlspecialchars($booking['ghi_chu'] ?? '') ?></textarea>
    </div>

    <!-- Trạng thái -->
    <div class="mb-3">
        <label for="trang_thai">Trạng thái:</label>
        <select name="trang_thai" id="trang_thai" class="form-control" required>
            <option value="Chưa thanh toán" <?= ($booking['trang_thai'] == 'Chưa thanh toán') ? 'selected' : '' ?>>Chưa thanh toán</option>
            <option value="Đã thanh toán" <?= ($booking['trang_thai'] == 'Đã thanh toán') ? 'selected' : '' ?>>Đã thanh toán</option>
            <option value="Hủy" <?= ($booking['trang_thai'] == 'Hủy') ? 'selected' : '' ?>>Hủy</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Cập nhật Booking</button>
    <a href="index.php?act=booking" class="btn btn-secondary">Quay lại</a>
</form>
<script>
const giaCoBanInput = document.getElementById('gia_co_ban');
const soLuongInput = document.getElementById('so_luong_khach');
const tongTienInput = document.getElementById('tong_tien');
const tongTienDisplay = document.getElementById('tong_tien_display');

function tinhTongTien() {
    const giaCoBan = parseFloat(giaCoBanInput.value || 0);
    const soLuong = parseInt(soLuongInput.value) || 0;
    const tongTien = giaCoBan * soLuong;

    // gán số thô vào input để submit
    tongTienInput.value = tongTien;

    // hiển thị đẹp ra ngoài
    tongTienDisplay.textContent = tongTien.toLocaleString('vi-VN') + ' VNĐ';
}

giaCoBanInput.addEventListener('input', tinhTongTien);
soLuongInput.addEventListener('input', tinhTongTien);

// chạy khi trang load
window.addEventListener('DOMContentLoaded', tinhTongTien);
</script>


<style>
/* ================== RESET & BASE ================== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 0;
    
    color: #2d3748;
}

/* ================== FORM CONTAINER ================== */
form {
    background: #ffffff;
    border-radius: 12px;
    padding: 30px;
    max-width: 700px;
    margin: 0 auto;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease;
}

/* ================== FORM GROUP ================== */
.mb-3 {
    margin-bottom: 20px;
}

label {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
    display: block;
}

/* ================== INPUT & SELECT ================== */
.form-control {
    width: 100%;
    padding: 12px 14px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fff;
    color: #2d3748;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    outline: none;
}

.form-control:hover {
    border-color: #cbd5e0;
}

/* ================== TEXTAREA ================== */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* ================== BUTTONS ================== */
.btn {
    border-radius: 8px;
    padding: 12px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
}

.btn-success {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    border: none;
    color: #fff;
}

.btn-success:hover {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    transform: translateY(-2px);
}

.btn-secondary {
    background: #e2e8f0;
    border: none;
    color: #4a5568;
}

.btn-secondary:hover {
    background: #cbd5e0;
    transform: translateY(-2px);
}

/* ================== ANIMATIONS ================== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ================== RESPONSIVE ================== */
@media (max-width: 600px) {
    form {
        padding: 20px;
        margin: 20px;
    }
}


</style>
