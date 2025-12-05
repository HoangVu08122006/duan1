<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lịch Khởi Hành</title>
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
                <option value="<?= $tour['id_tour'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($tour['ten_tour']) ?>
                </option>
            <?php endforeach; ?>                           
        </select><br>                                                                                               

        <label>Hướng dẫn viên chính:</label>                  
        <select name="id_hdv" required>                      
            <?php foreach($hdvs as $hdv):                     
                $selected = ($hdv['id_hdv'] == $lich['id_hdv']) ? 'selected' : '';
            ?>
                <option value="<?= $hdv['id_hdv'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($hdv['ho_ten']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Địa điểm khởi hành:</label>
        <input type="text" name="dia_diem_khoi_hanh" 
               value="<?= htmlspecialchars($lich['dia_diem_khoi_hanh']) ?>" required><br>

        <label>Địa điểm đến:</label>
        <input type="text" name="dia_diem_den" 
               value="<?= htmlspecialchars($lich['dia_diem_den']) ?>" required><br>

        <label>Ngày khởi hành:</label>
        <input type="date" name="ngay_khoi_hanh" 
               value="<?= htmlspecialchars($lich['ngay_khoi_hanh']) ?>" required><br>

        <label>Ngày kết thúc:</label>
        <input type="date" name="ngay_ket_thuc" 
               value="<?= htmlspecialchars($lich['ngay_ket_thuc']) ?>" required><br>

        <label>Phương tiện:</label>
        <input type="text" name="thong_tin_xe" 
               value="<?= htmlspecialchars($lich['thong_tin_xe']) ?>"><br>

        <label>Trạng thái:</label>
        <select name="id_trang_thai" required>
            <?php foreach($ttList as $tt):
                $selected = ($tt['id_trang_thai_lich_khoi_hanh'] == $lich['id_trang_thai_lich_khoi_hanh']) ? 'selected' : '';
            ?>
                <option value="<?= $tt['id_trang_thai_lich_khoi_hanh'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($tt['trang_thai_lich_khoi_hanh']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Ghi chú:</label>
        <textarea name="ghi_chu"><?= htmlspecialchars($lich['ghi_chu']) ?></textarea><br>
        
        <h2>Lịch trình từng ngày</h2>
<div id="lichTrinhContainer">
    <?php foreach($lichTrinh as $lt): ?>
        <fieldset style="margin:10px; padding:10px; border:1px solid #ccc;">
            <legend>Ngày thứ <?= htmlspecialchars($lt['ngay_thu']) ?></legend>
            <label>Tiêu đề:</label>
            <input type="text" name="lich_trinh[<?= $lt['ngay_thu'] ?>][tieu_de]" 
                   value="<?= htmlspecialchars($lt['tieu_de']) ?>" required><br>
            <label>Hoạt động:</label>
            <input type="text" name="lich_trinh[<?= $lt['ngay_thu'] ?>][hoat_dong]" 
                   value="<?= htmlspecialchars($lt['hoat_dong']) ?>" required><br>
            <label>Địa điểm:</label>
            <input type="text" name="lich_trinh[<?= $lt['ngay_thu'] ?>][dia_diem]" 
                   value="<?= htmlspecialchars($lt['dia_diem']) ?>" required><br>
        </fieldset>
    <?php endforeach; ?>
</div>


        <button type="submit">Cập nhật</button>
        <button type="button" onclick="location.href='index.php?act=dieuHanhTour'">Hủy</button>
    </form>
</body>
</html>
