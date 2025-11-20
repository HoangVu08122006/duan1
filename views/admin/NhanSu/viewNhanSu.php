<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/chiTiet.css">
</head>

<body>
    <h1>Chi tiết Hướng dẫn viên</h1>

<p><strong>ID:</strong> <?= $hdv['id_hdv'] ?></p>
<p><strong>Avatar:</strong> <?php if($hdv['avatar']): ?><img src="<?= $hdv['avatar'] ?>" width="80"><?php endif; ?></p>
<p><strong>Họ và tên:</strong> <?= $hdv['ho_ten'] ?></p>
<p><strong>Giới tính:</strong> <?= $hdv['gioi_tinh'] ?></p>
<p><strong>Ngày sinh:</strong> <?= $hdv['ngay_sinh'] ?></p>
<p><strong>Số CCCD:</strong> <?= $hdv['so_cccd'] ?></p>
<p><strong>Email:</strong> <?= $hdv['email'] ?></p>
<p><strong>Số điện thoại:</strong> <?= $hdv['so_dien_thoai'] ?></p>
<p><strong>Pass:</strong> <?= $hdv['pass'] ?></p>
<p><strong>Địa chỉ:</strong> <?= $hdv['dia_chi'] ?></p>
<p><strong>Chuyên môn:</strong> <?= $hdv['loai_hdv'] ?></p>
<p><strong>Số năm kinh nghiệm:</strong> <?= $hdv['so_nam_kinh_nghiem'] ?></p>
<p><strong>Tình trạng làm việc:</strong> <?= $hdv['trang_thai_lam_viec_hdv'] ?></p>
<p><strong>Ghi chú:</strong> <?= $hdv['mo_ta'] ?></p>

<button onclick="location.href='index.php?act=nhanSu'">Quay lại</button>
<button onclick="location.href='index.php?act=editNhanSu&id=<?= $hdv['id_hdv'] ?>'">Sửa</button>

</body>
</html>