<!-- Form tìm kiếm -->
<form method="GET" action="index.php" style="margin-bottom:15px;">
    <input type="hidden" name="act" value="nhatKy">
    <input type="text" name="keyword" placeholder="Tìm kiếm tour hoặc sự cố..." 
           value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
    <button type="submit">Tìm</button>
    <a href="index.php?act=nhatKy" style="margin-left:10px;">Reset</a>
</form>

<style>
/* Reset cơ bản */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



/* Tiêu đề */
h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
    font-size: 24px;
    font-weight: 600;
}

/* Form tìm kiếm */
form {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}

form input[type="text"] {
    flex: 1;
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

form input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
}

form button {
    padding: 10px 18px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

form a {
    text-decoration: none;
    color: #007bff;
    font-size: 14px;
}

form a:hover {
    text-decoration: underline;
}

/* Bảng danh sách */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border-radius: 6px;
    overflow: hidden;
}

thead {
    background-color: #007bff;
    color: white;
}

th, td {
    padding: 12px 10px;
    text-align: left;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #eef6ff;
    transition: background-color 0.3s ease;
}

td[title] {
    cursor: help;
}

/* Liên kết thao tác */
td a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

td a:hover {
    text-decoration: underline;
}

/* Dòng không có dữ liệu */
td[colspan] {
    text-align: center;
    padding: 20px;
    color: #666;
    font-style: italic;
}

</style>

<!-- Bảng danh sách -->
<table border="1" cellpadding="8" width="100%" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tour</th>
            <th>Ngày ghi</th>
            <th>Sự cố</th>
            <th>Phản hồi</th>
            <th>Nhận xét HDV</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($list) && is_array($list)): ?>
            <?php foreach ($list as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_nhat_ky']) ?></td>
                    <td><?= htmlspecialchars($row['ten_tour'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['ngay_ghi'] ?? '-') ?></td>
                    <td title="<?= htmlspecialchars($row['su_co'] ?? '') ?>">
                        <?= htmlspecialchars(mb_strimwidth($row['su_co'] ?? '', 0, 40, '...')) ?>
                    </td>
                    <td title="<?= htmlspecialchars($row['phan_hoi'] ?? '') ?>">
                        <?= htmlspecialchars(mb_strimwidth($row['phan_hoi'] ?? '', 0, 40, '...')) ?>
                    </td>
                    <td title="<?= htmlspecialchars($row['nhan_xet_hdv'] ?? '') ?>">
                        <?= htmlspecialchars(mb_strimwidth($row['nhan_xet_hdv'] ?? '', 0, 40, '...')) ?>
                    </td>
                    <td>
                        <a href="index.php?act=nhatKy&action=detail&id=<?= $row['id_nhat_ky'] ?>">👁️ Xem chi tiết</a>



                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">Không có dữ liệu</td>
            </tr>
        <?php endif; ?>
        
    </tbody>
</table>
