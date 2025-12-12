<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<style>
 body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
    margin: 0;

    color: #333;
}

/* Khung chi tiết */
.chi-tiet-hdv {
    max-width: 700px;
    margin: 40px auto;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    padding: 30px 40px;
    position: relative;
    border-top: 6px solid #009688;
}

/* Tiêu đề */
.chi-tiet-hdv h1 {
    text-align: center;
    color: #00796b;
    font-size: 2em;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
}

.chi-tiet-hdv h1::before {
    content: "🌴";
    margin-right: 10px;
}

.chi-tiet-hdv h1::after {
    content: "✈️";
    margin-left: 10px;
}

/* Nội dung */
.chi-tiet-hdv p {
    font-size: 16px;
    margin: 10px 0;
    padding: 8px 12px;
    background: #f1f8f7;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chi-tiet-hdv p strong {
    color: #00796b;
    min-width: 180px;
}

.chi-tiet-hdv img {
    border-radius: 10px;
    border: 2px solid #009688;
}

/* Nút hành động */
.chi-tiet-hdv button {
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    margin: 15px 10px 0 0;
    padding: 10px 20px;
    border-radius: 25px;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* Nút quay lại */
.chi-tiet-hdv button:first-of-type {
    background: linear-gradient(45deg, #0288d1, #26c6da);
}
.chi-tiet-hdv button:first-of-type:hover {
    background: linear-gradient(45deg, #01579b, #0097a7);
    transform: translateY(-2px);
}

/* Nút sửa */
.chi-tiet-hdv button:last-of-type {
    background: linear-gradient(45deg, #fbc02d, #fdd835);
    color: #333;
}
.chi-tiet-hdv button:last-of-type:hover {
    background: linear-gradient(45deg, #f9a825, #fbc02d);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 600px) {
    .chi-tiet-hdv {
        padding: 20px;
    }

    .chi-tiet-hdv p {
        flex-direction: column;
        align-items: flex-start;
    }

    .chi-tiet-hdv p strong {
        margin-bottom: 5px;
    }

    .chi-tiet-hdv button {
        width: 100%;
        margin: 10px 0;
    }
}
</style>
<body>
    <div class="chi-tiet-hdv">
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
    <p><strong>Lương:</strong> <?= $hdv['luong_hdv'] ?></p>
    <p><strong>Ghi chú:</strong> <?= $hdv['mo_ta'] ?></p>

    <button onclick="location.href='index.php?act=nhanSu'">Quay lại</button>
    <button onclick="location.href='index.php?act=nhanSu&action=edit&id=<?= $hdv['id_hdv'] ?>'">Sửa</button>
</div>

</body>
</html>