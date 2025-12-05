<?php
require_once __DIR__ . '/Database.php';

class LichKhoiHanh {
    private $conn;

    public function __construct() {
        $this->conn = new Database();

    }

    public function getAll() {
    $sql = "SELECT lk.id_lich, t.ten_tour, lk.ngay_khoi_hanh, lk.ngay_ket_thuc, 
                   lk.dia_diem_khoi_hanh, lk.dia_diem_den,  -- thêm dòng này
                   hdv.ho_ten AS hdv_chinh, lk.thong_tin_xe, 
                   ks.ten_khach_san, nh.ten_nha_hang, lk.ghi_chu, 
                   tt.trang_thai_lich_khoi_hanh
            FROM lich_khoi_hanh lk
            JOIN tour_du_lich t ON lk.id_tour = t.id_tour
            JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
            JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
            JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
            JOIN trang_thai_lich_khoi_hanh tt ON lk.id_trang_thai_lich_khoi_hanh = tt.id_trang_thai_lich_khoi_hanh
            ORDER BY lk.ngay_khoi_hanh DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Lấy theo ID
    public function getById($id) {
        $sql = "SELECT lk.id_lich, t.ten_tour, lk.ngay_khoi_hanh, lk.ngay_ket_thuc,
               lk.dia_diem_khoi_hanh, lk.dia_diem_den,
               hdv.ho_ten AS hdv_chinh, lk.thong_tin_xe, 
               ks.ten_khach_san, nh.ten_nha_hang, lk.ghi_chu, 
               tt.trang_thai_lich_khoi_hanh,
               tt.id_trang_thai_lich_khoi_hanh
        FROM lich_khoi_hanh lk
        JOIN tour_du_lich t ON lk.id_tour = t.id_tour
        JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
        JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
        JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
        JOIN trang_thai_lich_khoi_hanh tt ON lk.id_trang_thai_lich_khoi_hanh = tt.id_trang_thai_lich_khoi_hanh
        WHERE lk.id_lich = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới
    public function create($data){
        $sql = "INSERT INTO lich_khoi_hanh 
                (id_tour, id_hdv, dia_diem_khoi_hanh, dia_diem_den, ngay_khoi_hanh, ngay_ket_thuc, thong_tin_xe, id_trang_thai_lich_khoi_hanh, ghi_chu)
                VALUES (:id_tour, :id_hdv, :dia_diem_khoi_hanh, :dia_diem_den, :ngay_khoi_hanh, :ngay_ket_thuc, :thong_tin_xe, :id_trang_thai, :ghi_chu)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_tour'=>$data['id_tour'],
            'id_hdv'=>$data['id_hdv'],
            'dia_diem_khoi_hanh'=>$data['dia_diem_khoi_hanh'],
            'dia_diem_den'=>$data['dia_diem_den'],
            'ngay_khoi_hanh'=>$data['ngay_khoi_hanh'],
            'ngay_ket_thuc'=>$data['ngay_ket_thuc'],
            'thong_tin_xe'=>$data['thong_tin_xe'],
            'id_trang_thai'=>$data['id_trang_thai'],
            'ghi_chu'=>$data['ghi_chu']
        ]);
    }

    // Cập nhật
    public function update($id, $data){
        $sql = "UPDATE lich_khoi_hanh SET 
                    id_tour=:id_tour,
                    id_hdv=:id_hdv,
                    dia_diem_khoi_hanh=:dia_diem_khoi_hanh,
                    dia_diem_den=:dia_diem_den,
                    ngay_khoi_hanh=:ngay_khoi_hanh,
                    ngay_ket_thuc=:ngay_ket_thuc,
                    thong_tin_xe=:thong_tin_xe,
                    id_trang_thai_lich_khoi_hanh=:id_trang_thai,
                    ghi_chu=:ghi_chu
                WHERE id_lich=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_tour'=>$data['id_tour'],
            'id_hdv'=>$data['id_hdv'],
            'dia_diem_khoi_hanh'=>$data['dia_diem_khoi_hanh'],
            'dia_diem_den'=>$data['dia_diem_den'],
            'ngay_khoi_hanh'=>$data['ngay_khoi_hanh'],
            'ngay_ket_thuc'=>$data['ngay_ket_thuc'],
            'thong_tin_xe'=>$data['thong_tin_xe'],
            'id_trang_thai'=>$data['id_trang_thai'],
            'ghi_chu'=>$data['ghi_chu'],
            'id'=>$id
        ]);
    }

    // Xóa
    public function delete($id){
        $sql = "DELETE FROM lich_khoi_hanh WHERE id_lich=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
    }
}
