<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đoàn khách</title>
</head>

<style>
/* Tổng thể */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
}

h2, h3 {
    color: #1e3562;
}

/* Thông tin đoàn */
p {
    margin: 5px 0;
    font-size: 14px;
}

/* Nút thêm khách */
.btn-add {
    display: inline-block;
    background-color: #1e3562;
    color: white !important;
    padding: 8px 14px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.3s;
}

.btn-add:hover {
    background-color: #0d1f45;
}

/* Ô tìm kiếm */
.search-box {
    margin: 10px 0 15px 0;
    text-align: right;
}

.search-box input {
    padding: 8px 12px;
    width: 250px;
    font-size: 14px;
    border: 1px solid #1e3562;
    border-radius: 6px;
    outline: none;
    transition: 0.3s;
}

.search-box input:focus {
    border-color: #0d1f45;
    box-shadow: 0 0 4px rgba(30, 53, 98, 0.4);
}

/* Bảng */
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 10px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    font-size: 14px;
}

table th {
    background-color: #1e3562;
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f1f1f1;
}

table tr:hover {
    background-color: #e0e0e0;
}

/* Hành động sửa/xóa */
table td a {
    padding: 4px 8px;
    border: 1px solid #1e3562;
    border-radius: 5px;
    font-size: 12px;
    margin: 0 2px;
    transition: 0.3s;
}

table td a:hover {
    background-color: #1e3562;
    color: white;
}

</style>

<body>

<h2>Chi tiết đoàn khách #<?= $doan['id_dat_tour'] ?></h2>

<p><b>Tour:</b> <?= $doan['ten_tour'] ?></p>
<p><b>Hướng dẫn viên:</b> <?= $doan['ten_hdv'] ?></p>
<p><b>Ngày khởi hành:</b> <?= $doan['ngay_khoi_hanh'] ?></p>
<p><b>Ngày kết thúc:</b> <?= $doan['ngay_ket_thuc'] ?></p>
<p><b>Số khách:</b> <?= $doan['so_luong_khach'] ?></p>
<p><b>Tổng tiền:</b> <?= number_format($doan['tong_tien']) ?> đ</p>

<hr>

<h3>Danh sách khách</h3>

<!-- Ô tìm kiếm -->
<div class="search-box">
    <input type="text" id="searchInput" placeholder="Tìm kiếm khách... (Tên, SĐT, Trạng thái)">
</div>

<!-- Nút thêm -->
<p>
    <a class="btn-add" href="index.php?act=addKhach&id=<?= $doan['id_dat_tour'] ?>">+ Thêm khách mới</a>
</p>

<table>
    <tr>
        <th>Họ tên</th>
        <th>Giới tính</th>
        <th>SĐT</th>
        <th>Ngày sinh</th>
        <th>CCCD/CMND</th>
        <th>Trạng thái</th>
        <th>Ghi chú</th>
        <th>Hành động</th>
    </tr>

    <?php foreach($khachList as $k): ?>
    <tr>
        <td><?= $k['ho_ten'] ?></td>
        <td><?= $k['gioi_tinh'] ?></td>
        <td><?= $k['so_dien_thoai'] ?></td>
        <td><?= $k['ngay_sinh'] ?></td>
        <td><?= $k['so_cmnd_cccd'] ?></td>
        <td><?= $k['trang_thai_khach'] ?></td>
        <td><?= $k['ghi_chu'] ?></td>
        <td>
            <a href="index.php?act=editKhach&id_khach=<?= $k['id_khach'] ?>&id_dat_tour=<?= $doan['id_dat_tour'] ?>">Sửa</a> |
            <a href="index.php?act=deleteKhach&id_khach=<?= $k['id_khach'] ?>&id_dat_tour=<?= $doan['id_dat_tour'] ?>" onclick="return confirm('Xóa khách này?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="index.php?act=doanKhach">← Quay lại</a>

<!-- Script lọc bảng -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("table tr");

    rows.forEach((row, index) => {
        if (index === 0) return; // Bỏ qua tiêu đề
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(value) ? "" : "none";
    });
});
</script>

</body>
</html>
