<?php
require_once __DIR__ . '/Database.php';

class LichKhoiHanh {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    /* ================================
       LẤY TẤT CẢ LỊCH KHỞI HÀNH
    ================================= */
    public function getAll() {
        $sql = "SELECT lk.id_lich,
                       lk.id_tour,
                       t.ten_tour,
                       dt.ngay_khoi_hanh,
                       dt.ngay_ket_thuc,
                       lk.dia_diem_khoi_hanh,
                       lk.dia_diem_den,
                       hdv.ho_ten AS hdv_chinh,
                       lk.thong_tin_xe,
                       ks.ten_khach_san,
                       nh.ten_nha_hang,
                       lk.ghi_chu,
                       tt.trang_thai_lich_khoi_hanh
                FROM lich_khoi_hanh lk
                LEFT JOIN dat_tour dt ON lk.id_dat_tour = dt.id_dat_tour
                LEFT JOIN tour_du_lich t ON lk.id_tour = t.id_tour
                LEFT JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
                LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
                LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
                LEFT JOIN trang_thai_lich_khoi_hanh tt 
                    ON lk.id_trang_thai_lich_khoi_hanh = tt.id_trang_thai_lich_khoi_hanh
                ORDER BY dt.ngay_khoi_hanh DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ================================
       LẤY 1 LỊCH KHỞI HÀNH
    ================================= */
   public function getById($id) {
    $sql = "SELECT lk.id_lich, 
                   lk.id_tour,
                   t.ten_tour, 
                   dt.ngay_khoi_hanh, 
                   dt.ngay_ket_thuc,
                   lk.dia_diem_khoi_hanh, 
                   lk.dia_diem_den,
                   hdv.ho_ten AS hdv_chinh, 
                   nx.nha_xe, 
                   ks.ten_khach_san, 
                   nh.ten_nha_hang, 
                   lk.ghi_chu, 
                   tt.trang_thai_lich_khoi_hanh,
                   tt.id_trang_thai_lich_khoi_hanh
            FROM lich_khoi_hanh lk
            LEFT JOIN dat_tour dt ON lk.id_dat_tour = dt.id_dat_tour
            LEFT JOIN tour_du_lich t ON lk.id_tour = t.id_tour
            LEFT JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
            LEFT JOIN nha_xe nx ON t.id_xe = nx.id_xe
            LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
            LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
            LEFT JOIN trang_thai_lich_khoi_hanh tt 
                 ON lk.id_trang_thai_lich_khoi_hanh = tt.id_trang_thai_lich_khoi_hanh
            WHERE lk.id_lich = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    /* ================================
       THÊM LỊCH KHỞI HÀNH
    ================================= */
    public function create($data) {
        $sql = "INSERT INTO lich_khoi_hanh 
                (id_tour, id_dat_tour, id_hdv, dia_diem_khoi_hanh, dia_diem_den, 
                 id_trang_thai_lich_khoi_hanh, ghi_chu)
                VALUES (:id_tour, :id_dat_tour, :id_hdv, :dia_diem_khoi_hanh, 
                        :dia_diem_den, :id_trang_thai, :ghi_chu)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_tour'            => $data['id_tour'],
            'id_dat_tour'        => $data['id_dat_tour'],
            'id_hdv'             => $data['id_hdv'] ?? null,
            'dia_diem_khoi_hanh' => $data['dia_diem_khoi_hanh'] ?? '',
            'dia_diem_den'       => $data['dia_diem_den'] ?? '',
            'id_trang_thai'      => $data['id_trang_thai'] ?? 1,
            'ghi_chu'            => $data['ghi_chu'] ?? ''
        ]);

        return $this->conn->lastInsertId();
    }

    /* ================================
       CẬP NHẬT LỊCH KHỞI HÀNH
    ================================= */
    public function update($id, $data) {
        $sql = "UPDATE lich_khoi_hanh SET 
                    id_tour = :id_tour,
                    id_hdv = :id_hdv,
                    dia_diem_khoi_hanh = :dia_diem_khoi_hanh,
                    dia_diem_den = :dia_diem_den,
                    id_trang_thai_lich_khoi_hanh = :id_trang_thai,
                    ghi_chu = :ghi_chu
                WHERE id_lich = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_tour'            => $data['id_tour'],
            'id_hdv'             => $data['id_hdv'],
            'dia_diem_khoi_hanh' => $data['dia_diem_khoi_hanh'],
            'dia_diem_den'       => $data['dia_diem_den'],
            'id_trang_thai'      => $data['id_trang_thai'],
            'ghi_chu'            => $data['ghi_chu'],
            'id'                 => $id
        ]);
    }

    /* ================================
       XÓA LỊCH KHỞI HÀNH
    ================================= */
   public function delete($id) {
    // Chỉ xóa lịch khởi hành, không đụng vào booking
    $sql = "DELETE FROM lich_khoi_hanh WHERE id_lich = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
}


    /* ================================
       LỊCH CHƯA KẾT THÚC
    ================================= */
    public function getUpcomingAll() {
        $today = date('Y-m-d');

        $sql = "SELECT 
                    lk.id_lich,
                    lk.id_tour,
                    t.ten_tour,
                    dt.ngay_khoi_hanh,
                    dt.ngay_ket_thuc,
                    hdv.ho_ten AS hdv_chinh,
                    lk.dia_diem_khoi_hanh,
                    lk.dia_diem_den,
                    lk.ghi_chu,
                    tt.trang_thai_lich_khoi_hanh
                FROM lich_khoi_hanh lk
                LEFT JOIN dat_tour dt ON lk.id_dat_tour = dt.id_dat_tour
                LEFT JOIN tour_du_lich t ON lk.id_tour = t.id_tour
                LEFT JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
                LEFT JOIN trang_thai_lich_khoi_hanh tt 
                    ON lk.id_trang_thai_lich_khoi_hanh = tt.id_trang_thai_lich_khoi_hanh
                WHERE dt.ngay_ket_thuc >= :today
                ORDER BY dt.ngay_khoi_hanh ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['today' => $today]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ================================
       LỊCH ĐÃ KẾT THÚC
    ================================= */
    public function getFinishedDepartures() {
        $today = date('Y-m-d');

        $sql = "SELECT 
                    lk.id_lich,
                    lk.id_tour,
                    t.ten_tour,
                    dt.ngay_khoi_hanh,
                    dt.ngay_ket_thuc,
                    lk.dia_diem_khoi_hanh,
                    lk.dia_diem_den,
                    lk.ghi_chu,
                    hdv.ho_ten AS hdv_chinh,
                    tt.trang_thai_lich_khoi_hanh
                FROM lich_khoi_hanh lk
                LEFT JOIN dat_tour dt ON lk.id_dat_tour = dt.id_dat_tour
                LEFT JOIN tour_du_lich t ON lk.id_tour = t.id_tour
                LEFT JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
                LEFT JOIN trang_thai_lich_khoi_hanh tt 
                    ON lk.id_trang_thai_lich_khoi_hanh = tt.id_trang_thai_lich_khoi_hanh
                WHERE dt.ngay_ket_thuc < :today
                ORDER BY dt.ngay_khoi_hanh DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['today' => $today]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
