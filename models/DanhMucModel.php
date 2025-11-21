<?php
require_once __DIR__ . '/../commons/function.php'; // chứa connectDB()

class DanhMucModel {

    private $conn;

    public function __construct() {
        $this->conn = connectDB();
        if (!$this->conn) {
            die("Kết nối database thất bại!");
        }
    }

    public function getAll() {
        $sql = "SELECT * FROM danh_muc_tour ORDER BY id_danh_muc DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM danh_muc_tour WHERE id_danh_muc = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function add($ten, $mo_ta) {
        $sql = "INSERT INTO danh_muc_tour (ten_danh_muc, mo_ta) VALUES (:ten, :mo_ta)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':ten' => $ten, ':mo_ta' => $mo_ta]);
    }

    public function update($id, $ten, $mo_ta) {
        $sql = "UPDATE danh_muc_tour SET ten_danh_muc = :ten, mo_ta = :mo_ta WHERE id_danh_muc = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':ten' => $ten, ':mo_ta' => $mo_ta, ':id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM danh_muc_tour WHERE id_danh_muc = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
