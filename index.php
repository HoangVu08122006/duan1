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

switch ($act) {
    // HOME
    case '/':
        homeIndex();
        break;

    // AUTH
    case 'login':
        showLoginForm();
        break;
    case 'loginHandle':
        loginHandle();
        break;
    case 'logout':
        logout();
        break;

    // DASHBOARD
    case 'dashboard':
        requireAdmin();
        adminDashboard();
        break;

    // DANH MỤC TOUR
    case 'danhMuc':
        requireAdmin();
        switch ($action) {
            case 'add': danhMucAdd(); break;
            case 'edit': danhMucEdit(); break;
            case 'delete': danhMucDelete(); break;
            default: danhMucTour(); break;
        }
        break;

    // TOUR DU LỊCH
    case 'tour':
        requireAdmin();
        switch ($action) {
            case 'add': tourAdd(); break;
            case 'edit': tourEdit(); break;
            case 'delete': tourDelete(); break;
            case 'view': tourDetail(); break; // nếu có
            default: tourDuLich(); break;
        }
        break;

    // BOOKING
    case 'booking':
        requireAdmin();
        switch ($action) {
            case 'add': bookingAdd(); break;
            case 'edit': bookingEdit(); break;
            case 'delete': bookingDelete(); break;
            case 'detail': bookingDetail(); break;
            default: booking(); break;
        }
        break;

    // ĐOÀN KHÁCH
    case 'doanKhach':
        requireAdmin();
        switch ($action) {
            case 'view': viewDoanKhach($id); break;
            case 'addKhach': addKhach(); break;
            case 'editKhach': editKhach(); break;
            case 'deleteKhach': deleteKhach(); break;
            default: doanKhach(); break;
        }
        break;

    // NHÂN SỰ (HDV)
    case 'nhanSu':
        requireAdmin();
        switch ($action) {
            case 'view': viewNhanSu($id); break;
            case 'add': addNhanSu(); break;
            case 'edit': editNhanSu($id); break;
            case 'delete': deleteNhanSu($id); break;
            default: nhanSu(); break;
        }
        break;

    // ĐIỀU HÀNH TOUR
    case 'dieuHanhTour':
        requireAdmin();
        switch ($action) {
            case 'view': viewLich($id); break;
            case 'add': addLich(); break;
            case 'edit': editLich($id); break;
            case 'delete': deleteLich($id); break;
            default: dieuHanhTour(); break;
        }
        break;

    

    // NHẬT KÝ & BÁO CÁO
    case 'nhatKy':
        requireAdmin();
        nhatKy();
        break;
    case 'vanHanh':
        requireAdmin();
        vanHanh();
        break;

    // HDV HOME
    case 'hdvHome':
        requireHdv();
        require __DIR__ . '/views/hdv/home.php';
        break;

    // Quản lý nhà cung cấp
    case 'nhaCungCap':
        requireAdmin();
        switch ($action) {
            default: nhaCungCap(); break;
        }
        break;

    // Quản lý Khách sạn
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


    // 404
    default:
        require __DIR__ . '/views/404.php';
        break;
}
