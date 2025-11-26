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
// require_once './controllers/DanhMucController.php';

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



        //  DANH MỤC TOUR
    // case 'DanhMucTour':
    //      if (!isset($_SESSION['admin'])) {
    //         header("Location: index.php?act=login");
    //         exit();
    //     }
    //     danhMucTour();
    // $danhMucController = new DanhMucController();
    // $action = $_GET['action'] ?? 'index';
    // switch ($action) {
    //     case 'index': $danhMucController->index(); break;
    //     case 'addForm': $danhMucController->addForm(); break;
    //     case 'addSubmit': $danhMucController->addSubmit(); break;
    //     case 'editForm': $danhMucController->editForm(); break;
    //     case 'editSubmit': $danhMucController->editSubmit(); break;
    //     case 'delete': $danhMucController->delete(); break;
    //     default: require './views/404.php'; break;
    // }
    // break;

        // TRANG DANH MỤC TOUR
// ------------------- DANH MỤC TOUR CRUD -------------------
case 'danhMuc':
    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?act=login");
        exit();
    }

    $action = $_GET['action'] ?? 'list';

    switch($action){
        case 'add':
            danhMucAdd();
            break;
        case 'edit':
            danhMucEdit();
            break;
        case 'delete':
            danhMucDelete();
            break;
        case 'list':
        default:
            danhMucTour();
            break;
    }
    break;



        // TRANG TOUR DU LỊCH

    // TRANG TOUR DU LỊCH
case 'tour':
    $action = $_GET['action'] ?? 'list';
    switch($action){
        case 'add': tourAdd(); break;
        case 'edit': tourEdit(); break;
        case 'delete': tourDelete(); break;
        case 'view': tourView(); break;
        case 'list':
        default: tourDuLich(); break;
    }
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

        case 'viewDoanKhach':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        viewDoanKhach();
        break;

        case 'editKhach':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        editKhach();
        break;

        case 'addKhach':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        addKhach();
        break;

        case 'deleteKhach':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?act=login");
            exit();
        }
        deleteKhach();
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

            
        case 'hdvHome':
    if (!isset($_SESSION['hdv'])) {
        header("Location: index.php?act=login");
        exit();
    }
    require './views/hdv/home.php'; 
    break;




    default:
        require './views/404.php';
        break;
}
