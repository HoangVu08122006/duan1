<?php

function showLoginForm() {
    require './views/login.php';
}

function loginHandle() {
    require_once './models/nhanSuModel.php';
    require_once './models/AdminModel.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // ==============================
    // 1. KIỂM TRA ADMIN
    // ==============================
    $admin = getAdminByUsername($username);

    if ($admin && $admin['pass_admin'] == $password) {
        $_SESSION['admin'] = $admin['name_admin'];
        header("Location: index.php?act=dashboard");
        exit();
    }

    // ==============================
    // 2. KIỂM TRA HDV
    // (login bằng email OR họ tên)
    // ==============================
        $nhanSu = new HuongDanVien();
        $hdv = $nhanSu->getHDVByEmailOrName($username);


    if ($hdv && $hdv['pass'] == $password) {
    $_SESSION['hdv'] = $hdv; // ✅ lưu cả mảng dữ liệu HDV
    $_SESSION['id_hdv'] = $hdv['id_hdv'];

    header("Location: index.php?act=hdvHome");
    exit();
}


    // Sai tài khoản
    $error = "Sai tài khoản hoặc mật khẩu!";
    require './views/login.php';
}


function logout() {
    session_destroy();
    header("Location: index.php");
}

