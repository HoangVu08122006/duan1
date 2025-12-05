<?php

class NhatKyModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($tour = "", $ngay = "")
    {
        try {
            $sql = "
                SELECT nk.*, td.ten_tour, hd.ho_ten AS hdv
                FROM nhat_ky_tour nk
                JOIN lich_khoi_hanh lk ON nk.id_lich = lk.id_lich
                JOIN tour_du_lich td ON lk.id_tour = td.id_tour
                JOIN huong_dan_vien hd ON lk.id_hdv = hd.id_hdv
                WHERE 1
            ";

            $params = [];

            if (!empty($tour)) {
                $sql .= " AND td.ten_tour LIKE :tour";
                $params[':tour'] = "%$tour%";
            }

            if (!empty($ngay)) {
                $sql .= " AND nk.ngay_ghi = :ngay";
                $params[':ngay'] = $ngay;
            }

            $sql .= " ORDER BY nk.id_nhat_ky DESC";

            $stmt = $this->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Lỗi getAll: " . $e->getMessage());
        }
    }

    public function getOne($id)
    {
        try {
            $sql = "
                SELECT nk.*, td.ten_tour, hd.ho_ten AS hdv
                FROM nhat_ky_tour nk
                JOIN lich_khoi_hanh lk ON nk.id_lich = lk.id_lich
                JOIN tour_du_lich td ON lk.id_tour = td.id_tour
                JOIN huong_dan_vien hd ON lk.id_hdv = hd.id_hdv
                WHERE nk.id_nhat_ky = :id
                LIMIT 1
            ";

            $stmt = $this->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Lỗi getOne: " . $e->getMessage());
        }
    }

    public function insert(array $data)
    {
        try {
            $sql = "INSERT INTO nhat_ky_tour 
                    (id_lich, ngay_ghi, su_co, phan_hoi, nhan_xet_hdv)
                    VALUES (:id_lich, :ngay_ghi, :su_co, :phan_hoi, :nhan_xet_hdv)";

            $stmt = $this->prepare($sql);

            return $stmt->execute([
                ':id_lich' => $data['id_lich'],
                ':ngay_ghi' => $data['ngay_ghi'],
                ':su_co' => $data['su_co'],
                ':phan_hoi' => $data['phan_hoi'],
                ':nhan_xet_hdv' => $data['nhan_xet_hdv']
            ]);

        } catch (PDOException $e) {
            die("Lỗi insert: " . $e->getMessage());
        }
    }

public function update($id, array $data)
{
    try {
        $sql = "UPDATE nhat_ky_tour SET
                    id_lich = :id_lich,
                    ngay_ghi = :ngay_ghi,
                    su_co = :su_co,
                    phan_hoi = :phan_hoi,
                    nhan_xet_hdv = :nhan_xet_hdv
                WHERE id_nhat_ky = :id";

        $stmt = $this->prepare($sql);

        return $stmt->execute([
            ':id_lich' => $data['id_lich'],
            ':ngay_ghi' => $data['ngay_ghi'],
            ':su_co' => $data['su_co'],
            ':phan_hoi' => $data['phan_hoi'],
            ':nhan_xet_hdv' => $data['nhan_xet_hdv'],
            ':id' => $id
        ]);

    } catch (PDOException $e) {
        die("Lỗi update: " . $e->getMessage());
    }
}




    public function delete($id)
    {
        try {
            $sql = "DELETE FROM nhat_ky_tour WHERE id_nhat_ky = :id";
            $stmt = $this->prepare($sql);

            return $stmt->execute([':id' => $id]);

        } catch (PDOException $e) {
            die("Lỗi delete: " . $e->getMessage());
        }
    }
}
