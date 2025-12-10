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

        <!-- Thông tin Tour + Booking -->
<div class="col-lg-4 col-md-6">
    <div class="card shadow-sm p-4 h-100">
        <h3 class="card-title-section">Thông tin Tour</h3>
        <p><strong>Tên Tour:</strong> <?= htmlspecialchars($booking['ten_tour'] ?? '-') ?></p>
        <p><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($booking['mo_ta'] ?? '-')) ?></p>
        <p><strong>Thời gian:</strong>
            <?= $booking['ngay_khoi_hanh'] ? date('d/m/Y', strtotime($booking['ngay_khoi_hanh'])) : '-' ?> -
            <?= $booking['ngay_ket_thuc'] ? date('d/m/Y', strtotime($booking['ngay_ket_thuc'])) : '-' ?>
        </p>
        <p><strong>Khách sạn:</strong> <?= htmlspecialchars($booking['ten_khach_san'] ?? '-') ?></p>
        <p><strong>Nhà hàng:</strong> <?= htmlspecialchars($booking['ten_nha_hang'] ?? '-') ?></p>
        <p><strong>Nhà xe:</strong> <?= htmlspecialchars($booking['nha_xe'] ?? '-') ?></p>
        <p><strong>Giá cơ bản:</strong> <?= number_format($booking['gia_co_ban'] ?? 0, 0, ',', '.') ?> VNĐ</p>
        <p><strong>Trạng thái tour:</strong> <?= htmlspecialchars($booking['trang_thai_tour'] ?? '-') ?></p>
    </div>
</div>



        <!-- Danh sách khách -->
        <div class="col-lg-4 col-md-12">
            <div class="card shadow-sm p-4 h-100">
                <h4 class="card-title-section">Danh sách khách</h4>
                <a class="btn-add" 
                    href="index.php?act=booking&action=addKhach&id=<?= $booking['id_dat_tour'] ?>">
                    + Thêm khách mới
                </a>
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
                                    <th>Vai trò</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($khachList as $index => $k): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($k['ho_ten']) ?></td>
                                        <td><?= htmlspecialchars($k['gioi_tinh']) ?></td>
                                        <td><?= $k['ngay_sinh'] ?? '-' ?></td>
                                        <td><?= htmlspecialchars($k['so_cmnd_cccd'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($k['so_dien_thoai'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($k['trang_thai_khach'] ?? '-') ?></td>
                                        <td>
                                            <?php if ($index === 0): ?>
                                                <span class="badge badge-primary">Đại diện</span>
                                            <?php endif; ?>
                                        </td>
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
/* Nền tổng thể */
body {
    font-family: 'Inter', 'Poppins', sans-serif;
    background: #f0f2f5;
    color: #2c3e50;
    margin: 0;
    padding: 0;
}
.badge-primary {
    background: #007bff;
    color: #fff;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Tiêu đề trang */
.page-title {
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    color: #1a1a1a;
    margin-bottom: 2rem;
    position: relative;
}

.page-title::after {
    content: "";
    display: block;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #007bff, #00c6ff);
    margin: 12px auto 0;
    border-radius: 2px;
}

/* Card phong cách neumorphism */
.card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 8px 8px 20px rgba(0,0,0,0.08),
                -8px -8px 20px rgba(255,255,255,0.9);
    padding: 24px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 12px 12px 28px rgba(0,0,0,0.12),
                -12px -12px 28px rgba(255,255,255,1);
}

.card-title-section {
    font-size: 1.4rem;
    font-weight: 600;
    color: #007bff;
    margin-bottom: 1rem;
    border-left: 5px solid #00c6ff;
    padding-left: 10px;
}

/* Badge trạng thái */
.badge {
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    box-shadow: inset 2px 2px 6px rgba(0,0,0,0.1),
                inset -2px -2px 6px rgba(255,255,255,0.7);
}

.badge-warning { background: #ff9800; color: #fff; }
.badge-success { background: #4caf50; color: #fff; }
.badge-danger  { background: #f44336; color: #fff; }
.badge-info    { background: #2196f3; color: #fff; }
.badge-secondary { background: #9e9e9e; color: #fff; }

/* Bảng danh sách khách */
.table {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.table thead {
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: #fff;
    font-weight: 600;
}

.table th, .table td {
    padding: 14px;
    vertical-align: middle;
    font-size: 0.95rem;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f9fbfd;
}

.table-striped tbody tr:hover {
    background-color: #eaf4ff;
    transition: background 0.2s ease;
}

/* Nút quay lại */
.btn {
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.25s ease;
    cursor: pointer;
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d, #495057);
    border: none;
    color: #fff;
    box-shadow: 4px 4px 12px rgba(0,0,0,0.2),
                -4px -4px 12px rgba(255,255,255,0.1);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #495057, #343a40);
    transform: scale(1.08);
}

</style>
