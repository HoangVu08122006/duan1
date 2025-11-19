<?php

function adminDashboard() {
    $title = "Trang quản trị";

    ob_start();
    require './views/admin/dashboard.php';
    $content = ob_get_clean();

    require './views/layout_admin.php';
}
