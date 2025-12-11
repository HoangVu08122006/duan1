<link rel="stylesheet" href="hdv.css">

<style>
    .tour-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .debug-info {
        background: #fff3cd;
        padding: 10px;
        border: 1px solid #ffc107;
        margin-bottom: 20px;
        border-radius: 4px;
        font-size: 0.9em;
    }

    .tour-info {
        background: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        border-left: 4px solid #0066cc;
    }

    .tour-info h2 {
        margin-top: 0;
        color: #0066cc;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-weight: bold;
        color: #333;
        font-size: 0.9em;
        text-transform: uppercase;
    }

    .info-value {
        color: #666;
        margin-top: 5px;
        font-size: 1em;
    }

    .khach-list {
        margin-top: 30px;
    }

    .khach-list h3 {
        color: #0066cc;
        border-bottom: 2px solid #0066cc;
        padding-bottom: 10px;
    }

    .khach-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .khach-table thead {
        background: #0066cc;
        color: white;
    }

    .khach-table th,
    .khach-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .khach-table tbody tr:hover {
        background: #f9f9f9;
    }

    .status-form {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .status-select {
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.9em;
    }

    .btn-update {
        padding: 6px 12px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9em;
    }

    .btn-update:hover {
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

    .btn-edit-khach {
        padding: 6px 10px;
        background: #0066cc;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85em;
    }

    .btn-edit-khach:hover {
        background: #0052a3;
    }

    /* Nút điểm danh */
    .btn-diem-danh {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9em;
        font-weight: bold;
        color: white;
        margin-right: 5px;
        transition: all 0.3s;
    }

    .btn-co-mat {
        background: #28a745;
    }

    .btn-co-mat:hover {
        background: #218838;
    }

    .btn-vang {
        background: #dc3545;
    }

    .btn-vang:hover {
        background: #c82333;
    }

    .btn-khac {
        background: #ffc107;
        color: #333;
    }

    .btn-khac:hover {
        background: #e0a800;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        font-size: 1.3em;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 2px solid #0066cc;
        padding-bottom: 10px;
    }

    .modal-body {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1em;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .modal-footer button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
    }

    .btn-save {
        background: #28a745;
        color: white;
    }

    .btn-save:hover {
        background: #218838;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
    }

    .btn-cancel:hover {
        background: #5a6268;
    }

    .no-khach {
        padding: 20px;
        text-align: center;
        background: #fff3cd;
        border: 1px solid #ffc107;
        border-radius: 4px;
        color: #856404;
    }

    .don-dat-tour-group {
        margin-bottom: 25px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 15px;
    }

    .don-dat-tour-header {
        background: #e7f3ff;
        padding: 10px;
        border-left: 4px solid #0066cc;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    .don-dat-tour-header strong {
        color: #0066cc;
    }
</style>
<!-- ... giữ nguyên CSS của bạn ... -->

<div class="tour-detail-container">
    <a href="index.php?act=hdv_dashboard" class="btn-back">← Quay lại Dashboard</a>

    <div class="tour-info">
        <h2><?= htmlspecialchars($tour['ten_tour'] ?? '') ?></h2>

        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Thời gian</span>
                <span class="info-value"><?= htmlspecialchars($tour['thoi_luong'] ?? '-') ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Tổng tiền</span>
    <span class="info-value"><?= number_format($tongTien, 0, ',', '.') ?> VNĐ</span>
            </div>

            <div class="info-item" style="background: #e7f3ff; padding: 10px; border-radius: 4px; border-left: 4px solid #0066cc;">
                <span class="info-label">📅 Ngày khởi hành</span>
                <span class="info-value"><?= isset($tour['ngay_khoi_hanh']) ? date('d/m/Y', strtotime($tour['ngay_khoi_hanh'])) : 'Chưa có' ?></span>
            </div>
            <div class="info-item" style="background: #e7f3ff; padding: 10px; border-radius: 4px; border-left: 4px solid #0066cc;">
                <span class="info-label">📅 Ngày kết thúc</span>
                <span class="info-value"><?= isset($tour['ngay_ket_thuc']) ? date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) : 'Chưa có' ?></span>
            </div>

            <div class="info-item">
                <span class="info-label">Khởi hành từ</span>
                <span class="info-value"><?= htmlspecialchars($tour['dia_diem_khoi_hanh'] ?? '-') ?></span>
            </div>
            




            <div class="info-item">
                <span class="info-label">Đến</span>
                <span class="info-value"><?= htmlspecialchars($tour['dia_diem_den'] ?? '-') ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Phương tiện</span>
                <span class="info-value"><?= htmlspecialchars($tour['nha_xe'] ?? 'Chưa có xe') ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Trạng thái</span>
                <span class="info-value"><?= htmlspecialchars($tour['trang_thai_lich_khoi_hanh'] ?? 'N/A') ?></span>
            </div>
        </div>

        <?php if (!empty($tour['mo_ta'])): ?>
        <div class="info-item" style="margin-top: 15px;">
            <span class="info-label">Mô tả</span>
            <span class="info-value"><?= htmlspecialchars($tour['mo_ta'] ?? '') ?></span>
        </div>
        <?php endif; ?>
    </div>

    <!-- Lịch trình -->
    <div class="khach-list">
        <h3>📅 Lịch Trình</h3>
        <?php if (count($lichTrinh) > 0): ?>
        <table class="khach-table" style="margin-top: 15px;">
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
                    <td><?= htmlspecialchars($lt['ngay_thu'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($lt['tieu_de'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($lt['hoat_dong'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($lt['dia_diem'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="no-khach">⚠️ Chưa có lịch trình nào cho tour này</div>
        <?php endif; ?>
    </div>

    <!-- Danh sách khách -->
    <div class="khach-list">
        <h3>📋 Điểm Danh Ngày <?= htmlspecialchars($ngayDangDiemDanh ?? 'Không xác định') ?></h3>
        
        <?php if (count($khachsNgayHienTai) > 0): ?>
            <?php
            $grouped = [];
            foreach ($khachsNgayHienTai as $khach) {
                $id_dat = $khach['id_dat_tour'];
                if (!isset($grouped[$id_dat])) {
                    $grouped[$id_dat] = [
                        'ngay_dat' => $khach['ngay_dat'],
                        'khachs' => []
                    ];
                }
                $grouped[$id_dat]['khachs'][] = $khach;
            }
            ?>

            <?php foreach ($grouped as $id_dat => $dat_info): ?>
            <div class="don-dat-tour-group">
                <div class="don-dat-tour-header">
                    <strong>Đơn đặt tour #<?= $id_dat ?></strong> - Ngày đặt: <?= htmlspecialchars($dat_info['ngay_dat'] ?? '') ?>
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
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($dat_info['khachs'] as $idx => $khach): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td><?= htmlspecialchars($khach['ho_ten'] ?? '') ?></td>
                        <td><?= htmlspecialchars($khach['so_dien_thoai'] ?? '') ?></td>
                        <td><?= htmlspecialchars($khach['gioi_tinh'] ?? '') ?></td>
                        <td><?= htmlspecialchars($khach['ngay_sinh'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($khach['so_cmnd_cccd'] ?? '-') ?></td>
                            <td style="max-width: 200px; word-wrap: break-word;">
                                <small><?= htmlspecialchars($khach['yeu_cau_dac_biet'] ?? '-') ?></small>
                            </td>
                            <td><?= htmlspecialchars($khach['trang_thai_khach'] ?? 'Chưa xác định') ?></td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 5px;">
                            <?php 
                                    $idCoMat = null; $idVang = null;
                            foreach ($trangThaiList as $tt) {
                                if (stripos($tt['trang_thai_khach'], 'có mặt') !== false) $idCoMat = $tt['id_trang_thai_khach'];
                                if (stripos($tt['trang_thai_khach'], 'vắng') !== false) $idVang = $tt['id_trang_thai_khach'];
                            }
                            ?>
                                    <?php 
                            $trang_thai = strtolower($khach['trang_thai_khach'] ?? '');

                            $isCoMat = (strpos($trang_thai, 'có mặt') !== false);

                                // Tìm ID trạng thái
                                $idCoMat = null; 
                                $idVang = null;
                                foreach ($trangThaiList as $tt) {
                                    if (stripos($tt['trang_thai_khach'], 'có mặt') !== false) $idCoMat = $tt['id_trang_thai_khach'];
                                    if (stripos($tt['trang_thai_khach'], 'vắng')     !== false) $idVang = $tt['id_trang_thai_khach'];
                                }

                                // Xác định trạng thái tiếp theo
                                $nextTrangThai = $isCoMat ? $idVang : $idCoMat;

                                // Giao diện nút
                                $btnClass = $isCoMat ? "btn-vang" : "btn-co-mat";
                                $btnText  = $isCoMat ? "✗ Đánh dấu Vắng" : "✓ Đánh dấu Có mặt";
                                ?>

                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="diem_danh">
                                    <input type="hidden" name="id_khach" value="<?= $khach['id_khach'] ?>">
                                    <input type="hidden" name="trang_thai" value="<?= $nextTrangThai ?>">
                                    <button type="submit" class="btn-diem-danh <?= $btnClass ?>"><?= $btnText ?></button>
                                </form>


                                    <button type="button" class="btn-edit-khach" onclick="editYeuCau(event, <?= $khach['id_khach'] ?>, '<?= htmlspecialchars($khach['yeu_cau_dac_biet'] ?? '', ENT_QUOTES) ?>')" title="Sửa yêu cầu đặc biệt">⚙️ Yêu cầu</button>
                                </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-khach">⚠️ Chưa có khách hàng nào cho tour này</div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Cập nhật yêu cầu đặc biệt</div>
        <form method="POST" id="editForm">
            <div class="modal-body">
                <input type="hidden" name="id_khach" id="modalIdKhach">
                <input type="hidden" name="action" value="update_yeu_cau">
                
                <div class="form-group">
                    <label for="hoTen">Họ tên khách:</label>
                    <input type="text" id="hoTen" readonly style="background: #f0f0f0;">
                </div>

                <div class="form-group">
                    <label for="yeuCau">Yêu cầu đặc biệt <span style="color: red;">*</span></label>
                    <textarea name="yeu_cau_dac_biet" id="yeuCau" placeholder="Ví dụ: Ăn chay, dị ứng..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Hủy</button>
                <button type="submit" class="btn-save">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function editYeuCau(event, idKhach, yeuCau) {
    const row = event.target.closest('tr');
    const hoTen = row.querySelector('td:nth-child(2)').textContent;
    
    document.getElementById('modalIdKhach').value = idKhach;
    document.getElementById('hoTen').value = hoTen;
    document.getElementById('yeuCau').value = yeuCau || '';
    document.getElementById('editModal').classList.add('active');
}

function closeModal() {
    document.getElementById('editModal').classList.remove('active');
}

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

