<link rel="stylesheet" href="hdv.css">

<style>
    .danh-sach-khach-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .khach-section {
        margin-bottom: 30px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .khach-header {
        background: #0066cc;
        color: white;
        padding: 15px 20px;
        font-weight: bold;
    }

    .khach-table {
        width: 100%;
        border-collapse: collapse;
    }

    .khach-table th {
        background: #f5f5f5;
        padding: 12px;
        text-align: left;
        border-bottom: 2px solid #0066cc;
        font-weight: bold;
        font-size: 0.9em;
    }

    .khach-table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        font-size: 0.9em;
    }

    .khach-table tbody tr:hover {
        background: #f9f9f9;
    }

    .yeu-cau-badge {
        background: #fff3cd;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.85em;
        color: #856404;
    }

    .status-co-mat {
        background: #d4edda;
        color: #155724;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 0.85em;
    }

    .status-vang {
        background: #f8d7da;
        color: #721c24;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 0.85em;
    }

    .diem-danh-form {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .diem-danh-form select {
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.85em;
    }

    .diem-danh-form button {
        padding: 6px 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85em;
    }

    .diem-danh-form button:hover {
        background: #218838;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 20px;
        background: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .btn-back:hover {
        background: #5a6268;
    }

    .empty-message {
        padding: 20px;
        text-align: center;
        background: #fff3cd;
        border: 1px solid #ffc107;
        color: #856404;
        border-radius: 4px;
    }
</style>

<div class="danh-sach-khach-container">
    <a href="index.php?act=hdv_dashboard" class="btn-back">← Quay lại Dashboard</a>
    
    <h2>📋 Danh Sách Khách & Điểm Danh</h2>

    <?php if (!empty($khach)): ?>
        <?php
        // Nhóm khách theo lịch khởi hành
        $grouped = [];
        foreach ($khach as $k) {
            $id_lich = $k['id_lich'] ?? 'unknown';
            $id_dat = $k['id_dat_tour'] ?? 'unknown';
            
            if (!isset($grouped[$id_lich])) {
                $grouped[$id_lich] = [
                    'ngay_khoi_hanh' => $k['ngay_khoi_hanh'] ?? 'N/A',
                    'dat_tours' => []
                ];
            }
            
            if (!isset($grouped[$id_lich]['dat_tours'][$id_dat])) {
                $grouped[$id_lich]['dat_tours'][$id_dat] = [
                    'ngay_dat' => $k['ngay_dat'] ?? 'N/A',
                    'khachs' => []
                ];
            }
            
            $grouped[$id_lich]['dat_tours'][$id_dat]['khachs'][] = $k;
        }
        ?>

        <?php foreach ($grouped as $id_lich => $lich_data): ?>
            <div class="khach-section">
                <div class="khach-header">
                    📅 Lịch khởi hành: <?= htmlspecialchars($lich_data['ngay_khoi_hanh']) ?>
                </div>

                <?php foreach ($lich_data['dat_tours'] as $id_dat => $dat_data): ?>
                    <div style="background: #f0f0f0; padding: 12px 20px; border-top: 1px solid #ddd; font-weight: bold; font-size: 0.9em;">
                        Đơn đặt tour #<?= htmlspecialchars($id_dat) ?> - Ngày đặt: <?= htmlspecialchars($dat_data['ngay_dat']) ?>
                    </div>

                    <table class="khach-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ Tên</th>
                                <th>SĐT</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>CMND/CCCD</th>
                                <th>Yêu cầu đặc biệt</th>
                                <th>Trạng thái</th>
                                <th>Điểm danh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dat_data['khachs'] as $idx => $k): ?>
                            <tr>
                                <td><?= $idx + 1 ?></td>
                                <td><strong><?= htmlspecialchars($k['ho_ten']) ?></strong></td>
                                <td><?= htmlspecialchars($k['so_dien_thoai']) ?></td>
                                <td><?= htmlspecialchars($k['gioi_tinh']) ?></td>
                                <td><?= htmlspecialchars($k['ngay_sinh']) ?></td>
                                <td><?= htmlspecialchars($k['so_cmnd_cccd']) ?></td>
                                <td>
                                    <?php if (!empty($k['yeu_cau_dac_biet'])): ?>
                                        <span class="yeu-cau-badge">⚠️ <?= htmlspecialchars($k['yeu_cau_dac_biet']) ?></span>
                                    <?php else: ?>
                                        <small style="color: #999;">-</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                    $status = $k['trang_thai_khach'] ?? 'Chưa xác định';
                                    $status_class = (stripos($status, 'có mặt') !== false) ? 'status-co-mat' : 'status-vang';
                                    ?>
                                    <span class="<?= $status_class ?>"><?= htmlspecialchars($status) ?></span>
                                </td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <div class="diem-danh-form">
                                            <input type="hidden" name="id_khach" value="<?= $k['id_khach'] ?>">
                                            <input type="hidden" name="action" value="diem_danh">
                                            <select name="trang_thai" required>
                                                <option value="">-- Chọn --</option>
                                                <?php if (!empty($trangThaiList)): ?>
                                                    <?php foreach ($trangThaiList as $tt): ?>
                                                    <option value="<?= $tt['id_trang_thai_khach'] ?>" <?= ($k['id_trang_thai_khach'] == $tt['id_trang_thai_khach']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($tt['trang_thai_khach']) ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <button type="submit">Lưu</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="empty-message">
            ⚠️ Chưa có khách hàng nào trong danh sách
        </div>
    <?php endif; ?>
</div>
