<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đoàn khách</title>
</head>

<style>
    /* ================== CHI TIẾT ĐOÀN KHÁCH ================== */
.admin-content {
    font-family: "Segoe UI", Arial, sans-serif;
    color: #334155;
    background-color: #f9fafb;
    padding: 20px;
}

/* Tiêu đề chính */
.admin-content h2 {
    color: #0f766e;
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Thông tin đoàn khách */
.admin-content p {
    font-size: 15px;
    margin: 6px 0;
}

/* Tổng tiền in đậm, màu đỏ */
.admin-content p.tong-tien {
    color: #dc2626;
    font-weight: 700;
}

/* Đường kẻ phân cách */
.admin-content hr {
    margin: 20px 0;
    border: none;
    border-top: 2px solid #0d9488;
}

/* Tiêu đề phụ */
.admin-content h3 {
    color: #0f766e;
    margin-bottom: 10px;
}

/* Ô tìm kiếm */
.admin-content .search-box {
    text-align: right;
    margin-bottom: 15px;
}

.admin-content .search-box input {
    padding: 8px 12px;
    width: 280px;
    font-size: 14px;
    border: 1px solid #0d9488;
    border-radius: 6px;
    outline: none;
    transition: all 0.3s ease;
}

.admin-content .search-box input:focus {
    border-color: #0f766e;
    box-shadow: 0 0 6px rgba(13, 148, 136, 0.3);
}

/* Nút thêm khách */
.admin-content .btn-add {
    display: inline-block;
    background: linear-gradient(135deg, #0f766e, #0d9488);
    color: #fff;
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.admin-content .btn-add:hover {
    background: linear-gradient(135deg, #0d9488, #0f766e);
    transform: translateY(-2px);
}

/* Bảng danh sách khách */
.admin-content table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.admin-content table th,
.admin-content table td {
    padding: 10px 12px;
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #e2e8f0;
}

.admin-content table th {
    background: linear-gradient(135deg, #0f766e, #0d9488);
    color: #fff;
    font-weight: 600;
}

.admin-content table tr:nth-child(even) {
    background-color: #f9fafb;
}

.admin-content table tr:hover {
    background-color: #ecfdf5;
    transition: 0.2s;
}

/* Nút hành động: Sửa và Xóa */
.admin-content .btn-edit,
.admin-content .btn-delete {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

/* Nút Sửa */
.admin-content .btn-edit {
    background-color: #22c55e;
}
.admin-content .btn-edit:hover {
    background-color: #16a34a;
}

/* Nút Xóa */
.admin-content .btn-delete {
    background-color: #ef4444;
}
.admin-content .btn-delete:hover {
    background-color: #dc2626;
}

/* Nút quay lại */
.admin-content a[href*="doanKhach"] {
    display: inline-block;
    margin-top: 20px;
    color: #0d9488;
    text-decoration: none;
    font-weight: 500;
}

.admin-content a[href*="doanKhach"]:hover {
    color: #0f766e;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-content {
        padding: 10px;
    }

    .admin-content .search-box input {
        width: 100%;
    }

    .admin-content table {
        font-size: 13px;
    }

    .admin-content .btn-add {
        display: block;
        text-align: center;
        margin-bottom: 10px;
    }
}
</style>

<body>

<h2>Chi tiết đoàn khách #<?= $doan['id_dat_tour'] ?></h2>

<p><b>Tour:</b> <?= $doan['ten_tour'] ?></p>
<p><b>Hướng dẫn viên:</b> <?= $doan['ten_hdv'] ?></p>
<p><b>Ngày khởi hành:</b> <?= $doan['ngay_khoi_hanh'] ?></p>
<p><b>Ngày kết thúc:</b> <?= $doan['ngay_ket_thuc'] ?></p>
<p><b>Số khách:</b> <?= $doan['so_luong_khach'] ?></p>
<p class="tong-tien"><b>Tổng tiền:</b> <?= number_format($doan['tong_tien']) ?> đ</p>

<hr>

<h3>Danh sách khách</h3>

<!-- Ô tìm kiếm -->
<div class="search-box">
    <input type="text" id="searchInput" placeholder="Tìm kiếm khách... (Tên, SĐT, Trạng thái)">
</div>

<!-- Nút thêm -->
<p>
<a class="btn-add" 
   href="index.php?act=doanKhach&action=addKhach&id=<?= $doan['id_dat_tour'] ?>">
   + Thêm khách mới
</a>

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
   <a class="btn-edit" 
   href="index.php?act=doanKhach&action=editKhach&id_khach=<?= $k['id_khach'] ?>&id_dat_tour=<?= $doan['id_dat_tour'] ?>">
   Sửa
</a>

<a class="btn-delete" 
   href="index.php?act=doanKhach&action=deleteKhach&id_khach=<?= $k['id_khach'] ?>&id_dat_tour=<?= $doan['id_dat_tour'] ?>" 
   onclick="return confirm('Xóa khách này?')">
   Xóa
</a>

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
