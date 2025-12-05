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
        $tours = $model->getToursByHdv($id_hdv);

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
                $model->diemDanh($_POST['id_khach'], $_POST['trang_thai']);
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
        
        // Nếu có id_tour nhưng không có id_lich, redirect sang cách cũ (tạm thời)
        // Nếu có id_lich, lấy id_tour từ đó
        if ($id_lich > 0) {
            $lichDetail = $model->getLichKhoiHanhById($id_lich);
            if (!$lichDetail || $lichDetail['id_hdv'] != $id_hdv) {
                echo "Lịch khởi hành không tồn tại hoặc bạn không có quyền truy cập!";
                exit;
            }
            $id_tour = $lichDetail['id_tour'];
            
            // Lấy chi tiết tour từ lịch khởi hành cụ thể
            $tour = $lichDetail;
            // Bổ sung thông tin tour
            $tourInfo = $model->getTourInfoById($id_tour);
            if ($tourInfo) {
                $tour = array_merge($tour, $tourInfo);
            }
        } else {
            // Nếu chỉ có id_tour (link cũ), lấy lịch khởi hành đầu tiên của tour đó
            if ($id_tour > 0) {
                $lichs = $model->getLichKhoiHanhByTour($id_tour, $id_hdv);
                if (count($lichs) > 0) {
                    // Redirect sang id_lich của lịch đầu tiên
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

        // Lấy danh sách khách - chỉ lấy khách của lịch này (id_lich)
        $khachs = $model->getKhachByLichKhoiHanh($id_lich);
        $lichTrinh = $model->getLichTrinhByLichKhoiHanh($id_lich);
        $trangThaiList = $model->getTrangThaiKhach();

        // Xử lý POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            
            // Cập nhật yêu cầu đặc biệt
            if ($action === 'update_yeu_cau') {
                $id_khach = $_POST['id_khach'] ?? 0;
                $yeu_cau = $_POST['yeu_cau_dac_biet'] ?? '';
                if ($id_khach > 0) {
                    $model->updateYeuCauKhach($id_khach, $yeu_cau);
                    header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
                    exit;
                }
            } 
            // Cập nhật trạng thái điểm danh
            elseif (isset($_POST['id_khach']) && isset($_POST['trang_thai'])) {
                $model->diemDanh($_POST['id_khach'], $_POST['trang_thai']);
                header("Location: index.php?act=hdv_tour_detail&id_lich=$id_lich");
                exit;
            }
        }

        // View con
        $view_hdv_content = __DIR__ . '/../views/hdv/tour_detail.php';

        // Layout chính
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

        // View con
        $view_hdv_content = __DIR__ . '/../views/hdv/lich_su_tour.php';

        // Layout chính
        require __DIR__ . '/../views/hdv/home.php';
    }

}
