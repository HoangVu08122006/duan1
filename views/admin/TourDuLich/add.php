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
            <label>Thời lượng</label>
            <input type="text" name="thoi_luong">
        </div>

        <div class="form-group">
            <label>Ngày khởi hành</label>
            <input type="date" name="ngay_khoi_hanh" required>
        </div>

        <div class="form-group">
            <label>Ngày kết thúc</label>
            <input type="date" name="ngay_ket_thuc" required>
        </div>

        <div class="form-group">
            <label>Giá cơ bản</label>
            <input type="number" name="gia_co_ban" step="0.01">
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
/* Container chính */
.tour-form-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px 40px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Tiêu đề */
.tour-form-container h3 {
    text-align: center;
    margin-bottom: 30px;
    color: #1e1e2f;
    font-weight: 700;
    font-size: 28px;
}

/* Nhóm form */
.form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

/* Nhãn form */
.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
}

/* Input, select, textarea */
.form-group input,
.form-group select,
.form-group textarea {
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    transition: all 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
}

/* Textarea */
textarea {
    resize: vertical;
}

/* Nút */
.form-buttons {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-top: 20px;
}

.btn-success {
    flex: 1;
    padding: 12px 0;
    background-color: #28a745;
    border: none;
    font-weight: 600;
    font-size: 16px;
    border-radius: 8px;
    transition: all 0.3s;
}

.btn-success:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-secondary {
    flex: 1;
    padding: 12px 0;
    background-color: #6c757d;
    text-align: center;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Responsive nhỏ hơn 768px */
@media (max-width: 767px) {
    .tour-form-container {
        padding: 20px;
        margin: 20px;
    }

    .form-buttons {
        flex-direction: column;
    }

    .form-buttons .btn-success,
    .form-buttons .btn-secondary {
        width: 100%;
    }
}
</style>