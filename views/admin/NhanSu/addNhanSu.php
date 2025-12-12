<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/add.css">
</head>

<body>
    <h1>Thêm Hướng dẫn viên mới</h1>

<form method="post">
    <label>Avatar (URL):</label>
    <input type="text" name="avatar" placeholder="Đường dẫn ảnh"><br>

    <label>Họ và tên:</label>
    <input type="text" name="ho_ten" required><br>

    <label>Giới tính:</label>
    <select name="gioi_tinh">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select><br>

    <label>Ngày sinh:</label>
    <input type="date" name="ngay_sinh"><br>

    <label>Số CCCD:</label>
    <input type="text" name="so_cccd"><br>

    <label>Email:</label>
    <input type="email" name="email"><br>

    <label>Số điện thoại:</label>
    <input type="text" name="so_dien_thoai"><br>

    <label>Chuyên môn:</label>
    <select name="id_loai_hdv">
        <?php
        $loaiList = (new HuongDanVien())->getLoaiHDV();
        foreach($loaiList as $loai){
            echo "<option value='{$loai['id_loai_hdv']}'>{$loai['loai_hdv']}</option>";
        }
        ?>
    </select><br>

    <label>Số năm kinh nghiệm:</label>
    <input type="number" name="so_nam_kinh_nghiem"><br>

    <label>Địa chỉ:</label>
    <input type="text" name="dia_chi"><br>

    <label>Mật khẩu:</label>
    <input type="password" name="pass"><br>

    <label>Tình trạng làm việc:</label>
    <select name="id_trang_thai_lam_viec_hdv">
        <?php
        $ttList = (new HuongDanVien())->getTrangThai();
        foreach($ttList as $tt){
            echo "<option value='{$tt['id_trang_thai_lam_viec_hdv']}'>{$tt['trang_thai_lam_viec_hdv']}</option>";
        }
        ?>
    </select><br>

    <label>Lương:</label>
    <textarea name="luong_hdv"></textarea><br>

    <label>Ghi chú:</label>
    <textarea name="mo_ta"></textarea><br>

    <button type="submit">Thêm HDV</button>
    <button type="button" onclick="location.href='index.php?act=nhanSu'">Hủy</button>
</form>
</body>
</html>
