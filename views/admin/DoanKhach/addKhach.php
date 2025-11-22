<h2>Thêm khách cho đoàn #<?= $_GET['id'] ?></h2>

<form method="post" action="">
    <p>
        <label>Họ tên:</label><br>
        <input type="text" name="ho_ten" required>
    </p>
    <p>
        <label>Giới tính:</label><br>
        <select name="gioi_tinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </p>
    <p>
        <label>Số điện thoại:</label><br>
        <input type="text" name="so_dien_thoai">
    </p>
    <p>
        <label>Ngày sinh:</label><br>
        <input type="date" name="ngay_sinh">
    </p>
    <p>
        <label>CCCD/CMND:</label><br>
        <input type="text" name="so_cmnd_cccd">
    </p>
    <p>
        <label>Trạng thái khách:</label><br>
        <select name="id_trang_thai_khach" required>
            <?php foreach($trangThaiList as $tt): ?>
                <option value="<?= $tt['id_trang_thai_khach'] ?>"><?= htmlspecialchars($tt['trang_thai_khach']) ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label>Ghi chú:</label><br>
        <input type="text" name="ghi_chu">
    </p>
    <button type="submit">Thêm khách</button>
</form>

<br>
<a href="index.php?act=viewDoanKhach&id=<?= $_GET['id'] ?>">← Quay lại đoàn</a>
