<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Lịch Khởi Hành</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #0d6efd;
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 700;
        }

        .info, .schedule {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px 20px;
            font-size: 15px;
        }

        .info-grid div {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .info-grid strong {
            color: #0d6efd;
        }

        .schedule h2 {
            margin-bottom: 15px;
            color: #198754;
            font-size: 1.4rem;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background: #0d6efd;
            color: #fff;
            font-weight: 600;
        }

        table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions button {
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            margin: 0 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
        }

        .actions button:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }

        .back { background: #6c757d; color: #fff; }
        .edit { background: #0d6efd; color: #fff; }
    </style>
</head>
<body>

    <h1>Chi tiết Lịch Khởi Hành</h1>

    <div class="info">
        <div class="info-grid">
            <div><strong>Tour:</strong> <?= htmlspecialchars($lich['ten_tour']) ?></div>

            <div><strong>HDV chính:</strong> 
                <?= !empty($lich['hdv_chinh']) ? htmlspecialchars($lich['hdv_chinh']) : "Chưa phân công" ?>
            </div>

            <div><strong>Ngày khởi hành:</strong> 
                <?= date('d/m/Y', strtotime($lich['ngay_khoi_hanh'])) ?>
            </div>

            <div><strong>Ngày kết thúc:</strong> 
                <?= date('d/m/Y', strtotime($lich['ngay_ket_thuc'])) ?>
            </div>

            <div><strong>Điểm khởi hành:</strong> 
                <?= htmlspecialchars($lich['dia_diem_khoi_hanh']) ?>
            </div>

            <div><strong>Điểm đến:</strong> 
                <?= htmlspecialchars($lich['dia_diem_den']) ?>
            </div>

            <div><strong>Xe sử dụng:</strong> 
    <?= htmlspecialchars($lich['nha_xe'] ?? 'Chưa chọn xe') ?>
</div>



            <div><strong>Khách sạn:</strong> 
                <?= htmlspecialchars($lich['ten_khach_san'] ?? 'Không có dữ liệu') ?>
            </div>

            <div><strong>Nhà hàng:</strong> 
                <?= htmlspecialchars($lich['ten_nha_hang'] ?? 'Không có dữ liệu') ?>
            </div>

            <div><strong>Ghi chú:</strong> 
                <?= htmlspecialchars($lich['ghi_chu']) ?>
            </div>

            <div><strong>Trạng thái:</strong> 
                <?= htmlspecialchars($lich['trang_thai_lich_khoi_hanh']) ?>
            </div>
        </div>
    </div>

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
