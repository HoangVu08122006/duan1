<!-- views/hdv/nhatky.php -->
<link rel="stylesheet" href="hdv.css">
<h2>Nhật Ký Tour</h2>

<!-- Nút Thêm nhật ký mới -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tour</th> <!-- Hiển thị tên tour -->
            <th>Ngày ghi</th>
            <th>Sự cố</th>
            <th>Phản hồi</th>
            <th>Nhận xét HDV</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($nhatkyList)): ?>
            <?php  foreach($nhatkyList as $nk): ?>
                <tr>
                    <td><?= $nk['id_nhat_ky'] ?></td>
                    <td><?= $nk['ten_tour'] ?></td> <!-- sửa từ id_lich thành ten_tour -->
                    <td><?= $nk['ngay_ghi'] ?></td>
                    <td><?= htmlspecialchars($nk['su_co'] ?? 'Chưa có sự cố') ?></td>
                    <td><?= htmlspecialchars($nk['phan_hoi'] ?? 'Chưa có phản hồi') ?></td>
                    <td><?= htmlspecialchars($nk['nhan_xet_hdv'] ?? 'Chưa có nhận xét') ?></td>
                    <td>
                        <a href="index.php?act=nhatky_delete&id=<?= $nk['id_nhat_ky'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">Chưa có nhật ký nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
