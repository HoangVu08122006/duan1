<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Booking</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f6f9;
      color: #333;
      margin: 0;
    }

    h1 {
      text-align: center;
      font-size: 36px;
      font-weight: 700;
      color: #0d6efd;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
      margin-bottom: 15px;
    }

    .add-new {
      display: inline-block;
      margin: 10px auto 30px auto;
      padding: 10px 25px;
      background-color: #0d6efd;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: all 0.3s;
    }

    .add-new:hover {
      background-color: #0b5ed7;
      transform: translateY(-2px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    table th, table td {
      padding: 12px 15px;
      text-align: left;
    }

    table th {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 500;
    }

    table tr {
      border-bottom: 1px solid #ddd;
      transition: background 0.3s;
    }

    table tr:last-child {
      border-bottom: none;
    }

    table tr:hover {
      background-color: rgba(13, 110, 253, 0.05);
    }

    table a {
      text-decoration: none;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 14px;
      margin-right: 5px;
      transition: all 0.3s;
    }

    table a[href*="edit"] { background-color: #ffc107; color: #212529; }
    table a[href*="edit"]:hover { background-color: #e0a800; color: #fff; }

    table a[href*="detail"] { background-color: #0d6efd; color: #fff; }
    table a[href*="detail"]:hover { background-color: #0b5ed7; }

    table a[href*="delete"] { background-color: #dc3545; color: #fff; }
    table a[href*="delete"]:hover { background-color: #bb2d3b; }

    @media (max-width: 768px) {
      table th, table td { padding: 10px; font-size: 14px; }
      .add-new { width: 100%; display: block; text-align: center; }
    }
  </style>
</head>
<body>
  <h1>Quản lý Booking</h1>
  <a href="index.php?act=booking&action=add" class="add-new">Thêm Booking mới</a>

  <table>
    <tr>
      <th>ID</th>
      <th>Tên Tour</th>
      <th>Lịch khởi hành</th>
      <th>Số lượng</th>
      <th>Tổng tiền</th>
      <th>Tên khách</th>
      <th>SĐT khách</th>
      <th>Trạng thái</th>
      <th>Thao tác</th>
    </tr>

    <?php foreach($bookings as $b): 
      $khachChinh = $b['khachList'][0] ?? null;
    ?>
    <tr>
      <td><?= $b['id_dat_tour'] ?></td>
      <td><?= htmlspecialchars($b['ten_tour'] ?? '') ?></td>
      <td><?= !empty($b['ngay_khoi_hanh']) ? date('d/m/Y', strtotime($b['ngay_khoi_hanh'])) : '' ?></td>
      <td><?= $b['so_luong_khach'] ?></td>
      <td><?= number_format($b['tong_tien'] ?? 0) ?> đ</td>
      <td><?= htmlspecialchars($khachChinh['ho_ten'] ?? '-') ?></td>
      <td><?= htmlspecialchars($khachChinh['so_dien_thoai'] ?? '-') ?></td>
      <td><?= htmlspecialchars($b['trang_thai'] ?? '') ?></td>
      <td>
        <a href="index.php?act=booking&action=edit&id=<?= $b['id_dat_tour'] ?>">Sửa</a>
        <a href="index.php?act=booking&action=detail&id=<?= $b['id_dat_tour'] ?>">Xem</a>
        <a href="index.php?act=booking&action=delete&id=<?= $b['id_dat_tour'] ?>" onclick="return confirm('Bạn có chắc?')">Xóa</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
