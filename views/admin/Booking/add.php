<h1>Thêm Booking mới</h1>

<form action="index.php?act=booking&action=add" method="POST">

    <!-- Chọn Tour kiểu card -->
    <div class="mb-3">
        <label>Chọn Tour:</label>
        <div class="tour-list">
            <?php foreach ($tours as $tour): ?>
                <div class="tour-card selectable" 
                     data-id="<?= $tour['id_tour'] ?>" 
                     data-gia="<?= $tour['gia_co_ban'] ?>">
                    
                     <div class="tour-card-img">
            <?php if (!empty($tour['anh_tour']) && is_array($tour['anh_tour'])): ?>
                <div class="tour-gallery slideshow">
                    <?php foreach ($tour['anh_tour'] as $img): ?>
                        <img src="./uploads/tours/<?= htmlspecialchars($img) ?>" 
                             alt="<?= htmlspecialchars($tour['ten_tour']) ?>">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <img src="./assets/no-image.png" alt="No image">
            <?php endif; ?>
        </div>


                    <div class="tour-card-body">
                        <h3 class="tour-name"><?= htmlspecialchars($tour['ten_tour']) ?></h3>
                        <p class="tour-status"><?= htmlspecialchars($tour['trang_thai_tour']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Input ẩn lưu id tour -->
        <input type="hidden" name="id_tour" id="id_tour_selected" required>
    </div>

    <!-- Ngày khởi hành -->
    <div class="mb-3">
        <label for="ngay_khoi_hanh">Ngày khởi hành:</label>
        <input type="date" name="ngay_khoi_hanh" id="ngay_khoi_hanh" class="form-control" required>
    </div>

    <!-- Ngày kết thúc -->
    <div class="mb-3">
        <label for="ngay_ket_thuc">Ngày kết thúc:</label>
        <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control" required>
    </div>

    <!-- Giá cơ bản -->
    <div class="mb-3">
        <label for="gia_co_ban">Giá cơ bản (VNĐ):</label>
        <input type="number" name="gia_co_ban" id="gia_co_ban" class="form-control" min="0" required>
    </div>

    <!-- Số lượng khách -->
    <div class="mb-3">
        <label for="so_luong_khach">Số lượng khách:</label>
        <input type="number" name="so_luong_khach" id="so_luong_khach" class="form-control" min="1" required>
    </div>

    <!-- Tổng tiền -->
    <div class="mb-3">
        <label for="tong_tien">Tổng tiền:</label>
        <input type="text" id="tong_tien" name="tong_tien" class="form-control" readonly>
    </div>

    <!-- Thông tin khách -->
    <div class="mb-3">
        <label for="ho_ten">Tên khách đặt:</label>
        <input type="text" name="ho_ten" id="ho_ten" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="so_dien_thoai">Số điện thoại:</label>
        <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3">
        <label for="gioi_tinh">Giới tính:</label>
        <select name="gioi_tinh" id="gioi_tinh" class="form-control" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="ghi_chu">Ghi chú:</label>
        <textarea name="ghi_chu" id="ghi_chu" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Thêm Booking</button>
    <a href="index.php?act=booking" class="btn btn-secondary">Quay lại</a>
</form>



<script>
const giaCoBanInput = document.getElementById('gia_co_ban');
const soLuongInput = document.getElementById('so_luong_khach');
const tongTienInput = document.getElementById('tong_tien');

function tinhTongTien() {
    const giaCoBan = parseFloat(giaCoBanInput.value || 0);
    const soLuong = parseInt(soLuongInput.value) || 0;
    const tongTien = giaCoBan * soLuong;
    tongTienInput.value = tongTien.toLocaleString('vi-VN') + ' VNĐ';
}

giaCoBanInput.addEventListener('input', tinhTongTien);
soLuongInput.addEventListener('input', tinhTongTien);


const tourCards = document.querySelectorAll('.tour-card');
const idTourInput = document.getElementById('id_tour_selected');


tourCards.forEach(card => {
    card.addEventListener('click', () => {
        // Bỏ chọn thẻ khác
        tourCards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');

        // Cập nhật input ẩn
        idTourInput.value = card.dataset.id;

        // Cập nhật giá cơ bản
        giaCoBanInput.value = card.dataset.gia;

        // Tính tổng tiền nếu có số lượng
        tinhTongTien();
    });
});

document.querySelectorAll('.tour-gallery').forEach(gallery => {
    const imgs = gallery.querySelectorAll('img');
    let index = 0;
    let interval;

    if (imgs.length > 0) {
        imgs[0].classList.add('active');
    }

    gallery.addEventListener('mouseenter', () => {
        interval = setInterval(() => {
            imgs[index].classList.remove('active');
            index = (index + 1) % imgs.length;
            imgs[index].classList.add('active');
        }, 1500); // đổi ảnh mỗi 1.5s
    });

    gallery.addEventListener('mouseleave', () => {
        clearInterval(interval);
        imgs.forEach(img => img.classList.remove('active'));
        if (imgs.length > 0) imgs[0].classList.add('active');
    });
});
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

</style>
