<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa khách</title>

    <style>
        /* Khung tổng */
        .edit-form {
            max-width: 440px;
            margin: 20px auto;
            padding: 22px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }

        .edit-form h2 {
            margin: 0 0 18px;
            font-size: 22px;
            text-align: center;
            color: #333;
        }

        .edit-form p {
            margin-bottom: 15px;
        }

        .edit-form label {
            font-weight: bold;
            color: #333;
        }

        .edit-form input[type="text"],
        .edit-form input[type="date"],
        .edit-form select {
            width: 100%;
            padding: 9px 11px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
        }

        /* Button */
        .edit-form button {
            width: 100%;
            padding: 11px;
            margin-top: 10px;
            border: none;
            font-size: 16px;
            background: #007bff;
            color: white;
            border-radius: 7px;
            cursor: pointer;
            transition: 0.2s;
        }

        .edit-form button:hover {
            background: #005dc0;
        }

        /* Link quay lại */
        .back-link {
            display: inline-block;
            margin-top: 12px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="edit-form">
    <h2>Sửa khách</h2>

    <form method="post" action="">
        <p>
            <label>Họ tên:</label>
            <input type="text" name="ho_ten" value="<?= htmlspecialchars($khach['ho_ten'] ?? '') ?>" required>
        </p>

        <p>
            <label>Giới tính:</label>
            <select name="gioi_tinh">
                <option value="Nam" <?= (isset($khach['gioi_tinh']) && $khach['gioi_tinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                <option value="Nữ" <?= (isset($khach['gioi_tinh']) && $khach['gioi_tinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
            </select>
        </p>

        <p>
            <label>Số điện thoại:</label>
            <input type="text" name="so_dien_thoai" value="<?= htmlspecialchars($khach['so_dien_thoai'] ?? '') ?>">
        </p>

        <p>
            <label>Ngày sinh:</label>
            <input type="date" name="ngay_sinh" value="<?= $khach['ngay_sinh'] ?? '' ?>">
        </p>

        <p>
            <label>CCCD/CMND:</label>
            <input type="text" name="so_cmnd_cccd" value="<?= htmlspecialchars($khach['so_cmnd_cccd'] ?? '') ?>">
        </p>

        <p>
            <label>Trạng thái khách:</label>
            <select name="id_trang_thai_khach" required>
                <?php foreach($trangThaiList as $tt): ?>
                    <option value="<?= $tt['id_trang_thai_khach'] ?>"
                        <?= (isset($khach['id_trang_thai_khach']) && $khach['id_trang_thai_khach'] == $tt['id_trang_thai_khach']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($tt['trang_thai_khach']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label>Ghi chú:</label>
            <input type="text" name="ghi_chu" value="<?= htmlspecialchars($khach['ghi_chu'] ?? '') ?>">
        </p>

        <button type="submit">Cập nhật</button>
    </form>

    <a class="back-link" 
       href="index.php?act=viewDoanKhach&id=<?= $khach['id_dat_tour'] ?? 0 ?>">
        ← Quay lại đoàn
    </a>
</div>

</body>
</html>
