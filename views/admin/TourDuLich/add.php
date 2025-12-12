<div class="tour-form-container">
    <h3>✨ Thêm Tour Mới</h3>

    <!-- Bắt đầu layout 2 cột -->
    <div class="form-layout">

        <!-- CỘT TRÁI -->
        <div class="left-col">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Ảnh minh họa tour</label>
                    <input type="file" name="anh_tour[]" accept="image/*" class="file-input" multiple>
                    <small>Chọn nhiều ảnh cùng lúc (giữ Ctrl hoặc Shift)</small>
                </div>

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
                    <input type="text" name="ten_tour" placeholder="Nhập tên tour..." required>
                </div>

                <div class="form-group">
                    <label>Số ngày</label>
                    <input type="number" name="so_ngay" id="soNgayInput" min="1" required placeholder="Nhập số ngày của tour">
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
                    <button type="submit" class="btn btn-success">➕ Thêm tour</button>
                    <a href="index.php?act=tour" class="btn btn-secondary">⬅ Quay lại</a>
                </div>

        </div> <!-- end left col -->

        <!-- CỘT PHẢI — LỊCH TRÌNH -->
        <div class="right-col">
            <h3>📅 Lịch trình tour</h3>
            <div id="lichTrinhContainer"></div>
        </div>

    </div> <!-- end layout -->

    </form>
</div>


<script>
document.getElementById('soNgayInput').addEventListener('input', function () {
    const container = document.getElementById('lichTrinhContainer');
    container.innerHTML = '';
    const soNgay = parseInt(this.value);

    if (soNgay > 0) {
        for (let i = 1; i <= soNgay; i++) {
            const html = `
                <div class="form-group lt-item">
                    <h4>📅 Ngày ${i}</h4>

                    <label>Tiêu đề</label>
                    <input type="text" name="lich_trinh[${i}][tieu_de]" required>

                    <label>Hoạt động</label>
                    <textarea name="lich_trinh[${i}][hoat_dong]" rows="2" required></textarea>

                    <label>Địa điểm</label>
                    <input type="text" name="lich_trinh[${i}][dia_diem]" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    }
});
</script>



<style>
/* Tổng thể container */
.tour-form-container {
    max-width: 1200px;
    margin: 30px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

/* Layout 2 cột */
.form-layout {
    display: flex;
    gap: 40px; /* tăng khoảng cách giữa 2 cột */
}

/* Cột trái */
.left-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px; /* cách đều các nhóm form */
}

/* Cột phải */
.right-col {
    flex: 1;
    background: #f9fafc;
    border-left: 3px solid #e0e6ed;
    padding: 25px;
    border-radius: 8px;
    overflow-y: auto;
    max-height: 900px;
    display: flex;
    flex-direction: column;
    gap: 20px; /* cách đều các lịch trình */
}

/* Form group */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px; /* label và input cách nhau */
}

/* Lịch trình từng ngày */
.lt-item {
    background: #fff;
    border: 1px solid #e0e6ed;
    border-radius: 8px;
    padding: 18px;
    margin-bottom: 20px; /* thêm khoảng cách giữa các ngày */
    box-shadow: 0 3px 8px rgba(0,0,0,0.05);
}

.lt-item h4 {
    margin-bottom: 12px;
    color: #2980b9;
    font-size: 1.1rem;
}
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #34495e;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #dcdfe6;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #3498db;
    box-shadow: 0 0 6px rgba(52,152,219,0.3);
    outline: none;
}

/* Nút bấm */
.form-buttons {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.btn {
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s ease;
}

.btn-success {
    background: #27ae60;
    color: #fff;
}

.btn-success:hover {
    background: #219150;
}

.btn-secondary {
    background: #95a5a6;
    color: #fff;
}

.btn-secondary:hover {
    background: #7f8c8d;
}

/* Lịch trình */
/* Input và textarea trong lịch trình */
.lt-item input,
.lt-item textarea {
    width: 95%;   /* chỉ chiếm 70% chiều ngang thay vì 100% */
    max-width: 500px; /* giới hạn tối đa */
    background: #fdfdfd;
    border: 1px solid #b0c4de;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 10px;
}

.lt-item input:focus,
.lt-item textarea:focus {
    border-color: #2980b9;
    box-shadow: 0 0 8px rgba(41,128,185,0.3);
}


.lt-item h4 {
    margin-bottom: 12px;
    color: #2980b9;
    font-size: 1.1rem;
}
</style>
