<link rel="stylesheet" href="hdv.css">
<h2>Điểm Danh Khách</h2>
<table>
    <thead>
        <tr>
            <th>ID Khách</th>
            <th>Họ tên</th>
            <th>SĐT</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Trạng thái</th>
            <th>Điểm danh</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($khach)): ?>
            <?php foreach ($khach as $k): ?>
            <tr>
                <td><?= htmlspecialchars($k['id_khach']) ?></td>
                <td><?= htmlspecialchars($k['ho_ten']) ?></td>
                <td><?= htmlspecialchars($k['so_dien_thoai']) ?></td>
                <td><?= htmlspecialchars($k['gioi_tinh']) ?></td>
                <td><?= htmlspecialchars($k['ngay_sinh']) ?></td>
                <td><?= htmlspecialchars($k['trang_thai_khach'] ?? 'Chưa điểm danh') ?></td>
                <td>
                    <form method="post" action="index.php?act=hdv_diem_danh" class="diem-danh-form">
                        <input type="hidden" name="id_khach" value="<?= $k['id_khach'] ?>">
                        <button type="submit" name="trang_thai" value="1" class="btn green">Có mặt</button>
                        <button type="submit" name="trang_thai" value="2" class="btn red">Vắng mặt</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">Không có khách nào.</td></tr>
        <?php endif; ?>
    </tbody>
    <style>
.diem-danh-form {
    display: flex;
    gap: 10px;
}

.diem-danh-form .btn {
    padding: 6px 14px;
    border: none;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

/* Nút xanh lá cho Có mặt */
.diem-danh-form .btn.green {
    background-color: #28a745;
}

.diem-danh-form .btn.green:hover {
    background-color: #218838;
}

/* Nút đỏ cho Vắng mặt */
.diem-danh-form .btn.red {
    background-color: #dc3545;
}

.diem-danh-form .btn.red:hover {
    background-color: #c82333;
}
</style>

</table>


