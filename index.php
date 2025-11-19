<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Common
require_once './commons/env.php';
require_once './commons/function.php';


// Controller
require_once './controllers/HomeController.php';
require_once './controllers/AuthController.php';
require_once './controllers/AdminController.php'; // dashboard

// Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Route
$act = $_GET['act'] ?? '/';

switch ($act) {

    // Trang chủ
    case '/':
        homeIndex();
        break;

    // LOGIN
    case 'login':
        showLoginForm();
        break;

    case 'loginHandle':
        loginHandle();
        break;

    case 'logout':
        logout();
        break;

    // TRANG ADMIN
    case 'dashboard':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        adminDashboard();
        break;

    // TRANG DANH SÁCH NHÂN SỰ
    case 'nhanSu':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        nhanSu();
        break;

        // TRANG ĐIỀU HÀNH TOUR
    case 'dieuHanhTour':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        dieuHanhTour();
        break;

        // TRANG QUẢN LÝ ĐOÀN KHÁCH
    case 'doanKhach':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        doanKhach();
        break;

        // TRANG GHI CHÚ KHÁCH HÀNG
    case 'noteKhach':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        noteKhach();
        break;

        // TRANG NHẬT KÝ TOUR
    case 'nhatKy':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        nhatKy();
        break;

        // TRANG BÁO CÁO VẬN HÀNH
    case 'vanHanh':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        vanHanh();
        break;

    default:
        require './views/404.php';
        break;
}
