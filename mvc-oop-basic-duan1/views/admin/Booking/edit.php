<h1>Sửa Booking</h1>

<form action="index.php?act=booking&action=edit&id=<?= $booking['id_dat_tour'] ?>" method="POST">
    <div class="mb-3">
        <label for="id_tour">Tour:</label>
        <select name="id_tour" id="id_tour" class="form-control" required>
            <option value="">-- Chọn Tour --</option>
            <?php foreach($tours as $t): ?>
                <option value="<?= $t['id_tour'] ?>" 
                    <?= ($booking['id_tour'] == $t['id_tour']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t['ten_tour']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="id_lich">Lịch khởi hành:</label>
        <select name="id_lich" id="id_lich" class="form-control" required>
            <option value="">-- Chọn Lịch --</option>
            <?php foreach($lich as $l): ?>
                <option value="<?= $l['id_lich'] ?>" 
                    <?= ($booking['id_lich'] == $l['id_lich']) ? 'selected' : '' ?>>
                    <?= date('d/m/Y', strtotime($l['ngay_khoi_hanh'])) ?> - <?= date('d/m/Y', strtotime($l['ngay_ket_thuc'])) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="so_luong_khach">Số lượng khách:</label>
        <input type="number" name="so_luong_khach" id="so_luong_khach" class="form-control" min="1" 
            value="<?= htmlspecialchars($booking['so_luong_khach']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="tong_tien">Tổng tiền:</label>
        <input type="number" name="tong_tien" id="tong_tien" class="form-control" min="0" step="1000"
            value="<?= htmlspecialchars($booking['tong_tien']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="ngay_dat">Ngày đặt:</label>
        <input type="date" name="ngay_dat" id="ngay_dat" class="form-control" 
            value="<?= date('Y-m-d', strtotime($booking['ngay_dat'])) ?>" required>
    </div>

    <div class="mb-3">
        <label for="trang_thai">Trạng thái:</label>
        <select name="trang_thai" id="trang_thai" class="form-control">
            <option value="Chưa thanh toán" <?= ($booking['trang_thai']=='Chưa thanh toán')?'selected':'' ?>>Chưa thanh toán</option>
            <option value="Đã thanh toán" <?= ($booking['trang_thai']=='Đã thanh toán')?'selected':'' ?>>Đã thanh toán</option>
            <option value="Hủy" <?= ($booking['trang_thai']=='Hủy')?'selected':'' ?>>Hủy</option>
        </select>
    </div>

    <!-- <div class="mb-3">
        <label for="ghi_chu">Ghi chú:</label>
        <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="3"><?= htmlspecialchars($booking['ghi_chu'] ?? '') ?></textarea>
    </div> -->

    <button type="submit" class="btn btn-success">Cập nhật Booking</button>
    <a href="index.php?act=booking" class="btn btn-secondary">Hủy</a>
</form>

<style>
/* --- Bao toàn bộ form --- */
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
