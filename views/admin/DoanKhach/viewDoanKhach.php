<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đoàn khách</title>
</head>

<style>
body {
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
    margin: 0;
    color: #333;
}

.hh {
    text-align: center;
    font-size: 2rem;
    color: #00796b;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

p {
    font-size: 15px;
    margin: 6px 0;
}

.tong-tien {
    font-size: 16px;
    font-weight: bold;
    color: #d32f2f;
}

hr {
    margin: 20px 0;
    border: none;
    border-top: 2px dashed #ccc;
}

/* Tiêu đề danh sách khách */
h3 {
    color: #198754;
    margin-bottom: 15px;
    font-size: 1.4rem;
}

/* Ô tìm kiếm */
.search-box {
    text-align: center;
    margin-bottom: 20px;
}

#searchInput {
    width: 320px;
    padding: 10px 15px;
    border: 2px solid #009688;
    border-radius: 25px;
    outline: none;
    transition: 0.3s;
    font-size: 14px;
}

#searchInput:focus {
    border-color: #004d40;
    box-shadow: 0 0 8px rgba(0, 150, 136, 0.4);
}

/* Nút thêm khách */
.btn-add {
    display: inline-block;
    background: linear-gradient(45deg, #009688, #26a69a);
    color: #fff;
    padding: 8px 18px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.btn-add:hover {
    background: linear-gradient(45deg, #00796b, #004d40);
    transform: translateY(-2px);
}

/* Bảng danh sách khách */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
}

table th {
    background: linear-gradient(45deg, #009688, #26a69a);
    color: #fff;
    padding: 12px;
    text-align: center;
    font-weight: 600;
}

table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

table tr:nth-child(even) {
    background: #f9f9f9;
}

table tr:hover {
    background: #e0f2f1;
    transition: 0.3s;
}

/* Nút hành động */
.btn-edit, .btn-delete {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    margin: 0 4px;
    transition: 0.3s;
}

.btn-edit {
    background-color: #fbc02d;
    color: #333;
}

.btn-edit:hover {
    background-color: #f9a825;
    transform: scale(1.05);
}

.btn-delete {
    background-color: #e53935;
    color: #fff;
}

.btn-delete:hover {
    background-color: #b71c1c;
    transform: scale(1.05);
}

/* Nút quay lại */
.btn-back {
    display: inline-block;
    margin-top: 20px;
    background: #6c757d;
    color: #fff;
    padding: 8px 16px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.btn-back:hover {
    background: #495057;
    transform: translateY(-2px);
}

  
</style>


<body>

<h2 class="hh">Chi tiết đoàn khách #<?= $doan['id_dat_tour'] ?></h2>

<p><b>Tour:</b> <?= $doan['ten_tour'] ?></p>
<p><b>Hướng dẫn viên:</b> <?= $doan['ten_hdv'] ?></p>
<p><b>Ngày khởi hành:</b> <?= $doan['ngay_khoi_hanh'] ?></p>
<p><b>Ngày kết thúc:</b> <?= $doan['ngay_ket_thuc'] ?></p>
<p><b>Số khách: </b><strong>( <?= $soKhachThucTe ?> / <?= $doan['so_luong_khach'] ?> )</strong></p>
<p class="tong-tien"><b>Tổng tiền:</b> <?= number_format($tongTien) ?> đ</p>


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
        <td>
    <?= $k['ho_ten'] ?>
    <?php if (!empty($k['is_nguoi_dat']) && $k['is_nguoi_dat'] == 1): ?>
        <span style="color:#00796b; font-weight:bold;">(Người đặt)</span>
    <?php endif; ?>
</td>



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
<a href="index.php?act=doanKhach" class="btn-back">← Quay lại</a>




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
