<?php
class HdvController {

    // Lấy ID HDV từ session
    private function getHdvId() {
        return $_SESSION['hdv']['id'] ?? 1;
    }

    // ========= DASHBOARD =========
    public function dashboard() {
        require_once __DIR__ . '/../models/HdvModel.php';
        $model = new HdvModel();    
        $id_hdv = $this->getHdvId();
        $tours = $model->getToursWithTotal($id_hdv);

        // file giao diện con
        $view_hdv_content = __DIR__ . '/../views/hdv/dashboard.php';

        require __DIR__ . '/../views/hdv/home.php';
    }

    // ========= LỊCH TRÌNH =========
    public function lichTrinh() {
        require_once __DIR__ . '/../models/HdvModel.php';
        $model = new HdvModel();
        $id_hdv = $this->getHdvId();
        $lichTrinhData = $model->getLichTrinhByStatus($id_hdv);
        
        $upcomingTours = $lichTrinhData['upcoming'];
        $completedTours = $lichTrinhData['completed'];

        $view_hdv_content = __DIR__ . '/../views/hdv/lich_trinh.php';

        require __DIR__ . '/../views/hdv/home.php';
    }

    // ========= DANH SÁCH KHÁCH =========
   public function danhSachKhach() {
    require_once __DIR__ . '/../models/HdvModel.php';
    $model = new HdvModel();
    $id_hdv = $this->getHdvId();
    
    // Xử lý POST - cập nhật trạng thái điểm danh
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'diem_danh' && isset($_POST['id_khach']) && isset($_POST['trang_thai'])) {

    $id_khach = $_POST['id_khach'];
    $trang_thai = $_POST['trang_thai'];

    // Nếu trạng thái rỗng hoặc không hợp lệ → đặt mặc định = 1
    if ($trang_thai === "" || $trang_thai === null || !is_numeric($trang_thai)) {
        $trang_thai = 1;
    }

    $model->diemDanh($id_khach, $trang_thai);

    header("Location: index.php?act=hdv_danh_sach_khach");
    exit;
}

    }
    
    $khach = $model->getKhachByHdv($id_hdv);
    $trangThaiList = $model->getTrangThaiKhach();

    $view_hdv_content = __DIR__ . '/../views/hdv/danh_sach_khach.php';

    require __DIR__ . '/../views/hdv/home.php';
}


    // ========= ĐIỂM DANH =========
    public function diemDanh() {
        require_once __DIR__ . '/../models/HdvModel.php';
        $model = new HdvModel();
        $id_hdv = $this->getHdvId();

        // Nếu có POST thì cập nhật trạng thái
        if (!empty($_POST["id_khach"]) && isset($_POST["trang_thai"])) {
            $model->diemDanh($_POST["id_khach"], $_POST["trang_thai"]);
            header("Location: index.php?act=hdv_diem_danh");
            exit;
        }

        // Lấy danh sách khách theo HDV
        $khach = $model->getKhachByHdv($id_hdv);

        // View con
        $view_hdv_content = __DIR__ . '/../views/hdv/diem_danh.php';

        // Layout chính
        require __DIR__ . '/../views/hdv/home.php';
    }

    // ========= NHẬT KÝ =========
    public function nhatKy() {
    require_once __DIR__ . '/../models/HdvModel.php';
    $model = new HdvModel();
    $id_hdv = $this->getHdvId();

    // Xử lý POST (thêm/sửa nhật ký)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_nhat_ky = $_POST['id_nhat_ky'] ?? null;
        $id_lich = $_POST['id_lich'] ?? null;
        $ngay_ghi = $_POST['ngay_ghi'] ?? null;
        $su_co = $_POST['su_co'] ?? '';
        $phan_hoi = $_POST['phan_hoi'] ?? '';
        $nhan_xet_hdv = $_POST['nhan_xet_hdv'] ?? '';

        if ($id_nhat_ky) {
            // Sửa nhật ký
            $model->updateNhatKy($id_nhat_ky, [
                'id_lich' => $id_lich,
                'ngay_ghi' => $ngay_ghi,
                'su_co' => $su_co,
                'phan_hoi' => $phan_hoi,
                'nhan_xet_hdv' => $nhan_xet_hdv
            ]);
        } else {
            // Thêm nhật ký mới
            $model->createNhatKy([
                'id_hdv' => $id_hdv,   // <-- Gán id_hdv từ session
                'id_lich' => $id_lich,
                'ngay_ghi' => $ngay_ghi,
                'su_co' => $su_co,
                'phan_hoi' => $phan_hoi,
                'nhan_xet_hdv' => $nhan_xet_hdv
            ]);
        }
        header("Location: index.php?act=hdv_nhat_ky");
        exit;
    }

    // Lấy danh sách lịch khởi hành của HDV này
    $lichList = $model->getLichKhoiHanhByHdv($id_hdv);

    // Lấy tất cả nhật ký của HDV
    $nhatkyList = $model->getNhatKy($id_hdv);

    // Nếu đang edit, lấy nhật ký cụ thể
    $editingNhatKy = null;
    if (isset($_GET['edit'])) {
        $editingNhatKy = $model->getNhatKyById($_GET['edit']);
    }

    // Giao diện con
    $view_hdv_content = __DIR__ . '/../views/hdv/nhat_ky_new.php';

    // Gọi layout chính
    require __DIR__ . '/../views/hdv/home.php';
}


    // ========= XÓA NHẬT KÝ =========
    public function deleteNhatKy() {
        require_once __DIR__ . '/../models/HdvModel.php';
        $model = new HdvModel();
        $id = $_GET['id'] ?? 0;

        if ($id) {
            $model->deleteNhatKy($id);
        }
        header("Location: index.php?act=hdv_nhat_ky");
        exit;
    }

    // ========= CẬP NHẬT YÊU CẦU =========
    public function updateYeuCau() {
        require_once __DIR__ . '/../models/HdvModel.php';
        $model = new HdvModel();

        if (!empty($_POST["id_khach_tour"])) {
            $model->updateYeuCau($_POST["id_khach_tour"], $_POST["yeu_cau"]);
            header("Location: index.php?act=hdv_khach");
            exit;
        }
    }

    // ========= XEM CHI TIẾT TOUR =========
    public function tourDetail() {
    require_once __DIR__ . '/../models/HdvModel.php';
    $model = new HdvModel();
    $id_hdv = $this->getHdvId();
    $id_lich = $_GET['id_lich'] ?? 0;
    $id_tour = $_GET['id_tour'] ?? 0;

    // Xử lý lấy id_tour từ id_lich nếu có
    if ($id_lich > 0) {
        $lichDetail = $model->getLichKhoiHanhById($id_lich);
        if (!$lichDetail || $lichDetail['id_hdv'] != $id_hdv) {
            echo "Lịch khởi hành không tồn tại hoặc bạn không có quyền truy cập!";
            exit;
        }
        $id_tour = $lichDetail['id_tour'];

        // Lấy chi tiết tour từ lịch khởi hành
        $tour = $lichDetail;
        $tourInfo = $model->getTourInfoById($id_tour);
        if ($tourInfo) {
            $tour = array_merge($tour, $tourInfo);
        }
    } else {
        // Nếu chỉ có id_tour (link cũ), lấy lịch khởi hành đầu tiên
        if ($id_tour > 0) {
            $lichs = $model->getLichKhoiHanhByTour($id_tour, $id_hdv);
            if (count($lichs) > 0) {
                $id_lich = $lichs[0]['id_lich'];
                header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
                exit;
            }
        }
    }

    if (!$tour || !$id_lich) {
        echo "Tour không tồn tại hoặc bạn không có quyền truy cập!";
        exit;
    }

    // Lấy danh sách khách và lịch trình
    $khachs = $model->getKhachByLichKhoiHanh($id_lich);
    $lichTrinh = $model->getLichTrinhByLichKhoiHanh($id_lich);
    $trangThaiList = $model->getTrangThaiKhach();

    // Xác định ngày đang điểm danh (ngày đầu tiên có khách chưa hoàn thành)
    $ngayDangDiemDanh = null;
    $khachsNgayHienTai = [];
    
    // Nhóm khách theo ngày thứ
    $groupedByDay = [];
    foreach ($khachs as $khach) {
        $ngayThu = isset($khach['ngay_thu']) ? $khach['ngay_thu'] : 'Không xác định';
        if (!isset($groupedByDay[$ngayThu])) {
            $groupedByDay[$ngayThu] = [];
        }
        $groupedByDay[$ngayThu][] = $khach;
    }
    
    // Tìm ngày đầu tiên chưa hoàn thành điểm danh
    foreach ($groupedByDay as $ngayThu => $khachList) {
        $allDone = true;
        foreach ($khachList as $k) {
            if (empty($k['id_trang_thai_khach'])) {
                $allDone = false;
                break;
            }
        }
        if (!$allDone) {
            $ngayDangDiemDanh = $ngayThu;
            $khachsNgayHienTai = $khachList;
            break;
        }
    }
    
    // Nếu tất cả đã điểm danh, hiển thị ngày cuối cùng
    if ($ngayDangDiemDanh === null && !empty($groupedByDay)) {
        $ngayDangDiemDanh = array_key_last($groupedByDay);
        $khachsNgayHienTai = $groupedByDay[$ngayDangDiemDanh];
    }

    // Tổng tiền tour
    $tongTien = $model->getTongTienTour($id_tour);

    // Lấy ngày khởi hành và kết thúc từ bảng đặt tour
    $thongTinTour = $model->getThongTinDatTour($id_tour); // dùng hàm mới
    $ngayKhoiHanh = $thongTinTour['ngay_khoi_hanh'];
    $ngayKetThuc = $thongTinTour['ngay_ket_thuc'];

    // Xử lý POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'update_yeu_cau') {
            $id_khach = $_POST['id_khach'] ?? 0;
            $yeu_cau = $_POST['yeu_cau_dac_biet'] ?? '';
            if ($id_khach > 0) {
                $model->updateYeuCauKhach($id_khach, $yeu_cau);
                header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
                exit;
            }
        } elseif (isset($_POST['confirm_day'])) {
            // Xác nhận điểm danh ngày - chỉ refresh để chuyển sang ngày tiếp theo
            header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
            exit;
        } elseif (isset($_POST['toggle_diem_danh'])) {
            // Toggle điểm danh (có mặt <-> vắng)
            $id_khach = $_POST['id_khach'] ?? 0;
            $id_co_mat = $_POST['id_co_mat'] ?? 0;
            $id_vang = $_POST['id_vang'] ?? 0;
            if ($id_khach > 0 && $id_co_mat > 0 && $id_vang > 0) {
                $model->toggleDiemDanh($id_khach, $id_co_mat, $id_vang);
                header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
                exit;
            }
        } elseif (isset($_POST['id_khach']) && isset($_POST['trang_thai'])) {
            // Cập nhật trạng thái trực tiếp (legacy)
            $model->diemDanh($_POST['id_khach'], $_POST['trang_thai']);
            header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
            exit;
        }
    }

    $view_hdv_content = __DIR__ . '/../views/hdv/tour_detail.php';
    require __DIR__ . '/../views/hdv/home.php';
}


    // ========= LỊCH SỬ TOUR =========
    public function tourHistory() {
        require_once __DIR__ . '/../models/HdvModel.php';
        $model = new HdvModel();
        $id_hdv = $this->getHdvId();

        // Lấy tham số sort và order từ GET
        $sort = $_GET['sort'] ?? 'ngay_khoi_hanh';
        $order = $_GET['order'] ?? 'DESC';

        // Lấy lịch sử tour
        $tourHistory = $model->getTourHistory($id_hdv, $sort, $order);
        // $thongTinTour = $model->getThongTinDatTour($id_tour);

        // View con
        $view_hdv_content = __DIR__ . '/../views/hdv/lich_su_tour.php';

        // Layout chính
        require __DIR__ . '/../views/hdv/home.php';
    }

}
