<?php
require_once './models/Database.php';

class KhachSanModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    // Lấy danh sách khách sạn, có tìm kiếm theo tên
    public function getAll($search = '') {
        $sql = "SELECT * FROM khach_san WHERE ten_khach_san LIKE :search ORDER BY id_khach_san DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một khách sạn theo ID
    public function getOne($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM khach_san WHERE id_khach_san = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm khách sạn mới
    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO khach_san (ten_khach_san, mo_ta)
            VALUES (:ten_khach_san, :mo_ta)
        ");
        $stmt->execute([
            'ten_khach_san' => $data['ten_khach_san'],
            'mo_ta' => $data['mo_ta'] ?? ''
        ]);
        return $this->pdo->lastInsertId();
    }

    // Cập nhật thông tin khách sạn
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE khach_san SET
            ten_khach_san = :ten_khach_san,
            mo_ta = :mo_ta
            WHERE id_khach_san = :id
        ");
        return $stmt->execute([
            'ten_khach_san' => $data['ten_khach_san'],
            'mo_ta' => $data['mo_ta'] ?? '',
            'id' => $id
        ]);
    }

    // Xóa khách sạn
    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM khach_san WHERE id_khach_san = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                throw new Exception("Không thể xóa khách sạn vì đang được sử dụng trong tour!");
            }
            throw $e;
        }
    }
}
