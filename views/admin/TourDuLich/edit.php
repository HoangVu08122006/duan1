<div class="col-md-8 offset-md-2 p-4">
    <h3>Sửa Tour</h3>
    <form method="POST">

        <!-- Danh mục tour -->
        <div class="mb-3">
            <label class="form-label">Danh mục tour</label>
            <select name="id_danh_muc" class="form-select" required>
                <option value="">--Chọn danh mục--</option>
                <?php foreach ($danhMucList as $dm): ?>
                    <option value="<?= $dm['id_danh_muc'] ?>" <?= ($dm['id_danh_muc'] == $tour['id_danh_muc']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Trạng thái tour -->
        <div class="mb-3">
            <label class="form-label">Trạng thái tour</label>
            <select name="id_trang_thai_tour" class="form-select" required>
                <option value="">--Chọn trạng thái--</option>
                <?php foreach ($trangThaiList as $tt): ?>
                    <option value="<?= $tt['id_trang_thai_tour'] ?>"
                        <?= ($tt['id_trang_thai_tour'] == $tour['id_trang_thai_tour']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tt['trang_thai_tour']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Khách sạn  -->
        <div class="mb-3">
            <label class="form-label">Khách sạn</label>
            <select name="id_khach_san" class="form-select" required>
                <option value="">--Chọn khách sạn--</option>
                <?php foreach ($khachSanList as $ks): ?>
                    <option value="<?= $ks['id_khach_san'] ?>" <?= ($ks['id_khach_san'] == $tour['id_khach_san']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ks['ten_khach_san']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nhà hàng-->
        <div class="mb-3">
            <label class="form-label">Nhà hàng</label>
            <select name="id_nha_hang" class="form-select" required>
                <option value="">--Chọn nhà hàng--</option>
                <?php foreach ($nhaHangList as $nh): ?>
                    <option value="<?= $nh['id_nha_hang'] ?>" <?= ($nh['id_nha_hang'] == $tour['id_nha_hang']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($nh['ten_nha_hang']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Xe -->
        <div class="mb-3">
            <label class="form-label">Xe</label>
            <select name="id_xe" class="form-select" required>
                <option value="">--Chọn xe--</option>
                <?php foreach ($xeList as $xe): ?>
                    <option value="<?= $xe['id_xe'] ?>" 
                        <?= ($xe['id_xe'] == $tour['id_xe']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($xe['nha_xe']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tên tour -->
        <div class="mb-3">
            <label class="form-label">Tên tour</label>
            <input type="text" name="ten_tour" class="form-control" value="<?= htmlspecialchars($tour['ten_tour']) ?>"
                required>
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
<textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($tour['mo_ta']) ?></textarea>
        </div>

        <!-- Thời lượng -->
        <div class="mb-3">
            <label class="form-label">Thời lượng</label>
            <input type="text" name="thoi_luong" class="form-control"
                value="<?= htmlspecialchars($tour['thoi_luong']) ?>">
        </div>

        <!-- Giá cơ bản -->
        <div class="mb-3">
            <label class="form-label">Giá cơ bản</label>
            <input type="number" name="gia_co_ban" class="form-control" value="<?= $tour['gia_co_ban'] ?>" step="0.01">
        </div>
        <!-- Ngày khởi hành -->
        <div class="mb-3">
            <label class="form-label">Ngày khởi hành</label>
            <input type="date" name="ngay_khoi_hanh" class="form-control"
                value="<?= htmlspecialchars($tour['ngay_khoi_hanh']) ?>" required>
        </div>

        <!-- Ngày kết thúc -->
        <div class="mb-3">
            <label class="form-label">Ngày kết thúc</label>
            <input type="date" name="ngay_ket_thuc" class="form-control"
                value="<?= htmlspecialchars($tour['ngay_ket_thuc']) ?>" required>
        </div>


        <!-- Chính sách -->
        <div class="mb-3">
            <label class="form-label">Chính sách</label>
            <textarea name="chinh_sach" class="form-control"
                rows="3"><?= htmlspecialchars($tour['chinh_sach']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật tour</button>
        <a href="index.php?act=tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const startInput = document.querySelector("input[name='ngay_khoi_hanh']");
    const endInput = document.querySelector("input[name='ngay_ket_thuc']");
    const durationInput = document.querySelector("input[name='thoi_luong']");

    function calculateDuration() {
        const startDate = new Date(startInput.value);
        const endDate = new Date(endInput.value);

        if (startInput.value && endInput.value && endDate >= startDate) {
            // Tính số ngày (bao gồm cả ngày khởi hành)
            const diffTime = endDate - startDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            durationInput.value = diffDays + " ngày";
        } else {
            durationInput.value = "";
        }
    }

    startInput.addEventListener("change", calculateDuration);
    endInput.addEventListener("change", calculateDuration);
});
</script>

<style>
    /* Container */
.col-md-8 {
    background: linear-gradient(145deg, #fdfbfb, #ebedee);
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    padding: 30px;
}

/* Title */
h3 {
    text-align: center;
    margin-bottom: 30px;
    color: #222;
    font-weight: 700;
    font-size: 1.8rem;
}

/* Labels */
.form-label {
    font-weight: 600;
    color: #444;
}

/* Inputs & Selects */
.form-control,
.form-select {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 10px 12px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}

.form-control:focus,
.form-select:focus {
    border-color: #ff6b6b;
    box-shadow: 0 0 8px rgba(255, 107, 107, 0.4);
    outline: none;
}

textarea.form-control {
    resize: vertical;
}

/* Buttons */
button.btn-success {
    display: block;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    background-color: #ff6b6b;
    border: none;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

button.btn-success:hover {
    background-color: #ff3b3b;
    box-shadow: 0 4px 12px rgba(255, 59, 59, 0.4);
}

/* Quay lại button */
.btn-secondary {
    display: inline-block;
    background-color: #6c757d;
    color: #fff;
text-decoration: none;
    padding: 12px 25px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

/* Margin giữa các input */
.mb-3 {
    margin-bottom: 1.2rem !important;
}

/* Responsive */
@media (max-width: 767px) {
    .col-md-8.offset-md-2 {
        margin: 10px;
        padding: 20px;
    }
}

</style>