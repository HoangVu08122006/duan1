<?php
require_once __DIR__ . '/Database.php';

class TrangThaiLichKhoiHanh {
    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM trang_thai_lich_khoi_hanh");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
