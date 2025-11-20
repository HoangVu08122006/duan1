<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
</head>
<style></style>
<body>
    <h1>Điều hành tour</h1>
    <div class="search-box"><input type="text" id="searchInput" placeholder="Tìm theo Tour/HDV..."></div>
<button class="add-btn" onclick="location.href='index.php?act=addLich'">Thêm lịch mới</button>


<table id="lichTable">
<thead>
<tr>
    
    <th>Tour</th>
    <th>Ngày KH</th>
    <th>Ngày KT</th>
    <th>HDV chính</th>
    <th>Điểm khởi hành</th>
    <th>Điểm đến</th>
    <th>Ghi chú</th>
    <th>Trạng thái</th>
    <th>Hành động</th>
</tr>
</thead>
<tbody>
<?php foreach($lichKhoiHanhList as $lich): ?>
<tr>
    
    <td><?= $lich['ten_tour'] ?></td>
    <td><?= $lich['ngay_khoi_hanh'] ?></td>
    <td><?= $lich['ngay_ket_thuc'] ?></td>
    <td><?= $lich['hdv_chinh'] ?></td>
    <td><?= $lich['dia_diem_khoi_hanh'] ?></td>
    <td><?= $lich['dia_diem_den'] ?></td>
    <td><?= $lich['ghi_chu'] ?></td>
    <td><?= $lich['trang_thai_lich_khoi_hanh'] ?></td>
    <td>
        <button class="view" onclick="location.href='index.php?act=viewLich&id=<?= $lich['id_lich'] ?>'">Chi tiết</button>
        <button class="edit" onclick="location.href='index.php?act=editLich&id=<?= $lich['id_lich'] ?>'">Sửa</button>
        <button class="delete" onclick="if(confirm('Bạn có chắc muốn xóa?')) location.href='index.php?act=deleteLich&id=<?= $lich['id_lich'] ?>'">Xóa</button>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<script>
document.getElementById('searchInput').addEventListener('keyup', function(){
    const filter = this.value.toLowerCase();
    document.querySelectorAll('#lichTable tbody tr').forEach(row=>{
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter)?'':'none';
    });
});
</script>

</body>
</html>
