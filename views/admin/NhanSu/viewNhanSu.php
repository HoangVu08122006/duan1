<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<style>
    /* ================== CHI TIẾT HƯỚNG DẪN VIÊN ================== */
.admin-content .chi-tiet-hdv {
    max-width: 700px;
    margin: 0 auto;
    background: #ffffff;
    padding: 30px 40px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Tiêu đề */
.admin-content .chi-tiet-hdv h1 {
    color: #1e3a8a;
    font-size: 22px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
}

/* Dòng thông tin */
.admin-content .chi-tiet-hdv p {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px;
    margin: 6px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 15px;
}

.admin-content .chi-tiet-hdv p strong {
    color: #334155;
    min-width: 200px;
    font-weight: 600;
}

/* Ảnh đại diện */
.admin-content .chi-tiet-hdv img {
    border-radius: 6px;
    border: 1px solid #cbd5e1;
}

/* Nút hành động */
.admin-content .chi-tiet-hdv button {
    background-color: #2563eb;
    color: #fff;
    border: none;
    padding: 8px 16px;
    margin: 15px 6px 0 6px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s ease;
}

.admin-content .chi-tiet-hdv button:hover {
    background-color: #1d4ed8;
}

/* Responsive */
@media (max-width: 600px) {
    .admin-content .chi-tiet-hdv {
        padding: 20px;
    }

    .admin-content .chi-tiet-hdv p {
        flex-direction: column;
        align-items: flex-start;
    }

    .admin-content .chi-tiet-hdv p strong {
        margin-bottom: 4px;
    }

    .admin-content .chi-tiet-hdv button {
        width: 100%;
        margin-top: 10px;
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
    <p><strong>Ghi chú:</strong> <?= $hdv['mo_ta'] ?></p>

    <button onclick="location.href='index.php?act=nhanSu'">Quay lại</button>
    <button onclick="location.href='index.php?act=editNhanSu&id=<?= $hdv['id_hdv'] ?>'">Sửa</button>
</div>

</body>
</html>