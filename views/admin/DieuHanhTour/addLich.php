<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Lịch Khởi Hành</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/add.css">
</head>
<body>
    <h1>Thêm Lịch Khởi Hành</h1>

<form method="post" action="">
    <label>Tour:</label>
<select name="id_tour" id="id_tour" required>
    <option value="">-- Chọn tour --</option> <!-- option trống ban đầu -->
    <?php
    $tourModel = new TourDuLich();
    $tours = $tourModel->getAll();
    foreach($tours as $tour){
        // giả sử có cột ngay_khoi_hanh và ngay_ket_thuc trong $tour
        echo "<option value='{$tour['id_tour']}' 
                     data-ngay-khoi-hanh='{$tour['ngay_khoi_hanh']}' 
                     data-ngay-ket-thuc='{$tour['ngay_ket_thuc']}'>
                     {$tour['ten_tour']}
              </option>";
    }
    ?>
</select><br>


    <label>Hướng dẫn viên chính:</label>
    <select name="id_hdv" required>
        <?php
        $hdvModel = new HuongDanVien();
        $hdvs = $hdvModel->getAll();
        foreach($hdvs as $hdv){
            echo "<option value='{$hdv['id_hdv']}'>{$hdv['ho_ten']}</option>";
        }
        ?>
    </select><br>

    <label>Địa điểm khởi hành:</label>
    <input type="text" name="dia_diem_khoi_hanh" required><br>

    <label>Địa điểm đến:</label>
    <input type="text" name="dia_diem_den" required><br>

    <label>Ngày khởi hành:</label>
    <input type="date" name="ngay_khoi_hanh" required><br>

    <label>Ngày kết thúc:</label>
    <input type="date" name="ngay_ket_thuc" required><br>

    <label>Phương tiện:</label>
    <input type="text" name="thong_tin_xe"><br>

    <label>Trạng thái:</label>
    <select name="id_trang_thai" required>
        <?php
        $ttModel = new TrangThaiLichKhoiHanh();
        $ttList = $ttModel->getAll();
        foreach($ttList as $tt){
            echo "<option value='{$tt['id_trang_thai_lich_khoi_hanh']}'>{$tt['trang_thai_lich_khoi_hanh']}</option>";
        }
        ?>
    </select><br>

    <label>Ghi chú:</label>
    <textarea name="ghi_chu"></textarea><br>

    <h2>Lịch trình từng ngày</h2>
    <div id="lichTrinhContainer"></div>

    <button type="submit">Thêm mới</button>
    <button type="button" onclick="location.href='index.php?act=dieuHanhTour'">Hủy</button>
</form>

<script>
// Tạo bảng lịch trình theo số ngày
function taoBangLichTrinh() {
    const start = document.querySelector('input[name="ngay_khoi_hanh"]').value;
    const end = document.querySelector('input[name="ngay_ket_thuc"]').value;
    const container = document.getElementById('lichTrinhContainer');
    container.innerHTML = '';

    if (start && end) {
        const startDate = new Date(start);
        const endDate = new Date(end);
        const diffTime = endDate - startDate;
        const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24)) + 1;

        for (let i = 1; i <= diffDays; i++) {
            container.innerHTML += `
            <fieldset style="margin:10px; padding:10px; border:1px solid #ccc;">
                <legend>Ngày thứ ${i}</legend>
                <label>Tiêu đề:</label>
                <input type="text" name="lich_trinh[${i}][tieu_de]" required><br>
                <label>Hoạt động:</label>
                <input type="text" name="lich_trinh[${i}][hoat_dong]" required><br>
                <label>Địa điểm:</label>
                <input type="text" name="lich_trinh[${i}][dia_diem]" required><br>
            </fieldset>`;
        }
    }
}

// Gọi hàm khi thay đổi ngày khởi hành hoặc kết thúc
document.querySelector('input[name="ngay_khoi_hanh"]').addEventListener('change', taoBangLichTrinh);
document.querySelector('input[name="ngay_ket_thuc"]').addEventListener('change', taoBangLichTrinh);

// Khi chọn tour thì tự động điền ngày nếu có
document.getElementById('id_tour').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const ngayKhoiHanh = selectedOption.getAttribute('data-ngay-khoi-hanh');
    const ngayKetThuc = selectedOption.getAttribute('data-ngay-ket-thuc');

    if (ngayKhoiHanh) {
        document.querySelector('input[name="ngay_khoi_hanh"]').value = ngayKhoiHanh;
    }
    if (ngayKetThuc) {
        document.querySelector('input[name="ngay_ket_thuc"]').value = ngayKetThuc;
    }

    taoBangLichTrinh();
});

// Kiểm tra trống khi submit
document.querySelector('form').addEventListener('submit', function(e) {
    let valid = true;
    const inputs = document.querySelectorAll('#lichTrinhContainer input[type="text"]');
    inputs.forEach(input => {
        if (!input.value.trim()) {
            valid = false;
            input.style.border = "1px solid red"; // highlight ô trống
        } else {
            input.style.border = "1px solid #ccc";
        }
    });

    if (!valid) {
        e.preventDefault();
        alert("Vui lòng điền đầy đủ lịch trình từng ngày!");
    }
});
</script>

</body>
</html>
