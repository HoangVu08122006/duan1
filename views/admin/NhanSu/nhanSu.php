<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Danh sách nhân sự</title>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
</head>
<body>

<h1>Danh sách nhân sự</h1>
<div class="search-box">
    <input type="text" id="searchInput" placeholder="Tìm theo tên hoặc SĐT...">
</div>
<button class="add-btn" onclick="location.href='index.php?act=addNhanSu'">Thêm HDV mới</button>

<table id="nhanSuTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>SĐT</th>
            <th>Chuyên môn</th>
            <th>Tình trạng</th>
            <th>Ghi chú</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($nhanSuList as $hdv): ?>
        <tr>
            <td data-label="ID"><?= $hdv['id_hdv'] ?></td>
            <td data-label="Avatar"><?php if($hdv['avatar']): ?><img src="<?= $hdv['avatar'] ?>" alt="Avatar"><?php endif; ?></td>
            <td data-label="Họ và tên"><?= $hdv['ho_ten'] ?></td>
            <td data-label="Giới tính"><?= $hdv['gioi_tinh'] ?></td>
            <td data-label="Ngày sinh"><?= $hdv['ngay_sinh'] ?></td>
            <td data-label="SĐT"><?= $hdv['so_dien_thoai'] ?></td>
            <td data-label="Chuyên môn"><?= $hdv['loai_hdv'] ?></td>
            <td data-label="Tình trạng"><?= $hdv['trang_thai_lam_viec_hdv'] ?></td>
            <td data-label="Ghi chú"><?= $hdv['mo_ta'] ?></td>
            <td data-label="Hành động">
                <button class="view" onclick="location.href='index.php?act=viewNhanSu&id=<?= $hdv['id_hdv'] ?>'">Chi tiết</button>
                <button class="edit" onclick="location.href='index.php?act=editNhanSu&id=<?= $hdv['id_hdv'] ?>'">Sửa</button>
                <button class="delete" onclick="return confirm('Bạn có chắc muốn xóa?') ? location.href='index.php?act=deleteNhanSu&id=<?= $hdv['id_hdv'] ?>' : false;">Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// Lọc bảng theo input
document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#nhanSuTable tbody tr');
    rows.forEach(row => {
        const name = row.querySelector('td[data-label="Họ và tên"]').textContent.toLowerCase();
        const phone = row.querySelector('td[data-label="SĐT"]').textContent.toLowerCase();
        if(name.includes(filter) || phone.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

</body>
</html>
