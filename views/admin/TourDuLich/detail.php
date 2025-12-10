<div class="container mt-4">

    <!-- Tiêu đề tour -->
    <h2 class="text-primary"><?= htmlspecialchars($tour['ten_tour']) ?></h2>
    <p class="text-muted"><?= htmlspecialchars($tour['mo_ta']) ?></p>

    <div class="tour-content">
        <!-- Cột trái -->
        <div class="tour-left">
            <!-- Ảnh tour -->
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

            <!-- Thông tin cơ bản -->
            <h3 class="section-title">📌 Thông tin cơ bản</h3>
            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Danh mục:</strong> <?= htmlspecialchars($tour['ten_danh_muc'] ?? 'Chưa có') ?></p>
                <p><strong>Trạng thái:</strong> <?= htmlspecialchars($tour['trang_thai'] ?? 'Chưa có') ?></p>
                <p><strong>Khách sạn:</strong> <?= htmlspecialchars($tour['ten_khach_san'] ?? 'Chưa có') ?></p>
                <p><strong>Nhà hàng:</strong> <?= htmlspecialchars($tour['ten_nha_hang'] ?? 'Chưa có') ?></p>
                <p><strong>Xe:</strong> <?= htmlspecialchars($tour['nha_xe'] ?? 'Chưa có') ?></p>
                <p><strong>Giá cơ bản:</strong> <?= htmlspecialchars($tour['gia'] ?? 'Chưa có') ?></p>
            </div>
        </div>

        <!-- Cột phải -->
        <div class="tour-right">
            <!-- Chính sách -->
            <h3 class="section-title">📑 Chính sách</h3>
            <div class="card mb-3 shadow-sm p-3">
                <p><?= nl2br(htmlspecialchars($tour['chinh_sach'] ?? 'Chưa có')) ?></p>
            </div>

            <!-- Thông tin khởi hành -->
            <h3 class="section-title text-warning">🚌 Thông tin khởi hành</h3>
            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Địa điểm xuất phát:</strong> <?= htmlspecialchars($tour['dia_diem_xuat_phat'] ?? 'Chưa có') ?></p>
                <p><strong>Địa điểm đến:</strong> <?= htmlspecialchars($tour['dia_diem_den'] ?? 'Chưa có') ?></p>
                <p><strong>Ngày khởi hành:</strong> <?= htmlspecialchars($tour['ngay_khoi_hanh'] ?? 'Chưa có') ?></p>
                <p><strong>Ngày kết thúc:</strong> <?= htmlspecialchars($tour['ngay_ket_thuc'] ?? 'Chưa có') ?></p>
            </div>

            <!-- Lịch trình -->
            <h3 class="section-title text-success mb-3">🗺️ Lịch trình tour</h3>
            <?php if (!empty($lichTrinh)): ?>
                <?php foreach ($lichTrinh as $lt): ?>
                    <div class="card p-3 shadow-sm mb-3">
                        <p><strong>Ngày thứ:</strong> <?= $lt['ngay_thu'] ?></p>
                        <p><strong>Tiêu đề:</strong> <?= htmlspecialchars($lt['tieu_de']) ?></p>
                        <p><strong>Hoạt động:</strong><br> <?= nl2br(htmlspecialchars($lt['hoat_dong'])) ?></p>
                        <p><strong>Địa điểm:</strong> <?= htmlspecialchars($lt['dia_diem']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Chưa có lịch trình cho tour này.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="index.php?act=tour" class="btn btn-secondary">⬅ Quay lại</a>
</div>

<script>
document.querySelectorAll('.slideshow').forEach(slideshow => {
    const imgs = slideshow.querySelectorAll('img');
    let index = 0;
    if (imgs.length > 0) {
        imgs[0].classList.add('active');
    }

    let interval;
    slideshow.addEventListener('mouseenter', () => {
        interval = setInterval(() => {
            imgs[index].classList.remove('active');
            index = (index + 1) % imgs.length;
            imgs[index].classList.add('active');
        }, 1000); // đổi ảnh mỗi 1.5s
    });

    slideshow.addEventListener('mouseleave', () => {
        clearInterval(interval);
        // reset về ảnh đầu tiên
        imgs.forEach(img => img.classList.remove('active'));
        if (imgs.length > 0) imgs[0].classList.add('active');
    });
});
</script>


<style>
    /* Layout 2 cột */
.tour-content {
    display: grid;
    grid-template-columns: 40% 60%; /* trái 40%, phải 60% */
    gap: 30px;
    margin-top: 20px;
}

/* Cột trái */
.tour-left {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

/* Cột phải */
.tour-right {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

/* Responsive: màn hình nhỏ thì về 1 cột */
@media (max-width: 768px) {
    .tour-content {
        grid-template-columns: 1fr;
    }
}


   .tour-gallery {
    position: relative;
    width: 100%;
    height: 450px;
    overflow: hidden;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    background: #000;
}

.tour-gallery img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
    animation: fadeIn 1s ease;
}

.tour-gallery img.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0.4; }
    to { opacity: 1; }
}

/* Nút điều hướng */
.tour-gallery .prev,
.tour-gallery .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.7);
    border: none;
    padding: 10px 14px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    transition: background 0.3s;
}

.tour-gallery .prev:hover,
.tour-gallery .next:hover {
    background: rgba(255,255,255,0.95);
}

.tour-gallery .prev { left: 15px; }
.tour-gallery .next { right: 15px; }

/* Reset cơ bản */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Container chính */
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

/* Tiêu đề tour */
h2.text-primary {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: #0078d7;
    text-align: center;
}

p.text-muted {
    font-size: 1.1rem;
    color: #555;
    text-align: center;
    margin-bottom: 20px;
}

/* Section title */
.section-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin: 30px 0 15px;
    color: #2c3e50;
    border-left: 5px solid #0078d7;
    padding-left: 10px;
}

/* Card chung */
.card {
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 20px;
    margin-bottom: 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.card p {
    margin: 8px 0;
    font-size: 1rem;
    line-height: 1.5;
}

.card strong {
    color: #0078d7;
}

/* Slideshow ảnh */
.tour-gallery {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    background: #000;
    margin-bottom: 20px;
}

.tour-gallery img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: none;
    animation: fadeIn 1s ease;
}

.tour-gallery img.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0.3; }
    to { opacity: 1; }
}

/* Nút điều hướng slideshow */
.tour-gallery .prev,
.tour-gallery .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.8);
    border: none;
    padding: 12px 16px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 22px;
    transition: all 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.tour-gallery .prev:hover,
.tour-gallery .next:hover {
    background: #fff;
    transform: translateY(-50%) scale(1.1);
}

.tour-gallery .prev { left: 20px; }
.tour-gallery .next { right: 20px; }

/* Indicator dots */
.tour-gallery .dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
}

.tour-gallery .dots span {
    width: 12px;
    height: 12px;
    background: rgba(255,255,255,0.6);
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}

.tour-gallery .dots span.active {
    background: #fff;
    transform: scale(1.2);
}

/* Nút quay lại */
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
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    margin-top: 20px;
}

.btn-secondary:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

</style>