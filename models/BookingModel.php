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
        $sql = "
            SELECT dt.id_dat_tour, dt.so_luong_khach, dt.tong_tien, dt.trang_thai,
                   dt.ngay_khoi_hanh, dt.ngay_ket_thuc, dt.gia_co_ban,
                   t.ten_tour
            FROM dat_tour dt
            JOIN tour_du_lich t ON dt.id_tour = t.id_tour
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
            SELECT dt.*, t.ten_tour
            FROM dat_tour dt
            LEFT JOIN tour_du_lich t ON dt.id_tour = t.id_tour
            WHERE dt.id_dat_tour = :id
        ");
        $stmt->execute([':id' => $id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$booking) return null;

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
        if (!isset($data['id_tour'], $data['so_luong_khach'], $data['tong_tien'], $data['ngay_khoi_hanh'], $data['ngay_ket_thuc'], $data['gia_co_ban'])) {
            throw new Exception("Dữ liệu booking chưa đầy đủ!");
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO dat_tour 
            (id_tour, so_luong_khach, tong_tien, ngay_dat, trang_thai, ngay_khoi_hanh, ngay_ket_thuc, gia_co_ban, ghi_chu)
            VALUES (:id_tour, :so_luong_khach, :tong_tien, NOW(), :trang_thai, :ngay_khoi_hanh, :ngay_ket_thuc, :gia_co_ban, :ghi_chu)
        ");
        $stmt->execute([
            ':id_tour' => $data['id_tour'],
            ':so_luong_khach' => $data['so_luong_khach'],
            ':tong_tien' => $data['tong_tien'],
            ':trang_thai' => $data['trang_thai'] ?? 'Chưa thanh toán',
            ':ngay_khoi_hanh' => $data['ngay_khoi_hanh'],
            ':ngay_ket_thuc' => $data['ngay_ket_thuc'],
            ':gia_co_ban' => $data['gia_co_ban'],
            ':ghi_chu' => $data['ghi_chu'] ?? null
        ]);

        $newID = $this->pdo->lastInsertId();

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
                    ':id_trang_thai_khach' => $k['id_trang_thai_khach'] ?? 1
                ]);
            }
        }
        return $newID;
    }

// Lấy tất cả tour để show dropdown
public function getAllTours() {
    $stmt = $this->pdo->query("SELECT id_tour, ten_tour, gia_co_ban FROM tour_du_lich");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy 1 tour theo ID
public function getTourById($idTour) {
    $stmt = $this->pdo->prepare("SELECT id_tour, ten_tour, gia_co_ban FROM tour_du_lich WHERE id_tour = :id");
    $stmt->execute([':id' => $idTour]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



// Lấy tất cả lịch khởi hành
public function getAllLich() {
    $stmt = $this->pdo->query("SELECT id_lich, id_tour, ngay_khoi_hanh, ngay_ket_thuc FROM lich_khoi_hanh");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    // Cập nhật booking
   
    public function updateBooking($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE dat_tour SET
                id_tour = :id_tour,
                so_luong_khach = :so_luong_khach,
                tong_tien = :tong_tien,
                trang_thai = :trang_thai,
                ghi_chu = :ghi_chu,
                ngay_khoi_hanh = :ngay_khoi_hanh,
                ngay_ket_thuc = :ngay_ket_thuc,
                gia_co_ban = :gia_co_ban
            WHERE id_dat_tour = :id
        ");
        $stmt->execute([
            ':id_tour' => $data['id_tour'],
            ':so_luong_khach' => $data['so_luong_khach'],
            ':tong_tien' => $data['tong_tien'],
            ':trang_thai' => $data['trang_thai'] ?? 'Chưa thanh toán',
            ':ghi_chu' => $data['ghi_chu'] ?? null,
            ':ngay_khoi_hanh' => $data['ngay_khoi_hanh'],
            ':ngay_ket_thuc' => $data['ngay_ket_thuc'],
            ':gia_co_ban' => $data['gia_co_ban'],
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
               t.ten_tour, t.id_danh_muc, t.mo_ta,
               ks.ten_khach_san, nh.ten_nha_hang, nx.nha_xe,
               tt.trang_thai_tour AS trang_thai_tour
        FROM dat_tour dt
        LEFT JOIN tour_du_lich t ON dt.id_tour = t.id_tour
        LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
        LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
        LEFT JOIN nha_xe nx ON t.id_xe = nx.id_xe
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



public function getMonthlyRevenue() {
    $sql = "SELECT MONTH(ngay_dat) AS thang, SUM(tong_tien) AS doanh_thu
            FROM dat_tour
            GROUP BY MONTH(ngay_dat)
            ORDER BY thang ASC";
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// trong models/BookingModel.php
public function getLatestBooking() {
    // Lấy booking mới nhất
    $sql = "SELECT * FROM dat_tour ORDER BY id_dat_tour DESC LIMIT 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
        return null;
    }

    // Lấy danh sách khách liên quan trong khach_trong_dat_tour (nếu có)
    $sql2 = "SELECT id_khach, ho_ten, so_dien_thoai, gioi_tinh, ngay_sinh
             FROM khach_trong_dat_tour
             WHERE id_dat_tour = :id_dat_tour";
    $stmt2 = $this->pdo->prepare($sql2);
    $stmt2->execute([':id_dat_tour' => $booking['id_dat_tour']]);
    $passengers = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Gắn passengers vào booking trả về
    $booking['passengers'] = $passengers;
    $booking['first_passenger'] = isset($passengers[0]) ? $passengers[0] : null;

    return $booking;
}

public function getLatestBookingWithoutSchedule() {
    $sql = "SELECT dt.*, k.ho_ten, k.so_dien_thoai
            FROM dat_tour dt
            LEFT JOIN lich_khoi_hanh lk
                ON lk.id_dat_tour = dt.id_dat_tour
            LEFT JOIN khach_trong_dat_tour k
                ON k.id_dat_tour = dt.id_dat_tour
            WHERE lk.id_lich IS NULL
            ORDER BY dt.id_dat_tour DESC
            LIMIT 1";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// models/BookingModel.php

// Lấy tổng doanh thu tuần hiện tại
public function getWeeklyRevenue() {
    $pdo = $this->pdo;

    $startOfWeek = date('Y-m-d', strtotime('monday this week'));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

    $sql = "
    SELECT 
        dt.id_dat_tour,
        dt.ngay_khoi_hanh AS ngay,
        dt.tong_tien AS doanh_thu_thu_ngan,
        COALESCE(k.gia_khach_san,0) AS chi_phi_khach_san,
        COALESCE(n.gia_nha_hang,0) AS chi_phi_nha_hang,
        COALESCE(h.luong_hdv,0) AS chi_phi_hdv,
        COALESCE(x.gia_nha_xe,0) AS chi_phi_xe,
        (dt.tong_tien
         - COALESCE(k.gia_khach_san,0)
         - COALESCE(n.gia_nha_hang,0)
         - COALESCE(h.luong_hdv,0)
         - COALESCE(x.gia_nha_xe,0)
        ) AS doanh_thu
    FROM dat_tour dt
    LEFT JOIN tour_du_lich t ON dt.id_tour = t.id_tour
    LEFT JOIN khach_san k ON t.id_khach_san = k.id_khach_san
    LEFT JOIN nha_hang n ON t.id_nha_hang = n.id_nha_hang
    LEFT JOIN nha_xe x ON t.id_xe = x.id_xe
    LEFT JOIN lich_khoi_hanh lk ON dt.id_dat_tour = lk.id_dat_tour
    LEFT JOIN huong_dan_vien h ON lk.id_hdv = h.id_hdv
    WHERE dt.ngay_khoi_hanh BETWEEN :start AND :end
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['start' => $startOfWeek, 'end' => $endOfWeek]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as &$r) {
        $r['doanh_thu'] = floatval($r['doanh_thu']);
    }

    return $result;
}




// Tổng booking tuần này
public function countBookingsThisWeek() {
    $startOfWeek = date('Y-m-d', strtotime('monday this week'));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

    $sql = "SELECT COUNT(*) as total FROM dat_tour WHERE ngay_khoi_hanh BETWEEN :start AND :end";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['start' => $startOfWeek, 'end' => $endOfWeek]);

    return intval($stmt->fetch(PDO::FETCH_ASSOC)['total']);
}

// Tổng khách tuần này
public function countCustomersThisWeek() {
    $startOfWeek = date('Y-m-d', strtotime('monday this week'));
    $endOfWeek = date('Y-m-d', strtotime('sunday this week'));

    $sql = "SELECT SUM(so_luong_khach) as total FROM dat_tour WHERE ngay_khoi_hanh BETWEEN :start AND :end";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['start' => $startOfWeek, 'end' => $endOfWeek]);

    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    return $total !== null ? intval($total) : 0;
}




}

?>