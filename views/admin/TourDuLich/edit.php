







<div class="col-md-8 offset-md-2 p-4">
    <h3>Sửa Tour</h3>
    <form method="POST" enctype="multipart/form-data">

<div id="editTourLayout">

    <!-- Cột 1: Ảnh -->
    <div class="col-col image-column">
                <!-- Ảnh tour hiện tại -->
        <div class="mb-3">
            <label class="form-label">Ảnh tour hiện tại</label>
            <div class="image-grid">
                <?php if (!empty($tour['anh_tour']) && is_array($tour['anh_tour'])): ?>
                    <?php foreach ($tour['anh_tour'] as $img): ?>
                        <div class="image-box">
                            <img src="./uploads/tours/<?= htmlspecialchars($img) ?>" alt="Ảnh tour">
                            <button type="button" class="delete-btn" onclick="removeImage(this, '<?= htmlspecialchars($img) ?>')">×</button>
                            <input type="hidden" name="delete_images[]" value="" disabled>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Chưa có ảnh cho tour này.</p>
                <?php endif; ?>
            </div>
        </div>


        <!-- Upload ảnh mới -->
        <div class="mb-3">
            <label class="form-label">Thêm ảnh mới</label>
            <input type="file" name="anh_tour[]" class="form-control" multiple>
            <small class="text-muted">Có thể chọn nhiều ảnh (jpg, png, jpeg).</small>
        </div>

    </div>

    <!-- Cột 2: Thông tin tour -->
    <div class="col-col info-column">
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

        <!-- Khách sạn -->
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

        <!-- Nhà hàng -->
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
                    <option value="<?= $xe['id_xe'] ?>" <?= ($xe['id_xe'] == $tour['id_xe']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($xe['nha_xe']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tên tour -->
        <div class="mb-3">
            <label class="form-label">Tên tour</label>
            <input type="text" name="ten_tour" class="form-control" value="<?= htmlspecialchars($tour['ten_tour']) ?>" required>
        </div>
        <!-- Số ngày -->
        <div class="mb-3">
            <label class="form-label">Số ngày của tour</label>
                <input type="number" id="soNgay" name="so_ngay" class="form-control" 
                min="1"
                value="<?= count($lichTrinh) ?>">
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($tour['mo_ta']) ?></textarea>
        </div>

       

        <!-- Chính sách -->
        <div class="mb-3">
            <label class="form-label">Chính sách</label>
            <textarea name="chinh_sach" class="form-control" rows="3"><?= htmlspecialchars($tour['chinh_sach']) ?></textarea>
        </div>
    </div>

    <!-- Cột 3: Lịch trình -->
    <div class="col-col schedule-column">
        <h4 class="mt-4">Lịch trình tour</h4>

<div id="lichTrinhContainer">
<?php if (!empty($lichTrinh) && is_array($lichTrinh)): ?>
    <?php foreach ($lichTrinh as $lt): 
        $idLt    = $lt['id_lich_trinh'] ?? '';
        $ngayThu = $lt['ngay_thu'] ?? '';
        $tieuDe  = $lt['tieu_de'] ?? '';
        $hoatDong= $lt['hoat_dong'] ?? '';
        $diaDiem = $lt['dia_diem'] ?? '';
    ?>
        <div class="mb-3 p-3 bg-light rounded lich-item">
            <label>Ngày thứ</label>
            <input type="number" 
                   name="lich_trinh[<?= htmlspecialchars($idLt) ?>][ngay_thu]"
                   value="<?= htmlspecialchars($ngayThu) ?>" 
                   class="form-control">

            <label class="mt-2">Tiêu đề</label>
            <input type="text" 
                   name="lich_trinh[<?= htmlspecialchars($idLt) ?>][tieu_de]"
                   value="<?= htmlspecialchars($tieuDe) ?>" 
                   class="form-control">

            <label class="mt-2">Mô tả / Hoạt động</label>
            <textarea name="lich_trinh[<?= htmlspecialchars($idLt) ?>][hoat_dong]" 
                      class="form-control" rows="3"><?= htmlspecialchars($hoatDong) ?></textarea>

            <label class="mt-2">Địa điểm</label>
            <input type="text" 
                   name="lich_trinh[<?= htmlspecialchars($idLt) ?>][dia_diem]"
                   value="<?= htmlspecialchars($diaDiem) ?>" 
                   class="form-control">
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-muted">Chưa có lịch trình cho tour này.</p>
<?php endif; ?>
</div>
    </div>

</div>

        <button type="submit" class="btn btn-success">Cập nhật tour</button>
        <a href="index.php?act=tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>


<script>
// =========================
// AUTO ADD / REMOVE LỊCH TRÌNH
// =========================

document.addEventListener("DOMContentLoaded", function () {

    const soNgayInput = document.getElementById("soNgay");
    const lichContainer = document.getElementById("lichTrinhContainer");

    soNgayInput.addEventListener("change", function () {
        const newCount = parseInt(this.value);
        const currentCount = lichContainer.querySelectorAll(".lich-item").length;

        if (newCount > currentCount) {
            // ======= THÊM LỊCH TRÌNH =======
            const addCount = newCount - currentCount;

            for (let i = 1; i <= addCount; i++) {
                const dayNumber = currentCount + i;

                const newBlock = document.createElement("div");
                newBlock.classList.add("mb-3", "p-3", "bg-light", "rounded", "lich-item");

                newBlock.innerHTML = `
                    <label>Ngày thứ</label>
                    <input type="number" 
                           name="lich_trinh_new[${dayNumber}][ngay_thu]" 
                           value="${dayNumber}" class="form-control">

                    <label class="mt-2">Tiêu đề</label>
                    <input type="text" 
                           name="lich_trinh_new[${dayNumber}][tieu_de]" 
                           value="Ngày ${dayNumber}" class="form-control">

                    <label class="mt-2">Mô tả / Hoạt động</label>
                    <textarea name="lich_trinh_new[${dayNumber}][hoat_dong]" 
                              class="form-control" rows="3"></textarea>

                    <label class="mt-2">Địa điểm</label>
                    <input type="text" 
                           name="lich_trinh_new[${dayNumber}][dia_diem]" 
                           class="form-control">
                `;

                lichContainer.appendChild(newBlock);
            }

        } else if (newCount < currentCount) {
            // ======= XOÁ LỊCH TRÌNH DƯ =======
            const items = lichContainer.querySelectorAll(".lich-item");

            for (let i = items.length - 1; i >= newCount; i--) {
                items[i].remove();
            }
        }
    });

});
</script>



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
<script>
function removeImage(btn, fileName) {
    const box = btn.closest('.image-box');
    const input = box.querySelector('input[type="hidden"]');

    // Nếu đang đánh dấu xoá → hủy xoá
    if (!input.disabled) {
        input.value = "";
        input.disabled = true;
        box.style.opacity = "1";
        btn.innerText = "×";
        btn.disabled = false;
    } else {
        // Đánh dấu xoá
        input.value = fileName;
        input.disabled = false;
        box.style.opacity = "0.5";
        btn.innerText = "✓";
    }
}

</script>

<style>
    /* ======= LAYOUT 3 CỘT ======= */
#editTourLayout {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 30px;
    margin-top: 20px;
}

/* Cột chung */
.col-col {
    background: #ffffff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    height: fit-content;
}

/* Tiêu đề trong từng cột */
.col-col h4, .col-col h3 {
    font-weight: bold;
    margin-bottom: 18px;
    color: #34495e;
}

/* ======= CỘT 1: ẢNH ======= */
.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
    gap: 10px;
}

.image-grid img {
    width: 100%;
    border-radius: 10px;
    cursor: pointer;
}

/* ======= CỘT 3: LỊCH TRÌNH ======= */
#lichTrinhContainer {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.lich-item {
    background: #f4f7fb;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

/* Hover đẹp */
.lich-item:hover {
    transform: translateY(-3px);
    transition: 0.2s ease;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    #editTourLayout {
        grid-template-columns: 1fr 1fr;
    }
}
@media (max-width: 768px) {
    #editTourLayout {
        grid-template-columns: 1fr;
    }
}

    /* Container lịch trình: chia cột tự động */
#lichTrinhContainer {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

/* Mỗi block lịch trình */
.lich-item {
    background: #f4f7fb;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: 0.3s ease;
}

/* Hover đẹp */
.lich-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
}

    .image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 16px;
}

.image-box {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 12px;
    overflow: hidden;
    background: #f9f9f9;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: box-shadow 0.3s ease;
}

.image-box:hover {
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
}

.image-box img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    display: block;
}

.delete-btn {
    position: absolute;
    top: 6px;
    right: 6px;
    background: rgba(255, 80, 80, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 16px;
    cursor: pointer;
    line-height: 24px;
    text-align: center;
    transition: background 0.3s ease;
}

.delete-btn:hover {
    background: rgba(255, 50, 50, 1);
}

   /* Reset cơ bản */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Container chính */
.col-md-8 {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    padding: 40px;
    border: none;
    transition: all 0.3s ease;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.col-md-8:hover {
    box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    transform: translateY(-3px);
}

/* Tiêu đề */
h3 {
    text-align: center;
    font-weight: 700;
    font-size: 1.8rem;
    color: #34495e;
    margin-bottom: 25px;
    position: relative;
}

h3::after {
    content: "";
    display: block;
    width: 70px;
    height: 4px;
    background: linear-gradient(90deg, #3498db, #2ecc71);
    margin: 12px auto 0;
    border-radius: 2px;
}

/* Label */
.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 6px;
    display: block;
}

/* Input & Select */
.form-control, .form-select {
    border-radius: 12px;
    border: 1px solid #dcdcdc;
    padding: 12px 15px;
    transition: all 0.3s ease;
    font-size: 15px;
    background: #f9f9f9;
}

.form-control:focus, .form-select:focus {
    border-color: #3498db;
    background: #fff;
    box-shadow: 0 0 12px rgba(52, 152, 219, 0.25);
    outline: none;
}

/* Textarea */
textarea.form-control {
    resize: none;
}

/* Buttons */
.btn {
    border-radius: 12px;
    padding: 12px 26px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 15px;
    border: none;
}

.btn-success {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    color: #fff;
    box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(39, 174, 96, 0.4);
}

.btn-secondary {
    background: #bdc3c7;
    color: #2c3e50;
    box-shadow: 0 4px 12px rgba(189, 195, 199, 0.3);
}

.btn-secondary:hover {
    background: #95a5a6;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(149, 165, 166, 0.4);
}

/* Khoảng cách giữa các phần */
.mb-3 {
    margin-bottom: 20px;
}

/* Ảnh hiện tại */
.current-images {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 10px;
}

.image-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
}

.preview-img {
    width: 140px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.preview-img:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

.image-item label {
    font-size: 0.85rem;
    color: #555;
}


</style>