<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/add.css">
</head>
<body>
    <h1>Thêm Lịch Khởi Hành</h1>

<form method="post" action="">
    <label>Tour:</label>
    <select name="id_tour" required>
        <?php
        $tourModel = new TourDuLich();
        $tours = $tourModel->getAll();
        foreach($tours as $tour){
            echo "<option value='{$tour['id_tour']}'>{$tour['ten_tour']}</option>";
        }
        ?>
    </select><br>

    <label>Hướng dẫn viên chính:</label>
    <select name="id_hdv" required>
        <?php
        $hdvModel = new HuongDanVien();
        $hdvs = $hdvModel->getAll();
        foreach($hdvs as $hdv){
            echo "<option value='{$hdv['id_hdv']}'>{$hdv['ho_ten']}</option>";
        }
        ?>
    </select><br>

    <label>Địa điểm khởi hành:</label>
    <input type="text" name="dia_diem_khoi_hanh" required><br>

    <label>Địa điểm đến:</label>
    <input type="text" name="dia_diem_den" required><br>

    <label>Ngày khởi hành:</label>
    <input type="date" name="ngay_khoi_hanh" required><br>

    <label>Ngày kết thúc:</label>
    <input type="date" name="ngay_ket_thuc" required><br>

    <label>Phương tiện:</label>
    <input type="text" name="thong_tin_xe"><br>

    <label>Trạng thái:</label>
    <select name="id_trang_thai" required>
        <?php
        $ttModel = new TrangThaiLichKhoiHanh();
        $ttList = $ttModel->getAll();
        foreach($ttList as $tt){
            echo "<option value='{$tt['id_trang_thai_lich_khoi_hanh']}'>{$tt['trang_thai_lich_khoi_hanh']}</option>";
        }
        ?>
    </select><br>

    <label>Ghi chú:</label>
    <textarea name="ghi_chu"></textarea><br>

    <button type="submit">Thêm mới</button>
    <button type="button" onclick="location.href='index.php?act=dieuHanhTour'">Hủy</button>
</form>

</body>
</html>