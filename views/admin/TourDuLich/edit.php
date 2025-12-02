<div class="col-md-8 offset-md-2 p-4">
    <h3>Sửa Tour</h3>
    <form method="POST">

        <!-- Danh mục tour -->
        <div class="mb-3">
            <label class="form-label">Danh mục tour</label>
            <select name="id_danh_muc" class="form-select" required>
                <option value="">--Chọn danh mục--</option>
                <?php foreach($danhMucList as $dm): ?>
                    <option value="<?= $dm['id_danh_muc'] ?>" 
                        <?= ($dm['id_danh_muc'] == $tour['id_danh_muc']) ? 'selected' : '' ?>> 
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
                <?php foreach($trangThaiList as $tt): ?>
                    <option value="<?= $tt['id_trang_thai_tour'] ?>" 
                        <?= ($tt['id_trang_thai_tour'] == $tour['id_trang_thai_tour']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tt['trang_thai_tour']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Khách sạn -->
        <!-- <div class="mb-3">
            <label class="form-label">Khách sạn</label>
            <select name="id_khach_san" class="form-select" required>
                <option value="">--Chọn khách sạn--</option>
                <!-- <?php foreach($khachSanList as $ks): ?>
                    <option value="<?= $ks['id_khach_san'] ?>" 
                        <?= ($ks['id_khach_san'] == $tour['id_khach_san']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ks['ten_khach_san']) ?>
                   </option> -->
                <!-- <?php endforeach; ?> -->
            <!-- </select>
        </div> --> 

        <!-- Nhà hàng
        <div class="mb-3">
            <label class="form-label">Nhà hàng</label>
            <select name="id_nha_hang" class="form-select" required>
                <option value="">--Chọn nhà hàng--</option>
                <!-- <?php foreach($nhaHangList as $nh): ?>
                    <option value="<?= $nh['id_nha_hang'] ?>" 
                        <?= ($nh['id_nha_hang'] == $tour['id_nha_hang']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($nh['ten_nha_hang']) ?>
                    </option>
                <?php endforeach; ?>-->
            <!-- </select>
        </div> --> 
        <!-- Tên tour -->
        <div class="mb-3">
            <label class="form-label">Tên tour</label>
            <input type="text" name="ten_tour" class="form-control" value="<?= htmlspecialchars($tour['ten_tour']) ?>" required>
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta" class="form-control" rows="3"><?= htmlspecialchars($tour['mo_ta']) ?></textarea>
        </div>

        <!-- Thời lượng -->
        <div class="mb-3">
            <label class="form-label">Thời lượng</label>
            <input type="text" name="thoi_luong" class="form-control" value="<?= htmlspecialchars($tour['thoi_luong']) ?>">
        </div>

        <!-- Giá cơ bản -->
        <div class="mb-3">
            <label class="form-label">Giá cơ bản</label>
            <input type="number" name="gia_co_ban" class="form-control" value="<?= $tour['gia_co_ban'] ?>" step="0.01">
        </div>

        <!-- Chính sách -->
        <div class="mb-3">
            <label class="form-label">Chính sách</label>
            <textarea name="chinh_sach" class="form-control" rows="3"><?= htmlspecialchars($tour['chinh_sach']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật tour</button>
          <a href="index.php?act=tour" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<style>
/* Giữ nguyên toàn bộ style của bạn */
.col-md-8 {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
h3 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-weight: 600;
}
.form-label {
    font-weight: 500;
    color: #555;
}
.form-control, .form-select {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 8px 10px;
    transition: 0.3s;
}
.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
    outline: none;
}
textarea.form-control {
    resize: vertical;
}
button.btn-success {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 16px;
    font-weight: 500;
    border-radius: 5px;
    transition: 0.3s;
}
button.btn-success:hover {
    background-color: #d01628ff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
.mb-3 {
    margin-bottom: 1rem !important;
}
@media (max-width: 767px) {
    .col-md-8.offset-md-2 {
        margin: 10px;
        padding: 15px;
    }
}
/* Nút quay lại */
.btn-secondary {
    display: inline-block;
    background-color: #6c757d; /* màu xám chuẩn bootstrap secondary */
    color: #fff;
    text-decoration: none;
    padding: 12px 25px; /* tăng padding để to hơn */
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
     margin-top: 20px;
}

/* Hover */
.btn-secondary:hover {
    background-color: #5a6268; /* tối hơn khi hover */
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

/* Focus */
.btn-secondary:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(108,117,125,0.4);
}
</style>