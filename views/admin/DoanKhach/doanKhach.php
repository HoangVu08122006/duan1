<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Điều hành tour</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: #f4f6f9;
      margin: 0;
      
      color: #333;
    }

    h1 {
      text-align: center;
      color: #00796b;
      font-size: 2rem;
      margin-bottom: 25px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Ô tìm kiếm */
    .search-container {
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
      font-size: 15px;
    }

    #searchInput:focus {
      border-color: #004d40;
      box-shadow: 0 0 8px rgba(0, 150, 136, 0.4);
    }

    /* Bảng */
    #tableDoanKhach {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      border-radius: 10px;
      overflow: hidden;
    }

    #tableDoanKhach th {
      background: linear-gradient(45deg, #009688, #26a69a);
      color: #fff;
      padding: 12px;
      text-align: center;
      font-weight: 600;
    }

    #tableDoanKhach td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    #tableDoanKhach tr:nth-child(even) {
      background: #f9f9f9;
    }

    #tableDoanKhach tr:hover {
      background: #e0f2f1;
      transition: 0.3s;
    }

    /* Link hành động */
    #tableDoanKhach td a {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 6px;
      background: #0288d1;
      color: #fff;
      text-decoration: none;
      font-size: 14px;
      transition: 0.3s;
    }

    #tableDoanKhach td a:hover {
      background: #01579b;
      transform: scale(1.05);
    }

    .btn-view i {
      margin-right: 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      #tableDoanKhach thead {
        display: none;
      }

      #tableDoanKhach, #tableDoanKhach tbody, #tableDoanKhach tr, #tableDoanKhach td {
        display: block;
        width: 100%;
      }

      #tableDoanKhach tr {
        margin-bottom: 15px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        padding: 10px;
      }

      #tableDoanKhach td {
        text-align: right;
        padding-left: 50%;
        position: relative;
      }

      #tableDoanKhach td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        text-align: left;
        font-weight: bold;
        color: #00796b;
      }
    }
  </style>
</head>
<body>

  <h1>Quản lý đoàn khách</h1>

  <!-- 🔍 SEARCH -->
  <div class="search-container">
    <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm...">
  </div>

  <table id="tableDoanKhach">
    <thead>
      <tr>
        <th><i class="fa fa-id-card"></i> ID</th>
        <th><i class="fa fa-map"></i> Tour</th>
        <th><i class="fa fa-user-tie"></i> Hướng dẫn viên</th>
        <th><i class="fa fa-calendar-alt"></i> Ngày khởi hành</th>
        <th><i class="fa fa-calendar-check"></i> Ngày kết thúc</th>
        <th><i class="fa fa-users"></i> Số khách</th>
        <th><i class="fa fa-coins"></i> Tổng tiền</th>
        <th><i class="fa fa-info-circle"></i> Trạng thái</th>
        <th><i class="fa fa-cogs"></i> Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $today = date('Y-m-d');
      foreach($list as $row): 
         if (strtotime($row['ngay_ket_thuc']) < strtotime($today)) {
    continue; // bỏ qua đoàn đã kết thúc
}

      ?>
      <tr>
        <td data-label="ID"><?= $row['id_dat_tour'] ?></td>
        <td data-label="Tour"><?= $row['ten_tour'] ?></td>
        <td data-label="Hướng dẫn viên"><?= $row['ten_hdv'] ?></td>
        <td data-label="Ngày khởi hành"><?= $row['ngay_khoi_hanh'] ?></td>
        <td data-label="Ngày kết thúc"><?= $row['ngay_ket_thuc'] ?></td>
        <td data-label="Số khách"><?= $row['so_luong_khach'] ?></td>
        <td data-label="Tổng tiền"><?= number_format($row['tong_tien']) ?> đ</td>
        <td data-label="Trạng thái"><?= $row['trang_thai'] ?></td>
        <td data-label="Hành động">
          <a href="index.php?act=doanKhach&action=view&id=<?= $row['id_dat_tour'] ?>" class="btn-view">
            <i class="fa fa-eye"></i> Xem
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll("#tableDoanKhach tbody tr").forEach((row) => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
      });
    });
  </script>

</body>
</html>
