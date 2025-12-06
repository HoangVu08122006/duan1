<style>
/* Reset cơ bản */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Toàn trang */
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
    padding: 40px 20px;
}

/* Khung chi tiết */
.detail-box {
    max-width: 700px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    animation: fadeIn 0.5s ease-in-out;
}

/* Tiêu đề */
.detail-box h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 25px;
    font-size: 26px;
    font-weight: 600;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

/* Nhãn */
.detail-box label {
    display: block;
    margin-top: 18px;
    font-weight: bold;
    font-size: 15px;
    color: #444;
}

/* Nội dung */
.detail-box p {
    margin-top: 6px;
    padding: 12px 15px;
    background-color: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    font-size: 14px;
    line-height: 1.6;
    white-space: pre-wrap;
    transition: background-color 0.3s ease;
}

.detail-box p:hover {
    background-color: #eef6ff;
}



.detail-box a:hover {
    background-color: #0056b3;
    text-decoration: none;
}
.back-link {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 18px;
    background-color: #007bff;
    color: #fff !important;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s ease;
}

.back-link:hover {
    background-color: #0056b3;
    transform: translateX(-3px);
    text-decoration: none;
}

/* Hiệu ứng xuất hiện */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

</style>
<div class="detail-box">
    <h2>Chi tiết nhật ký tour</h2>

    <label>Tên tour:</label>
    <p><?= htmlspecialchars($nhatky['ten_tour']) ?></p>

    <label>Ngày ghi:</label>
    <p><?= htmlspecialchars($nhatky['ngay_ghi']) ?></p>

    <label>Sự cố:</label>
    <p><?= htmlspecialchars($nhatky['su_co']) ?></p>

    <label>Phản hồi khách:</label>
    <p><?= htmlspecialchars($nhatky['phan_hoi']) ?></p>

    <label>Nhận xét HDV:</label>
    <p><?= htmlspecialchars($nhatky['nhan_xet_hdv']) ?></p>

    <a href="index.php?act=nhatKy" class="back-link">← Quay lại danh sách</a>

</div>
