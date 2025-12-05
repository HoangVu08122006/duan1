<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<style>
    /* ================== FORM SỬA HƯỚNG DẪN VIÊN ================== */
.admin-content h1 {
    text-align: center;
    color: #166534;
    font-size: 22px;
    margin-bottom: 25px;
    font-weight: 600;
}

/* Khung form */
.admin-content form {
    max-width: 600px;
    margin: 0 auto;
    background: #ffffff;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    border: 1px solid #d1fae5;
}

/* Nhãn */
.admin-content form label {
    display: block;
    font-weight: 600;
    color: #14532d;
    margin-top: 12px;
    margin-bottom: 6px;
    font-size: 14px;
}

/* Input, select, textarea */
.admin-content form input,
.admin-content form select,
.admin-content form textarea {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #a7f3d0;
    border-radius: 6px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.admin-content form input:focus,
.admin-content form select:focus,
.admin-content form textarea:focus {
    border-color: #16a34a;
    box-shadow: 0 0 4px rgba(22, 163, 74, 0.3);
}

/* Textarea */
.admin-content form textarea {
    min-height: 80px;
    resize: vertical;
}

/* Nút hành động */
.admin-content form button {
    background-color: #16a34a;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    margin-top: 18px;
    margin-right: 8px;
    transition: background 0.3s ease, transform 0.2s ease;
}

.admin-content form button:hover {
    background-color: #15803d;
    transform: translateY(-2px);
}

/* Nút hủy */
.admin-content form button[type="button"] {
    background-color: #9ca3af;
}

.admin-content form button[type="button"]:hover {
    background-color: #6b7280;
}

/* Responsive */
@media (max-width: 600px) {
    .admin-content form {
        padding: 20px;
    }

    .admin-content form button {
        width: 100%;
        margin-top: 10px;
    }
}
</style>
<body>
    <h1>Sửa Hướng dẫn viên</h1>

<form method="post">
    <label>Avatar (URL):</label>
    <input type="text" name="avatar" value="<?= $hdv['avatar'] ?>"><br>

    <label>Họ và tên:</label>
    <input type="text" name="ho_ten" value="<?= $hdv['ho_ten'] ?>" required><br>

    <label>Giới tính:</label>
    <select name="gioi_tinh">
        <option value="Nam" <?= $hdv['gioi_tinh']=='Nam'?'selected':'' ?>>Nam</option>
        <option value="Nữ" <?= $hdv['gioi_tinh']=='Nữ'?'selected':'' ?>>Nữ</option>
    </select><br>

    <label>Ngày sinh:</label>
    <input type="date" name="ngay_sinh" value="<?= $hdv['ngay_sinh'] ?>"><br>

    <label>Số CCCD:</label>
    <input type="text" name="so_cccd" value="<?= $hdv['so_cccd'] ?>"><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $hdv['email'] ?>"><br>

    <label>Số điện thoại:</label>
    <input type="text" name="so_dien_thoai" value="<?= $hdv['so_dien_thoai'] ?>"><br>

    <label>Chuyên môn:</label>
    <select name="id_loai_hdv">
        <?php
        $loaiList = (new HuongDanVien())->getLoaiHDV();
        foreach($loaiList as $loai){
            $sel = $hdv['id_loai_hdv']==$loai['id_loai_hdv']?'selected':'';
            echo "<option value='{$loai['id_loai_hdv']}' $sel>{$loai['loai_hdv']}</option>";
        }
        ?>
    </select><br>

    <label>Số năm kinh nghiệm:</label>
    <input type="number" name="so_nam_kinh_nghiem" value="<?= $hdv['so_nam_kinh_nghiem'] ?>"><br>

    <label>Địa chỉ:</label>
    <input type="text" name="dia_chi" value="<?= $hdv['dia_chi'] ?>"><br>

    <label>Mật khẩu:</label>
    <input type="password" name="pass" value="<?= $hdv['pass'] ?>"><br>

    <label>Tình trạng làm việc:</label>
    <select name="id_trang_thai_lam_viec_hdv">
        <?php
        $ttList = (new HuongDanVien())->getTrangThai();
        foreach($ttList as $tt){
            $sel = $hdv['id_trang_thai_lam_viec_hdv']==$tt['id_trang_thai_lam_viec_hdv']?'selected':'';
            echo "<option value='{$tt['id_trang_thai_lam_viec_hdv']}' $sel>{$tt['trang_thai_lam_viec_hdv']}</option>";
        }
        ?>
    </select><br>

    <label>Lương:</label>
    <textarea name="luong_hdv"><?= $hdv['luong_hdv'] ?></textarea><br>

    <label>Ghi chú:</label>
    <textarea name="mo_ta"><?= $hdv['mo_ta'] ?></textarea><br>

    <button type="submit">Cập nhật</button>
    <button type="button" onclick="location.href='index.php?act=nhanSu'">Hủy</button>
</form>

</body>
</html>
