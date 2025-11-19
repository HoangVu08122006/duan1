<?php

function showLoginForm() {
    require './views/login.php';
}

function loginHandle() {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Tài khoản mẫu
    $adminUser = 'admin';
    $adminPass = '123456';

    if ($username == $adminUser && $password == $adminPass) {
        $_SESSION['admin'] = $username;
        header("Location: index.php?act=dashboard");
        exit();
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
        require './views/login.php';
    }
}

function logout() {
    session_destroy();
    header("Location: index.php");
}

