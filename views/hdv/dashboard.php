<?php
if (!isset($_SESSION['hdv'])) {
    header("Location: index.php?act=login");
    exit();
}
$hdv = $_SESSION['hdv']; // lúc này $hdv là mảng
?>
<link rel="stylesheet" href="hdv.css">
<h2>Dashboard HDV</h2>
<p>Chào mừng, </p>
<strong><?= $hdv['ho_ten'] ?></strong><br>
<strong><?= $hdv['email'] ?></strong>
<h4>Tour của bạn</h4>

<table>
    <thead>
        <tr>
            <th>Tên Tour</th>
            <th>Thời gian</th>
            <th>Giá cơ bản</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tours as $tour): ?>
    <tr>
        <td>
            <a href="index.php?act=hdv_tour_detail&id_tour=<?= $tour['id_tour'] ?>" style="cursor: pointer; color: #0066cc; text-decoration: none; font-weight: bold;">
                <?= $tour['ten_tour'] ?>
            </a>
        </td>
        <td><?= $tour['thoi_luong'] ?></td>
        <td><?= number_format($tour['gia_co_ban'], 0, ',', '.') ?> VNĐ</td>
        <td>
            <a href="index.php?act=hdv_lich_trinh&id_tour=<?= $tour['id_tour'] ?>">
                Xem Lịch Trình
            </a>
            |
            <a href="index.php?act=hdv_tour_detail&id_tour=<?= $tour['id_tour'] ?>">
                Chi Tiết
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
