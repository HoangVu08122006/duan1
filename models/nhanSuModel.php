<?php
require_once __DIR__ . '/Database.php';

class HuongDanVien {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Lấy tất cả HDV
    public function getAll() {
        $sql = "SELECT hdv.*, lhv.loai_hdv, tstv.trang_thai_lam_viec_hdv
                FROM huong_dan_vien hdv
                JOIN loai_hdv lhv ON hdv.id_loai_hdv = lhv.id_loai_hdv
                JOIN trang_thai_lam_viec_hdv tstv ON hdv.id_trang_thai_lam_viec_hdv = tstv.id_trang_thai_lam_viec_hdv
                ORDER BY hdv.id_hdv DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy HDV theo ID
    public function getById($id) {
        $sql = "SELECT hdv.*, lhv.loai_hdv, tstv.trang_thai_lam_viec_hdv
                FROM huong_dan_vien hdv
                JOIN loai_hdv lhv ON hdv.id_loai_hdv = lhv.id_loai_hdv
                JOIN trang_thai_lam_viec_hdv tstv ON hdv.id_trang_thai_lam_viec_hdv = tstv.id_trang_thai_lam_viec_hdv
                WHERE hdv.id_hdv=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới HDV
    public function create($data) {
        $sql = "INSERT INTO huong_dan_vien 
            (avatar, ho_ten, gioi_tinh, ngay_sinh, so_cccd, email, so_dien_thoai, id_loai_hdv, so_nam_kinh_nghiem, dia_chi, pass, id_trang_thai_lam_viec_hdv, mo_ta)
            VALUES
            (:avatar, :ho_ten, :gioi_tinh, :ngay_sinh, :so_cccd, :email, :so_dien_thoai, :id_loai_hdv, :so_nam_kinh_nghiem, :dia_chi, :pass, :id_trang_thai_lam_viec_hdv, :mo_ta)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Cập nhật HDV
    public function update($id, $data) {
        $sql = "UPDATE huong_dan_vien SET
                    avatar=:avatar,
                    ho_ten=:ho_ten,
                    gioi_tinh=:gioi_tinh,
                    ngay_sinh=:ngay_sinh,
                    so_cccd=:so_cccd,
                    email=:email,
                    so_dien_thoai=:so_dien_thoai,
                    id_loai_hdv=:id_loai_hdv,
                    so_nam_kinh_nghiem=:so_nam_kinh_nghiem,
                    dia_chi=:dia_chi,
                    pass=:pass,
                    id_trang_thai_lam_viec_hdv=:id_trang_thai_lam_viec_hdv,
                    mo_ta=:mo_ta
                WHERE id_hdv=:id";
        $data['id'] = $id;
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Xóa HDV
    public function delete($id) {
        $sql = "DELETE FROM huong_dan_vien WHERE id_hdv=:id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id'=>$id]);
    }

    // Lấy danh sách loại HDV
    public function getLoaiHDV() {
        return $this->db->query("SELECT * FROM loai_hdv")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách trạng thái làm việc
    public function getTrangThai() {
        return $this->db->query("SELECT * FROM trang_thai_lam_viec_hdv")->fetchAll(PDO::FETCH_ASSOC);
    }
}
