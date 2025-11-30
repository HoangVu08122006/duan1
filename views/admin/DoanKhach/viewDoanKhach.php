<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đoàn khách</title>
</head>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    color: #333;
  }

  .hh h2 {
    text-align: center;
    
    color: #2c3e50;
  }

  h3 {
    margin-top: 30px;
    color: #007bff;
  }

  .tong-tien {
    font-size: 18px;
    color: #e74c3c;
    font-weight: bold;
  }

  .search-box {
    text-align: center;
    margin: 20px 0;
  }

  .search-box input {
    width: 300px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 25px;
    font-size: 14px;
    transition: all 0.3s ease;
  }

  .search-box input:focus {
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.4);
    outline: none;
  }

  .btn-add {
    display: inline-block;
    padding: 8px 14px;
    background-color: #28a745;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
  }

  .btn-add:hover {
    background-color: #1e7e34;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  table th {
    background-color: #007bff;
    color: #fff;
    padding: 12px;
    text-align: center;
    font-weight: 600;
  }

  table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
  }

  table tr:hover {
    background-color: #f1f9ff;
  }

  .btn-edit, .btn-delete {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    margin: 2px;
    transition: background-color 0.3s ease;
  }

  .btn-edit {
    background-color: #ffc107;
    color: #000;
  }
  .btn-edit:hover {
    background-color: #e0a800;
  }

  .btn-delete {
    background-color: #dc3545;
    color: #fff;
  }
  .btn-delete:hover {
    background-color: #a71d2a;
  }

 .btn-back {
  display: inline-block;
  padding: 10px 18px;
  background: linear-gradient(135deg, #6c757d, #495057);
  color: #fff;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-back:hover {
  background: linear-gradient(135deg, #5a6268, #343a40);
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  transform: translateY(-2px);
}


  
</style>


<body>

<h2 class="hh">Chi tiết đoàn khách #<?= $doan['id_dat_tour'] ?></h2>

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
