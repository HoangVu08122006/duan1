<?php
require_once __DIR__ . '/Database.php';

class DashboardModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    // 1. Đếm số tour đang hoạt động
    public function countActiveTours() {
        $sql = "SELECT COUNT(*) as total 
                FROM tour_du_lich 
                WHERE id_trang_thai_tour = 1"; // giả sử 1 = đang hoạt động
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // 2. Số lượng booking hôm nay / tuần này
    public function getBookingStats() {
        $sqlToday = "SELECT COUNT(*) as today 
                     FROM dat_tour 
                     WHERE DATE(ngay_dat) = CURDATE()";
        $sqlWeek = "SELECT COUNT(*) as week 
                    FROM dat_tour 
                    WHERE YEARWEEK(ngay_dat, 1) = YEARWEEK(CURDATE(), 1)";

        $today = $this->pdo->query($sqlToday)->fetch(PDO::FETCH_ASSOC)['today'];
        $week  = $this->pdo->query($sqlWeek)->fetch(PDO::FETCH_ASSOC)['week'];

        return ['today' => $today, 'week' => $week];
    }

    // 3. Lịch khởi hành sắp tới
    public function getUpcomingDepartures($limit = 5) {
        $sql = "SELECT t.ten_tour, lk.ngay_khoi_hanh 
                FROM lich_khoi_hanh lk
                JOIN tour_du_lich t ON lk.id_tour = t.id_tour
                WHERE lk.ngay_khoi_hanh >= CURDATE()
                ORDER BY lk.ngay_khoi_hanh ASC
                LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Doanh thu theo tháng (trong năm hiện tại)
    public function getMonthlyRevenue() {
        $sql = "SELECT MONTH(ngay_dat) as thang, SUM(tong_tien) as doanh_thu
                FROM dat_tour
                WHERE YEAR(ngay_dat) = YEAR(CURDATE())
                GROUP BY MONTH(ngay_dat)
                ORDER BY thang ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 5. Cảnh báo tour sắp hết chỗ hoặc bị hủy
    public function getTourAlerts() {
        $sql = "SELECT t.ten_tour, lk.so_luong_con_lai, tt.trang_thai_tour
                FROM lich_khoi_hanh lk
                JOIN tour_du_lich t ON lk.id_tour = t.id_tour
                JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
                WHERE lk.so_luong_con_lai < 5 OR tt.trang_thai_tour = 'Hủy'";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
