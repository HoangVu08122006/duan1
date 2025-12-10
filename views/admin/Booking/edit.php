<h1>Sửa Booking</h1>

<form action="index.php?act=booking&action=edit&id=<?= $booking['id_dat_tour'] ?>" method="POST">
    <?php
// ================== Đưa tour đang chọn lên đầu ==================
$toursSorted = $tours; // clone mảng gốc
$selectedIndex = array_search($booking['id_tour'], array_column($toursSorted, 'id_tour'));
if ($selectedIndex !== false) {
    $selectedTour = $toursSorted[$selectedIndex];
    unset($toursSorted[$selectedIndex]);
    array_unshift($toursSorted, $selectedTour);
}
?>

    <!-- Chọn Tour -->
    <div class="mb-3">
    <label>Chọn Tour:</label>
    <div class="tour-list">
    <?php foreach ($toursSorted as $tour): ?>
        <div class="tour-card selectable <?= ($booking['id_tour'] == $tour['id_tour']) ? 'selected' : '' ?>" 
             data-id="<?= $tour['id_tour'] ?>" 
             data-gia="<?= $tour['gia_co_ban'] ?>">

            <div class="tour-card-img">
                <?php if (!empty($tour['anh_tour']) && is_array($tour['anh_tour'])): ?>
                    <div class="tour-gallery slideshow">
                        <?php foreach ($tour['anh_tour'] as $img): ?>
                            <img src="./uploads/tours/<?= htmlspecialchars($img) ?>" 
                                 alt="<?= htmlspecialchars($tour['ten_tour']) ?>" 
                                 class="<?= ($img === $tour['anh_tour'][0]) ? 'active' : '' ?>">
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <img src="./assets/no-image.png" alt="No image" class="active">
                <?php endif; ?>
            </div>

            <div class="tour-card-body">
                <h3 class="tour-name"><?= htmlspecialchars($tour['ten_tour']) ?></h3>
                <p class="tour-status"><?= htmlspecialchars($tour['trang_thai_tour'] ?? '-') ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>


    <!-- Input ẩn lưu id tour -->
    <input type="hidden" name="id_tour" id="id_tour_selected" value="<?= $booking['id_tour'] ?>" required>
</div>

    <!-- Ngày khởi hành -->
    <div class="mb-3">
        <label for="ngay_khoi_hanh">Ngày khởi hành:</label>
        <input type="date" name="ngay_khoi_hanh" id="ngay_khoi_hanh" class="form-control"
               value="<?= date('Y-m-d', strtotime($booking['ngay_khoi_hanh'])) ?>" required>
    </div>

    <!-- Ngày kết thúc -->
    <div class="mb-3">
        <label for="ngay_ket_thuc">Ngày kết thúc:</label>
        <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control"
               value="<?= date('Y-m-d', strtotime($booking['ngay_ket_thuc'])) ?>" required>
    </div>

    <!-- Giá cơ bản -->
    <div class="mb-3">
        <label for="gia_co_ban">Giá cơ bản (VNĐ/người):</label>
        <input type="number" name="gia_co_ban" id="gia_co_ban" class="form-control" min="0"
               value="<?= htmlspecialchars($booking['gia_co_ban']) ?>" required>
    </div>

    <!-- Nhà xe -->
    <div class="mb-3">
        <label for="id_nha_xe">Nhà xe:</label>
        <select name="id_nha_xe" id="id_nha_xe" class="form-control">
            <option value="">-- Chọn Nhà xe --</option>
            <?php foreach($nhaXeList as $nx): ?>
                <option value="<?= $nx['id_nha_xe'] ?>" <?= ($booking['id_nha_xe'] == $nx['id_nha_xe']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($nx['ten_nha_xe']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Số lượng khách -->
    <div class="mb-3">
        <label for="so_luong_khach">Số lượng khách:</label>
        <input type="number" name="so_luong_khach" id="so_luong_khach" class="form-control" min="1"
               value="<?= htmlspecialchars($booking['so_luong_khach']) ?>" required>
    </div>

    <?php $khachChinh = $booking['khachList'][0] ?? []; ?>
    <div class="mb-3">
        <label for="ho_ten">Tên khách đặt:</label>
        <input type="text" name="ho_ten" id="ho_ten" class="form-control"
               value="<?= htmlspecialchars($khachChinh['ho_ten'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control"
               value="<?= htmlspecialchars($khachChinh['so_dien_thoai'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label for="gioi_tinh">Giới tính:</label>
        <select name="gioi_tinh" id="gioi_tinh" class="form-control" required>
            <option value="Nam" <?= (($khachChinh['gioi_tinh'] ?? '') == 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= (($khachChinh['gioi_tinh'] ?? '') == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
        </select>
    </div>

    <!-- Tổng tiền -->
    <!-- Tổng tiền -->
<div class="mb-3">
    <label for="tong_tien">Tổng tiền:</label>
    <input type="number" name="tong_tien" id="tong_tien" class="form-control" min="0" step="1000"
           value="<?= htmlspecialchars($booking['tong_tien']) ?>" required>
    <small id="tong_tien_display" style="font-weight:600;color:#27ae60;"></small>
</div>


    <!-- Ngày đặt -->
    <div class="mb-3">
        <label for="ngay_dat">Ngày đặt:</label>
        <input type="date" name="ngay_dat" id="ngay_dat" class="form-control"
               value="<?= date('Y-m-d', strtotime($booking['ngay_dat'])) ?>" required>
    </div>

    <!-- Ghi chú -->
    <div class="mb-3">
        <label for="ghi_chu">Ghi chú:</label>
        <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="3"><?= htmlspecialchars($booking['ghi_chu'] ?? '') ?></textarea>
    </div>

    <!-- Trạng thái -->
    <div class="mb-3">
        <label for="trang_thai">Trạng thái:</label>
        <select name="trang_thai" id="trang_thai" class="form-control" required>
            <option value="Chưa thanh toán" <?= ($booking['trang_thai'] == 'Chưa thanh toán') ? 'selected' : '' ?>>Chưa thanh toán</option>
            <option value="Đã thanh toán" <?= ($booking['trang_thai'] == 'Đã thanh toán') ? 'selected' : '' ?>>Đã thanh toán</option>
            <option value="Hủy" <?= ($booking['trang_thai'] == 'Hủy') ? 'selected' : '' ?>>Hủy</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Cập nhật Booking</button>
    <a href="index.php?act=booking" class="btn btn-secondary">Quay lại</a>
</form>
<script>
   const tourCards = document.querySelectorAll('.tour-card');
const idTourInput = document.getElementById('id_tour_selected');
const giaCoBanInput = document.getElementById('gia_co_ban');
const soLuongInput = document.getElementById('so_luong_khach');
const ngayKhoiHanhInput = document.getElementById('ngay_khoi_hanh');
const ngayKetThucInput = document.getElementById('ngay_ket_thuc');
const nhaXeSelect = document.getElementById('id_nha_xe');

const tours = <?= json_encode($tours) ?>;

tourCards.forEach(card => {
    card.addEventListener('click', function() {
        // Xóa class selected cũ
        tourCards.forEach(c => c.classList.remove('selected'));
        this.classList.add('selected');

        const idTour = this.dataset.id;
        idTourInput.value = idTour;

        // Tìm tour trong mảng tours
        const tour = tours.find(t => t.id_tour == idTour);
        if(tour){
            // Cập nhật giá cơ bản
            giaCoBanInput.value = tour.gia_co_ban || 0;

            // Cập nhật ngày khởi hành & kết thúc (nếu có)
            ngayKhoiHanhInput.value = tour.ngay_khoi_hanh || '';
            ngayKetThucInput.value = tour.ngay_ket_thuc || '';

            // Cập nhật nhà xe
            if(nhaXeSelect){
                nhaXeSelect.value = tour.id_nha_xe || '';
            }

            // Cập nhật tổng tiền
            const soLuong = parseInt(soLuongInput.value) || 0;
            const tongTien = (tour.gia_co_ban || 0) * soLuong;
            document.getElementById('tong_tien').value = tongTien;
            document.getElementById('tong_tien_display').textContent = tongTien.toLocaleString('vi-VN') + ' VNĐ';
        }
    });
});



const tongTienInput = document.getElementById('tong_tien');
const tongTienDisplay = document.getElementById('tong_tien_display');

function tinhTongTien() {
    const giaCoBan = parseFloat(giaCoBanInput.value || 0);
    const soLuong = parseInt(soLuongInput.value) || 0;
    const tongTien = giaCoBan * soLuong;

    // gán số thô vào input để submit
    tongTienInput.value = tongTien;

    // hiển thị đẹp ra ngoài
    tongTienDisplay.textContent = tongTien.toLocaleString('vi-VN') + ' VNĐ';
}

giaCoBanInput.addEventListener('input', tinhTongTien);
soLuongInput.addEventListener('input', tinhTongTien);

// chạy khi trang load
window.addEventListener('DOMContentLoaded', tinhTongTien);
</script>


<style>
    /* ================== TOUR LIST ================== */
.tour-list {
    display: flex;              /* hiển thị theo hàng ngang */
    gap: 20px;                  /* khoảng cách giữa các card */
    overflow-x: auto;           /* cho phép cuộn ngang */
    padding: 10px;
    scroll-snap-type: x mandatory; /* cuộn mượt từng card */
}

.tour-card {
    flex: 0 0 220px;            /* cố định chiều rộng card */
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    background: #fff;
    scroll-snap-align: start;   /* card bám vào khi cuộn */
}

.tour-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}

.tour-card.selected {
    border: 2px solid #0d6efd;
    background: #0d6efd;
    color: #fff;
    box-shadow: 0 0 10px rgba(13,110,253,0.4);
}

/* ================== TOUR CARD IMAGE ================== */
.tour-card-img {
    width: 100%;
    height: 150px;              /* khung ảnh cố định */
    overflow: hidden;
    position: relative;
}

.tour-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
}

.tour-card-img img.active {
    display: block;
}

/* ================== TOUR CARD BODY ================== */
.tour-card-body {
    padding: 8px;
}

.tour-name {
    font-size: 0.95rem;
    font-weight: 600;
    margin: 5px 0;
}

.tour-status {
    font-size: 0.85rem;
    color: #ff5722;
}

/* ================== FORM ================== */
form {
    max-width: 700px;
    margin: 40px auto;
    padding: 30px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #0d6efd;
    font-weight: 600;
}

form label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
    color: #333;
}

form input,
form select,
form textarea {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 10px 12px;
    transition: all 0.3s;
}

form input:focus,
form select:focus,
form textarea:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px rgba(13,110,253,0.2);
    outline: none;
}

form button,
form a.btn {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s;
}

form button.btn-success:hover {
    background-color: #198754;
}

form a.btn-secondary:hover {
    background-color: #6c757d;
    color: #fff;
}

.mb-3 {
    margin-bottom: 20px !important;
}

@media (max-width: 768px) {
    form {
        padding: 20px;
        margin: 20px;
    }
}

/* ================== RESET & BASE ================== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 0;
    
    color: #2d3748;
}

/* ================== FORM CONTAINER ================== */
form {
    background: #ffffff;
    border-radius: 12px;
    padding: 30px;
    max-width: 700px;
    margin: 0 auto;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease;
}

/* ================== FORM GROUP ================== */
.mb-3 {
    margin-bottom: 20px;
}

label {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
    display: block;
}

/* ================== INPUT & SELECT ================== */
.form-control {
    width: 100%;
    padding: 12px 14px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #fff;
    color: #2d3748;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    outline: none;
}

.form-control:hover {
    border-color: #cbd5e0;
}

/* ================== TEXTAREA ================== */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* ================== BUTTONS ================== */
.btn {
    border-radius: 8px;
    padding: 12px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
}

.btn-success {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    border: none;
    color: #fff;
}

.btn-success:hover {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    transform: translateY(-2px);
}

.btn-secondary {
    background: #e2e8f0;
    border: none;
    color: #4a5568;
}

.btn-secondary:hover {
    background: #cbd5e0;
    transform: translateY(-2px);
}

/* ================== ANIMATIONS ================== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ================== RESPONSIVE ================== */
@media (max-width: 600px) {
    form {
        padding: 20px;
        margin: 20px;
    }
}


</style>
