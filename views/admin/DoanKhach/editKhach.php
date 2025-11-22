<h2>Sửa khách</h2>

<form method="post" action="">
    <p>
        <label>Họ tên:</label><br>
        <input type="text" name="ho_ten" value="<?= htmlspecialchars($khach['ho_ten'] ?? '') ?>" required>
    </p>
    <p>
        <label>Giới tính:</label><br>
        <select name="gioi_tinh">
            <option value="Nam" <?= (isset($khach['gioi_tinh']) && $khach['gioi_tinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= (isset($khach['gioi_tinh']) && $khach['gioi_tinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
        </select>
    </p>
    <p>
        <label>Số điện thoại:</label><br>
        <input type="text" name="so_dien_thoai" value="<?= htmlspecialchars($khach['so_dien_thoai'] ?? '') ?>">
    </p>
    <p>
        <label>Ngày sinh:</label><br>
        <input type="date" name="ngay_sinh" value="<?= $khach['ngay_sinh'] ?? '' ?>">
    </p>
    <p>
        <label>CCCD/CMND:</label><br>
        <input type="text" name="so_cmnd_cccd" value="<?= htmlspecialchars($khach['so_cmnd_cccd'] ?? '') ?>">
    </p>
    <p>
        <label>Trạng thái khách:</label><br>
        <select name="id_trang_thai_khach" required>
            <?php foreach($trangThaiList as $tt): ?>
                <option value="<?= $tt['id_trang_thai_khach'] ?>"
                    <?= (isset($khach['id_trang_thai_khach']) && $khach['id_trang_thai_khach'] == $tt['id_trang_thai_khach']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($tt['trang_thai_khach']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>Ghi chú:</label><br>
        <input type="text" name="ghi_chu" value="<?= htmlspecialchars($khach['ghi_chu'] ?? '') ?>">
    </p>
    <button type="submit">Cập nhật</button>
</form>

<br>
<a href="index.php?act=viewDoanKhach&id=<?= $khach['id_dat_tour'] ?? 0 ?>">← Quay lại đoàn</a>
