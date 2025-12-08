<?php
require_once './models/DoanKhach.php';
require_once './models/nhanSuModel.php';
require_once './models/LichKhoiHanh.php';
require_once './models/TourDuLich.php';
require_once './models/DanhMucModel.php';
require_once './models/BookingModel.php';
require_once './models/khachSanModel.php';
require_once './models/nhaHangModel.php';
require_once './models/nhaXeModel.php';
require_once './models/LichTrinhModel.php';



// ------------------- Trang Admin -------------------

function adminDashboard() {
    $tourModel     = new TourDuLich();
    $bookingModel  = new BookingModel();
    $lichModel     = new LichKhoiHanh();
    $hdvModel      = new HuongDanVien();
    $ksModel       = new KhachSanModel();
    $nhModel       = new NhaHangModel();
    $xeModel       = new NhaXeModel();

    $data = [
        'totalTours'         => $tourModel->getAll() ?? [],
        'activeTours'        => $tourModel->countActiveTours() ?? 0,
        'totalBookings'      => $bookingModel->getAll() ?? [],
        'monthlyRevenue'     => $bookingModel->getMonthlyRevenue() ?? [],
        'upcomingDepartures' => $lichModel->getUpcomingDepartures(7) ?? [],
        'totalHDV'           => $hdvModel->getAll() ?? [],
        'totalKhachSan'      => $ksModel->getAll() ?? [],
        'totalNhaHang'       => $nhModel->getAll() ?? [],
        'totalNhaXe'         => $xeModel->getAll() ?? [],
    ];

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
    try {
        $model->delete($id);
        header("Location: index.php?act=danhMuc");
        exit;
    } catch (Exception $e) {
        echo $e->getMessage(); // "Không thể xóa danh mục vì còn tour liên quan!"
    }
}



//require_once './models/TourDuLich.php';

// ------------------- Tour -------------------
function tourDuLich() {
    $model = new TourDuLich();
    $search = $_GET['search'] ?? '';
    $list = $model->getAll($search);

    ob_start();
    require './views/admin/TourDuLich/list.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}
function tourAdd()
{
    $model = new TourDuLich();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_khach_san = $_POST['id_khach_san'] ?? null;
        $id_nha_hang = $_POST['id_nha_hang'] ?? null;
        $id_xe = $_POST['id_xe'] ?? null;

        if (!$id_khach_san || !$id_nha_hang || !$id_xe) {
            die("Vui lòng chọn khách sạn, nhà hàng và xe!");
        }

        $data = [
            'id_danh_muc' => $_POST['id_danh_muc'],
            'id_trang_thai_tour' => $_POST['id_trang_thai_tour'],
            'id_khach_san' => $id_khach_san,
            'id_nha_hang' => $id_nha_hang,
            'id_xe' => $id_xe,
            'ten_tour' => $_POST['ten_tour'],
            'mo_ta' => $_POST['mo_ta'],
            'thoi_luong' => $_POST['thoi_luong'],
            'gia_co_ban' => $_POST['gia_co_ban'],
            'chinh_sach' => $_POST['chinh_sach']
        ];

        // Tạo tour
        $model->create($data);
        $id_tour = $model->getLastInsertId();

        // Tạo lịch khởi hành
        $model->createLichKhoiHanh([
            'id_tour' => $id_tour,
            'id_hdv' => null,
            'dia_diem_khoi_hanh' => '',
            'dia_diem_den' => '',
            'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'],
            'ngay_ket_thuc' => $_POST['ngay_ket_thuc'],
            'thong_tin_xe' => '',
            'id_trang_thai_lich_khoi_hanh' => 1,
            'ghi_chu' => ''
        ]);

        header('Location: index.php?act=tour');
        exit();
    }

    // Lấy dữ liệu cho form
    $danhMucList = $model->getAllDanhMuc();
    $trangThaiList = $model->getAllTrangThai();
    $khachSanList = $model->getAllKhachSan();
    $nhaHangList = $model->getAllNhaHang();
    $xeList = $model->getAllXe();

    ob_start();
    require './views/admin/TourDuLich/add.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function tourEdit() {
    $model = new TourDuLich();
    $id = $_GET['id'] ?? 0;
    $tour = $model->getOne($id);

    if (!$tour) {
        echo "Tour không tồn tại!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'id_danh_muc' => $_POST['id_danh_muc'],
            'id_trang_thai_tour' => $_POST['id_trang_thai_tour'],
            'id_khach_san' => $_POST['id_khach_san'],
            'id_nha_hang' => $_POST['id_nha_hang'],
            'id_xe' => $_POST['id_xe'],
            'ten_tour' => $_POST['ten_tour'],
            'mo_ta' => $_POST['mo_ta'],
            'thoi_luong' => $_POST['thoi_luong'],
            'gia_co_ban' => $_POST['gia_co_ban'],
            'chinh_sach' => $_POST['chinh_sach']
        ];

        $model->update($id, $data);

        // cập nhật lịch khởi hành nếu cần
        $lich = $model->getLichKhoiHanhByTour($id);
        if ($lich) {
            $model->updateLichKhoiHanh($lich['id_lich'], [
                'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'],
                'ngay_ket_thuc' => $_POST['ngay_ket_thuc'],
                'id_lich' => $lich['id_lich']
            ]);
        }

        header('Location: index.php?act=tour');
        exit;
    }

    // lấy dữ liệu cho form
    $danhMucList = $model->getAllDanhMuc();
    $trangThaiList = $model->getAllTrangThai();
    $khachSanList = $model->getAllKhachSan();
    $nhaHangList = $model->getAllNhaHang();
    $xeList = $model->getAllXe();

    ob_start();
    require './views/admin/TourDuLich/edit.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function tourDelete()
{
    $model = new TourDuLich();
    $id = $_GET['id'] ?? 0;
    try {
        $model->delete($id);
        header('Location: index.php?act=tour');
        exit();
    } catch (Exception $e) {
        echo $e->getMessage(); // "Không thể xóa tour vì còn lịch khởi hành liên quan!"
    }
}

function tourDetail() {
    $id = $_GET['id'] ?? 0;
    $model = new TourDuLich();
    $tour = $model->getOne($id);

    if (!$tour) {
        echo "Tour không tồn tại!";
        exit;
    }

    // Lấy lịch trình từng ngày
    $lichTrinh = $model->getLichTrinh($id);

    // Lấy lịch khởi hành
    $lichKhoiHanh = $model->getLichKhoiHanh($id);
   // Lấy ảnh từ folder thay vì DB
    $anhTour = $model->getAnhTourFolder($id);


    ob_start();
    require './views/admin/TourDuLich/detail.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}



// ================== BOOKING ==================

function booking() {
    $model = new BookingModel();
    $bookings = $model->getAll();

    ob_start();
    require './views/admin/Booking/list.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function bookingAdd() {
    $bookingModel = new BookingModel();

    // Lấy tất cả tour và lịch để hiển thị form
    $tours = $bookingModel->getAllTours();
    $lich = $bookingModel->getAllLich();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idTour = $_POST['id_tour'] ?? null;
        $idLich = $_POST['id_lich'] ?? null;
        $soLuongKhach = $_POST['so_luong_khach'] ?? 1;

        // Lấy thông tin tour
        $tour = $bookingModel->getTourById($idTour);
        if (!$tour) {
            echo "Tour không tồn tại!";
            exit;
        }

        $tongTien = $tour['gia_co_ban'] * $soLuongKhach;

        // Dữ liệu booking
        $dataBooking = [
            'id_tour' => $idTour,
            'id_lich' => $idLich,
            'so_luong_khach' => $soLuongKhach,
            'tong_tien' => $tongTien,
            'trang_thai' => 'Chưa thanh toán',
            'ghi_chu' => $_POST['ghi_chu'] ?? null
        ];

        // Dữ liệu khách đặt (mặc định id_trang_thai_khach = 1)
        $khachDat = [
            [
                'ho_ten' => $_POST['ho_ten'] ?? '-',
                'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '-',
                'gioi_tinh' => $_POST['gioi_tinh'] ?? 'Nam',
                'id_trang_thai_khach' => 1 // Mặc định
            ]
        ];

        // Thêm booking
        $newID = $bookingModel->create($dataBooking, $khachDat);

        header("Location: index.php?act=booking");
        exit;
    }

    ob_start();
    require './views/admin/Booking/add.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}


function bookingEdit() {
    $id = $_GET['id'] ?? 0;
    $model = new BookingModel();
    $booking = $model->getById($id);

    if (!$booking) { 
        echo "Booking không tồn tại!"; 
        exit; 
    }

    // Lấy tất cả tour và lịch để hiển thị dropdown
    $tours = $model->getAllTours();
    $lich = $model->getAllLich();

    // Lấy thông tin khách đầu tiên
    $khach = $booking['khachList'][0] ?? [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Tính tổng tiền dựa trên giá tour
        $tourInfo = $model->getTourById($_POST['id_tour']);
        $tongTien = ($tourInfo['gia_co_ban'] ?? 0) * $_POST['so_luong_khach'];

        // Dữ liệu booking cập nhật
        $dataBooking = [
            'id_tour' => $_POST['id_tour'],
            'id_lich' => $_POST['id_lich'],
            'so_luong_khach' => $_POST['so_luong_khach'],
            'tong_tien' => $tongTien,
            'trang_thai' => $_POST['trang_thai'] ?? 'Chưa thanh toán',
            'ghi_chu' => $_POST['ghi_chu'] ?? null
        ];

        // Cập nhật booking
        $model->updateBooking($id, $dataBooking);

        // Cập nhật khách chính
        $model->updateKhach($khach['id_khach'], [
            'ho_ten' => $_POST['ho_ten'],
            'so_dien_thoai' => $_POST['so_dien_thoai'],
            // 'email' => $_POST['email'] ?? null,
            'gioi_tinh' => $_POST['gioi_tinh'],
        ]);

        header("Location: index.php?act=booking");
        exit;
    }

    ob_start();
    require './views/admin/Booking/edit.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function bookingDelete() {
    $id = $_GET['id'] ?? 0;
    $model = new BookingModel();
    try {
        $model->deleteBooking($id);
        header("Location: index.php?act=booking");
        exit;
    } catch (Exception $e) {
        echo $e->getMessage(); // "Không thể xóa booking vì còn dữ liệu liên quan!"
    }
}



// ================== Booking Detail ==================
function bookingDetail() {
    $id = $_GET['id'] ?? 0;
    if (!$id) {
        echo "ID booking không hợp lệ!";
        exit;
    }

    $bookingModel = new BookingModel();
    $booking = $bookingModel->getBookingDetail($id);

    if (!$booking) {
        echo "Booking không tồn tại!";
        exit;
    }

    // Lấy thông tin tour từ dữ liệu booking
    $tour = [
        'ten_tour' => $booking['ten_tour'] ?? '-',
        'mo_ta' => $booking['mo_ta'] ?? '-',
        'gia_co_ban' => $booking['gia'] ?? 0,
        'ngay_khoi_hanh' => $booking['ngay_khoi_hanh'] ?? null,
        'ngay_ket_thuc' => $booking['ngay_ket_thuc'] ?? null,
        'ten_khach_san' => $booking['ten_khach_san'] ?? '-',
        'ten_nha_hang' => $booking['ten_nha_hang'] ?? '-',
    ];

    // Lấy danh sách khách
    $khachList = $booking['khachList'] ?? [];



    // Hiển thị view
    ob_start();
    require './views/admin/Booking/detail.php';
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
    $soKhachThucTe = $model->countKhachThucTe($id);

    if(!$doan){
        echo "Đoàn khách không tồn tại!";
        exit;
    }

    // Lấy số lượng đề ra và giá cơ bản
    $soKhachDeRa = $doan['so_luong_khach'];
    $giaCoBan = $doan['gia_co_ban']; // cần join thêm từ bảng tour_du_lich trong getOne()

    // Tính tổng tiền
    if ($soKhachThucTe <= $soKhachDeRa) {
        $tongTien = $doan['tong_tien'];
    } else {
        $soDu = $soKhachThucTe - $soKhachDeRa;
        $tongTien = $doan['tong_tien'] + ($soDu * $giaCoBan);
    }

    // Lấy danh sách khách
    $khachList = $model->getKhachByDoan($id);

    // Truyền thêm biến ra view
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
        // ✅ Kiểm tra trùng toàn bộ hoặc trùng CCCD
    if ($model->checkKhachTonTai($id_dat_tour, $data)) {
        echo "<script>alert('Khách đã tồn tại trong đoàn này!');history.back();</script>";
        exit;
    }

        $model->addKhach($id_dat_tour, $data);
        header("Location: index.php?act=doanKhach&action=view&id=$id_dat_tour");

        // header("Location: index.php?act=viewDoanKhach&id=$id_dat_tour");
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
        header("Location: index.php?act=doanKhach&action=view&id=$id_dat_tour");
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
    if ($khach) {
        $model->deleteKhach($id_khach);
        // Redirect về đúng route chi tiết đoàn khách
        header("Location: index.php?act=doanKhach&action=view&id=" . $khach['id_dat_tour']);
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
            'luong_hdv' => $_POST['luong_hdv'],
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
            'luong_hdv' => $_POST['luong_hdv'],
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
    try {
        $model = new HuongDanVien();
        $model->delete($id);
        $_SESSION['success'] = "Xóa HDV thành công!";
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: index.php?act=nhanSu");
    exit;
}


// ------------------- Lịch khởi hành -------------------// ================== Lịch khởi hành ==================
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

    // Lấy lịch trình theo tour
    $lichTrinhModel = new LichTrinh();
    $lichTrinh = $lichTrinhModel->getByTour($lich['id_tour']);

    ob_start();
    require './views/admin/DieuHanhTour/viewLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}
function addLich(){
    $lichModel = new LichKhoiHanh();
    $lichTrinhModel = new LichTrinh();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = [
            'id_tour'            => $_POST['id_tour'],
            'id_hdv'             => $_POST['id_hdv'],
            'dia_diem_khoi_hanh' => $_POST['dia_diem_khoi_hanh'],
            'dia_diem_den'       => $_POST['dia_diem_den'],
            'ngay_khoi_hanh'     => $_POST['ngay_khoi_hanh'],
            'ngay_ket_thuc'      => $_POST['ngay_ket_thuc'],
            'thong_tin_xe'       => $_POST['thong_tin_xe'],
            'id_trang_thai'      => $_POST['id_trang_thai'],
            'ghi_chu'            => $_POST['ghi_chu']
        ];

        // ✅ Kiểm tra trùng lịch HDV trước khi thêm
        if ($lichModel->checkHdvTrungLich($data['id_hdv'], $data['ngay_khoi_hanh'], $data['ngay_ket_thuc'])) {
            echo "<script>alert('HDV này đã có lịch trùng!');history.back();</script>";
            exit;
        }

        // Thêm lịch khởi hành
        $idLich = $lichModel->create($data);
        $idTour = $data['id_tour'];

        // Thêm lịch trình nếu có
        if (!empty($_POST['lich_trinh'])) {
            foreach ($_POST['lich_trinh'] as $ngay => $lt) {
                $lichTrinhModel->create($idTour, [
                    'ngay_thu'   => $ngay,
                    'tieu_de'    => $lt['tieu_de'],
                    'hoat_dong'  => $lt['hoat_dong'],
                    'dia_diem'   => $lt['dia_diem']
                ]);
            }
        }

        header("Location: index.php?act=dieuHanhTour");
        exit;
    }

    ob_start();
    require './views/admin/DieuHanhTour/addLich.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}


function editLich($id){
    $lichModel       = new LichKhoiHanh();
    $tourModel       = new TourDuLich();
    $hdvModel        = new HuongDanVien();
    $ttModel         = new TrangThaiLichKhoiHanh();
    $lichTrinhModel  = new LichTrinh();

    // Lấy lịch khởi hành theo id
    $lich = $lichModel->getById($id);
    if(!$lich){
        echo "Lịch khởi hành không tồn tại!";
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // cập nhật lịch khởi hành
        $data = [
            'id_tour'            => $_POST['id_tour'],
            'id_hdv'             => $_POST['id_hdv'],
            'dia_diem_khoi_hanh' => $_POST['dia_diem_khoi_hanh'],
            'dia_diem_den'       => $_POST['dia_diem_den'],
            'ngay_khoi_hanh'     => $_POST['ngay_khoi_hanh'],
            'ngay_ket_thuc'      => $_POST['ngay_ket_thuc'],
            'thong_tin_xe'       => $_POST['thong_tin_xe'],
            'id_trang_thai'      => $_POST['id_trang_thai'],
            'ghi_chu'            => $_POST['ghi_chu']
        ];
        // ✅ Kiểm tra trùng lịch HDV (loại trừ chính lịch này)
    if ($lichModel->checkHdvTrungLich($data['id_hdv'], $data['ngay_khoi_hanh'], $data['ngay_ket_thuc'], $id)) {
        echo "<script>alert('HDV này đã có lịch trùng!');history.back();</script>";
        exit;
    }
        $lichModel->update($id, $data);

        // cập nhật lịch trình từng ngày
        if (!empty($_POST['lich_trinh'])) {
            foreach ($_POST['lich_trinh'] as $ngay => $lt) {
                // SỬA: truyền id_tour thay vì id_lich
                $lichTrinhModel->updateOrCreate($data['id_tour'], $ngay, $lt);
            }
        }

        header("Location: index.php?act=dieuHanhTour");
        exit;
    }

    // lấy dữ liệu cho form
    $tours      = $tourModel->getAll();
    $hdvs       = $hdvModel->getAll();
    $ttList     = $ttModel->getAll();
    $lichTrinh  = $lichTrinhModel->getByTour($lich['id_tour']);

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


// ================== Nhà cung cấp ==================

function nhaCungCap() {
    // $model = new BookingModel();
    // $bookings = $model->getAll();

    ob_start();
    require './views/admin/nhaCungCap/viewNhaCungCap.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

// ==================Khách sạn ==================

function khachSan() {
    $model = new KhachSanModel();
    $search = $_GET['search'] ?? '';
    $khachSanList = $model->getAll($search);

    ob_start();
    require './views/admin/nhaCungCap/khachSan/khachSanList.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function khachSanAdd() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'ten_khach_san' => $_POST['ten_khach_san'],
            'sdt_khach_san' => $_POST['sdt_khach_san'],
            'gia_khach_san' => $_POST['gia_khach_san'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $model = new KhachSanModel();
        $model->create($data);
        header("Location: index.php?act=khachSan");
        exit;
    }

    ob_start();
    require './views/admin/nhaCungCap/khachSan/khachSanAdd.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function khachSanEdit() {
    $id = $_GET['id'] ?? 0;
    $model = new KhachSanModel();
    $ks = $model->getOne($id);

    if (!$ks) {
        echo "Khách sạn không tồn tại!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'ten_khach_san' => $_POST['ten_khach_san'],
            'sdt_khach_san' => $_POST['sdt_khach_san'],
            'gia_khach_san' => $_POST['gia_khach_san'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $model->update($id, $data);
        header("Location: index.php?act=khachSan");
        exit;
    }

    ob_start();
    require './views/admin/nhaCungCap/khachSan/khachSanEdit.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function khachSanDelete() {
    $id = $_GET['id'] ?? 0;
    $model = new KhachSanModel();
    try {
        $model->delete($id);
        header("Location: index.php?act=khachSan");
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


// ================== Nhà hàng ==================

function nhaHang() {
    $model = new NhaHangModel();
    $search = $_GET['search'] ?? '';
    $nhaHangList = $model->getAll($search);

    ob_start();
    require './views/admin/nhaCungCap/nhaHang/nhaHangList.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function nhaHangAdd() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'ten_nha_hang' => $_POST['ten_nha_hang'],
            'sdt_nha_hang' => $_POST['sdt_nha_hang'],
            'gia_nha_hang' => $_POST['gia_nha_hang'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $model = new NhaHangModel();
        $model->create($data);
        header("Location: index.php?act=nhaHang");
        exit;
    }

    ob_start();
    require './views/admin/nhaCungCap/nhaHang/nhaHangAdd.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function nhaHangEdit() {
    $id = $_GET['id'] ?? 0;
    $model = new NhaHangModel();
    $nh = $model->getOne($id);

    if (!$nh) {
        echo "Nhà hàng không tồn tại!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'ten_nha_hang' => $_POST['ten_nha_hang'],
            'sdt_nha_hang' => $_POST['sdt_nha_hang'],
            'gia_nha_hang' => $_POST['gia_nha_hang'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $model->update($id, $data);
        header("Location: index.php?act=nhaHang");
        exit;
    }

    ob_start();
    require './views/admin/nhaCungCap/nhaHang/nhaHangEdit.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function nhaHangDelete() {
    $id = $_GET['id'] ?? 0;
    $model = new NhaHangModel();
    try {
        $model->delete($id);
        header("Location: index.php?act=nhaHang");
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


// ================== Nhà Xe ==================

function nhaXe() {
    $model = new NhaXeModel();
    $search = $_GET['search'] ?? '';
    $nhaXeList = $model->getAll($search);

    ob_start();
    require './views/admin/nhaCungCap/nhaXe/nhaXeList.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function nhaXeAdd() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form, dùng ?? để tránh lỗi undefined
        $nha_xe     = $_POST['nha_xe']     ?? '';
        $sdt_nha_xe = $_POST['sdt_nha_xe'] ?? '';
        $gia_nha_xe = $_POST['gia_nha_xe'] ?? null;
        $mo_ta      = $_POST['mo_ta']      ?? '';

        // Validate dữ liệu bắt buộc
        if (empty($nha_xe)) {
            die("Lỗi: Bạn chưa nhập tên nhà xe.");
        }
        if (empty($sdt_nha_xe)) {
            die("Lỗi: Bạn chưa nhập số điện thoại.");
        }
        if ($gia_nha_xe === null || $gia_nha_xe === '') {
            die("Lỗi: Bạn chưa nhập giá nhà xe.");
        }
        if (!is_numeric($gia_nha_xe)) {
            die("Lỗi: Giá nhà xe phải là số.");
        }

        // Chuẩn bị dữ liệu để insert
        $data = [
            'nha_xe'     => $nha_xe,
            'sdt_nha_xe' => $sdt_nha_xe,
            'gia_nha_xe' => (int)$gia_nha_xe,
            'mo_ta'      => $mo_ta
        ];

        // Gọi model để thêm mới
        $model = new NhaXeModel();
        try {
            $model->create($data);
            // Redirect về danh sách nhà xe
            header("Location: index.php?act=nhaXe");
            exit;
        } catch (Exception $e) {
            die("Lỗi khi thêm nhà xe: " . $e->getMessage());
        }
    }

    // Nếu không phải POST thì hiển thị form thêm
    ob_start();
    require './views/admin/nhaCungCap/nhaXe/nhaXeAdd.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}


function nhaXeEdit() {
    $id = $_GET['id'] ?? 0;
    $model = new NhaXeModel();
    $xe = $model->getOne($id);

    if (!$xe) {
        echo "Nhà xe không tồn tại!";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'nha_xe' => $_POST['nha_xe'],
            'sdt_nha_xe' => $_POST['sdt_nha_xe'],
            'gia_nha_xe' => $_POST['gia_nha_xe'],
            'mo_ta' => $_POST['mo_ta']
        ];
        $model->update($id, $data);
        header("Location: index.php?act=nhaXe");
        exit;
    }

    ob_start();
    require './views/admin/nhaCungCap/nhaXe/nhaXeEdit.php';
    $content = ob_get_clean();
    require './views/layout_admin.php';
}

function nhaXeDelete() {
    $id = $_GET['id'] ?? 0;
    $model = new NhaXeModel();
    try {
        $model->delete($id);
        header("Location: index.php?act=nhaXe");
        exit;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


