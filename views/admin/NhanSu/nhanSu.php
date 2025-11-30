<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Danh sách nhân sự</title>

</head>
<style>
    /* ================== DANH SÁCH NHÂN SỰ ================== */
.admin-content h1 {
    font-size: 24px;
    color: #0f766e;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

/* Ô tìm kiếm */
.admin-content .search-box {
    text-align: right;
    margin-bottom: 15px;
}

.admin-content .search-box input {
    padding: 8px 14px;
    width: 260px;
    font-size: 14px;
    border: 1px solid #0d9488;
    border-radius: 8px;
    outline: none;
    transition: all 0.3s ease;
    background-color: #fff;
}

.admin-content .search-box input:focus {
    border-color: #14b8a6;
    box-shadow: 0 0 6px rgba(13, 148, 136, 0.3);
}

/* Nút thêm */
.admin-content .add-btn {
    background: linear-gradient(135deg, #0d9488, #14b8a6);
    color: #fff;
    border: none;
    padding: 9px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 18px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}

.admin-content .add-btn:hover {
    background: linear-gradient(135deg, #0f766e, #0d9488);
    transform: translateY(-2px);
}

/* Bảng */
.admin-content table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.admin-content table th,
.admin-content table td {
    padding: 12px 10px;
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #e2e8f0;
}

.admin-content table th {
    background: linear-gradient(135deg, #0d9488, #14b8a6);
    color: #fff;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.admin-content table tr:nth-child(even) {
    background-color: #f9fafb;
}

.admin-content table tr:hover {
    background-color: #ecfdf5;
    transition: 0.2s;
}

/* Ảnh đại diện */
.admin-content table td img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #0d9488;
}

/* Nút hành động */
.admin-content table td button {
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    margin: 2px;
    color: #fff;
    transition: all 0.3s ease;
}

.admin-content table td button.view {
    background-color: #0ea5e9;
}
.admin-content table td button.view:hover {
    background-color: #0284c7;
}

.admin-content table td button.edit {
    background-color: #22c55e;
}
.admin-content table td button.edit:hover {
    background-color: #16a34a;
}

.admin-content table td button.delete {
    background-color: #ef4444;
}
.admin-content table td button.delete:hover {
    background-color: #dc2626;
}

/* Responsive */
@media (max-width: 768px) {
    .admin-content table {
        font-size: 13px;
    }

    .admin-content .search-box input {
        width: 100%;
        margin-bottom: 10px;
    }

    .admin-content .add-btn {
        width: 100%;
    }
}
</style>
<body>

<h1>Danh sách nhân sự</h1>
<div class="search-box">
    <input type="text" id="searchInput" placeholder="Tìm theo tên hoặc SĐT...">
</div>
<button class="add-btn" 
        onclick="location.href='index.php?act=nhanSu&action=add'">
    Thêm HDV mới
</button>


<table id="nhanSuTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>SĐT</th>
            <th>Chuyên môn</th>
            <th>Tình trạng</th>
            <th>Ghi chú</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($nhanSuList as $hdv): ?>
        <tr>
            <td data-label="ID"><?= $hdv['id_hdv'] ?></td>
            <td data-label="Avatar"><?php if($hdv['avatar']): ?><img src="<?= $hdv['avatar'] ?>" alt="Avatar"><?php endif; ?></td>
            <td data-label="Họ và tên"><?= $hdv['ho_ten'] ?></td>
            <td data-label="Giới tính"><?= $hdv['gioi_tinh'] ?></td>
            <td data-label="Ngày sinh"><?= $hdv['ngay_sinh'] ?></td>
            <td data-label="SĐT"><?= $hdv['so_dien_thoai'] ?></td>
            <td data-label="Chuyên môn"><?= $hdv['loai_hdv'] ?></td>
            <td data-label="Tình trạng"><?= $hdv['trang_thai_lam_viec_hdv'] ?></td>
            <td data-label="Ghi chú"><?= $hdv['mo_ta'] ?></td>
            <td data-label="Hành động">
                <button class="view" 
        onclick="location.href='index.php?act=nhanSu&action=view&id=<?= $hdv['id_hdv'] ?>'">
    Chi tiết
</button>

<button class="edit" 
        onclick="location.href='index.php?act=nhanSu&action=edit&id=<?= $hdv['id_hdv'] ?>'">
    Sửa
</button>

<button class="delete" 
        onclick="return confirm('Bạn có chắc muốn xóa?') 
            ? location.href='index.php?act=nhanSu&action=delete&id=<?= $hdv['id_hdv'] ?>' 
            : false;">
    Xóa
</button>

            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// Lọc bảng theo input
document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#nhanSuTable tbody tr');
    rows.forEach(row => {
        const name = row.querySelector('td[data-label="Họ và tên"]').textContent.toLowerCase();
        const phone = row.querySelector('td[data-label="SĐT"]').textContent.toLowerCase();
        if(name.includes(filter) || phone.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

</body>
</html>
