<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý nhà hàng</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      color: #333;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-block;
      padding: 10px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
    }
    .btn-primary:hover { background-color: #0056b3; }

    .btn-success {
      background-color: #28a745;
      color: #fff;
    }
    .btn-success:hover { background-color: #1e7e34; }

    .btn-danger {
      background-color: #dc3545;
      color: #fff;
    }
    .btn-danger:hover { background-color: #a71d2a; }

    .btn-back {
      background-color: #269affff;
      color: #fff;
      margin-top: 20px;
    }
    .btn-back:hover { background-color: #1c5682ff; }

    form input[type="text"] {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      width: 200px;
    }

    form button {
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      background-color: #17a2b8;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    form button:hover { background-color: #117a8b; }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    table thead {
      background-color: #007bff;
      color: #fff;
    }

    table th, table td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    table tbody tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>
  <h1>Quản lý nhà hàng</h1>

  <div class="actions">
    <a href="index.php?act=nhaHang&action=add" class="btn btn-primary">➕ Thêm nhà hàng</a>

    <form method="get" action="">
      <input type="hidden" name="act" value="nhaHang">
      <input type="text" name="search" placeholder="🔍 Tìm theo tên..." 
             value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
      <button type="submit">Tìm kiếm</button>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên nhà hàng</th>
        <th>Mô tả</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($nhaHangList as $nh): ?>
      <tr>
        <td><?= $nh['id_nha_hang'] ?></td>
        <td><?= htmlspecialchars($nh['ten_nha_hang']) ?></td>
        <td><?= htmlspecialchars($nh['mo_ta']) ?></td>
        <td>
          <a href="index.php?act=nhaHang&action=edit&id=<?= $nh['id_nha_hang'] ?>" class="btn btn-success">✏️ Sửa</a>
          <a href="index.php?act=nhaHang&action=delete&id=<?= $nh['id_nha_hang'] ?>" class="btn btn-danger" onclick="return confirm('Xóa nhà hàng này?')">🗑️ Xóa</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="index.php?act=nhaCungCap" class="btn btn-back">⬅️ Quay lại</a>
</body>
</html>
