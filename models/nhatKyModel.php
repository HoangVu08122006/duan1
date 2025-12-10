<?php
require_once __DIR__ . '/Database.php';

class NhatKyTour {
    private $db; // Database instance
    private $pdo; // PDO connection

    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    // Method thực thi SELECT trả về mảng
    private function pdo_query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method thực thi INSERT/UPDATE/DELETE
    private function pdo_execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    // Lấy tất cả nhật ký (có join lấy tên tour + HDV)
    public function getAllNhatKy() {
        $sql = "SELECT nk.*, l.id_tour, t.ten_tour, d.ngay_khoi_hanh, h.ho_ten AS ten_hdv
        FROM nhat_ky_tour nk
        JOIN lich_khoi_hanh l ON nk.id_lich = l.id_lich
        JOIN tour_du_lich t ON l.id_tour = t.id_tour
        JOIN huong_dan_vien h ON nk.id_hdv = h.id_hdv
        JOIN dat_tour d ON l.id_dat_tour = d.id_dat_tour
        ORDER BY nk.ngay_ghi DESC";

        return $this->pdo_query($sql);
    }

    // Lấy 1 nhật ký theo ID
    public function getNhatKyById($id_nhat_ky) {
        $sql = "SELECT nk.*, l.id_tour, t.ten_tour, l.ngay_khoi_hanh, h.ho_ten AS ten_hdv
                FROM nhat_ky_tour nk
                JOIN lich_khoi_hanh l ON nk.id_lich = l.id_lich
                JOIN tour_du_lich t ON l.id_tour = t.id_tour
                JOIN huong_dan_vien h ON nk.id_hdv = h.id_hdv
                WHERE nk.id_nhat_ky = ?";
        $rows = $this->pdo_query($sql, [$id_nhat_ky]);
        return $rows[0] ?? null;
    }


    

    // Xóa nhật ký
    public function deleteNhatKy($id_nhat_ky) {
        $sql = "DELETE FROM nhat_ky_tour WHERE id_nhat_ky = ?";
        return $this->pdo_execute($sql, [$id_nhat_ky]);
    }
}
?>
