<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Thêm nhật ký tour</h2>

<form action="index.php?act=storeNhatKy" method="POST">

    <label>Lịch khởi hành:</label>
    <input type="number" name="id_lich" required>

    <label>Ngày ghi:</label>
    <input type="date" name="ngay_ghi" required>

    <label>Sự cố:</label>
    <textarea name="su_co"></textarea>

    <label>Phản hồi khách:</label>
    <textarea name="phan_hoi"></textarea>

    <label>Nhận xét HDV:</label>
    <textarea name="nhan_xet_hdv"></textarea>

    <button type="submit">Lưu</button>
</form>

</body>
</html>