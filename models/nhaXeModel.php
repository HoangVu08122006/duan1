<?php
require_once './models/Database.php';

class NhaXeModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll($search = '') {
        $sql = "SELECT * FROM nha_xe WHERE nha_xe LIKE :search ORDER BY id_xe DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['search' => "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM nha_xe WHERE id_xe = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        // Kiểm tra dữ liệu bắt buộc
        if (empty($data['nha_xe'])) {
            throw new Exception("Tên nhà xe không được để trống");
        }
        if (empty($data['sdt_nha_xe'])) {
            throw new Exception("Số điện thoại không được để trống");
        }
        if (!isset($data['gia_nha_xe']) || $data['gia_nha_xe'] === '') {
            throw new Exception("Giá nhà xe không được để trống");
        }
        if (!is_numeric($data['gia_nha_xe'])) {
            throw new Exception("Giá nhà xe phải là số");
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO nha_xe (nha_xe, sdt_nha_xe, gia_nha_xe, mo_ta)
            VALUES (:nha_xe, :sdt_nha_xe, :gia_nha_xe, :mo_ta)
        ");
        $stmt->execute([
            'nha_xe'     => $data['nha_xe'],
            'sdt_nha_xe' => $data['sdt_nha_xe'],
            'gia_nha_xe' => (int)$data['gia_nha_xe'],
            'mo_ta'      => $data['mo_ta'] ?? ''
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        // Kiểm tra dữ liệu bắt buộc
        if (empty($data['nha_xe'])) {
            throw new Exception("Tên nhà xe không được để trống");
        }
        if (empty($data['sdt_nha_xe'])) {
            throw new Exception("Số điện thoại không được để trống");
        }
        if (!isset($data['gia_nha_xe']) || $data['gia_nha_xe'] === '') {
            throw new Exception("Giá nhà xe không được để trống");
        }
        if (!is_numeric($data['gia_nha_xe'])) {
            throw new Exception("Giá nhà xe phải là số");
        }

        $stmt = $this->pdo->prepare("
            UPDATE nha_xe SET
            nha_xe = :nha_xe,
            sdt_nha_xe = :sdt_nha_xe,
            gia_nha_xe = :gia_nha_xe,
            mo_ta = :mo_ta
            WHERE id_xe = :id
        ");
        return $stmt->execute([
            'nha_xe'     => $data['nha_xe'],
            'sdt_nha_xe' => $data['sdt_nha_xe'],
            'gia_nha_xe' => (int)$data['gia_nha_xe'],
            'mo_ta'      => $data['mo_ta'] ?? '',
            'id'         => $id
        ]);
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM nha_xe WHERE id_xe = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                throw new Exception("Không thể xóa nhà xe vì đang được sử dụng trong tour!");
            }
            throw $e;
        }
    }
}
