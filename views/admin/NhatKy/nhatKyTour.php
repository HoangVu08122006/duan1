<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
    <style>
        /* Reset cơ bản cho body */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2rem;
            letter-spacing: 1px;
        }

        /* CSS riêng cho bảng nhật ký */
        .nhat-ky-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .nhat-ky-table thead {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: #fff;
        }

        .nhat-ky-table thead th {
            padding: 12px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }

        .nhat-ky-table tbody td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .nhat-ky-table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .nhat-ky-table tbody tr:hover {
            background: #eaf6ff;
            transition: 0.3s;
        }

        /* Link hành động trong bảng */
        .nhat-ky-table a {
            display: inline-block;
            padding: 6px 12px;
            background: #e74c3c;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            transition: background 0.3s;
        }

        .nhat-ky-table a:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Nhật ký Tour</h1>

    <table class="nhat-ky-table" border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tour</th>
                <th>Ngày khởi hành</th>
                <th>HDV</th>
                <th>Ngày ghi</th>
                <th>Sự cố</th>
                <th>Phản hồi</th>
                <th>Nhận xét HDV</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($nhatKyList)) : ?>
                <?php foreach ($nhatKyList as $nk) : ?>
                    <tr>
                        <td><?= $nk['id_nhat_ky'] ?></td>
                        <td><?= $nk['ten_tour'] ?></td>
                        <td><?= $nk['ngay_khoi_hanh'] ?></td>
                        <td><?= $nk['ten_hdv'] ?></td>
                        <td><?= $nk['ngay_ghi'] ?></td>
                        <td><?= $nk['su_co'] ?></td>
                        <td><?= $nk['phan_hoi'] ?></td>
                        <td><?= $nk['nhan_xet_hdv'] ?></td>
                        <td>
                            <a href="index.php?act=nhatky&action=delete&id=<?= $nk['id_nhat_ky'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Chưa có nhật ký nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
