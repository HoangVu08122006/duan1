<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<h1 class="page-title"><i class="fa-solid fa-map-location-dot"></i> Danh sách Tour</h1>

<form method="GET" action="" class="search-box">
    <input type="hidden" name="act" value="tour">
    <input type="text" 
           name="search" 
           placeholder="🔎 Tìm theo tên tour..." 
           value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
           class="search-input">
    <button type="submit" class="search-btn">
        <i class="fa-solid fa-magnifying-glass"></i> Tìm
    </button>
</form>

<a href="index.php?act=tour&action=add" class="btn-add">
    <i class="fa-solid fa-circle-plus"></i> Thêm tour mới
</a>
<div class="tour-list">
    <?php foreach ($list as $tour): ?>
    <!-- Toàn bộ card có thể click -->
    <div class="tour-card" 
         onclick="window.location.href='index.php?act=tour&action=view&id=<?= $tour['id_tour'] ?>'">
        
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

        <!-- Nội dung -->
        <div class="tour-card-body">
            <h3 class="tour-name"><?= htmlspecialchars($tour['ten_tour']) ?></h3>
            <p class="tour-category"><?= htmlspecialchars($tour['ten_danh_muc']) ?></p>
            <p class="tour-desc"><?= htmlspecialchars($tour['mo_ta'] ?? '') ?></p>
            <p class="tour-status">Trạng thái: <?= htmlspecialchars($tour['trang_thai_tour']) ?></p>

            <!-- Chỉ giữ lại nút Sửa / Xóa -->
            <div class="tour-actions">
                <a class="btn-edit" href="index.php?act=tour&action=edit&id=<?= $tour['id_tour'] ?>"
                   onclick="event.stopPropagation();">
                    <i class="fa-solid fa-pen-to-square"></i> Sửa
                </a>
                <a class="btn-delete" href="index.php?act=tour&action=delete&id=<?= $tour['id_tour'] ?>"
                   onclick="event.stopPropagation(); return confirm('Bạn có chắc chắn muốn xóa?')">
                    <i class="fa-solid fa-trash"></i> Xóa
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>




<script>
function toggleDetail(el) {
    const detail = el.nextElementSibling;
    detail.classList.toggle("show");
}
</script>
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
    .tour-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
    cursor: pointer; /* hiển thị bàn tay khi hover */
}
.tour-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    background-color: #fafafa; /* highlight nhẹ khi hover */
}

    .slideshow {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
}
.slideshow img {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 180px;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.8s ease;
}
.slideshow img.active {
    opacity: 1;
}

.page-title {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Search */
.search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}
.search-input {
    flex: 1;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
}
.search-btn {
    background: #ff5722;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}
.btn-add {
    display: inline-block;
    margin-bottom: 15px;
    background: #27ae60;
    padding: 10px 15px;
    border-radius: 8px;
    color: #fff;
    font-weight: 500;
    text-decoration: none;
}

.tour-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.tour-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: pointer;
}
.tour-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}

.tour-card-img img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
}

.tour-card-body {
    padding: 15px;
}
.tour-name {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}
.tour-category {
    font-size: 0.95rem;
    color: #888;
    margin-bottom: 6px;
}
.tour-desc {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 8px;
    height: 40px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.tour-status {
    font-size: 0.9rem;
    color: #ff5722;
    margin-bottom: 10px;
}

.tour-actions {
    display: flex;
    gap: 8px;
}
.tour-actions a {
    flex: 1;
    text-align: center;
    padding: 8px;
    border-radius: 6px;
    font-size: 0.9rem;
    text-decoration: none;
    color: #fff;
    transition: 0.2s;
}
.btn-view { background: #3498db; }
.btn-edit { background: #f1c40f; color: #000; }
.btn-delete { background: #e74c3c; }
.btn-view:hover { background: #2980b9; }
.btn-edit:hover { background: #d4ac0d; }
.btn-delete:hover { background: #c0392b; }

.btn-view { background: #3498db; }
.btn-edit { background: #f1c40f; color: #000; }
.btn-delete { background: #e74c3c; }

/* Chi tiết ẩn/hiện */
.order-detail {
    display: none;
    padding: 15px;
    border-top: 1px solid #eee;
    font-size: 0.95rem;
    color: #555;
}
.order-detail.show {
    display: block;
}
</style>
