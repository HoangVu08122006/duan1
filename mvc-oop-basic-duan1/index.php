<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ----------------- COMMON -----------------
require_once __DIR__ . '/commons/env.php';
require_once __DIR__ . '/commons/function.php';

// ----------------- CONTROLLERS -----------------
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/AdminController.php';

// ----------------- MODELS -----------------
require_once __DIR__ . '/models/NhatKyModel.php'; // thêm model nhật ký
require_once __DIR__ . '/models/TrangThaiLichKhoiHanh.php';
require_once __DIR__ . '/models/LichKhoiHanh.php';
require_once __DIR__ . '/models/TourDuLich.php';
require_once __DIR__ . '/models/nhanSuModel.php';
require_once __DIR__ . '/models/DanhMucModel.php';
require_once __DIR__ . '/models/BookingModel.php';
require_once __DIR__ . '/models/DoanKhach.php';

// ----------------- SESSION -----------------
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ----------------- HELPER -----------------
function requireAdmin() {
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?act=login");
        exit();
    }
}

function requireHdv() {
    if (!isset($_SESSION['hdv'])) {
        header("Location: index.php?act=login");
        exit();
    }
}

// ----------------- ROUTE -----------------
$act = $_GET['act'] ?? '/';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? 0;

// ----------------- Hàm nhatKy -----------------
function nhatKy() {
    $model = new NhatKyModel();
    $list = $model->getAll();

    ob_start();
    require './views/admin/nhatky/list.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// ----------------- Switch route -----------------
switch ($act) {
    case '/':
        homeIndex();
        break;

    case 'login':
        showLoginForm();
        break;

    case 'loginHandle':
        loginHandle();
        break;

    case 'logout':
        logout();
        break;

    case 'dashboard':
        requireAdmin();
        adminDashboard();
        break;

    // ... các case khác như danhMuc, tour, booking, doanKhach, nhanSu, dieuHanhTour ...

    // NHẬT KÝ
    // NHẬT KÝ
case 'nhatKy':
    requireAdmin();
    switch ($action) {
        case 'add':
            nhatKyAdd();
            break;

        case 'detail':
            nhatKyDetail();
            break;

        case 'update':
            nhatKyUpdate(); // nếu có
            break;

        case 'delete':
            nhatKyDelete();
            break;

        default:
            nhatKyList(); // hoặc nhatKy() nếu bạn dùng tên đó
            break;
    }
    break;



    case 'vanHanh':
    requireAdmin();
    vanHanh();
    break;


    case 'hdvHome':
        requireHdv();
        require __DIR__ . '/views/hdv/home.php';
        break;

    // Quản lý nhà cung cấp
    case 'nhaCungCap':
        requireAdmin();
        nhaCungCap();
        break;

    case 'khachSan':
        requireAdmin();
        switch ($action) {
            case 'add': khachSanAdd(); break;
            case 'edit': khachSanEdit(); break;
            case 'delete': khachSanDelete(); break;
            default: khachSan(); break;
        }
        break;

    case 'nhaHang':
        requireAdmin();
        switch ($action) {
            case 'add': nhaHangAdd(); break;
            case 'edit': nhaHangEdit(); break;
            case 'delete': nhaHangDelete(); break;
            default: nhaHang(); break;
        }
        break;

    case 'nhaXe':
        requireAdmin();
        switch ($action) {
            case 'add': nhaXeAdd(); break;
            case 'edit': nhaXeEdit(); break;
            case 'delete': nhaXeDelete(); break;
            default: nhaXe(); break;
        }
        break;

    default:
        require __DIR__ . '/views/404.php';
        break;
}
