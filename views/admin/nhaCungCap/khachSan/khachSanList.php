<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách sạn</title>
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
        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
        .btn-success:hover {
            background-color: #1e7e34;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover {
            background-color: #a71d2a;
        }

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

        form button:hover {
            background-color: #117a8b;
        }

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

        /* Chỉ áp dụng hover cho các dòng dữ liệu */
        table tbody tr:hover {
        background-color: #f1f1f1;
        }


        .btn-back {
    display: inline-block;
    padding: 10px 16px;
    background-color: #269affff; /* màu xám nhã nhặn */
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

.btn-back:hover {
    background-color: #1c5682ff; /* màu xám đậm khi hover */
}

    </style>
</head>
<body>
    <h1>Quản lý khách sạn</h1>

    <div class="actions">
        <a href="index.php?act=khachSan&action=add" class="btn btn-primary">➕ Thêm khách sạn</a>

        <form method="get" action="">
            <input type="hidden" name="act" value="khachSan">
            <input type="text" name="search" placeholder="🔍 Tìm theo tên..." 
                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khách sạn</th>
                <th>SĐT</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($khachSanList as $ks): ?>
            <tr>
                <td><?= $ks['id_khach_san'] ?></td>
                <td><?= htmlspecialchars($ks['ten_khach_san']) ?></td>
                <td><?= htmlspecialchars($ks['sdt_khach_san']) ?></td>
                <td><?= htmlspecialchars($ks['gia_khach_san']) ?></td>
                <td><?= htmlspecialchars($ks['mo_ta']) ?></td>
                <td>
                    <a href="index.php?act=khachSan&action=edit&id=<?= $ks['id_khach_san'] ?>" class="btn btn-success">✏️ Sửa</a>
                    <a href="index.php?act=khachSan&action=delete&id=<?= $ks['id_khach_san'] ?>" class="btn btn-danger" onclick="return confirm('Xóa khách sạn này?')">🗑️ Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?act=nhaCungCap" class="btn btn-back">⬅️ Quay lại</a>

</body>
</html>
