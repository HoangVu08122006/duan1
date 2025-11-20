<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/chiTiet.css">
</head>
<body>
    <h1>Chi tiết Lịch Khởi Hành</h1>

<p><strong>Tour: </strong><?= $lich['ten_tour'] ?></p>
<p><strong>Hướng dẫn viên chính: </strong><?= $lich['hdv_chinh'] ?></p>
<p><strong>Ngày khởi hành: </strong><?= $lich['ngay_khoi_hanh'] ?></p>
<p><strong>Ngày kết thúc: </strong><?= $lich['ngay_ket_thuc'] ?></p>
<p><strong>Điểm khởi hành: </strong><?= $lich['dia_diem_khoi_hanh'] ?></p>
<p><strong>Điểm đến: </strong><?= $lich['dia_diem_den'] ?></p>
<p><strong>Phương tiện: </strong><?= $lich['thong_tin_xe'] ?></p>
<p><strong>Khách sạn chính: </strong><?= $lich['ten_khach_san'] ?></p>
<p><strong>Nhà hàng chính: </strong><?= $lich['ten_nha_hang'] ?></p>
<p><strong>Ghi chú: </strong><?= $lich['ghi_chu'] ?></p>
<p><strong>Trạng thái: </strong><?= $lich['trang_thai_lich_khoi_hanh'] ?></p>

<button onclick="location.href='index.php?act=dieuHanhTour'">Quay lại</button>
<button onclick="location.href='index.php?act=editLich&id=<?= $lich['id_lich'] ?>'">Sửa</button>


</body>
</html>