<?php
require_once __DIR__ . '/Database.php';

class DoanKhach {
    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    // Lấy toàn bộ đoàn khách có tour + HDV
    public function getAll() {
    $sql = "
        SELECT 
            dt.id_dat_tour,
            t.ten_tour,
            hdv.ho_ten AS ten_hdv,
            dt.ngay_khoi_hanh,
            dt.ngay_ket_thuc,
            dt.so_luong_khach,
            dt.tong_tien,
            dt.trang_thai
        FROM dat_tour dt
        JOIN tour_du_lich t ON dt.id_tour = t.id_tour
        JOIN lich_khoi_hanh lk ON dt.id_dat_tour = lk.id_dat_tour   -- sửa chỗ này
        JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
        ORDER BY dt.id_dat_tour DESC
    ";
    return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


    // Lấy danh sách khách theo đoàn
    // Lấy danh sách khách theo đoàn, kèm tên trạng thái
public function getKhachByDoan($id_dat_tour){
    $sql = "
        SELECT k.*, t.trang_thai_khach
        FROM khach_trong_dat_tour k
        LEFT JOIN trang_thai_khach t ON k.id_trang_thai_khach = t.id_trang_thai_khach
        WHERE k.id_dat_tour = ?
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id_dat_tour]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy tất cả trạng thái khách (dùng cho select dropdown)
public function getAllTrangThaiKhach(){
    $sql = "SELECT * FROM trang_thai_khach";
    return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}



    // Lấy 1 khách theo id_khach
public function getKhach($id_khach){
    $sql = "SELECT * FROM khach_trong_dat_tour WHERE id_khach = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id_khach]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public function getOne($id){
    $sql = "
        SELECT 
            dt.*,
            t.ten_tour,
            t.gia_co_ban,
            hdv.ho_ten AS ten_hdv,
            dt.ngay_khoi_hanh,
            dt.ngay_ket_thuc
        FROM dat_tour dt
        JOIN tour_du_lich t ON dt.id_tour = t.id_tour
        JOIN lich_khoi_hanh lk ON dt.id_tour = lk.id_tour   -- sửa chỗ này
        JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
        WHERE dt.id_dat_tour = ?
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



public function checkKhachTonTai($id_dat_tour, $data){
    $sql = "SELECT COUNT(*) 
            FROM khach_trong_dat_tour 
            WHERE id_dat_tour = ?
              AND (
                   (ho_ten = ? AND gioi_tinh = ? AND so_dien_thoai = ? 
                    AND ngay_sinh = ? AND so_cmnd_cccd = ? AND ghi_chu = ?)
                   OR so_cmnd_cccd = ?
              )";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        $id_dat_tour,
        $data['ho_ten'],
        $data['gioi_tinh'],
        $data['so_dien_thoai'],
        $data['ngay_sinh'],
        $data['so_cmnd_cccd'],
        $data['ghi_chu'] ?? '',
        $data['so_cmnd_cccd']
    ]);
    return $stmt->fetchColumn() > 0;
}


    // Thêm khách vào đoàn
public function addKhach($id_dat_tour, $data) {
   $sql = "INSERT INTO khach_trong_dat_tour
    (id_dat_tour, ho_ten, so_dien_thoai, gioi_tinh, ngay_sinh, so_cmnd_cccd, id_trang_thai_khach, ghi_chu)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        $id_dat_tour,
        $data['ho_ten'],
        $data['so_dien_thoai'],
        $data['gioi_tinh'],
        $data['ngay_sinh'],
        $data['so_cmnd_cccd'],
        $data['id_trang_thai_khach'],
        $data['ghi_chu'] ?? '',
    ]);

    // ❌ Không gọi recalcTongTien nữa
}

// Sửa khách
public function updateKhach($id_khach, $data){
    $sql = "UPDATE khach_trong_dat_tour
            SET ho_ten = ?, gioi_tinh = ?, so_dien_thoai = ?, ngay_sinh = ?, so_cmnd_cccd = ?, id_trang_thai_khach = ?,  ghi_chu = ?
            WHERE id_khach = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        $data['ho_ten'],
        $data['gioi_tinh'],
        $data['so_dien_thoai'],
        $data['ngay_sinh'],
        $data['so_cmnd_cccd'],
        $data['id_trang_thai_khach'],
        $data['ghi_chu'] ?? '',
        $id_khach
    ]);

    // ❌ Không gọi recalcTongTien nữa
}

// Xóa khách
public function deleteKhach($id_khach){
    $sqlDel = "DELETE FROM khach_trong_dat_tour WHERE id_khach = ?";
    $stmtDel = $this->conn->prepare($sqlDel);
    $stmtDel->execute([$id_khach]);

    // ❌ Không gọi recalcTongTien nữa
}

public function countKhachThucTe($id_dat_tour){
    $sql = "SELECT COUNT(*) FROM khach_trong_dat_tour WHERE id_dat_tour = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id_dat_tour]);
    return $stmt->fetchColumn();
}

    // Tính lại số lượng khách và tổng tiền
    private function recalcTongTien($id_dat_tour){
        $sql = "SELECT COUNT(*) AS so_khach, t.gia_co_ban
                FROM khach_trong_dat_tour k
                JOIN dat_tour dt ON k.id_dat_tour = dt.id_dat_tour
                JOIN tour_du_lich t ON dt.id_tour = t.id_tour
                WHERE k.id_dat_tour = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_dat_tour]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $so_khach = $res['so_khach'];
        $tong_tien = $so_khach * $res['gia_co_ban'];

        $sqlUpdate = "UPDATE dat_tour SET so_luong_khach = ?, tong_tien = ? WHERE id_dat_tour = ?";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);
        $stmtUpdate->execute([$so_khach, $tong_tien, $id_dat_tour]);
    }
}
