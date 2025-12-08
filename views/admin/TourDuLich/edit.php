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
    background: #fdfdfd;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.12);
    padding: 35px;
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
}

/* Tiêu đề */
h3 {
    text-align: center;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 30px;
    letter-spacing: 1px;
    position: relative;
}

h3::after {
    content: "";
    display: block;
    width: 60px;
    height: 3px;
    background: #3498db;
    margin: 10px auto 0;
    border-radius: 2px;
}

/* Label */
.form-label {
    font-weight: 600;
    color: #34495e;
    margin-bottom: 8px;
}

/* Input & Select */
.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #dcdcdc;
    padding: 12px 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-size: 15px;
}

.form-control:focus, .form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 10px rgba(52, 152, 219, 0.25);
}

/* Textarea */
textarea.form-control {
    resize: none;
}

/* Buttons */
.btn {
    border-radius: 10px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 15px;
}

.btn-success {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    border: none;
    color: #fff;
    box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(39, 174, 96, 0.4);
}

.btn-secondary {
    background: #95a5a6;
    border: none;
    color: #fff;
    box-shadow: 0 4px 12px rgba(149, 165, 166, 0.3);
}

.btn-secondary:hover {
    background: #7f8c8d;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(127, 140, 141, 0.4);
}

/* Khoảng cách giữa các phần */
.mb-3 {
    margin-bottom: 22px;
}

/* Hiệu ứng hover container */
.col-md-8:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.18);
    transform: translateY(-3px);
}

</style>