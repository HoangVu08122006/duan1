<div class="container-fluid px-4" style="max-width: 1200px; margin: 40px auto;">
    <h3 class="page-title mb-4">Chi tiết Booking</h3>

    <div class="row g-4">

        <!-- Thông tin Booking -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm p-4 h-100">
                <h2 class="card-title-section">Thông tin Booking</h2>
                <p><strong>Số lượng khách:</strong> <?= $booking['so_luong_khach'] ?? '-' ?></p>
                <p><strong>Tổng tiền:</strong> <?= number_format($booking['tong_tien'] ?? 0, 0, ',', '.') ?> VNĐ</p>
                <p><strong>Ngày đặt:</strong> <?= $booking['ngay_dat'] ?? '-' ?></p>
                <p><strong>Trạng thái:</strong> 
                    <?php
                        $status = $booking['trang_thai'] ?? '-';
                        $badgeClass = match($status) {
                            'Chưa thanh toán' => 'badge-warning',
                            'Đã thanh toán'   => 'badge-success',
                            'Hủy'             => 'badge-danger',
                            'Chờ xác nhận'    => 'badge-info',
                            default           => 'badge-secondary',
                        };
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                </p>
                <p><strong>Ghi chú:</strong> <?= htmlspecialchars($booking['ghi_chu'] ?? '-') ?></p>
            </div>
        </div>

        <!-- Thông tin Tour -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm p-4 h-100">
                <h3 class="card-title-section">Thông tin Tour</h3>
                <p><strong>Tên Tour:</strong> <?= htmlspecialchars($tour['ten_tour'] ?? '-') ?></p>
                <p><strong>Danh mục:</strong> <?= htmlspecialchars($tour['ten_danh_muc'] ?? '-') ?></p>
                <p><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($tour['mo_ta'] ?? '-')) ?></p>
                <p><strong>Thời gian:</strong>
                    <?= $tour['ngay_khoi_hanh'] ? date('d/m/Y', strtotime($tour['ngay_khoi_hanh'])) : '-' ?> -
                    <?= $tour['ngay_ket_thuc'] ? date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) : '-' ?>
                </p>
                <p><strong>Khách sạn:</strong> <?= htmlspecialchars($tour['ten_khach_san'] ?? '-') ?></p>
                <p><strong>Nhà hàng:</strong> <?= htmlspecialchars($tour['ten_nha_hang'] ?? '-') ?></p>
                <p><strong>Giá cơ bản:</strong> <?= number_format($tour['gia_co_ban'] ?? 0, 0, ',', '.') ?> VNĐ</p>
                <p><strong>Trạng thái tour:</strong> <?= htmlspecialchars($tour['trang_thai_tour'] ?? '-') ?></p>
            </div>
        </div>

        <!-- Danh sách khách -->
        <div class="col-lg-4 col-md-12">
            <div class="card shadow-sm p-4 h-100">
                <h4 class="card-title-section">Danh sách khách</h4>
                <?php if (!empty($khachList)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>CMND/CCCD</th>
                                    <th>SĐT</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($khachList as $k): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($k['ho_ten']) ?></td>
                                        <td><?= htmlspecialchars($k['gioi_tinh']) ?></td>
                                        <td><?= $k['ngay_sinh'] ?? '-' ?></td>
                                        <td><?= htmlspecialchars($k['so_cmnd_cccd'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($k['so_dien_thoai'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($k['trang_thai_khach'] ?? '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Chưa có khách nào.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="index.php?act=booking" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<!-- ================= CSS CHUẨN ================= -->
<style>
.page-title {
    font-size: 26px;
    font-weight: 700;
    color: #0d6efd;
    position: relative;
    padding-left: 14px;
}
.page-title::before {
    content: "";
    position: absolute;
    left: 0;
    width: 4px;
    height: 26px;
    background: #0d6efd;
    border-radius: 5px;
}

.card {
    border-radius: 14px !important;
    background: #ffffff;
    border: none;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: 0.25s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.15);
}

.card-title-section {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 16px;
    padding-bottom: 6px;
    border-left: 4px solid #0d6efd;
    padding-left: 10px;
    color: #1e293b;
}

p, td, th {
    font-size: 15px;
    color: #333;
}

.table th {
    background: #f1f3f5;
    font-weight: 600;
    color: #222;
    text-align: center;
}
.table td {
    text-align: center;
    vertical-align: middle;
}

.btn-secondary { 
    display: inline-block;
    border-radius: 12px; 
    padding: 12px 28px; 
    font-size: 17px;
    font-weight: 600;
    background: #6c757d;
    color: #fff;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.25s ease-in-out;
}
.btn-secondary:hover { 
    background: #5a6268; 
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.20);
    color: #fff;
}

.badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    color: #fff;
}
.badge-warning { background-color: #ffc107; color:#212529; }
.badge-success { background-color: #28a745; }
.badge-danger { background-color: #dc3545; }
.badge-info { background-color: #17a2b8; }
.badge-secondary { background-color: #6c757d; }

@media (max-width: 991px) {
    .col-lg-4 { margin-bottom: 20px; }
}
</style>
