<?php
// Kết nối CSDL và lấy dữ liệu theo ID
$id = $_GET['id'];
$sql = "SELECT nk.*, lt.ten_tour FROM nhat_ky nk 
        JOIN lich_khoi_hanh lt ON nk.id_lich = lt.id_lich 
        WHERE nk.id_nhat_ky = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$nhatky = $stmt->fetch();
?>

<style>
.detail-box {
    max-width: 700px;
    margin: 30px auto;
    padding: 25px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
}

.detail-box h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
}

.detail-box label {
    display: block;
    margin-top: 16px;
    font-weight: bold;
    color: #333;
}

.detail-box p {
    margin-top: 6px;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 6px;
    border: 1px solid #ccc;
    white-space: pre-wrap;
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

    <a href="index.php?act=nhatKy" style="display:inline-block; margin-top:20px; text-align:center; text-decoration:none; color:#007bff;">← Quay lại danh sách</a>
</div>
