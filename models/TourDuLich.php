<?php
require_once __DIR__ . '/Database.php';

class TourDuLich {
    private $conn;

    public function __construct() {
        $this->conn = new Database();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM tour_du_lich");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tour_du_lich WHERE id_tour = :id");
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
