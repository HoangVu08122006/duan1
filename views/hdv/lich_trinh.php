<link rel="stylesheet" href="hdv.css">

<style>
    .lich-trinh-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .section-title {
        font-size: 1.3em;
        font-weight: bold;
        color: #333;
        margin-top: 30px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 3px solid #0066cc;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title.completed {
        border-bottom-color: #6c757d;
    }

    .tour-section {
        margin-bottom: 40px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .tour-header {
        background: #0066cc;
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tour-header.completed {
        background: #6c757d;
    }

    .tour-header h4 {
        margin: 0;
        font-size: 1.2em;
    }

    .tour-link {
        background: white;
        color: #0066cc;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.9em;
        border: 1px solid white;
    }

    .tour-header.completed .tour-link {
        color: #6c757d;
    }

    .tour-link:hover {
        background: #f0f0f0;
    }

    .lich-trinh-table {
        width: 100%;
        border-collapse: collapse;
    }

    .lich-trinh-table th {
        background: #f5f5f5;
        padding: 12px;
        text-align: left;
        border-bottom: 2px solid #0066cc;
        font-weight: bold;
    }

    .lich-trinh-table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    .lich-trinh-table tbody tr:hover {
        background: #f9f9f9;
    }

    .no-lich-trinh {
        padding: 20px;
        text-align: center;
        background: #fff3cd;
        border: 1px solid #ffc107;
        color: #856404;
        border-radius: 4px;
    }

    .empty-section {
        padding: 20px;
        text-align: center;
        color: #999;
        font-style: italic;
    }
</style>

<div class="lich-trinh-container">
    <h2>📅 Lịch Trình Tour</h2>

    <!-- PHẦN TOUR SẮP DIỄN RA / ĐANG DIỄN RA -->
    <?php if (count($upcomingTours) > 0): ?>
        <div class="section-title">
            🚀 Tour Sắp Diễn Ra / Đang Diễn Ra
        </div>
        
        <?php foreach ($upcomingTours as $id_lich => $lichs): ?>
            <div class="tour-section">
                <div class="tour-header">
                    <div>
                        <h4><?= htmlspecialchars($lichs[0]['ten_tour'] ?? 'Tour') ?></h4>
                        <small style="opacity: 0.8;">
                            Khởi hành: <?= htmlspecialchars($lichs[0]['ngay_khoi_hanh']) ?> 
                            - Kết thúc: <?= htmlspecialchars($lichs[0]['ngay_ket_thuc']) ?>
                        </small>
                    </div>
                    <a href="index.php?act=hdv_tour_detail&id_lich=<?= $id_lich ?>" class="tour-link">
                        Xem Chi Tiết
                    </a>
                </div>
                <table class="lich-trinh-table">
                    <thead>
                        <tr>
                            <th>Ngày thứ</th>
                            <th>Tiêu đề</th>
                            <th>Hoạt động</th>
                            <th>Địa điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lichs as $lt): ?>
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
        <?php endforeach; ?>
    <?php else: ?>
        <div class="section-title">
            🚀 Tour Sắp Diễn Ra / Đang Diễn Ra
        </div>
        <div class="empty-section">
            Không có tour sắp diễn ra hoặc đang diễn ra
        </div>
    <?php endif; ?>

    <!-- PHẦN TOUR ĐÃ KẾT THÚC -->
    <?php if (count($completedTours) > 0): ?>
        <div class="section-title completed">
            ✅ Tour Đã Kết Thúc
        </div>
        
        <?php foreach ($completedTours as $id_lich => $lichs): ?>
            <div class="tour-section">
                <div class="tour-header completed">
                    <div>
                        <h4><?= htmlspecialchars($lichs[0]['ten_tour'] ?? 'Tour') ?></h4>
                        <small style="opacity: 0.9;">
                            Khởi hành: <?= htmlspecialchars($lichs[0]['ngay_khoi_hanh']) ?> 
                            - Kết thúc: <?= htmlspecialchars($lichs[0]['ngay_ket_thuc']) ?>
                        </small>
                    </div>
                    <a href="index.php?act=hdv_tour_detail&id_lich=<?= $id_lich ?>" class="tour-link">
                        Xem Chi Tiết
                    </a>
                </div>
                <table class="lich-trinh-table">
                    <thead>
                        <tr>
                            <th>Ngày thứ</th>
                            <th>Tiêu đề</th>
                            <th>Hoạt động</th>
                            <th>Địa điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lichs as $lt): ?>
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
        <?php endforeach; ?>
    <?php else: ?>
        <div class="section-title completed">
            ✅ Tour Đã Kết Thúc
        </div>
        <div class="empty-section">
            Không có tour đã kết thúc
        </div>
    <?php endif; ?>

    <?php if (count($upcomingTours) === 0 && count($completedTours) === 0): ?>
        <div class="no-lich-trinh">
            ⚠️ Chưa có lịch trình nào
        </div>
    <?php endif; ?>
</div>

