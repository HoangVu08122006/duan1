<?php
require_once './models/DoanKhach.php';
require_once './models/nhanSuModel.php';
require_once './models/LichKhoiHanh.php';
require_once './models/TourDuLich.php';
require_once './models/DanhMucModel.php';

// ------------------- Trang Admin -------------------
function adminDashboard() {
    $title = "Trang quản trị";
    ob_start();
    require './views/admin/dashboard.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// ------------------- Tour -------------------
// function danhMucTour() {
//     ob_start();
//     require './views/admin/danhMuc/danhMucTour.php';
//     $content = ob_get_clean();
//     require './views/layout_admin.php';
// }
// ------------------- DANH MỤC TOUR CRUD -------------------

function danhMucTour() {  // đổi tên hàm từ danhMucList
    $model = new DanhMucModel();
    $list = $model->getAll();

    ob_start();
    require './views/admin/danhMuc/list.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// controllers/AdminController.php

function danhMucAdd() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'ten_danh_muc' => $_POST['ten_danh_muc'],
            'mo_ta'        => $_POST['mo_ta'] ?? ''
        ];

        $model = new DanhMucModel();
        $model->create($data);

        header("Location: index.php?act=danhMuc");
        exit;
    }

    ob_start();
    require './views/admin/danhMuc/add.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function danhMucEdit() {

    $id = $_GET['id'] ?? 0;
    $model = new DanhMucModel();
    $dm = $model->getOne($id);

    if (!$dm) {
        echo "Danh mục không tồn tại!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        
        $data = [
            'ten_danh_muc' => $_POST['ten_danh_muc'],
            'mo_ta'        => $_POST['mo_ta']
        ];

        $model->update($id, $data);

        header("Location: index.php?act=danhMuc"); // đổi redirect
        exit;
    }

    ob_start();
    require './views/admin/danhMuc/edit.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// function danhMucDelete() {
//     $id = $_GET['id'] ?? 0;
//     $model = new DanhMucModel();
//     $model->delete($id);

//     header("Location: index.php?act=danhMucTour");
// }
function danhMucDelete() {
    $id = $_GET['id'] ?? 0;
    $model = new DanhMucModel();
    $model->delete($id);

    header("Location: index.php?act=danhMuc"); // đổi redirect
    exit;
}


function tourDuLich() {
    ob_start();
    require './views/admin/TourDuLich/tourDuLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// ------------------- Booking -------------------
function taoBooking() {
    ob_start();
    require './views/admin/TaoBooking/taoBooking.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function quanLyBooking() {
    ob_start();
    require './views/admin/QuanLyBooking/quanLyBooking.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// ------------------- Quản lý đoàn khách -------------------
function doanKhach() {
    $model = new DoanKhach();
    $list = $model->getAll();
    ob_start();
    require './views/admin/DoanKhach/doanKhach.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function viewDoanKhach() {
    $id = $_GET['id'] ?? 0;
    $model = new DoanKhach();
    $doan = $model->getOne($id);
    if(!$doan){
        echo "Đoàn khách không tồn tại!";
        exit;
    }
    $khachList = $model->getKhachByDoan($id);
    ob_start();
    require './views/admin/DoanKhach/viewDoanKhach.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function addKhach(){
    $id_dat_tour = $_GET['id'] ?? 0;
    $model = new DoanKhach();
    $trangThaiList = $model->getAllTrangThaiKhach(); // lấy danh sách trạng thái khách

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = [
            'ho_ten' => $_POST['ho_ten'],
            'gioi_tinh' => $_POST['gioi_tinh'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            'ngay_sinh' => $_POST['ngay_sinh'],
            'so_cmnd_cccd' => $_POST['so_cmnd_cccd'],
            'id_trang_thai_khach' => $_POST['id_trang_thai_khach'],
            'ghi_chu' => $_POST['ghi_chu']
        ];
        $model->addKhach($id_dat_tour, $data);
        header("Location: index.php?act=viewDoanKhach&id=$id_dat_tour");
        exit;
    }

    ob_start();
    require './views/admin/DoanKhach/addKhach.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}


function editKhach(){
    $id_khach = $_GET['id_khach'] ?? 0;
    $id_dat_tour = $_GET['id_dat_tour'] ?? 0;
    $model = new DoanKhach();

    // Lấy thông tin khách
    $khach = $model->getKhach($id_khach);
    if(!$khach){
        echo "Khách không tồn tại!";
        exit;
    }

    $trangThaiList = $model->getAllTrangThaiKhach(); // lấy danh sách trạng thái khách

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = [
            'ho_ten' => $_POST['ho_ten'],
            'gioi_tinh' => $_POST['gioi_tinh'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            'ngay_sinh' => $_POST['ngay_sinh'],
            'so_cmnd_cccd' => $_POST['so_cmnd_cccd'],
            'id_trang_thai_khach' => $_POST['id_trang_thai_khach'],
            'ghi_chu' => $_POST['ghi_chu']
        ];
        $model->updateKhach($id_khach, $data);
        header("Location: index.php?act=viewDoanKhach&id=$id_dat_tour");
        exit;
    }

    ob_start();
    require './views/admin/DoanKhach/editKhach.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}



function deleteKhach() {
    $id_khach = $_GET['id_khach'] ?? 0;
    $model = new DoanKhach();
    $khach = $model->getKhach($id_khach);
    if($khach){
        $model->deleteKhach($id_khach);
        header("Location: index.php?act=viewDoanKhach&id=" . $khach['id_dat_tour']);
        exit;
    }
    echo "Khách không tồn tại!";
}

// ------------------- Nhân sự (HDV) -------------------
function nhanSu() {
    $hdvModel = new HuongDanVien();
    $nhanSuList = $hdvModel->getAll();
    ob_start();
    require './views/admin/NhanSu/nhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

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
        exit;
    }
    ob_start();
    require './views/admin/NhanSu/addNhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function editNhanSu($id) {
    $hdvModel = new HuongDanVien();
    $hdv = $hdvModel->getById($id);
    if(!$hdv){
        echo "Hướng dẫn viên không tồn tại!";
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
        exit;
    }

    ob_start();
    require './views/admin/NhanSu/editNhanSu.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function deleteNhanSu($id) {
    $hdvModel = new HuongDanVien();
    $hdvModel->delete($id);
    header("Location: index.php?act=nhanSu");
}

// ------------------- Lịch khởi hành -------------------
function dieuHanhTour() {
    $lichModel = new LichKhoiHanh();
    $lichKhoiHanhList = $lichModel->getAll();
    ob_start();
    require './views/admin/DieuHanhTour/dieuHanhTour.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

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
        exit;
    }
    ob_start();
    require './views/admin/DieuHanhTour/addLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function editLich($id){
    $lichModel = new LichKhoiHanh();
    $tourModel = new TourDuLich();
    $hdvModel = new HuongDanVien();
    $ttModel = new TrangThaiLichKhoiHanh();

    $lich = $lichModel->getById($id);
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

    $tours = $tourModel->getAll();
    $hdvs = $hdvModel->getAll();
    $ttList = $ttModel->getAll();

    ob_start();
    require './views/admin/DieuHanhTour/editLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function deleteLich($id){
    $lichModel = new LichKhoiHanh();
    $lichModel->delete($id);
    header("Location: index.php?act=dieuHanhTour");
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