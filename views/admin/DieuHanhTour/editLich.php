<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lịch Khởi Hành</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/edit.css">
</head>
<style>
    body {
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: #f4f6f9;
    margin: 0;
    
}

h1 {
    text-align: center;
    color: #0d6efd;
    margin-bottom: 30px;
}

form {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.form-group label {
    flex: 0 0 200px;
    font-weight: 600;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.95rem;
}

textarea {
    min-height: 80px;
}

fieldset {
    margin: 15px 0;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fafafa;
}

legend {
    font-weight: 600;
    color: #198754;
}

button {
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    margin: 10px 5px 0;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
}

button[type="submit"] {
    background: #0d6efd;
    color: #fff;
}

button[type="button"] {
    background: #6c757d;
    color: #fff;
}

button:hover {
    opacity: 0.85;
}

</style>
<body>
    <form method="post" action="">
    <div class="form-group">
        <label>Tour:</label>
        <select name="id_tour" required>
            <?php foreach($tours as $tour): 
                $selected = ($tour['id_tour'] == $lich['id_tour']) ? 'selected' : '';
            ?>
                <option value="<?= $tour['id_tour'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($tour['ten_tour']) ?>
                </option>
            <?php endforeach; ?>                           
        </select>
    </div>

    <div class="form-group">
        <label>Hướng dẫn viên chính:</label>
        <select name="id_hdv" required>
            <?php foreach($hdvs as $hdv): 
                $selected = ($hdv['id_hdv'] == $lich['id_hdv']) ? 'selected' : '';
            ?>
                <option value="<?= $hdv['id_hdv'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($hdv['ho_ten']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Địa điểm khởi hành:</label>
        <input type="text" name="dia_diem_khoi_hanh" 
               value="<?= htmlspecialchars($lich['dia_diem_khoi_hanh']) ?>" required>
    </div>

    <div class="form-group">
        <label>Địa điểm đến:</label>
        <input type="text" name="dia_diem_den" 
               value="<?= htmlspecialchars($lich['dia_diem_den']) ?>" required>
    </div>

    <div class="form-group">
        <label>Ngày khởi hành:</label>
        <input type="date" name="ngay_khoi_hanh" 
               value="<?= htmlspecialchars($lich['ngay_khoi_hanh']) ?>" required>
    </div>

    <div class="form-group">
        <label>Ngày kết thúc:</label>
        <input type="date" name="ngay_ket_thuc" 
               value="<?= htmlspecialchars($lich['ngay_ket_thuc']) ?>" required>
    </div>

    <div class="form-group">
    <label>Phương tiện:</label>
    <input type="text" value="<?= htmlspecialchars($lich['nha_xe'] ?? 'Không có') ?>" disabled>
</div>


    <div class="form-group">
        <label>Trạng thái:</label>
        <select name="id_trang_thai" required>
            <?php foreach($ttList as $tt):
                $selected = ($tt['id_trang_thai_lich_khoi_hanh'] == $lich['id_trang_thai_lich_khoi_hanh']) ? 'selected' : '';
            ?>
                <option value="<?= $tt['id_trang_thai_lich_khoi_hanh'] ?>" <?= $selected ?>>
                    <?= htmlspecialchars($tt['trang_thai_lich_khoi_hanh']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Ghi chú:</label>
        <textarea name="ghi_chu"><?= htmlspecialchars($lich['ghi_chu']) ?></textarea>
    </div>

    <h2>Lịch trình từng ngày</h2>
    <div id="lichTrinhContainer">
        <?php foreach($lichTrinh as $lt): ?>
            <fieldset>
                <legend>Ngày thứ <?= htmlspecialchars($lt['ngay_thu']) ?></legend>
                <label>Tiêu đề:</label>
                <input type="text" name="lich_trinh[<?= $lt['ngay_thu'] ?>][tieu_de]" 
                       value="<?= htmlspecialchars($lt['tieu_de']) ?>" required><br>
                <label>Hoạt động:</label>
                <input type="text" name="lich_trinh[<?= $lt['ngay_thu'] ?>][hoat_dong]" 
                       value="<?= htmlspecialchars($lt['hoat_dong']) ?>" required><br>
                <label>Địa điểm:</label>
                <input type="text" name="lich_trinh[<?= $lt['ngay_thu'] ?>][dia_diem]" 
                       value="<?= htmlspecialchars($lt['dia_diem']) ?>" required><br>
            </fieldset>
        <?php endforeach; ?>
    </div>

    <button type="submit">Cập nhật</button>
    <button type="button" onclick="location.href='index.php?act=dieuHanhTour'">Hủy</button>
</form>
</body>
</html>
<script>
function renderLichTrinh() {
    const startInput = document.querySelector('input[name="ngay_khoi_hanh"]');
    const endInput   = document.querySelector('input[name="ngay_ket_thuc"]');
    const container  = document.getElementById('lichTrinhContainer');

    const startDate = new Date(startInput.value);
    const endDate   = new Date(endInput.value);

    if (!startInput.value || !endInput.value || startDate > endDate) {
        container.innerHTML = "<p>Vui lòng chọn ngày hợp lệ.</p>";
        return;
    }

    const days = Math.ceil((endDate - startDate) / (1000*60*60*24)) + 1;

    // Lấy dữ liệu cũ từ input (nếu có)
    const oldData = {};
    container.querySelectorAll('fieldset').forEach(fs => {
        const day = fs.querySelector('legend').textContent.match(/Ngày thứ (\d+)/)[1];
        oldData[day] = {
            tieu_de: fs.querySelector('input[name^="lich_trinh"][name$="[tieu_de]"]')?.value || "",
            hoat_dong: fs.querySelector('input[name^="lich_trinh"][name$="[hoat_dong]"]')?.value || "",
            dia_diem: fs.querySelector('input[name^="lich_trinh"][name$="[dia_diem]"]')?.value || ""
        };
    });

    let html = "";
    for (let i = 0; i < days; i++) {
        const currentDate = new Date(startDate);
        currentDate.setDate(startDate.getDate() + i);
        const dateStr = currentDate.toLocaleDateString('vi-VN');

        const old = oldData[i+1] || {tieu_de:"", hoat_dong:"", dia_diem:""};

        html += `
        <fieldset style="margin:10px; padding:10px; border:1px solid #ccc;">
            <legend>Ngày thứ ${i+1} (${dateStr})</legend>
            <label>Tiêu đề:</label>
            <input type="text" name="lich_trinh[${i+1}][tieu_de]" value="${old.tieu_de}" required><br>
            <label>Hoạt động:</label>
            <input type="text" name="lich_trinh[${i+1}][hoat_dong]" value="${old.hoat_dong}" required><br>
            <label>Địa điểm:</label>
            <input type="text" name="lich_trinh[${i+1}][dia_diem]" value="${old.dia_diem}" required><br>
        </fieldset>`;
    }

    container.innerHTML = html;
}

// Gắn sự kiện
document.querySelector('input[name="ngay_khoi_hanh"]').addEventListener('change', renderLichTrinh);
document.querySelector('input[name="ngay_ket_thuc"]').addEventListener('change', renderLichTrinh);

// Render khi load trang
window.addEventListener('DOMContentLoaded', renderLichTrinh);
</script>
