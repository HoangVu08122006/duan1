<?php
// variables available from controller:
// $latestBooking (array|null), $tours (array), $hdvList (array), $ttList (array), $error (string|null), $old (array)
?>

<h2>Thêm Lịch Khởi Hành</h2>

<?php if (!empty($error)): ?>
    <div style="color: red; margin-bottom: 10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if ($latestBooking): ?>
    <div class="booking-info" style="border:1px solid #ddd;padding:8px;margin-bottom:12px;">
        <p><strong>ID Đặt Tour mới nhất:</strong> <?= htmlspecialchars($latestBooking['id_dat_tour']) ?></p>

        <?php
        // Tên khách: lấy từ first_passenger nếu có, nếu không, thử các key phổ biến
        $passenger = $latestBooking['first_passenger'] ?? null;
        $name = $passenger['ho_ten'] ?? $latestBooking['ho_ten'] ?? $latestBooking['ten_khach'] ?? '';
        $phone = $passenger['so_dien_thoai'] ?? $latestBooking['so_dien_thoai'] ?? $latestBooking['sdt'] ?? '';
        ?>
        <p><strong>Tên khách:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>Số lượng khách:</strong> <?= htmlspecialchars($latestBooking['so_luong_khach'] ?? '') ?></p>

        <?php if (!empty($latestBooking['passengers'])): ?>
            <div>
                <strong>Danh sách khách:</strong>
                <ul>
                    <?php foreach ($latestBooking['passengers'] as $p): ?>
                        <li><?= htmlspecialchars($p['ho_ten'] ?? 'N/A') ?> - <?= htmlspecialchars($p['so_dien_thoai'] ?? '') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p>Hiện chưa có booking nào!</p>
<?php endif; ?>

<form method="POST" action="">
    <!-- hidden booking & tour từ latestBooking nếu có, hoặc dùng old giữ giá trị khi lỗi -->
    <input type="hidden" name="id_dat_tour" value="<?= htmlspecialchars($old['id_dat_tour'] ?? ($latestBooking['id_dat_tour'] ?? '')) ?>">
    <input type="hidden" name="id_tour" value="<?= htmlspecialchars($old['id_tour'] ?? ($latestBooking['id_tour'] ?? '')) ?>">

    <label>Chọn Tour</label>
    <select name="id_tour" required>
        <option value="">-- Chọn tour --</option>
        <?php foreach ($tours as $t): ?>
            <?php $sel = (($old['id_tour'] ?? ($latestBooking['id_tour'] ?? '')) == $t['id_tour']) ? 'selected' : ''; ?>
            <option value="<?= htmlspecialchars($t['id_tour']) ?>" <?= $sel ?>><?= htmlspecialchars($t['ten_tour']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Hướng dẫn viên chính</label>
    <select name="id_hdv">
        <option value="">-- Chọn HDV --</option>
        <?php foreach ($hdvList as $h): ?>
            <?php $sel = (($old['id_hdv'] ?? '') == $h['id_hdv']) ? 'selected' : ''; ?>
            <option value="<?= htmlspecialchars($h['id_hdv']) ?>" <?= $sel ?>><?= htmlspecialchars($h['ho_ten']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Địa điểm khởi hành</label>
    <input type="text" name="dia_diem_khoi_hanh" value="<?= htmlspecialchars($old['dia_diem_khoi_hanh'] ?? ($latestBooking['dia_diem_khoi_hanh'] ?? '')) ?>"><br><br>

    <label>Địa điểm đến</label>
    <input type="text" name="dia_diem_den" value="<?= htmlspecialchars($old['dia_diem_den'] ?? '') ?>"><br><br>

    <label>Trạng thái</label>
    <select name="id_trang_thai" required>
        <option value="">-- Chọn trạng thái --</option>
        <?php foreach ($ttList as $tt): ?>
            <?php $sel = (($old['id_trang_thai'] ?? '') == $tt['id_trang_thai_lich_khoi_hanh']) ? 'selected' : ''; ?>
            <option value="<?= htmlspecialchars($tt['id_trang_thai_lich_khoi_hanh']) ?>" <?= $sel ?>><?= htmlspecialchars($tt['trang_thai_lich_khoi_hanh']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Ghi chú</label><br>
    <textarea name="ghi_chu"><?= htmlspecialchars($old['ghi_chu'] ?? '') ?></textarea><br><br>

    <button type="submit"  class="btn btn-submit">Thêm mới</button>
    <button type="button"  class="btn btn-cancel" onclick="location.href='index.php?act=dieuHanhTour'">Hủy</button>
</form>
<?php if (!$latestBooking): ?>
    <p style="color:red;font-weight:bold;">
        Không còn booking nào chưa tạo lịch khởi hành!
    </p>
<?php endif; ?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(160deg, #a0e9fd 0%, #fdf6e3 100%);
        color: #2c3e50;
        
    }

    h2 {
        font-size: 26px;
        color: #ff6f61;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Card booking info */
    .booking-info {
        background-color: #ffffffcc;
        border-left: 6px solid #ff6f61;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }

    .booking-info:hover {
        transform: translateY(-3px);
    }

    .booking-info p {
        font-size: 15px;
        margin-bottom: 8px;
    }

    .booking-info strong {
        color: #3498db;
    }

    .booking-info ul li {
        font-size: 14px;
        margin-bottom: 4px;
    }

    /* Form styling */
    form {
        background-color: #ffffffcc;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        max-width: 600px;
        margin: auto;
    }

    label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #2c3e50;
        display: block;
    }

    input[type="text"],
    select,
    textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 18px;
        font-size: 14px;
        transition: all 0.2s;
    }

    input[type="text"]:focus,
    select:focus,
    textarea:focus {
        border-color: #ff6f61;
        box-shadow: 0 0 8px rgba(255,111,97,0.3);
        outline: none;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    /* Buttons */
    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        font-size: 14px;
    }

    .btn-submit {
        background-color: #ff6f61;
        color: #fff;
        margin-right: 10px;
    }

    .btn-submit:hover {
        background-color: #e85b4f;
    }

    .btn-cancel {
        background-color: #3498db;
        color: #fff;
    }

    .btn-cancel:hover {
        background-color: #2980b9;
    }

    /* Error */
    .error {
        background-color: #ffe5e0;
        color: #e74c3c;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-weight: 600;
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 650px) {
        form {
            padding: 20px;
        }
    }
</style>
