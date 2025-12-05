<?php
require_once './models/Database.php';

class BookingModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    // Lấy tất cả booking
 // models/BookingModel.php
public function getAll() {
    // Lấy tất cả booking
    $sql = "
        SELECT dt.id_dat_tour, dt.so_luong_khach, dt.tong_tien, dt.trang_thai,
               t.ten_tour, t.gia_co_ban AS gia_tour,
               lk.ngay_khoi_hanh, lk.ngay_ket_thuc
        FROM dat_tour dt
        JOIN tour_du_lich t ON dt.id_tour = t.id_tour
        JOIN lich_khoi_hanh lk ON dt.id_lich = lk.id_lich
        ORDER BY dt.id_dat_tour DESC
    ";

    $bookings = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // Lấy danh sách khách cho mỗi booking
    foreach ($bookings as &$b) {
        $stmt = $this->pdo->prepare("
            SELECT ho_ten, so_dien_thoai, gioi_tinh
            FROM khach_trong_dat_tour
            WHERE id_dat_tour = :id
            ORDER BY id_khach ASC
        ");
        $stmt->execute([':id' => $b['id_dat_tour']]);
        $b['khachList'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $bookings;
}
// Lấy 1 booking theo ID, bao gồm danh sách khách
public function getById($id) {
    $stmt = $this->pdo->prepare("
        SELECT dt.*,
               t.ten_tour, t.gia_co_ban AS gia_tour,
               lk.ngay_khoi_hanh, lk.ngay_ket_thuc
        FROM dat_tour dt
        LEFT JOIN tour_du_lich t ON dt.id_tour = t.id_tour
        LEFT JOIN lich_khoi_hanh lk ON dt.id_lich = lk.id_lich
        WHERE dt.id_dat_tour = :id
    ");
    $stmt->execute([':id' => $id]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) return null;

    // Lấy danh sách khách
    $stmt2 = $this->pdo->prepare("
        SELECT * FROM khach_trong_dat_tour
        WHERE id_dat_tour = :id
        ORDER BY id_khach ASC
    ");
    $stmt2->execute([':id' => $id]);
    $booking['khachList'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    return $booking;
}


    // Tạo booking mới
// Tạo booking mới
public function create($data, $khach = null) {
    // Kiểm tra dữ liệu booking bắt buộc
    if (empty($data['id_tour']) || empty($data['so_luong_khach']) || empty($data['id_lich']) || empty($data['tong_tien'])) {
        throw new Exception("Dữ liệu booking chưa đầy đủ!");
    }

    // Thêm booking
    $stmt = $this->pdo->prepare("
        INSERT INTO dat_tour 
        (id_tour, so_luong_khach, id_lich, tong_tien, ngay_dat, trang_thai)
        VALUES (:id_tour, :so_luong_khach, :id_lich, :tong_tien, NOW(), :trang_thai)
    ");
    $stmt->execute([
        ':id_tour' => $data['id_tour'],
        ':so_luong_khach' => $data['so_luong_khach'],
        ':id_lich' => $data['id_lich'],
        ':tong_tien' => $data['tong_tien'],
        ':trang_thai' => $data['trang_thai'] ?? 'Chưa thanh toán'
    ]);

    $newID = $this->pdo->lastInsertId();

    // Nếu có dữ liệu khách, thêm tất cả khách vào khach_trong_dat_tour
    if ($khach && is_array($khach)) {
        $stmt2 = $this->pdo->prepare("
            INSERT INTO khach_trong_dat_tour 
            (id_dat_tour, ho_ten, so_dien_thoai, gioi_tinh, id_trang_thai_khach)
            VALUES (:id_dat_tour, :ho_ten, :so_dien_thoai, :gioi_tinh, :id_trang_thai_khach)
        ");

        foreach ($khach as $k) {
            $stmt2->execute([
                ':id_dat_tour' => $newID,
                ':ho_ten' => $k['ho_ten'] ?? '-',
                ':so_dien_thoai' => $k['so_dien_thoai'] ?? '-',
                ':gioi_tinh' => $k['gioi_tinh'] ?? 'Nam',
                ':id_trang_thai_khach' => $k['id_trang_thai_khach'] ?? 1 // Mặc định 1
            ]);
        }
    }

    return $newID;
}

// models/BookingModel.php
public function getTourById($idTour) {
    $stmt = $this->pdo->prepare("SELECT * FROM tour_du_lich WHERE id_tour = :id");
    $stmt->execute([':id' => $idTour]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Nếu cần lấy tất cả tour để show dropdown
public function getAllTours() {
    $stmt = $this->pdo->query("SELECT * FROM tour_du_lich");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy tất cả lịch khởi hành
public function getAllLich() {
    $stmt = $this->pdo->query("SELECT id_lich, id_tour, ngay_khoi_hanh, ngay_ket_thuc FROM lich_khoi_hanh");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    // Cập nhật booking
    public function updateBooking($id, $data) {
        if (empty($data['id_tour']) || empty($data['so_luong_khach']) || empty($data['id_lich']) || empty($data['tong_tien'])) {
            throw new Exception("Dữ liệu booking chưa đầy đủ!");
        }

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
 public function updateKhach($id_khach, $data) {
    $stmt = $this->pdo->prepare("
        UPDATE khach_trong_dat_tour SET
            ho_ten = :ho_ten,
            so_dien_thoai = :so_dien_thoai,
            gioi_tinh = :gioi_tinh
        WHERE id_khach = :id
    ");
    $stmt->execute([
        ':ho_ten' => $data['ho_ten'] ?? '-',
        ':so_dien_thoai' => $data['so_dien_thoai'] ?? '-',
        ':gioi_tinh' => $data['gioi_tinh'] ?? 'Nam',
        ':id' => $id_khach
    ]);
}



    // Xóa booking (bao gồm tất cả khách)
    public function deleteBooking($id) {
        try {
            $this->pdo->beginTransaction();

            // Xóa khách liên quan
            $stmt1 = $this->pdo->prepare("DELETE FROM khach_trong_dat_tour WHERE id_dat_tour = :id");
            $stmt1->execute(['id' => $id]);

            // Xóa booking
            $stmt2 = $this->pdo->prepare("DELETE FROM dat_tour WHERE id_dat_tour = :id");
            $stmt2->execute(['id' => $id]);

            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            if ($e->getCode() == '23000') {
                throw new Exception("Không thể xóa booking vì còn dữ liệu liên quan!");
            }
            throw $e;
        }
    }

    // Lấy danh sách khách của booking
    public function getKhach($id_dat_tour) {
        $stmt = $this->pdo->prepare("
            SELECT ho_ten, so_dien_thoai, gioi_tinh, ngay_sinh, so_cmnd_cccd, ghi_chu
            FROM khach_trong_dat_tour
            WHERE id_dat_tour = :id
            ORDER BY id_khach ASC
        ");
        $stmt->execute(['id' => $id_dat_tour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết booking (booking + tour + danh sách khách)
    public function getBookingDetail($id) {
        $stmt = $this->pdo->prepare("
            SELECT dt.*,
                   t.ten_tour, t.id_danh_muc, t.mo_ta, t.gia_co_ban AS gia,
                   lk.ngay_khoi_hanh, lk.ngay_ket_thuc,
                   ks.ten_khach_san, nh.ten_nha_hang,
                   tt.trang_thai_tour AS trang_thai_tour
            FROM dat_tour dt
            LEFT JOIN tour_du_lich t ON dt.id_tour = t.id_tour
            LEFT JOIN lich_khoi_hanh lk ON dt.id_lich = lk.id_lich
            LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
            LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
            LEFT JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
            WHERE dt.id_dat_tour = :id
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$booking) return null;

        // Lấy tất cả khách của booking
        $booking['khachList'] = $this->getKhach($id);

        return $booking;
    }

    public function countBookingsToday() {
    $today = date('Y-m-d');
    $sql = "SELECT COUNT(*) FROM dat_tour WHERE DATE(ngay_dat) = :today";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':today' => $today]);
    return $stmt->fetchColumn();
}


public function countBookingsThisWeek() {
    $start = date('Y-m-d', strtotime('monday this week'));
    $end = date('Y-m-d', strtotime('sunday this week'));
    $sql = "SELECT COUNT(*) FROM dat_tour WHERE DATE(ngay_dat) BETWEEN :start AND :end";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':start' => $start, ':end' => $end]);
    return $stmt->fetchColumn();
}
public function getMonthlyRevenue() {
    $sql = "SELECT MONTH(ngay_dat) AS thang, SUM(tong_tien) AS doanh_thu
            FROM dat_tour
            GROUP BY MONTH(ngay_dat)
            ORDER BY thang ASC";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>