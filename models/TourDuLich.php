<?php
require_once './models/Database.php';

class TourDuLich {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    // Lấy danh sách tour, có search theo tên
 public function getAll($search = '') {
        $sql = "SELECT t.*, 
                       dm.ten_danh_muc, 
                       tt.trang_thai_tour, 
                       ks.ten_khach_san, 
                       nh.ten_nha_hang
                FROM tour_du_lich t
                JOIN danh_muc_tour dm ON t.id_danh_muc = dm.id_danh_muc
                JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
                LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
                LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
                WHERE t.ten_tour LIKE :search
                ORDER BY t.id_tour DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 tour theo id
    // public function getOne($id) {
    //     $sql = "SELECT t.*, 
    //                    d.ten_danh_muc, 
    //                    tt.trang_thai_tour
    //             FROM tour_du_lich t
    //             LEFT JOIN danh_muc_tour d ON t.id_danh_muc = d.id_danh_muc
    //             LEFT JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
    //             WHERE t.id_tour = :id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute(['id' => $id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    public function getOne($id_tour) {
    $sql = "SELECT t.*, 
                   t.gia_co_ban AS gia,
                   ks.ten_khach_san,
                   nh.ten_nha_hang,
                   tt.trang_thai_tour AS trang_thai,
                   lk.ngay_khoi_hanh,
                   lk.ngay_ket_thuc
            FROM tour_du_lich t
            LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
            LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
            LEFT JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
            LEFT JOIN lich_khoi_hanh lk ON t.id_tour = lk.id_tour
            WHERE t.id_tour = :id
            LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id_tour]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // Thêm tour mới
    public function create($data) {
    $sql = "INSERT INTO tour_du_lich 
            (id_danh_muc, id_trang_thai_tour, id_khach_san, id_nha_hang, id_xe, ten_tour, mo_ta, thoi_luong, gia_co_ban, chinh_sach)
            VALUES 
            (:id_danh_muc, :id_trang_thai_tour, :id_khach_san, :id_nha_hang, :id_xe, :ten_tour, :mo_ta, :thoi_luong, :gia_co_ban, :chinh_sach)";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($data);
}


    // Cập nhật tour
    public function update($id, $data) {
        $data['id_tour'] = $id;
        $sql = "UPDATE tour_du_lich SET 
                    id_danh_muc = :id_danh_muc,
                    id_trang_thai_tour = :id_trang_thai_tour,
                    ten_tour = :ten_tour,
                    mo_ta = :mo_ta,
                    thoi_luong = :thoi_luong,
                    gia_co_ban = :gia_co_ban,
                    chinh_sach = :chinh_sach
                WHERE id_tour = :id_tour";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // Xóa tour
    public function delete($id) {
    try {
        $sql = "DELETE FROM tour_du_lich WHERE id_tour = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            // Foreign key constraint violation
            throw new Exception("Không thể xóa tour vì còn lịch khởi hành liên quan!");
        }
        throw $e;
    }
}


    // Lấy danh sách danh mục tour
    public function getAllDanhMuc() {
        $stmt = $this->pdo->query("SELECT * FROM danh_muc_tour ORDER BY ten_danh_muc");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách trạng thái tour
    
    public function getAllTrangThai() {
        $stmt = $this->pdo->query("SELECT * FROM trang_thai_tour ORDER BY id_trang_thai_tour");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách khách sạn
    public function getAllKhachSan() {
        $stmt = $this->pdo->query("SELECT * FROM khach_san ORDER BY ten_khach_san");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách nhà hàng
    public function getAllNhaHang() {
        $stmt = $this->pdo->query("SELECT * FROM nha_hang ORDER BY ten_nha_hang");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function getLichKhoiHanh($id_tour)
{
    $sql = "SELECT * FROM lich_khoi_hanh WHERE id_tour = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id_tour]);
    return $stmt->fetchAll();
}
// TourDuLich.php - model
public function getLichTrinh($id_tour) {
    $sql = "SELECT * FROM lich_trinh WHERE id_tour = :id_tour ORDER BY ngay_thu ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id_tour' => $id_tour]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getAnhTourFolder($id_tour)
{
    $folder = __DIR__ . '/../uploads/img/' . $id_tour; // đường dẫn vật lý
    $images = [];

    if (is_dir($folder)) {
        $files = scandir($folder);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            // Kiểm tra là ảnh
            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                $images[] = 'uploads/img/' . $id_tour . '/' . $file; // đường dẫn dùng trong HTML
            }
        }
    }

    return $images;
}


}