<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khách</title>

    <style>
        /* Wrapper căn giữa toàn bộ */
        .form-add-khach-wrapper {
            display: flex;
            justify-content: center;
            padding-top: 20px;
            width: 100%;
        }

        /* Form Box */
        .form-add-khach {
            width: 420px;
            background: #ffffff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e5e7eb;
            font-family: "Segoe UI", sans-serif;
        }

        .form-add-khach h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-add-khach p {
            margin-bottom: 15px;
        }

        .form-add-khach label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #444;
        }

        .form-add-khach input[type="text"],
        .form-add-khach input[type="date"],
        .form-add-khach select {
            width: 100%;
            padding: 10px 5px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            transition: 0.2s;
        }

        .form-add-khach input:focus,
        .form-add-khach select:focus {
            border-color: #4a89ff;
            background: #fff;
            box-shadow: 0 0 5px rgba(74,137,255,0.3);
        }

        .form-add-khach button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #4a89ff;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .form-add-khach button:hover {
            background: #2f6dff;
        }

        .form-add-khach a {
            color: #4a89ff;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        .form-add-khach a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

<div class="form-add-khach-wrapper">
    <div class="form-add-khach">

        <h2>Thêm khách cho đoàn #<?= $_GET['id'] ?></h2>

        <form method="post" action="">
            <p>
                <label>Họ tên:</label>
                <input type="text" name="ho_ten" required>
            </p>

            <p>
    <label>Giới tính:</label>
    <select name="gioi_tinh" required>
        <option value="" disabled selected>— Chọn giới tính —</option>
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select>
</p>


            <p>
                <label>Số điện thoại:</label>
                <input type="text" name="so_dien_thoai">
            </p>

            <p>
                <label>Ngày sinh:</label>
                <input type="date" name="ngay_sinh">
            </p>

            <p>
                <label>CCCD/CMND:</label>
                <input type="text" name="so_cmnd_cccd">
            </p>

            <p>
                <label>Trạng thái khách:</label>
                <select name="id_trang_thai_khach" required>
                    <?php foreach($trangThaiList as $tt): ?>
                        <option value="<?= $tt['id_trang_thai_khach'] ?>">
                            <?= htmlspecialchars($tt['trang_thai_khach']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p>
                <label>Ghi chú:</label>
                <input type="text" name="ghi_chu">
            </p>

            <button type="submit">Thêm khách</button>
        </form>

        <a href="index.php?act=viewDoanKhach&id=<?= $_GET['id'] ?>">← Quay lại đoàn</a>

    </div>
</div>

</body>
</html>
