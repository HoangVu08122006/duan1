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
    .tour-title {
        font-size: 24px;
        margin-bottom: 20px;
    }
    .add-tour-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 15px;
    }
    #tourTable {
        width: 100%;
        border-collapse: collapse;
    }
    #tourTable th, #tourTable td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    #tourTable th {
        background-color: #f2f2f2;
    }
    .desc {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .tour-edit, .tour-delete {
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .tour-edit {
        background-color: #007bff;
        color: white;
        margin-right: 5px;
    }
    .tour-delete {
        background-color: #dc3545;
        color: white;
    }
</style>