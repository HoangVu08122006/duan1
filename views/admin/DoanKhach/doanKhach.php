<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dk.css">

    <style>
        /* Căn giữa ô search */
        .search-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        #searchInput {
            padding: 8px 12px;
            width: 300px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
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
                <a href="index.php?act=viewDoanKhach&id=<?= $row['id_dat_tour'] ?>">Xem</a>
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
