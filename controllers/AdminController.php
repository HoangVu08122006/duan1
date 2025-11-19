<?php

function adminDashboard() {
    $title = "Trang quản trị";

    ob_start();
    require './views/admin/dashboard.php';
    $content = ob_get_clean();

    require './views/layout_admin.php';
}

function nhanSu(){
    ob_start();
    require './views/admin/nhanSu.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function dieuHanhTour(){
    ob_start();
    require './views/admin/dieuHanhTour.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function doanKhach(){
    ob_start();
    require './views/admin/doanKhach.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function noteKhach(){
    ob_start();
    require './views/admin/noteKhach.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function nhatKy(){
    ob_start();
    require './views/admin/nhatKyTour.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function vanHanh(){
    ob_start();
    require './views/admin/baoCaoVanHanh.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}
