<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <style>
        body { display: flex; margin: 0; }
        .sidebar { width: 200px; background: #eee; padding: 20px; }
        .content { flex: 1; padding: 20px; }
        .sidebar a { display: block; margin: 5px 0; text-decoration: none; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>QUẢN LÝ TOUR</h3>
        <a href="index.php?act=dashboard">Dashboard</a>
        <a href="index.php?act=danhMuc&action=index">Danh mục tour</a>
        <a href="index.php?act=tour">Tour du lịch</a>
        <a href="index.php?act=taoBooking">Booking</a>
        <a href="index.php?act=nhanSu">Danh sách nhân sự</a>
        <a href="index.php?act=dieuHanhTour">Điều hành tour</a>
        <a href="index.php?act=doanKhach">Quản lý đoàn khách</a>
        <a href="index.php?act=noteKhach">Ghi chú khách hàng</a>
        <a href="index.php?act=nhatKy">Nhật ký tour</a>
        <a href="index.php?act=vanHanh">Báo cáo vận hành</a>
    </div>
    <div class="content">
        <?php if (isset($content)) echo $content; ?>
    </div>
</body>
</html>
z