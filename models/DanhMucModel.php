<?php
require_once __DIR__ . '/../commons/function.php'; // chứa hàm connectDB()

class DanhMucModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // kết nối database
        if (!$this->conn) {
            die("Kết nối database thất bại!");
        }
    }

    // Lấy tất cả danh mục
    public function getAll() {
        $sql = "SELECT * FROM danh_muc_tour ORDER BY id_danh_muc DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 danh mục theo id
    public function getOne($id) {
        $sql = "SELECT * FROM danh_muc_tour WHERE id_danh_muc = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục mới
    // public function create($data) {
    //     $sql = "INSERT INTO danh_muc_tour (ten_danh_muc, mo_ta) 
    //             VALUES (:ten_danh_muc, :mo_ta)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([
    //         'ten_danh_muc' => $data['ten_danh_muc'],
    //         'mo_ta'        => $data['mo_ta']
    //     ]);
    //     return $this->conn->lastInsertId();
    // }
   public function create($data) {
    $sql = "INSERT INTO danh_muc_tour (ten_danh_muc, mo_ta) 
            VALUES (:ten_danh_muc, :mo_ta)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        'ten_danh_muc' => $data['ten_danh_muc'],
        'mo_ta'        => $data['mo_ta'] ?? ''
    ]);
    return $this->conn->lastInsertId();
}

    // Cập nhật danh mục
    public function update($id, $data) {
        $sql = "UPDATE danh_muc_tour SET 
                    ten_danh_muc = :ten_danh_muc,
                  
                    mo_ta = :mo_ta
                WHERE id_danh_muc = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'ten_danh_muc' => $data['ten_danh_muc'],
            // 'image'        => $data['image'],
            'mo_ta'        => $data['mo_ta'],
            'id'           => $id
        ]);
    }

    // Xóa danh mục
    public function delete($id) {
        $sql = "DELETE FROM danh_muc_tour WHERE id_danh_muc = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
