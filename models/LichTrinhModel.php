<?php

class LichTrinh {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    // Thêm mới lịch trình theo tour
    public function create($idTour, $data) {
        $sql = "INSERT INTO lich_trinh (id_tour, ngay_thu, tieu_de, hoat_dong, dia_diem)
                VALUES (:id_tour, :ngay_thu, :tieu_de, :hoat_dong, :dia_diem)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_tour'   => $idTour,
            'ngay_thu'  => $data['ngay_thu'],
            'tieu_de'   => $data['tieu_de'],
            'hoat_dong' => $data['hoat_dong'],
            'dia_diem'  => $data['dia_diem']
        ]);
        return $this->conn->lastInsertId();
    }

    // Lấy lịch trình theo tour
    public function getByTour($idTour) {
        $stmt = $this->conn->prepare("SELECT * FROM lich_trinh WHERE id_tour = :id ORDER BY ngay_thu ASC");
        $stmt->execute(['id' => $idTour]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy lịch trình theo lịch khởi hành
    public function getByLich($idLich) {
        $stmt = $this->conn->prepare("SELECT * FROM lich_trinh WHERE id_lich = :id_lich ORDER BY ngay_thu ASC");
        $stmt->execute(['id_lich' => $idLich]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update nếu tồn tại, insert nếu chưa có
public function updateOrCreate($idTour, $ngayThu, $data) {
    // Kiểm tra xem lịch trình cho tour + ngày_thu đã tồn tại chưa
    $stmt = $this->conn->prepare(
        "SELECT id_lich_trinh 
         FROM lich_trinh 
         WHERE id_tour = :id_tour AND ngay_thu = :ngay_thu"
    );
    $stmt->execute(['id_tour' => $idTour, 'ngay_thu' => $ngayThu]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Nếu tồn tại thì update
        $sql = "UPDATE lich_trinh 
                SET tieu_de = :tieu_de, hoat_dong = :hoat_dong, dia_diem = :dia_diem
                WHERE id_lich_trinh = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'tieu_de'   => $data['tieu_de'],
            'hoat_dong' => $data['hoat_dong'],
            'dia_diem'  => $data['dia_diem'],
            'id'        => $row['id_lich_trinh']
        ]);
        return $row['id_lich_trinh'];
    } else {
        // Nếu chưa có thì insert mới
        $sql = "INSERT INTO lich_trinh (id_tour, ngay_thu, tieu_de, hoat_dong, dia_diem)
                VALUES (:id_tour, :ngay_thu, :tieu_de, :hoat_dong, :dia_diem)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id_tour'   => $idTour,
            'ngay_thu'  => $ngayThu,
            'tieu_de'   => $data['tieu_de'],
            'hoat_dong' => $data['hoat_dong'],
            'dia_diem'  => $data['dia_diem']
        ]);
        return $this->conn->lastInsertId();
    }
}

}
