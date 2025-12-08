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

<table class="modern-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Loại tour</th>
            <th>Thời lượng</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Chính sách</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($list as $tour): ?>
        <tr>
            <td><?= $tour['id_tour'] ?></td>
            <td><?= htmlspecialchars($tour['ten_tour']) ?></td>
            <td><?= htmlspecialchars($tour['ten_danh_muc']) ?></td>
            <td><?= htmlspecialchars($tour['thoi_luong'] ?? '') ?></td>
            <td><?= number_format($tour['gia_co_ban'] ?? 0) ?>đ</td>
            <td><?= htmlspecialchars($tour['mo_ta'] ?? '') ?></td>
            <td><?= htmlspecialchars($tour['chinh_sach'] ?? '') ?></td>
            <td><?= htmlspecialchars($tour['trang_thai_tour']) ?></td>

            <td class="action-buttons">
                <a class="btn-view" href="index.php?act=tour&action=view&id=<?= $tour['id_tour'] ?>">
                    <i class="fa-solid fa-eye"></i>
                </a>

                <a class="btn-edit" href="index.php?act=tour&action=edit&id=<?= $tour['id_tour'] ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <a class="btn-delete" 
                   href="index.php?act=tour&action=delete&id=<?= $tour['id_tour'] ?>"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<style>
.page-title {
    font-size: 28px;
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
    transition: 0.2s;
}

.search-input:focus {
    border-color: #3498db;
}

.search-btn {
    background: #2980b9;
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

.modern-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

.modern-table thead {
    background: #34495e;
    color: white;
}

.modern-table th, 
.modern-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.modern-table tbody tr:hover {
    background: #f5f6fa;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;             /* khoảng cách giữa các nút */
}

.action-buttons a {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 36px;          /* tất cả nút vuông đều nhau */
    height: 36px;
    border-radius: 8px;
    text-decoration: none;
    color: #fff;
    font-size: 16px;
}


.btn-view { background: #3498db; }
.btn-edit { background: #f1c40f; color: black; }
.btn-delete { background: #e74c3c; }

</style>
