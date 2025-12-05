<?php
require_once './models/Database.php';

class BaoCaoVanHanhModel {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function getAll() {
        $sql = "SELECT t.id_tour, t.ten_tour, t.mo_ta, t.thoi_luong, t.gia_co_ban, t.chinh_sach,
                       ks.ten_khach_san, nh.ten_nha_hang,
                       lk.ngay_khoi_hanh, lk.ngay_ket_thuc, lk.dia_diem_khoi_hanh, lk.dia_diem_den,
                       hdv.ho_ten AS huong_dan_vien,
                       dt.so_luong_khach, dt.tong_tien, dt.trang_thai
                FROM tour_du_lich t
                JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
                JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
                LEFT JOIN lich_khoi_hanh lk ON t.id_tour = lk.id_tour
                LEFT JOIN huong_dan_vien hdv ON lk.id_hdv = hdv.id_hdv
                LEFT JOIN dat_tour dt ON t.id_tour = dt.id_tour
                ORDER BY t.id_tour DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
