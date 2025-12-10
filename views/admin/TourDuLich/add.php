<div class="tour-form-container">
    <h3>Thêm Tour Mới</h3>
    <form method="POST">
        <div class="form-group">
            <label>Danh mục tour</label>
            <select name="id_danh_muc" required>
                <option value="">--Chọn danh mục--</option>
                <?php foreach ($danhMucList as $dm): ?>
                    <option value="<?= $dm['id_danh_muc'] ?>"><?= htmlspecialchars($dm['ten_danh_muc']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Trạng thái tour</label>
            <select name="id_trang_thai_tour" required>
                <option value="">--Chọn trạng thái--</option>
                <?php foreach ($trangThaiList as $tt): ?>
                    <option value="<?= $tt['id_trang_thai_tour'] ?>"><?= htmlspecialchars($tt['trang_thai_tour']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Khách sạn</label>
            <select name="id_khach_san" required>
                <option value="">--Chọn khách sạn--</option>
                <?php foreach ($khachSanList as $ks): ?>
                    <option value="<?= $ks['id_khach_san'] ?>"><?= htmlspecialchars($ks['ten_khach_san']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Nhà hàng</label>
            <select name="id_nha_hang" required>
                <option value="">--Chọn nhà hàng--</option>
                <?php foreach ($nhaHangList as $nh): ?>
                    <option value="<?= $nh['id_nha_hang'] ?>"><?= htmlspecialchars($nh['ten_nha_hang']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Xe</label>
            <select name="id_xe" required>
                <option value="">--Chọn xe--</option>
                <?php foreach ($xeList as $xe): ?>
                    <option value="<?= $xe['id_xe'] ?>"><?= htmlspecialchars($xe['nha_xe']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Tên tour</label>
            <input type="text" name="ten_tour" required>
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="mo_ta" rows="3"></textarea>
        </div>

        


        <div class="form-group">
            <label>Chính sách</label>
            <textarea name="chinh_sach" rows="3"></textarea>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-success">Thêm tour</button>
            <a href="index.php?act=tour" class="btn btn-secondary">Quay lại</a>
        </div>
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
/* ========================== */
/* FORM CONTAINER */
/* ========================== */
.tour-form-container {
    background: #ffffff;
    padding: 28px;
    border-radius: 12px;
    max-width: 650px;
    margin: 20px auto;
    border: 1px solid #e1e5eb;
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
}

.tour-form-container h3 {
    margin-bottom: 20px;
    font-size: 22px;
    font-weight: 600;
    color: #2c3e50;
    text-align: center;
}

/* ========================== */
/* FORM GROUP */
/* ========================== */
.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    font-size: 14px;
    color: #2c3e50;
}

/* Inputs + Select + Textarea */
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #cfd8e3;
    font-size: 14px;
    background: #f9fafb;
    transition: 0.2s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #3498db;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
    outline: none;
}

/* ========================== */
/* BUTTONS */
/* ========================== */
.form-buttons {
    margin-top: 20px;
    display: flex;
    gap: 12px;
    justify-content: center;
}

.form-buttons .btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
}

.btn-success {
    background-color: #2ecc71;
    color: #fff;
    border: none;
}

.btn-success:hover {
    background-color: #27ae60;
}

.btn-secondary {
    background-color: #95a5a6;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #7f8c8d;
}

</style>