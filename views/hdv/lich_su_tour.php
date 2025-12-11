<link rel="stylesheet" href="hdv.css">

<style>
    .lich-su-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #0066cc;
        padding-bottom: 15px;
    }

    .header-section h2 {
        margin: 0;
        color: #0066cc;
    }

    .sort-controls {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .sort-controls select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.9em;
    }

    .sort-controls button {
        padding: 8px 15px;
        background: #0066cc;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9em;
    }

    .sort-controls button:hover {
        background: #0052a3;
    }

    .tour-history-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .tour-history-table thead {
        background: linear-gradient(135deg, #0066cc 0%, #004a94 100%);
        color: white;
    }

    .tour-history-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        border-bottom: 3px solid #0052a3;
    }

    .tour-history-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .tour-history-table tbody tr {
        transition: all 0.3s ease;
    }

    .tour-history-table tbody tr:hover {
        background: #f0f7ff;
        box-shadow: inset 0 0 10px rgba(0, 102, 204, 0.1);
    }

    .tour-name {
        font-weight: 600;
        color: #0066cc;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85em;
        font-weight: 500;
        text-align: center;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-ongoing {
        background: #cfe2ff;
        color: #084298;
    }

    .status-completed {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #842029;
    }

    .tour-date {
        color: #666;
        font-size: 0.95em;
    }

    .stat-box {
        display: inline-block;
        margin: 0 8px;
        padding: 4px 10px;
        background: #f5f5f5;
        border-radius: 4px;
        border-left: 3px solid #0066cc;
    }

    .stat-label {
        font-size: 0.8em;
        color: #999;
        text-transform: uppercase;
    }

    .stat-value {
        font-weight: bold;
        color: #0066cc;
        font-size: 1.1em;
    }

    .action-links {
        display: flex;
        gap: 8px;
    }

    .btn-detail {
        display: inline-block;
        padding: 6px 12px;
        background: #0066cc;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.85em;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-detail:hover {
        background: #0052a3;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        opacity: 0.3;
        margin-bottom: 20px;
    }

    .summary-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .summary-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-left: 4px solid #0066cc;
    }

    .summary-card h4 {
        margin: 0 0 10px 0;
        color: #999;
        font-size: 0.9em;
        text-transform: uppercase;
    }

    .summary-card .value {
        font-size: 2em;
        font-weight: bold;
        color: #0066cc;
    }
</style>

<div class="lich-su-container">
    <div class="header-section">
        <h2>📊 Lịch Sử Tour</h2>
        <div class="sort-controls">
            <label>Sắp xếp theo:</label>
            <select id="sortBy" onchange="updateSort()">
                <option value="ngay_khoi_hanh" <?= ($sort === 'ngay_khoi_hanh') ? 'selected' : '' ?>>Ngày khởi hành</option>
                <option value="ten_tour" <?= ($sort === 'ten_tour') ? 'selected' : '' ?>>Tên tour</option>
                <option value="gia_co_ban" <?= ($sort === 'gia_co_ban') ? 'selected' : '' ?>>Giá cơ bản</option>
                <option value="trang_thai_lich_khoi_hanh" <?= ($sort === 'trang_thai_lich_khoi_hanh') ? 'selected' : '' ?>>Trạng thái</option>
            </select>
            <button onclick="toggleOrder()">
                <?= ($order === 'DESC') ? '↓ Mới nhất' : '↑ Cũ nhất' ?>
            </button>
        </div>
    </div>

    <?php if (count($tourHistory) > 0): ?>
        <?php
        // Tính thống kê
        $totalTours = count($tourHistory);
        $totalBookings = array_sum(array_column($tourHistory, 'so_dat_tour'));
        $totalPassengers = array_sum(array_column($tourHistory, 'so_khach'));
        $completedTours = count(array_filter($tourHistory, function($t) {
            return $t['trang_thai_lich_khoi_hanh'] === 'Đã kết thúc' || $t['ngay_da_qua'] > 0;
        }));
        ?>

        <div class="summary-stats">
            <div class="summary-card">
                <h4>Tổng số tour</h4>
                <div class="value"><?= $totalTours ?></div>
            </div>
            <div class="summary-card">
                <h4>Đơn đặt tour</h4>
                <div class="value"><?= $totalBookings ?></div>
            </div>
            <div class="summary-card">
                <h4>Tổng khách hàng</h4>
                <div class="value"><?= $totalPassengers ?></div>
            </div>
            <div class="summary-card">
                <h4>Tour hoàn thành</h4>
                <div class="value"><?= $completedTours ?></div>
            </div>
        </div>

        <table class="tour-history-table">
            <thead>
                <tr>
                    <th>Tên Tour</th>
                    <th>Ngày Khởi Hành</th>
                    <th>Ngày Kết Thúc</th>
                    <th>Trạng Thái</th>
                    <th>Giá Cơ Bản</th>
                    <th>Tổng tiền</th>
                    <th>Khách</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($tourHistory as $tour): ?>
<tr>
    <td>
        <div class="tour-name"><?= htmlspecialchars($tour['ten_tour'] ?? '') ?></div>
        <small class="tour-date"><?= htmlspecialchars($tour['thoi_luong'] ?? '') ?></small>
    </td>
    <td>
        <div class="tour-date"><?= htmlspecialchars($tour['ngay_khoi_hanh'] ?? '') ?></div>
    </td>
    <td>
        <div class="tour-date"><?= htmlspecialchars($tour['ngay_ket_thuc'] ?? '') ?></div>
        <?php if (isset($tour['ngay_da_qua']) && $tour['ngay_da_qua'] >= 0): ?>
            <small style="color: #999;">(<?= $tour['ngay_da_qua'] ?> ngày trước)</small>
        <?php endif; ?>
    </td>
    <td>
        <?php
        $status = $tour['trang_thai_lich_khoi_hanh'] ?? '';
        $statusClass = 'status-pending';
        if ($status === 'Đang diễn ra') $statusClass = 'status-ongoing';
        elseif ($status === 'Đã kết thúc' || ($tour['ngay_da_qua'] ?? -1) >= 0) $statusClass = 'status-completed';
        elseif ($status === 'Hủy') $statusClass = 'status-cancelled';
        ?>
        <span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($status) ?></span>
    </td>
    <td>
        <strong><?= isset($tour['gia_co_ban']) ? number_format($tour['gia_co_ban'], 0, ',', '.') : 0 ?> VNĐ</strong>
    </td>
    <td>
        <?php 
            $tongTien = (isset($tour['gia_co_ban'], $tour['so_khach'])) 
                        ? $tour['gia_co_ban'] * $tour['so_khach'] 
                        : 0; 
        ?>
        <strong><?= number_format($tongTien, 0, ',', '.') ?> VNĐ</strong>
    </td>
    <td>
        <div class="stat-box">
            <div class="stat-label">Khách</div>
            <div class="stat-value"><?= $tour['so_khach'] ?? 0 ?></div>
        </div>
    </td>
    <td>
        <div class="action-links">
            <a href="index.php?act=hdv_tour_detail&id_tour=<?= $tour['id_tour'] ?? 0 ?>" class="btn-detail">
                Xem chi tiết
            </a>
        </div>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

        </table>

    <?php else: ?>
        <div class="empty-state">
            <p style="font-size: 5em; margin: 0;">📭</p>
            <h3>Chưa có tour nào</h3>
            <p>Bạn chưa được giao bất kỳ tour nào</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function updateSort() {
        const sort = document.getElementById('sortBy').value;
        const order = '<?= $order ?>';
        window.location.href = `index.php?act=hdv_lich_su_tour&sort=${sort}&order=${order}`;
    }

    function toggleOrder() {
        const sort = '<?= $sort ?>';
        const order = '<?= $order ?>';
        const newOrder = order === 'DESC' ? 'ASC' : 'DESC';
        window.location.href = `index.php?act=hdv_lich_su_tour&sort=${sort}&order=${newOrder}`;
    }
</script>
