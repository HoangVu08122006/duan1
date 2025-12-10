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
require_once __DIR__ . './controllers/HdvController.php';


// ----------------- MODELS -----------------
require_once __DIR__ . '/models/TrangThaiLichKhoiHanh.php';
require_once __DIR__ . '/models/LichKhoiHanh.php';
require_once __DIR__ . '/models/TourDuLich.php';
require_once __DIR__ . '/models/nhanSuModel.php';
require_once __DIR__ . '/models/DanhMucModel.php';
require_once __DIR__ . '/models/BookingModel.php';
require_once __DIR__ . '/models/DoanKhach.php';
require_once __DIR__ . '/models/LichTrinhModel.php';
require_once __DIR__ .'./models/HdvModel.php';


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
            case 'addKhach': addKhach(); break;
            default: booking(); break;
        }
        break;

    // ĐOÀN KHÁCH
    case 'doanKhach':
        requireAdmin();
        switch ($action) {
            case 'view': viewDoanKhach($id); break;
            
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

    // HDV Routes
    case 'hdvHome':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        header("Location: index.php?act=hdv_dashboard");
        exit();
    case 'hdv_dashboard':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->dashboard();
        break;
    case 'hdv_lich_trinh':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->lichTrinh();
        break;
    case 'hdv_khach':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->danhSachKhach();
        break;
    case 'hdv_diem_danh':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->diemDanh();
        break;
    case 'hdv_nhat_ky':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->nhatKy();
        break;
    case 'hdv_nhat_ky_delete':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        require_once __DIR__ . '/models/HdvModel.php';
        $model = new HdvModel();
        $id = $_GET['id'] ?? 0;
        if ($id) {
            $model->deleteNhatKy($id);
        }
        header("Location: index.php?act=hdv_nhat_ky");
        exit;
    case 'hdv_update_yeucau':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->updateYeuCau();
        break;
    case 'hdv_tour_detail':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->tourDetail();
        break;
    case 'hdv_lich_su_tour':
        if (!isset($_SESSION['hdv'])) {
            header("Location: index.php?act=login");
            exit();
        }
        $hdv = new HdvController();
        $hdv->tourHistory();
        break;
    default:
        require './views/404.php';
        break;
}
