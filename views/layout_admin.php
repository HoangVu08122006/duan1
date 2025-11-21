<?php
require_once __DIR__ . '/../commons/env.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/admin.css">

</head>

<body>
<div class="admin-container">

    <!-- MENU TRÁI -->
    <?php require_once __DIR__ . '/components/sidebar.php'; ?>

    <!-- PHẦN BÊN PHẢI -->
    <div class="admin-right">
                      
        <!-- HEADER -->
        <?php require_once __DIR__ . '/components/header.php'; ?>

        <!-- NỘI DUNG CHÍNH -->
        <main class="admin-content">
            <?= $content ?>
        </main>

        <!-- FOOTER -->
        <?php require_once __DIR__ . '/components/footer.php'; ?>
    </div>

</div>
</body>
</html>
