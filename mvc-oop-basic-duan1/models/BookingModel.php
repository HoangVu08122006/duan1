<?php
require_once './models/Database.php';

class BookingModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll() {
        $sql = "
            SELECT dt.*, t.ten_tour, lk.ngay_khoi_hanh
            FROM dat_tour dt
            JOIN tour_du_lich t ON dt.id_tour = t.id_tour
            JOIN lich_khoi_hanh lk ON dt.id_lich = lk.id_lich
            ORDER BY dt.id_dat_tour DESC
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

//  public function getById($id) {
//     $stmt = $this->pdo->prepare("
//         SELECT dt.*, t.ten_tour, lk.ngay_khoi_hanh
//         FROM dat_tour dt
//         JOIN tour_du_lich t ON dt.id_tour = t.id_tour
//         JOIN lich_khoi_hanh lk ON dt.id_lich = lk.id_lich
//         WHERE dt.id_dat_tour = :id
//     ");
//     $stmt->execute(['id' => $id]);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }
public function getById($id) {
    $stmt = $this->pdo->prepare("
        SELECT dt.*,
               t.ten_tour,
               t.id_danh_muc,
               t.mo_ta,
               t.gia_co_ban AS gia,
               lk.ngay_khoi_hanh,
               lk.ngay_ket_thuc,
               ks.ten_khach_san,
               nh.ten_nha_hang,
               tt.trang_thai_tour AS trang_thai
        FROM dat_tour dt
        LEFT JOIN tour_du_lich t ON dt.id_tour = t.id_tour
        LEFT JOIN lich_khoi_hanh lk ON dt.id_lich = lk.id_lich
        LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
        LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
        LEFT JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
        WHERE dt.id_dat_tour = :id
    ");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



    public function create($data) {
        // đảm bảo các key tồn tại
        $stmt = $this->pdo->prepare("
            INSERT INTO dat_tour 
            (id_tour, so_luong_khach, id_lich, tong_tien,ngay_dat, trang_thai )
            VALUES (:id_tour, :so_luong_khach, :id_lich, :tong_tien, NOW(), :trang_thai)
        ");

        // bind từng giá trị để tránh lỗi
        $stmt->execute([
            ':id_tour' => $data['id_tour'],
            ':so_luong_khach' => $data['so_luong_khach'],
            ':id_lich' => $data['id_lich'],
            ':tong_tien' => $data['tong_tien'],
            // ':ngay_dat' => $data['ngay_dat']
            ':trang_thai' => $data['trang_thai'] ?? 'Chưa thanh toán',
            // ':ghi_chu' => $data['ghi_chu'] ?? null
        ]);

        return $this->pdo->lastInsertId();
    }

    public function updateBooking($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE dat_tour SET
            id_tour = :id_tour,
            id_lich = :id_lich,
            so_luong_khach = :so_luong_khach,
            tong_tien = :tong_tien,
            trang_thai = :trang_thai,
            ghi_chu = :ghi_chu
            WHERE id_dat_tour = :id
        ");

        $stmt->execute([
            ':id_tour' => $data['id_tour'],
            ':id_lich' => $data['id_lich'],
            ':so_luong_khach' => $data['so_luong_khach'],
            ':tong_tien' => $data['tong_tien'],
            ':trang_thai' => $data['trang_thai'] ?? 'Chưa thanh toán',
            ':ghi_chu' => $data['ghi_chu'] ?? null,
            ':id' => $id
        ]);
    }

    public function deleteBooking($id) {
    try {
        // Xóa tất cả khách thuộc booking
        $stmt1 = $this->pdo->prepare("DELETE FROM khach_trong_dat_tour WHERE id_dat_tour = :id");
        $stmt1->execute(['id' => $id]);

        // Sau đó xóa booking
        $stmt2 = $this->pdo->prepare("DELETE FROM dat_tour WHERE id_dat_tour = :id");
        $stmt2->execute(['id' => $id]);

    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            throw new Exception("Không thể xóa booking vì còn dữ liệu liên quan!");
        }
        throw $e;
    }
}


    public function getKhach($id_dat_tour) {
        $stmt = $this->pdo->prepare("SELECT * FROM khach_trong_dat_tour WHERE id_dat_tour=:id");
        $stmt->execute(['id'=>$id_dat_tour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
