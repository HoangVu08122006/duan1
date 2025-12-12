<?php
require_once './models/Database.php';

class NhaHangModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll($search = '') {
        $sql = "SELECT * FROM nha_hang WHERE ten_nha_hang LIKE :search ORDER BY id_nha_hang DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM nha_hang WHERE id_nha_hang = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO nha_hang (ten_nha_hang, sdt_nha_hang, gia_nha_hang, mo_ta)
            VALUES (:ten_nha_hang, :sdt_nha_hang, :gia_nha_hang, :mo_ta)
        ");
        $stmt->execute([
            'ten_nha_hang' => $data['ten_nha_hang'],
            'sdt_nha_hang' => $data['sdt_nha_hang'],
            'gia_nha_hang' => $data['gia_nha_hang'],
            'mo_ta' => $data['mo_ta'] ?? ''
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE nha_hang SET
            ten_nha_hang = :ten_nha_hang,
            sdt_nha_hang = :sdt_nha_hang,
            gia_nha_hang = :gia_nha_hang,
            mo_ta = :mo_ta
            WHERE id_nha_hang = :id
        ");
        return $stmt->execute([
            'ten_nha_hang' => $data['ten_nha_hang'],
            'sdt_nha_hang' => $data['sdt_nha_hang'], // giữ nguyên dạng chuỗi
            'gia_nha_hang' => (int)$data['gia_nha_hang'], // giá thì ép kiểu số
            'mo_ta'        => $data['mo_ta'] ?? '',
            'id'           => $id
        ]);

    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM nha_hang WHERE id_nha_hang = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                throw new Exception("Không thể xóa nhà hàng vì đang được sử dụng trong tour!");
            }
            throw $e;
        }
    }
}
