<?php
class HdvModel {
    private $conn;

    public function __construct() {
        $host = "localhost";
        $dbname = "quan_ly_tour";
        $username = "root";
        $password = "";

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối DB: " . $e->getMessage());
        }
    }

    // SELECT trả về mảng
    public function pdo_query($sql, $args = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    // INSERT/UPDATE/DELETE
    public function pdo_execute($sql, $args = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($args);
    }

    // Lấy tất cả tour theo HDV
   // Lấy tất cả tour của HDV kèm tổng tiền (tính từ dat_tour)
public function getToursWithTotal($id_hdv) {
    $sql = "
        SELECT 
            t.id_tour,
            t.ten_tour,
            t.thoi_luong,
            IFNULL(MAX(d.tong_tien), 0) AS tong_tien
        FROM tour_du_lich t
        JOIN lich_khoi_hanh l ON l.id_tour = t.id_tour
        LEFT JOIN dat_tour d ON d.id_tour = t.id_tour
        WHERE l.id_hdv = ?
        GROUP BY t.id_tour, t.ten_tour, t.thoi_luong
        ORDER BY t.ten_tour ASC
    ";
    return $this->pdo_query($sql, [$id_hdv]);
}







    // Lấy lịch trình theo HDV (group theo id_tour)
    public function getLichTrinhByHdv($id_hdv) {
        $sql = "SELECT k.*, d.id_lich, d.ngay_dat, d.ngay_khoi_hanh, d.ngay_ket_thuc, l.id_hdv, t.trang_thai_khach
        FROM khach_trong_dat_tour k
        JOIN dat_tour d ON k.id_dat_tour = d.id_dat_tour
        JOIN lich_khoi_hanh l ON d.id_lich = l.id_lich
        LEFT JOIN trang_thai_khach t ON k.id_trang_thai_khach = t.id_trang_thai_khach
        WHERE l.id_hdv = ?
        ORDER BY d.ngay_khoi_hanh DESC, d.id_dat_tour, k.id_khach";

        $rows = $this->pdo_query($sql, [$id_hdv]);
        $grouped = [];
        foreach ($rows as $r) {
            $grouped[$r['id_tour']][] = $r;
        }
        return $grouped;
    }

    // Lấy lịch trình của một tour cụ thể
    public function getLichTrinhByTour($id_tour, $id_hdv) {
        $sql = "SELECT lt.*, l.id_tour, lt.ngay_thu, t.ten_tour
                FROM lich_trinh lt
                JOIN lich_khoi_hanh l ON lt.id_tour = l.id_tour
                JOIN tour_du_lich t ON l.id_tour = t.id_tour
                WHERE l.id_tour = ? AND l.id_hdv = ?
                ORDER BY lt.ngay_thu";
        return $this->pdo_query($sql, [$id_tour, $id_hdv]);
    }

    // Lấy lịch trình phân theo trạng thái (sắp diễn ra/đang diễn ra vs đã kết thúc)
    public function getLichTrinhByStatus($id_hdv) {
        $sql = "SELECT lt.*, l.id_tour, l.id_lich, d.ngay_khoi_hanh, d.ngay_ket_thuc, lt.ngay_thu, t.ten_tour, ts.trang_thai_lich_khoi_hanh
        FROM lich_trinh lt
        JOIN lich_khoi_hanh l ON lt.id_tour = l.id_tour
        JOIN dat_tour d ON l.id_dat_tour = d.id_dat_tour
        JOIN tour_du_lich t ON l.id_tour = t.id_tour
        JOIN trang_thai_lich_khoi_hanh ts ON l.id_trang_thai_lich_khoi_hanh = ts.id_trang_thai_lich_khoi_hanh
        WHERE l.id_hdv = ?
        ORDER BY ts.trang_thai_lich_khoi_hanh DESC, d.ngay_khoi_hanh DESC, l.id_lich, lt.ngay_thu";

        $rows = $this->pdo_query($sql, [$id_hdv]);
        
        // Phân loại tour theo trạng thái
        $upcoming = [];   // Sắp diễn ra / Đang diễn ra
        $completed = [];  // Đã kết thúc - grouping theo id_lich (mỗi lịch khởi hành là 1 bảng)
        
        foreach ($rows as $r) {
            if ($r['trang_thai_lich_khoi_hanh'] === 'Đã kết thúc') {
                // Key bằng id_lich để mỗi lịch khởi hành có 1 bảng riêng
                $key = $r['id_lich'];
                if (!isset($completed[$key])) {
                    $completed[$key] = [];
                }
                $completed[$key][] = $r;
            } else {
                // Cho tour sắp diễn ra, grouping theo id_lich luôn
                $key = $r['id_lich'];
                if (!isset($upcoming[$key])) {
                    $upcoming[$key] = [];
                }
                $upcoming[$key][] = $r;
            }
        }
        
        return ['upcoming' => $upcoming, 'completed' => $completed];
    }
    // Lấy danh sách khách theo HDV
public function getKhachByHdv($id_hdv) {
    $sql = "SELECT k.*, k.ghi_chu as yeu_cau_dac_biet, d.id_lich, d.ngay_dat, l.id_hdv, l.ngay_khoi_hanh, l.ngay_ket_thuc, t.trang_thai_khach
            FROM khach_trong_dat_tour k
            JOIN dat_tour d ON k.id_dat_tour = d.id_dat_tour
            JOIN lich_khoi_hanh l ON d.id_lich = l.id_lich
            LEFT JOIN trang_thai_khach t ON k.id_trang_thai_khach = t.id_trang_thai_khach
            WHERE l.id_hdv = ?
            ORDER BY l.ngay_khoi_hanh DESC, d.id_dat_tour, k.id_khach";
    return $this->pdo_query($sql, [$id_hdv]);
}

    // Cập nhật yêu cầu đặc biệt của khách
    public function updateYeuCauKhach($id_khach, $yeu_cau) {
        $sql = "UPDATE khach_trong_dat_tour SET ghi_chu = ? WHERE id_khach = ?";
    return $this->pdo_execute($sql, [$yeu_cau, $id_khach]);
    }

    // Cập nhật trạng thái điểm danh
public function diemDanh($id_khach, $trang_thai) {

    // Chống lỗi giá trị rỗng
    if ($trang_thai === "" || $trang_thai === null || !is_numeric($trang_thai)) {
        $trang_thai = 1;
    }

    $sql = "UPDATE khach_trong_dat_tour 
            SET id_trang_thai_khach = ? 
            WHERE id_khach = ?";
    return $this->pdo_execute($sql, [$trang_thai, $id_khach]);
}


    // Toggle trạng thái điểm danh (có mặt <-> vắng)
    public function toggleDiemDanh($id_khach, $idCoMat, $idVang) {
        // Lấy trạng thái hiện tại
        $sql = "SELECT id_trang_thai_khach FROM khach_trong_dat_tour WHERE id_khach = ?";
        $rows = $this->pdo_query($sql, [$id_khach]);
        if (empty($rows)) return false;
        
        $currentStatus = $rows[0]['id_trang_thai_khach'];
        $newStatus = ($currentStatus == $idCoMat) ? $idVang : $idCoMat;
        
        // Cập nhật trạng thái
        $updateSql = "UPDATE khach_trong_dat_tour 
                      SET id_trang_thai_khach = ? 
                      WHERE id_khach = ?";
        return $this->pdo_execute($updateSql, [$newStatus, $id_khach]);
    }


    /*** CRUD Nhật ký Tour ***/

    // Lấy tất cả nhật ký theo HDV
    public function getNhatKy($id_hdv) {
    $sql = "SELECT nk.*, d.ngay_khoi_hanh, t.ten_tour, h.ho_ten AS ten_hdv
            FROM nhat_ky_tour nk
            LEFT JOIN lich_khoi_hanh l ON nk.id_lich = l.id_lich
            LEFT JOIN dat_tour d ON l.id_dat_tour = d.id_dat_tour
            LEFT JOIN tour_du_lich t ON l.id_tour = t.id_tour
            LEFT JOIN huong_dan_vien h ON nk.id_hdv = h.id_hdv
            WHERE l.id_hdv = ?";
    return $this->pdo_query($sql, [$id_hdv]);
}



    // Lấy 1 nhật ký theo ID
    public function getNhatKyById($id_nhat_ky) {
    $sql = "SELECT nk.*, l.id_tour, d.ngay_khoi_hanh, d.ngay_ket_thuc, t.ten_tour
        FROM nhat_ky_tour nk
        LEFT JOIN lich_khoi_hanh l ON nk.id_lich = l.id_lich
        LEFT JOIN dat_tour d ON l.id_dat_tour = d.id_dat_tour
        LEFT JOIN tour_du_lich t ON l.id_tour = t.id_tour
        WHERE nk.id_nhat_ky = ?";

    $rows = $this->pdo_query($sql, [$id_nhat_ky]);
    return $rows[0] ?? null;
}
    /*** Login HDV ***/
    public function hdvLoginCheck($username, $password) {
        $username = trim($username);
        $password = trim($password);

        $sql = "SELECT * FROM huong_dan_vien WHERE email = ? OR so_dien_thoai = ? LIMIT 1";
        $rows = $this->pdo_query($sql, [$username, $username]);
        $user = $rows[0] ?? null;
        if (!$user) return null;

        $stored = $user['pass'] ?? '';
        if ($stored === $password) return $user;
        if (!empty($stored) && password_verify($password, $stored)) return $user;

        return null;
    }

    // Lấy chi tiết tour theo tour ID + HDV ID
    
    public function getTourBookings($id_tour) {
    $sql = "
        SELECT 
            d.id_dat_tour, d.ngay_dat, d.ngay_khoi_hanh, d.ngay_ket_thuc,
            d.so_luong_khach, d.tong_tien, d.trang_thai AS trang_thai_dat,
            t.ten_tour, t.thoi_luong, t.gia_co_ban
        FROM dat_tour d
        INNER JOIN tour_du_lich t ON t.id_tour = d.id_tour
        WHERE d.id_tour = ?
        ORDER BY d.ngay_khoi_hanh ASC
    ";
    return $this->pdo_query($sql, [$id_tour]);
}




public function getTongTienTour($id_tour) {
    $sql = "SELECT COALESCE(SUM(tong_tien), 0) AS tong_tien
            FROM dat_tour
            WHERE id_tour = ?";
    $rows = $this->pdo_query($sql, [$id_tour]);
    return $rows[0]['tong_tien'] ?? 0;
}
public function getThongTinDatTour($id_tour) {
    $sql = "SELECT 
                COALESCE(SUM(tong_tien), 0) AS tong_tien,
                MIN(ngay_khoi_hanh) AS ngay_khoi_hanh,
                MAX(ngay_ket_thuc) AS ngay_ket_thuc
            FROM dat_tour
            WHERE id_tour = ?";
    $rows = $this->pdo_query($sql, [$id_tour]);
    return $rows[0] ?? [
        'tong_tien' => 0,
        'ngay_khoi_hanh' => null,
        'ngay_ket_thuc' => null
    ];
}


    // Lấy danh sách khách theo tour ID + HDV ID (để điểm danh)
    public function getKhachByTourAndHdv($id_tour, $id_hdv) {
        $sql = "SELECT k.*, k.ghi_chu as yeu_cau_dac_biet, tk.trang_thai_khach, d.id_dat_tour, d.ngay_dat
                FROM khach_trong_dat_tour k
                JOIN dat_tour d ON k.id_dat_tour = d.id_dat_tour
                JOIN lich_khoi_hanh lk ON d.id_lich = lk.id_lich
                LEFT JOIN trang_thai_khach tk ON k.id_trang_thai_khach = tk.id_trang_thai_khach
                WHERE lk.id_tour = ? AND lk.id_hdv = ?
                ORDER BY d.id_dat_tour, k.id_khach";
        return $this->pdo_query($sql, [$id_tour, $id_hdv]);
    }

    // Lấy danh sách khách theo lịch khởi hành cụ thể (không gộp chung)
    public function getKhachByLichKhoiHanh($id_lich) {
    $sql = "SELECT DISTINCT k.*, k.ghi_chu as yeu_cau_dac_biet, tk.trang_thai_khach, tk.id_trang_thai_khach,
                   d.id_dat_tour, d.ngay_dat, d.ngay_khoi_hanh,
                   (SELECT MIN(lt.ngay_thu) FROM lich_trinh lt WHERE lt.id_tour = lk.id_tour) as ngay_thu
            FROM khach_trong_dat_tour k
            JOIN dat_tour d ON k.id_dat_tour = d.id_dat_tour
            JOIN lich_khoi_hanh lk ON lk.id_dat_tour = d.id_dat_tour
            LEFT JOIN trang_thai_khach tk ON k.id_trang_thai_khach = tk.id_trang_thai_khach
            WHERE lk.id_lich = ?
            ORDER BY ngay_thu, d.id_dat_tour, k.id_khach";
    return $this->pdo_query($sql, [$id_lich]);
}


    // Lấy tất cả trạng thái khách
    public function getTrangThaiKhach() {
        $sql = "SELECT * FROM trang_thai_khach";
        return $this->pdo_query($sql);
    }

    // Lấy chi tiết lịch khởi hành theo id_lich (kèm trạng thái)
    public function getLichKhoiHanhById($id_lich) {
        $sql = "SELECT l.*, d.ngay_khoi_hanh, d.ngay_ket_thuc, ts.trang_thai_lich_khoi_hanh 
                FROM lich_khoi_hanh l
                LEFT JOIN dat_tour d ON l.id_dat_tour = d.id_dat_tour
                LEFT JOIN trang_thai_lich_khoi_hanh ts ON l.id_trang_thai_lich_khoi_hanh = ts.id_trang_thai_lich_khoi_hanh
                WHERE l.id_lich = ?";
        $rows = $this->pdo_query($sql, [$id_lich]);
        return $rows[0] ?? null;
    }

    // Lấy thông tin tour cơ bản theo id_tour
    public function getTourInfoById($id_tour) {
        $sql = "SELECT t.*, nx.nha_xe FROM tour_du_lich t
                LEFT JOIN nha_xe nx ON t.id_xe = nx.id_xe
                WHERE t.id_tour = ?";
        $rows = $this->pdo_query($sql, [$id_tour]);
        return $rows[0] ?? null;
    }

    // Lấy danh sách lịch khởi hành của 1 tour theo id_tour + id_hdv
    public function getLichKhoiHanhByTour($id_tour, $id_hdv) {
    $sql = "SELECT lk.*, d.ngay_khoi_hanh, d.ngay_ket_thuc
            FROM lich_khoi_hanh lk
            JOIN dat_tour d ON lk.id_dat_tour = d.id_dat_tour
            WHERE lk.id_tour = ? AND lk.id_hdv = ?
            ORDER BY d.ngay_khoi_hanh DESC";
    return $this->pdo_query($sql, [$id_tour, $id_hdv]);
}


    // Lấy lịch trình của một lịch khởi hành cụ thể
    public function getLichTrinhByLichKhoiHanh($id_lich) {
        $sql = "SELECT lt.*, l.id_tour, l.id_lich, t.ten_tour
                FROM lich_trinh lt
                JOIN lich_khoi_hanh l ON lt.id_tour = l.id_tour
                JOIN tour_du_lich t ON l.id_tour = t.id_tour
                WHERE l.id_lich = ?
                ORDER BY lt.ngay_thu";
        return $this->pdo_query($sql, [$id_lich]);
    }

    // Lấy danh sách lịch khởi hành theo HDV (kèm thông tin tour)
    public function getLichKhoiHanhByHdv($id_hdv) {
    $sql = "SELECT lk.id_lich, t.ten_tour, d.ngay_khoi_hanh
            FROM lich_khoi_hanh lk
            JOIN tour_du_lich t ON lk.id_tour = t.id_tour
            JOIN dat_tour d ON lk.id_dat_tour = d.id_dat_tour
            WHERE lk.id_hdv = ?
            ORDER BY d.ngay_khoi_hanh DESC";
    return $this->pdo_query($sql, [$id_hdv]);
}

    // Tạo nhật ký mới
    public function createNhatKy($data) {
    $sql = "INSERT INTO nhat_ky_tour (id_lich, id_hdv, ngay_ghi, su_co, phan_hoi, nhan_xet_hdv)
            VALUES (?, ?, ?, ?, ?, ?)";
    return $this->pdo_execute($sql, [
        $data['id_lich'],
        $data['id_hdv'],       // phải truyền id_hdv ở đây
        $data['ngay_ghi'],
        $data['su_co'],
        $data['phan_hoi'],
        $data['nhan_xet_hdv']
    ]);
}


    // Cập nhật nhật ký
    public function updateNhatKy($id_nhat_ky, $data) {
        $sql = "UPDATE nhat_ky_tour SET 
                    id_lich = ?,
                    ngay_ghi = ?,
                    su_co = ?,
                    phan_hoi = ?,
                    nhan_xet_hdv = ?
                WHERE id_nhat_ky = ?";
        return $this->pdo_execute($sql, [
            $data['id_lich'],
            $data['ngay_ghi'],
            $data['su_co'],
            $data['phan_hoi'],
            $data['nhan_xet_hdv'],
            $id_nhat_ky
        ]);
    }

    // Xóa nhật ký
    public function deleteNhatKy($id) {
        $sql = "DELETE FROM nhat_ky_tour WHERE id_nhat_ky = ?";
        return $this->pdo_execute($sql, [$id]);
    }

    // Lấy lịch sử tour của HDV (tất cả tour đã/đang hướng dẫn)
   public function getTourHistory($id_hdv, $sort = 'ngay_khoi_hanh', $order = 'DESC') {
    $validSorts = ['ngay_khoi_hanh', 'ten_tour', 'gia_co_ban', 'trang_thai_lich_khoi_hanh'];
    $sort = in_array($sort, $validSorts) ? $sort : 'ngay_khoi_hanh';
    $order = ($order === 'ASC') ? 'ASC' : 'DESC';

    $sql = "SELECT t.*, 
                   l.id_lich,
                   d.id_dat_tour,
                   d.ngay_khoi_hanh,
                   d.ngay_ket_thuc,
                   d.tong_tien,
                   d.gia_co_ban,
                   ts.trang_thai_lich_khoi_hanh,
                   COUNT(DISTINCT k.id_khach) as so_khach,
                   DATEDIFF(NOW(), d.ngay_ket_thuc) as ngay_da_qua
            FROM tour_du_lich t
            JOIN lich_khoi_hanh l ON t.id_tour = l.id_tour
            JOIN trang_thai_lich_khoi_hanh ts ON l.id_trang_thai_lich_khoi_hanh = ts.id_trang_thai_lich_khoi_hanh
            LEFT JOIN dat_tour d ON l.id_dat_tour = d.id_dat_tour
            LEFT JOIN khach_trong_dat_tour k ON d.id_dat_tour = k.id_dat_tour
            WHERE l.id_hdv = ?
            GROUP BY l.id_lich
            ORDER BY $sort $order";

    return $this->pdo_query($sql, [$id_hdv]);
}



public function updateYeuCau($id_khach_tour, $yeu_cau) {
    $sql = "UPDATE khach_trong_dat_tour SET ghi_chu = ? WHERE id_khach = ?";
    return $this->pdo_execute($sql, [$yeu_cau, $id_khach_tour]);
}


}
?>
