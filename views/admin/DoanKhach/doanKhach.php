<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Điều hành tour</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      color: #333;
    }

    h1 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    .search-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .search-container input {
      width: 300px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 25px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .search-container input:focus {
      border-color: #007bff;
      box-shadow: 0 0 6px rgba(0,123,255,0.4);
      outline: none;
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

    table a {
      display: inline-block;
      padding: 6px 12px;
      background-color: #17a2b8;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
      font-size: 13px;
      transition: background-color 0.3s ease;
    }

    table a:hover {
      background-color: #117a8b;
    }
  </style>
</head>
<body>

  <h1>Quản lý đoàn khách</h1>

  <!-- 🔍 SEARCH CĂN GIỮA -->
  <div class="search-container">
    <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm...">
  </div>

  <table id="tableDoanKhach">
    <tr>
      <th>ID</th>
      <th>Tour</th>
      <th>Hướng dẫn viên</th>
      <th>Ngày khởi hành</th>
      <th>Ngày kết thúc</th>
      <th>Số khách</th>
      <th>Tổng tiền</th>
      <th>Trạng thái</th>
      <th>Hành động</th>
    </tr>

    <?php foreach($list as $row): ?>
    <tr>
      <td><?= $row['id_dat_tour'] ?></td>
      <td><?= $row['ten_tour'] ?></td>
      <td><?= $row['ten_hdv'] ?></td>
      <td><?= $row['ngay_khoi_hanh'] ?></td>
      <td><?= $row['ngay_ket_thuc'] ?></td>
      <td><?= $row['so_luong_khach'] ?></td>
      <td><?= number_format($row['tong_tien']) ?> đ</td>
      <td><?= $row['trang_thai'] ?></td>
      <td>
        <a href="index.php?act=doanKhach&action=view&id=<?= $row['id_dat_tour'] ?>">Xem</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll("#tableDoanKhach tr").forEach((row, index) => {
        if (index === 0) return; // bỏ tiêu đề
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
      });
    });
  </script>

</body>
</html>
