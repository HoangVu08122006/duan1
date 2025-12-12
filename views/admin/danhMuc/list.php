<h1 class="tour-title">Danh sách Danh mục Tour</h1>

<button class="add-tour-btn" onclick="location.href='index.php?act=danhMuc&action=add'">
    Thêm danh mục mới
</button>

<table id="tourTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php if(!empty($list)): ?>
            <?php foreach($list as $dm): ?>
                <tr>
                    <td><?= $dm['id_danh_muc'] ?></td>
                    <td><?= $dm['ten_danh_muc'] ?></td>
                    <td class="desc"><?= $dm['mo_ta'] ?></td>

                    <td>
                        <button class="tour-edit"
                            onclick="location.href='index.php?act=danhMuc&action=edit&id=<?= $dm['id_danh_muc'] ?>'">
                            Sửa
                        </button>

                        <button class="tour-delete"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?') 
                            ? location.href='index.php?act=danhMuc&action=delete&id=<?= $dm['id_danh_muc'] ?>' 
                            : false;">
                            Xóa
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Chưa có danh mục nào!</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<style>
   /* ===== FONT ===== */
* {
    font-family: "Segoe UI", Arial, sans-serif;
}

/* ===== TIÊU ĐỀ ===== */
.tour-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 18px;
    color: #2c3e50; /* xanh xám dễ nhìn */
}

/* ===== NÚT THÊM ===== */
.add-tour-btn {
    padding: 10px 16px;
    background-color: #3498db; /* xanh nhẹ */
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 18px;
    transition: 0.2s ease;
}

.add-tour-btn:hover {
    background-color: #2980b9;
}

/* ===== BẢNG ===== */
#tourTable {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #dfe6e9; /* viền mỏng */
}

#tourTable thead {
    background-color: #ecf0f1; /* xám sáng, dịu mắt */
    color: #2c3e50;
}

#tourTable thead th {
    padding: 12px 14px;
    text-align: left;
    font-size: 14px;
}

#tourTable tbody tr {
    border-bottom: 1px solid #ecf0f1;
}

#tourTable tbody tr:hover {
    background-color: #f7f9fa; /* hover rất nhẹ */
}

#tourTable td {
    padding: 12px 14px;
    font-size: 14px;
    color: #2c3e50;
}

.desc {
    color: #636e72;
}

/* ===== NÚT SỬA – XÓA ===== */
.tour-edit,
.tour-delete {
    padding: 7px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    transition: 0.2s;
}

.tour-edit {
    background-color: #27ae60;
    color: white;
}

.tour-edit:hover {
    background-color: #1e8449;
}

.tour-delete {
    background-color: #e74c3c;
    color: white;
}

.tour-delete:hover {
    background-color: #c0392b;
}

</style>