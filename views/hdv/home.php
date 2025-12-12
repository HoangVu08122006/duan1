<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HDV Panel</title>
    <link rel="stylesheet" href="hdv.css">
</head>

<body>

<div class="hdv-container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>HDV Panel</h2>

        <ul class="menu">
            <li><a href="index.php?act=hdv_dashboard">Dashboard</a></li>
            <li><a href="index.php?act=hdv_lich_trinh">Lịch trình</a></li>
            <li><a href="index.php?act=hdv_nhat_ky">Nhật ký</a></li>
            <li><a href="index.php?act=hdv_lich_su_tour">Lịch sử tour</a></li>
        </ul>

        <div class="logout-box">
            <a href="index.php?act=logout"
               onclick="return confirm('Bạn có chắc muốn đăng xuất không?')">
               Đăng xuất
            </a>
        </div>
    </div>

    <!-- PHẦN BÊN PHẢI -->
<div class="hdv-right">
    <?php
    if (isset($view_hdv_content) && file_exists($view_hdv_content)) {
        require $view_hdv_content;
    } else {
        echo "<p style='color:red;'>Không tìm thấy file giao diện!</p>";
    }
    ?>
</div>
</body>
</html>
