<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    

    <style>
        /* ================== QUẢN LÝ ĐOÀN KHÁCH ================== */
.admin-content h1 {
    font-size: 24px;
    color: #0f766e;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

/* Ô tìm kiếm căn giữa */
.search-container {
    width: 100%;
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

#searchInput {
    padding: 10px 14px;
    width: 320px;
    font-size: 15px;
    border: 1px solid #0d9488;
    border-radius: 8px;
    outline: none;
    transition: all 0.3s ease;
    background-color: #fff;
}

#searchInput:focus {
    border-color: #0f766e;
    box-shadow: 0 0 6px rgba(13, 148, 136, 0.3);
}

/* Bảng */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

table th,
table td {
    padding: 12px 10px;
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #e2e8f0;
}

table th {
    background: linear-gradient(135deg, #0f766e, #0d9488);
    color: #fff;
    font-weight: 600;
    letter-spacing: 0.3px;
}

table tr:nth-child(even) {
    background-color: #f9fafb;
}

table tr:hover {
    background-color: #ecfdf5;
    transition: 0.2s;
}

/* Liên kết hành động */
table td a {
    display: inline-block;
    background-color: #0d9488;
    color: #fff;
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    transition: all 0.3s ease;
}

table td a:hover {
    background-color: #0f766e;
}

/* Responsive */
@media (max-width: 768px) {
    table {
        font-size: 13px;
    }

    #searchInput {
        width: 100%;
        margin: 0 10px;
    }
}
    </style>
</head>

<body>

    <h1>Quản lý đoàn khách</h1>

    <!-- 🔍 SEARCH CĂN GIỮA -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Tìm kiếm...">
    </div>

    <table id="tableDoanKhach">
        <tr>
            <th>ID</th>
            <th>Tour</th>
            <th>Hướng dẫn viên</th>
            <th>Ngày khởi hành</th>
            <th>Ngày kết thúc</th>
            <th>Số khách</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>

        <?php foreach($list as $row): ?>
        <tr>
            <td><?= $row['id_dat_tour'] ?></td>
            <td><?= $row['ten_tour'] ?></td>
            <td><?= $row['ten_hdv'] ?></td>
            <td><?= $row['ngay_khoi_hanh'] ?></td>
            <td><?= $row['ngay_ket_thuc'] ?></td>
            <td><?= $row['so_luong_khach'] ?></td>
            <td><?= number_format($row['tong_tien']) ?> đ</td>
            <td><?= $row['trang_thai'] ?></td>
            <td>
                <a href="index.php?act=doanKhach&action=view&id=<?= $row['id_dat_tour'] ?>">Xem</a>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    const keyword = this.value.toLowerCase();

    document.querySelectorAll("#tableDoanKhach tr").forEach((row, index) => {
        if (index === 0) return; // bỏ tiêu đề

        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
    });
});
</script>

</body>
</html>
