<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Booking</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
     body {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100%;
      width: 100%;
    }

    * {
      box-sizing: border-box;
    }

    .container {
      width: 100%;
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px 30px;
    }

    .header {
      background: #ffffff;
      border-radius: 20px;
      padding: 35px 40px;
      margin-bottom: 30px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    h1 {
      margin: 0;
      font-size: 32px;
      font-weight: 700;
      color: #2d3748;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    h1 i {
      font-size: 36px;
      color: #667eea;
    }

    .add-new {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #ffffff;
      padding: 14px 28px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .add-new:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }

    .add-new i {
      font-size: 18px;
    }

    .table-container {
      background: #ffffff;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      min-width: 1000px;
    }

    th {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #ffffff;
      padding: 18px 16px;
      text-align: left;
      font-weight: 600;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      white-space: nowrap;
    }

    th:first-child {
      border-top-left-radius: 12px;
    }

    th:last-child {
      border-top-right-radius: 12px;
    }

    td {
      padding: 18px 16px;
      border-bottom: 1px solid #e2e8f0;
      color: #4a5568;
      font-size: 14px;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover {
      background: #f7fafc;
    }

    .status-badge {
      display: inline-block;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      text-transform: capitalize;
    }

    .status-pending {
      background: #fef3c7;
      color: #92400e;
    }

    .status-confirmed {
      background: #d1fae5;
      color: #065f46;
    }

    .status-cancelled {
      background: #fee2e2;
      color: #991b1b;
    }

    .actions {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .action-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 13px;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
    }

    .action-edit {
      background: #dbeafe;
      color: #1e40af;
    }

    .action-edit:hover {
      background: #bfdbfe;
      transform: translateY(-1px);
    }

    .action-view {
      background: #d1fae5;
      color: #065f46;
    }

    .action-view:hover {
      background: #a7f3d0;
      transform: translateY(-1px);
    }

    .action-delete {
      background: #fee2e2;
      color: #991b1b;
    }

    .action-delete:hover {
      background: #fecaca;
      transform: translateY(-1px);
    }

    .price {
      font-weight: 700;
      color: #667eea;
      font-size: 15px;
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #718096;
    }

    .empty-state i {
      font-size: 64px;
      color: #cbd5e0;
      margin-bottom: 20px;
    }

    .empty-state h3 {
      margin: 0 0 10px 0;
      font-size: 20px;
      color: #4a5568;
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px 15px;
      }

      .header {
        padding: 25px 20px;
      }

      h1 {
        font-size: 24px;
      }

      h1 i {
        font-size: 28px;
      }

      .table-container {
        padding: 20px 15px;
      }
    }

    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background: #ffffff;
      border-radius: 16px;
      padding: 30px;
      max-width: 400px;
      width: 90%;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-content h3 {
      margin: 0 0 15px 0;
      color: #2d3748;
      font-size: 20px;
    }

    .modal-content p {
      margin: 0 0 25px 0;
      color: #4a5568;
      line-height: 1.6;
    }

    .modal-actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
    }

    .modal-btn {
      padding: 10px 24px;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .modal-btn-cancel {
      background: #e2e8f0;
      color: #4a5568;
    }

    .modal-btn-cancel:hover {
      background: #cbd5e0;
    }

    .modal-btn-confirm {
      background: #ef4444;
      color: #ffffff;
    }

    .modal-btn-confirm:hover {
      background: #dc2626;
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
</head>

<body>
<header class="header">
    <h1><i class="bi bi-calendar-check"></i> <span id="pageTitle">Quản lý Booking</span></h1>
    <a href="index.php?act=booking&action=add" class="add-new" id="addButton"> <i class="bi bi-plus-circle"></i> 
    <span id="addButtonText">Thêm Booking mới</span> </a>
   </header>


  <table>
    <tr>
      <th class="bi bi-hash">ID</th>
      <th class="bi bi-map">Tên Tour</th>
      <th class="bi bi-calendar3">Lịch khởi hành</th>
      <th class="bi bi-people">Số lượng</th>
      <th class="bi bi-cash-coin">Tổng tiền</th>
      <th class="bi bi-person">Tên khách</th>
      <th class="bi bi-telephone">SĐT khách</th>
      <th class="bi bi-info-circle">Trạng thái</th>
      <th class="bi bi-gear">Thao tác</th>
    </tr>

    <?php foreach($bookings as $b): 
      $khachChinh = $b['khachList'][0] ?? null;
    ?>
    <tr>
      <td><?= $b['id_dat_tour'] ?></td>
      <td><?= htmlspecialchars($b['ten_tour'] ?? '') ?></td>
      <td><?= !empty($b['ngay_khoi_hanh']) ? date('d/m/Y', strtotime($b['ngay_khoi_hanh'])) : '' ?></td>
      <td><i class="bi bi-people-fill" style="margin-right: 5px; color: #667eea;"></i><?= $b['so_luong_khach'] ?></td>
      <td class="price"><?= number_format($b['tong_tien'] ?? 0) ?> đ</td>
      <td><?= htmlspecialchars($khachChinh['ho_ten'] ?? '-') ?></td>
      <td><?= htmlspecialchars($khachChinh['so_dien_thoai'] ?? '-') ?></td>
      <td><?= htmlspecialchars($b['trang_thai'] ?? '') ?></td>
      
        <td>
          <a class="action-btn action-edit" href="index.php?act=booking&action=edit&id=<?= $b['id_dat_tour'] ?>">
            <i class="bi bi-pencil-square"></i> Sửa
          </a>
          |
          <a class="action-btn action-view" href="index.php?act=booking&action=detail&id=<?= $b['id_dat_tour'] ?>">
            <i class="bi bi-eye-fill"></i> Xem
          </a>
          |
          <a class="action-btn action-delete" 
            href="index.php?act=booking&action=delete&id=<?= $b['id_dat_tour'] ?>" 
            onclick="return confirm('Bạn có chắc muốn xóa booking này?')">
            <i class="bi bi-trash-fill"></i> Xóa
          </a>
        </td>

      
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
