
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dk.css">
</head>

<body>
    <h1>Quản lý đoàn khách</h1>

<table border="1" cellpadding="10" width="100%">
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



</body>
</html>
