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
require_once './controllers/DanhMucController.php';

// Models
require_once './models/TrangThaiLichKhoiHanh.php';
require_once './models/LichKhoiHanh.php';
require_once './models/TourDuLich.php';
require_once './models/nhanSuModel.php';
require_once './models/DanhMucModel.php';


// Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Route
$act =$_GET['act'] ?? '/';  



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



         // DANH MỤC TOUR
    case 'danhMuc':
        $danhMucController = new DanhMucController();
        $action = $_GET['action'] ?? 'index';
        switch ($action) {
            case 'index':
                $danhMucController->index();
                break;
            case 'addForm':
                $danhMucController->addForm();
                break;
            case 'addSubmit':
                $danhMucController->addSubmit();
                break;
            case 'editForm':
                $danhMucController->editForm();
                break;
            case 'editSubmit':
                $danhMucController->editSubmit();
                break;
            case 'delete':
                $danhMucController->delete();
                break;
            default:
                require './views/404.php';
                break;
        }
        break;

        // TRANG DANH MỤC TOUR
    case 'danhMuc':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        danhMucTour();
        break;

        // TRANG TOUR DU LỊCH
    case 'tour':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        tourDuLich();
        break;

        // TRANG TẠO BOOKING
    case 'taoBooking':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        taoBooking();
        break;

        // TRANG QUẢN LÝ BOOKING
    case 'trangThaiBooking':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        quanLyBooking();
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

        case 'nhanSu':
            nhanSu(); break;
        case 'viewNhanSu':
            $id = $_GET['id'] ?? 0;
            viewNhanSu($id); break;
        case 'addNhanSu':
            addNhanSu(); break;
        case 'editNhanSu':
            $id = $_GET['id'] ?? 0;
            editNhanSu($id); break;
        case 'deleteNhanSu':
            $id = $_GET['id'] ?? 0;
            deleteNhanSu($id); break;

        case 'dieuHanhTour': dieuHanhTour(); 
        break;
        case 'viewLich':
            $id = $_GET['id'] ?? 0; 
            viewLich($id); break;
        case 'addLich': addLich(); break;
        case 'editLich':
            $id = $_GET['id'] ?? 0; editLich($id); break;
        case 'deleteLich':
            $id = $_GET['id'] ?? 0; deleteLich($id); break;



    default:
        require './views/404.php';
        break;
}
