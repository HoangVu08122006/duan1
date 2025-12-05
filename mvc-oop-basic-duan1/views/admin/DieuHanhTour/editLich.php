<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/edit.css">
</head>
<body>
    <h1>Sửa Lịch Khởi Hành</h1>

        <form method="post" action="">
    <label>Tour:</label>
    <select name="id_tour" required>
        <?php foreach($tours as $tour): 
            $selected = ($tour['id_tour'] == $lich['id_tour']) ? 'selected' : '';
        ?>
            <option value="<?= $tour['id_tour'] ?>" <?= $selected ?>><?= $tour['ten_tour'] ?></option>
        <?php endforeach; ?>                           
    </select><br>                                                                                               
    <label>Hướng dẫn viên chính:</label>                  
    <select name="id_hdv" required>                      
        <?php foreach($hdvs as $hdv):                     
            $selected = ($hdv['id_hdv'] == $lich['id_hdv']) ? 'selected' : '';
        ?>
            <option value="<?= $hdv['id_hdv'] ?>" <?= $selected ?>><?= $hdv['ho_ten'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Địa điểm khởi hành:</label>
    <input type="text" name="dia_diem_khoi_hanh" value="<?= $lich['dia_diem_khoi_hanh'] ?>" required><br>

    <label>Địa điểm đến:</label>
    <input type="text" name="dia_diem_den" value="<?= $lich['dia_diem_den'] ?>" required><br>

    <label>Ngày khởi hành:</label>
    <input type="date" name="ngay_khoi_hanh" value="<?= $lich['ngay_khoi_hanh'] ?>" required><br>

    <label>Ngày kết thúc:</label>
    <input type="date" name="ngay_ket_thuc" value="<?= $lich['ngay_ket_thuc'] ?>" required><br>

    <label>Phương tiện:</label>
    <input type="text" name="thong_tin_xe" value="<?= $lich['thong_tin_xe'] ?>"><br>

    <label>Trạng thái:</label>
    <select name="id_trang_thai" required>
        <?php foreach($ttList as $tt):
            $selected = ($tt['id_trang_thai_lich_khoi_hanh'] == $lich['id_trang_thai_lich_khoi_hanh']) ? 'selected' : '';
        ?>
            <option value="<?= $tt['id_trang_thai_lich_khoi_hanh'] ?>" <?= $selected ?>><?= $tt['trang_thai_lich_khoi_hanh'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Ghi chú:</label>
    <textarea name="ghi_chu"><?= $lich['ghi_chu'] ?></textarea><br>

    <button type="submit">Cập nhật</button>
    <button type="button" onclick="location.href='index.php?act=dieuHanhTour'">Hủy</button>
</form>


</body>
</html>