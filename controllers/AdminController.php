<?php

function adminDashboard() {
    $title = "Trang quản trị";

    ob_start();
    require './views/admin/dashboard.php';
    $content = ob_get_clean();

    require './views/layout_admin.php';
}

function danhMucTour(){
    ob_start();
    require './views/admin/DanhMucTour/danhMucTour.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function tourDuLich(){
    ob_start();
    require './views/admin/TourDuLich/tourDuLich.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function taoBooking(){
    ob_start();
    require './views/admin/TaoBooking/taoBooking.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function quanLyBooking(){
    ob_start();
    require './views/admin/QuanLyBooking/quanLyBooking.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}


function doanKhach(){
    ob_start();
    require './views/admin/DoanKhach/doanKhach.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function noteKhach(){
    ob_start();
    require './views/admin/NoteKhach/noteKhach.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function nhatKy(){
    ob_start();
    require './views/admin/NhatKy/nhatKyTour.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

function vanHanh(){
    ob_start();
    require './views/admin/BaoCaoVanHanh/baoCaoVanHanh.php'; // load file view tĩnh
    $content = ob_get_clean();

    require './views/layout_admin.php'; // load layout admin
}

require_once './models/nhanSuModel.php';

// Danh sách HDV
function nhanSu() {
    $hdvModel = new HuongDanVien();
    $nhanSuList = $hdvModel->getAll();

    ob_start();
    require './views/admin/NhanSu/nhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Xem chi tiết HDV
function viewNhanSu($id) {
    $hdvModel = new HuongDanVien();
    $hdv = $hdvModel->getById($id);

    if(!$hdv){
        echo "Hướng dẫn viên không tồn tại!";
        exit;
    }

    ob_start();
    require './views/admin/NhanSu/viewNhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Thêm HDV mới
function addNhanSu() {
    $hdvModel = new HuongDanVien();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'avatar' => $_POST['avatar'] ?? '',
            'ho_ten' => $_POST['ho_ten'],
            'gioi_tinh' => $_POST['gioi_tinh'],
            'ngay_sinh' => $_POST['ngay_sinh'],
            'so_cccd' => $_POST['so_cccd'],
            'email' => $_POST['email'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            'id_loai_hdv' => $_POST['id_loai_hdv'],
            'so_nam_kinh_nghiem' => $_POST['so_nam_kinh_nghiem'],
            'dia_chi' => $_POST['dia_chi'],
            'pass' => $_POST['pass'],
            'id_trang_thai_lam_viec_hdv' => $_POST['id_trang_thai_lam_viec_hdv'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $hdvModel->create($data);
        header("Location: index.php?act=nhanSu");
    }

    ob_start();
    require './views/admin/NhanSu/addNhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Sửa HDV
function editNhanSu($id) {
    $hdvModel = new HuongDanVien();
    $hdv = $hdvModel->getById($id);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'avatar' => $_POST['avatar'] ?? '',
            'ho_ten' => $_POST['ho_ten'],
            'gioi_tinh' => $_POST['gioi_tinh'],
            'ngay_sinh' => $_POST['ngay_sinh'],
            'so_cccd' => $_POST['so_cccd'],
            'email' => $_POST['email'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            'id_loai_hdv' => $_POST['id_loai_hdv'],
            'so_nam_kinh_nghiem' => $_POST['so_nam_kinh_nghiem'],
            'dia_chi' => $_POST['dia_chi'],
            'pass' => $_POST['pass'],
            'id_trang_thai_lam_viec_hdv' => $_POST['id_trang_thai_lam_viec_hdv'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $hdvModel->update($id, $data);
        header("Location: index.php?act=nhanSu");
    }

    ob_start();
    require './views/admin/NhanSu/editNhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Xóa HDV
function deleteNhanSu($id) {
    $hdvModel = new HuongDanVien();
    $hdvModel->delete($id);
    header("Location: index.php?act=nhanSu");
}







require_once './models/LichKhoiHanh.php';
require_once './models/TourDuLich.php';

function dieuHanhTour(){
    $lichModel = new LichKhoiHanh();
    $lichKhoiHanhList = $lichModel->getAll();

    ob_start();
    require './views/admin/DieuHanhTour/dieuHanhTour.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Xem chi tiết
function viewLich($id){
    $lichModel = new LichKhoiHanh();
    $lich = $lichModel->getById($id);

    if(!$lich){
        echo "Lịch khởi hành không tồn tại!";
        exit;
    }

    ob_start();
    require './views/admin/DieuHanhTour/viewLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Thêm lịch
function addLich(){
    $lichModel = new LichKhoiHanh();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = [
            'id_tour'=>$_POST['id_tour'],
            'id_hdv'=>$_POST['id_hdv'],
            'dia_diem_khoi_hanh'=>$_POST['dia_diem_khoi_hanh'],
            'dia_diem_den'=>$_POST['dia_diem_den'],
            'ngay_khoi_hanh'=>$_POST['ngay_khoi_hanh'],
            'ngay_ket_thuc'=>$_POST['ngay_ket_thuc'],
            'thong_tin_xe'=>$_POST['thong_tin_xe'],
            'id_trang_thai'=>$_POST['id_trang_thai'],
            'ghi_chu'=>$_POST['ghi_chu']
        ];
        $lichModel->create($data);
        header("Location: index.php?act=dieuHanhTour");
    }

    ob_start();
    require './views/admin/DieuHanhTour/addLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// Sửa
function editLich($id){
    $lichModel = new LichKhoiHanh();
    $tourModel = new TourDuLich();
    $hdvModel = new HuongDanVien();
    $ttModel = new TrangThaiLichKhoiHanh();

    $lich = $lichModel->getById($id);
    $tours = $tourModel->getAll();
    $hdvs = $hdvModel->getAll();
    $ttList = $ttModel->getAll();

    if(!$lich){
        echo "Lịch khởi hành không tồn tại!";
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = [
            'id_tour'=>$_POST['id_tour'],
            'id_hdv'=>$_POST['id_hdv'],
            'dia_diem_khoi_hanh'=>$_POST['dia_diem_khoi_hanh'],
            'dia_diem_den'=>$_POST['dia_diem_den'],
            'ngay_khoi_hanh'=>$_POST['ngay_khoi_hanh'],
            'ngay_ket_thuc'=>$_POST['ngay_ket_thuc'],
            'thong_tin_xe'=>$_POST['thong_tin_xe'],
            'id_trang_thai'=>$_POST['id_trang_thai'],
            'ghi_chu'=>$_POST['ghi_chu']
        ];
        $lichModel->update($id, $data);
        header("Location: index.php?act=dieuHanhTour");
        exit;
    }

    ob_start();
    require './views/admin/DieuHanhTour/editLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}


// Xóa
function deleteLich($id){
    $lichModel = new LichKhoiHanh();
    $lichModel->delete($id);
    header("Location: index.php?act=dieuHanhTour");
}
