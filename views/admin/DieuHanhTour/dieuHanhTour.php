<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    
</head>
<style>
    /* ================== QUẢN LÝ LỊCH KHỞI HÀNH ================== */
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
    border-color: #0f766e;
    box-shadow: 0 0 6px rgba(13, 148, 136, 0.3);
}

/* Nút thêm */
.admin-content .add-btn {
    background: linear-gradient(135deg, #0f766e, #0d9488);
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
    background: linear-gradient(135deg, #0d9488, #0f766e);
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
    <h1>Quản lý lịch khởi hành & phân bổ nhân sự</h1>
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Tìm theo Tour/HDV...">
    </div>
    <button class="add-btn" onclick="location.href='index.php?act=dieuHanhTour&action=add'">Thêm lịch mới</button>

    <table id="lichTable">
        <thead>
            <tr>
                <th>Tour</th>
                <th>Ngày KH</th>
                <th>Ngày KT</th>
                <th>HDV chính</th>
                <th>Điểm khởi hành</th>
                <th>Điểm đến</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lichKhoiHanhList as $lich): ?>
            <tr>
                <td><?= $lich['ten_tour'] ?></td>
                <td><?= $lich['ngay_khoi_hanh'] ?></td>
                <td><?= $lich['ngay_ket_thuc'] ?></td>
                <td><?= $lich['hdv_chinh'] ?></td>
                <td><?= $lich['dia_diem_khoi_hanh'] ?></td>
                <td><?= $lich['dia_diem_den'] ?></td>
                <td><?= $lich['ghi_chu'] ?></td>
                <td><?= $lich['trang_thai_lich_khoi_hanh'] ?></td>
                <td>
                    <button class="view" onclick="location.href='index.php?act=dieuHanhTour&action=view&id=<?= $lich['id_lich'] ?>'">Chi tiết</button>
                    <button class="edit" onclick="location.href='index.php?act=dieuHanhTour&action=edit&id=<?= $lich['id_lich'] ?>'">Sửa</button>
                    <button class="delete" onclick="if(confirm('Bạn có chắc muốn xóa?')) location.href='index.php?act=dieuHanhTour&action=delete&id=<?= $lich['id_lich'] ?>'">Xóa</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
    document.getElementById('searchInput').addEventListener('keyup', function(){
        const filter = this.value.toLowerCase();
        document.querySelectorAll('#lichTable tbody tr').forEach(row=>{
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter)?'':'none';
        });
    });
    </script>
</body>
</html>

