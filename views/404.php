<?php
$title = "404 - Không tìm thấy trang";
ob_start();
?>

<div class="container py-5 text-center">
    <h1 class="display-1 text-danger">404</h1>
    <p class="lead">Trang bạn yêu cầu không tồn tại.</p>
    <a href="index.php?act=dashboard" class="btn btn-primary">Quay về trang chủ</a>
</div>

<?php
$content = ob_get_clean();
require './views/layout_admin.php';
?>
