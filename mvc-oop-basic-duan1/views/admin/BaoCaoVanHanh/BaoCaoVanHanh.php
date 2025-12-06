<style>
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
}

/* Định dạng bảng */
table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 14px;
    background-color: #fdfdfd;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Định dạng tiêu đề cột */
table th {
    background-color: #3498db;
    color: white;
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

/* Định dạng ô dữ liệu */
table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

/* Hiệu ứng khi rê chuột */
table tr:hover {
    background-color: #f1f1f1;
    transition: 0.3s;
}

/* Dòng chẵn có màu nền khác */
table tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Định dạng trạng thái */
td:last-child {
    font-weight: bold;
    color: #27ae60; /* màu xanh cho trạng thái */
}
</style>
<h2>Báo cáo vận hành tour</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID Tour</th>
        <th>Tên Tour</th>
        <th>Khách sạn</th>
        <th>Nhà hàng</th>
        <th>Ngày khởi hành</th>
        <th>Ngày kết thúc</th>
        <th>Hướng dẫn viên</th>
        <th>Số khách</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
    </tr>
    <?php foreach ($list as $row): ?>
    <tr>
        <td><?= htmlspecialchars($row['id_tour'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['ten_tour'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['ten_khach_san'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['ten_nha_hang'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['ngay_khoi_hanh'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['ngay_ket_thuc'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['huong_dan_vien'] ?? '') ?></td>
        <td><?= htmlspecialchars($row['so_luong_khach'] ?? '0') ?></td>
        <td>
            <?php 
                $tongTien = $row['tong_tien'] ?? 0;
                echo number_format((float)$tongTien, 0, ',', '.') . " VND";
            ?>
        </td>
        <td><?= htmlspecialchars($row['trang_thai'] ?? '') ?></td>
    </tr>
    <?php endforeach; ?>
</table>
