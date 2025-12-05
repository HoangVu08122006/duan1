<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Lịch Khởi Hành</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/chiTiet.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            margin: 0;
        }
        h1 {
            text-align: center;
            color: #0d6efd;
            margin-bottom: 30px;
        }
        .info, .schedule {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .info p {
            margin: 8px 0;
            font-size: 16px;
        }
        .info strong {
            color: #333;
        }
        .actions {
            text-align: center;
            margin-top: 20px;
        }
        .actions button {
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .actions button:hover { opacity: 0.85; }
        .back { background: #6c757d; color: #fff; }
        .edit { background: #0d6efd; color: #fff; }
        .schedule h2 { margin-bottom: 15px; color: #198754; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th { background: #f1f1f1; }
    </style>
</head>
<body>
    <h1>Chi tiết Lịch Khởi Hành</h1>

    <?php if (empty($lich['ngay_khoi_hanh']) || empty($lich['ngay_ket_thuc'])): ?>
    <div class="info">
        <p><strong>Tour: </strong><?= htmlspecialchars($lich['ten_tour']) ?></p>
        <p><strong>Hướng dẫn viên chính: </strong><?= htmlspecialchars($lich['hdv_chinh']) ?></p>
        <?php if (!empty($lich['ngay_khoi_hanh'])): ?>
            <p><strong>Ngày khởi hành: </strong><?= date('d/m/Y', strtotime($lich['ngay_khoi_hanh'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($lich['ngay_ket_thuc'])): ?>
            <p><strong>Ngày kết thúc: </strong><?= date('d/m/Y', strtotime($lich['ngay_ket_thuc'])) ?></p>
        <?php endif; ?>
        <p><strong>Điểm khởi hành: </strong><?= htmlspecialchars($lich['dia_diem_khoi_hanh']) ?></p>
        <p><strong>Điểm đến: </strong><?= htmlspecialchars($lich['dia_diem_den']) ?></p>
        <p><strong>Phương tiện: </strong><?= htmlspecialchars($lich['thong_tin_xe']) ?></p>
        <p><strong>Khách sạn chính: </strong><?= htmlspecialchars($lich['ten_khach_san']) ?></p>
        <p><strong>Nhà hàng chính: </strong><?= htmlspecialchars($lich['ten_nha_hang']) ?></p>
        <p><strong>Ghi chú: </strong><?= htmlspecialchars($lich['ghi_chu']) ?></p>
        <p><strong>Trạng thái: </strong><?= htmlspecialchars($lich['trang_thai_lich_khoi_hanh']) ?></p>
    </div>
    <?php endif; ?>

    <?php if (!empty($lichTrinh)): ?>
    <div class="schedule">
        <h2>Lịch trình chi tiết</h2>
        <table>
            <thead>
                <tr>
                    <th>Ngày thứ</th>
                    <th>Tiêu đề</th>
                    <th>Hoạt động</th>
                    <th>Địa điểm</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lichTrinh as $lt): ?>
                <tr>
                    <td><?= htmlspecialchars($lt['ngay_thu']) ?></td>
                    <td><?= htmlspecialchars($lt['tieu_de']) ?></td>
                    <td><?= htmlspecialchars($lt['hoat_dong']) ?></td>
                    <td><?= htmlspecialchars($lt['dia_diem']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="actions">
        <button class="back" onclick="location.href='index.php?act=dieuHanhTour'">Quay lại</button>
        <button class="edit" onclick="location.href='index.php?act=dieuHanhTour&action=edit&id=<?= $lich['id_lich'] ?>'">Sửa</button>
    </div>

</body>
</html>
