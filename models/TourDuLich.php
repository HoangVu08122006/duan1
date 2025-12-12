<?php
require_once './models/Database.php';

class TourDuLich
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    // Lấy danh sách tour, có search theo tên
 public function getAll($search = '')
{
    $sql = "SELECT t.*, 
                   dm.ten_danh_muc, 
                   tt.trang_thai_tour, 
                   ks.ten_khach_san, 
                   nh.ten_nha_hang,
                   nx.nha_xe,
                   GROUP_CONCAT(a.duong_dan_anh) AS anh_tour
            FROM tour_du_lich t
            JOIN danh_muc_tour dm ON t.id_danh_muc = dm.id_danh_muc
            JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
            LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
            LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
            LEFT JOIN nha_xe nx ON t.id_xe = nx.id_xe
            LEFT JOIN anh_tour a ON t.id_tour = a.id_tour
            WHERE t.ten_tour LIKE :search
            GROUP BY t.id_tour
            ORDER BY t.id_tour DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['search' => "%$search%"]);
    $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Chuyển chuỗi ảnh thành mảng
    foreach ($tours as &$tour) {
        $tour['anh_tour'] = !empty($tour['anh_tour']) ? explode(',', $tour['anh_tour']) : [];
    }
    return $tours;
}

public function getOne($id_tour)
{
    // Lấy thông tin tour + ảnh + danh mục
    $sql = "SELECT t.*, 
                   t.gia_co_ban AS gia,
                   dm.ten_danh_muc,
                   ks.ten_khach_san,
                   nh.ten_nha_hang,
                   tt.trang_thai_tour AS trang_thai,
                   nx.nha_xe,
                   GROUP_CONCAT(a.duong_dan_anh) AS anh_tour
            FROM tour_du_lich t
            LEFT JOIN danh_muc_tour dm ON t.id_danh_muc = dm.id_danh_muc
            LEFT JOIN khach_san ks ON t.id_khach_san = ks.id_khach_san
            LEFT JOIN nha_hang nh ON t.id_nha_hang = nh.id_nha_hang
            LEFT JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
            LEFT JOIN nha_xe nx ON t.id_xe = nx.id_xe
            LEFT JOIN anh_tour a ON t.id_tour = a.id_tour
            WHERE t.id_tour = :id
            GROUP BY t.id_tour";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id_tour]);
    $tour = $stmt->fetch(PDO::FETCH_ASSOC);

    // Chuyển chuỗi ảnh thành mảng
    $tour['anh_tour'] = !empty($tour['anh_tour']) ? explode(',', $tour['anh_tour']) : [];

    // Lấy lịch khởi hành mới nhất
    $sqlDt = "SELECT ngay_khoi_hanh, ngay_ket_thuc 
              FROM dat_tour 
              WHERE id_tour = :id 
              ORDER BY id_dat_tour DESC 
              LIMIT 1";
    $stmtDt = $this->pdo->prepare($sqlDt);
    $stmtDt->execute(['id' => $id_tour]);
    $datTour = $stmtDt->fetch(PDO::FETCH_ASSOC);

    if ($datTour) {
        $tour['ngay_khoi_hanh'] = $datTour['ngay_khoi_hanh'];
        $tour['ngay_ket_thuc']  = $datTour['ngay_ket_thuc'];
    }

    return $tour;
}

public function create($data)
{
    // 1. Thêm tour
    $sql = "INSERT INTO tour_du_lich 
            (id_danh_muc, id_trang_thai_tour, id_khach_san, id_nha_hang, id_xe, 
             ten_tour, mo_ta, chinh_sach, so_ngay)
            VALUES 
            (:id_danh_muc, :id_trang_thai_tour, :id_khach_san, :id_nha_hang, :id_xe,
             :ten_tour, :mo_ta, :chinh_sach, :so_ngay)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':id_danh_muc'        => $data['id_danh_muc'],
        ':id_trang_thai_tour' => $data['id_trang_thai_tour'],
        ':id_khach_san'       => $data['id_khach_san'],
        ':id_nha_hang'        => $data['id_nha_hang'],
        ':id_xe'              => $data['id_xe'],
        ':ten_tour'           => $data['ten_tour'],
        ':mo_ta'              => $data['mo_ta'],
        ':chinh_sach'         => $data['chinh_sach'],
        ':so_ngay'            => $data['so_ngay']
    ]);

    // 2. Lấy id_tour vừa tạo
    $idTour = $this->pdo->lastInsertId();

    // 3. Lưu nhiều ảnh
    if (!empty($data['anh_tour']) && is_array($data['anh_tour'])) {
        $sqlAnh = "INSERT INTO anh_tour (id_tour, duong_dan_anh) VALUES (:id_tour, :duong_dan_anh)";
        $stmtAnh = $this->pdo->prepare($sqlAnh);
        foreach ($data['anh_tour'] as $fileName) {
            if (!empty($fileName)) {
                $stmtAnh->execute([
                    ':id_tour' => $idTour,
                    ':duong_dan_anh' => $fileName
                ]);
            }
        }
    }

    // 4. Lưu lịch trình
    if (!empty($data['lich_trinh']) && is_array($data['lich_trinh'])) {
        $sqlLich = "INSERT INTO lich_trinh (id_tour, ngay_thu, tieu_de, hoat_dong, dia_diem) 
                    VALUES (:id_tour, :ngay_thu, :tieu_de, :hoat_dong, :dia_diem)";
        $stmtLich = $this->pdo->prepare($sqlLich);

        foreach ($data['lich_trinh'] as $ngay => $lt) {
            $stmtLich->execute([
                ':id_tour'   => $idTour,
                ':ngay_thu'  => $lt['ngay_thu'],
                ':tieu_de'   => $lt['tieu_de'],
                ':hoat_dong' => $lt['hoat_dong'],
                ':dia_diem'  => $lt['dia_diem']
            ]);
        }
    }

    return $idTour;
}

    // Lấy danh sách ảnh theo tour
    public function getAnhTour($id_tour)
    {
        $sql = "SELECT duong_dan_anh FROM anh_tour WHERE id_tour = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id_tour]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
public function updateLichTrinh($id_lich_trinh, $data) {
    $sql = "UPDATE lich_trinh 
            SET ngay_thu = :ngay_thu,
                tieu_de  = :tieu_de,
                hoat_dong= :hoat_dong,
                dia_diem = :dia_diem
            WHERE id_lich_trinh = :id";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':ngay_thu'  => $data['ngay_thu']  ?? null,
        ':tieu_de'   => $data['tieu_de']   ?? '',
        ':hoat_dong' => $data['hoat_dong'] ?? '',
        ':dia_diem'  => $data['dia_diem']  ?? '',
        ':id'        => $id_lich_trinh
    ]);
}

public function addLichTrinh($id_tour, $data) {
    $sql = "INSERT INTO lich_trinh (id_tour, ngay_thu, tieu_de, hoat_dong, dia_diem)
            VALUES (:id_tour, :ngay_thu, :tieu_de, :hoat_dong, :dia_diem)";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id_tour'  => $id_tour,
        ':ngay_thu' => $data['ngay_thu'],
        ':tieu_de'  => $data['tieu_de'],
        ':hoat_dong'=> $data['hoat_dong'],
        ':dia_diem' => $data['dia_diem']
    ]);
}

public function deleteLichTrinhFromDay($id_tour, $maxDay) {
    $sql = "DELETE FROM lich_trinh 
            WHERE id_tour = :id_tour AND ngay_thu > :maxDay";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([
        ':id_tour' => $id_tour,
        ':maxDay'  => $maxDay
    ]);
}


public function update($id, $data)
{
    $data['id_tour'] = $id;
    $sql = "UPDATE tour_du_lich SET 
                id_danh_muc = :id_danh_muc,
                id_trang_thai_tour = :id_trang_thai_tour,
                id_nha_hang = :id_nha_hang, 
                id_khach_san = :id_khach_san,
                id_xe = :id_xe,
                ten_tour = :ten_tour,
                mo_ta = :mo_ta,
                
                chinh_sach = :chinh_sach
            WHERE id_tour = :id_tour";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($data);
}
public function addImage($id_tour, $fileName) {
    $sql = "INSERT INTO anh_tour (id_tour, duong_dan_anh) VALUES (:id_tour, :fileName)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'id_tour' => $id_tour,
        'fileName' => $fileName
    ]);
}

public function deleteImage($id_tour, $fileName) {
    $sql = "DELETE FROM anh_tour WHERE id_tour = :id_tour AND duong_dan_anh = :fileName";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id_tour' => $id_tour, 'fileName' => $fileName]);
}


public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


    public function createLichKhoiHanh($data)
    {
        $sql = "INSERT INTO lich_khoi_hanh 
            (id_tour, id_hdv, dia_diem_khoi_hanh, dia_diem_den, 
             ngay_khoi_hanh, ngay_ket_thuc, thong_tin_xe, 
             id_trang_thai_lich_khoi_hanh, ghi_chu)
            VALUES 
            (:id_tour, :id_hdv, :dia_diem_khoi_hanh, :dia_diem_den,
             :ngay_khoi_hanh, :ngay_ket_thuc, :thong_tin_xe,
             :id_trang_thai_lich_khoi_hanh, :ghi_chu)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
           // Lấy lịch khởi hành theo tour
    public function getLichKhoiHanhByTour($id_tour)
    {
        $sql = "SELECT * FROM lich_khoi_hanh WHERE id_tour = :id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id_tour]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update lịch khởi hành
    public function updateLichKhoiHanh($id_lich, $data)
    {
        $sql = "UPDATE lich_khoi_hanh SET
                    ngay_khoi_hanh = :ngay_khoi_hanh,
                    ngay_ket_thuc = :ngay_ket_thuc
                WHERE id_lich = :id_lich";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
   
public function delete($id)
{
    try {
        // 1. Xóa tất cả ảnh của tour
        $sql = "DELETE FROM anh_tour WHERE id_tour = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        // 2. Xóa tất cả lịch khởi hành của tour
        $sql = "DELETE FROM lich_khoi_hanh WHERE id_tour = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        // 3. Cuối cùng xóa tour
        $sql = "DELETE FROM tour_du_lich WHERE id_tour = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        throw $e;
    }
}



    // Lấy danh sách danh mục tour
    public function getAllDanhMuc()
    {
        $stmt = $this->pdo->query("SELECT * FROM danh_muc_tour ORDER BY ten_danh_muc");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách trạng thái tour
    public function getAllTrangThai()
    {
$stmt = $this->pdo->query("SELECT * FROM trang_thai_tour ORDER BY trang_thai_tour");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllXe()
    {
    $stmt = $this->pdo->query("SELECT * FROM nha_xe ORDER BY nha_xe");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Lấy danh sách khách sạn
    public function getAllKhachSan()
    {
        $stmt = $this->pdo->query("SELECT * FROM khach_san ORDER BY ten_khach_san");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách nhà hàng
    public function getAllNhaHang()
    {
        $stmt = $this->pdo->query("SELECT * FROM nha_hang ORDER BY ten_nha_hang");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLichKhoiHanh($id_tour)
    {
        $sql = "SELECT * FROM lich_khoi_hanh WHERE id_tour = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_tour]);
        return $stmt->fetchAll();
    }
    // TourDuLich.php - model
  public function getLichTrinh($id_tour)
{
    $sql = "SELECT * 
            FROM lich_trinh 
            WHERE id_tour = :id 
            ORDER BY ngay_thu ASC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id_tour]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getAnhTourFolder($id_tour)
    {
        $folder = __DIR__ . '/../uploads/img/' . $id_tour; // đường dẫn vật lý
        $images = [];

        if (is_dir($folder)) {
            $files = scandir($folder);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..')
                    continue;
                // Kiểm tra là ảnh
                if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                    $images[] = 'uploads/img/' . $id_tour . '/' . $file; // đường dẫn dùng trong HTML
                }
            }
        }

        return $images;
    }
public function countActiveTours()
{
    $sql = "SELECT COUNT(*) FROM tour_du_lich WHERE id_trang_thai_tour = 1"; // 1 = đang hoạt động
    return $this->pdo->query($sql)->fetchColumn();
}

public function getTourAlerts()
{
    $sql = "SELECT t.ten_tour, tt.trang_thai_tour, dt.ngay_khoi_hanh
            FROM tour_du_lich t
            JOIN trang_thai_tour tt ON t.id_trang_thai_tour = tt.id_trang_thai_tour
            JOIN dat_tour dt ON t.id_tour = dt.id_tour
            WHERE dt.ngay_khoi_hanh BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            ORDER BY dt.ngay_khoi_hanh ASC";

    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}