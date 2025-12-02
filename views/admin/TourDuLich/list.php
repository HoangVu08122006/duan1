<h1>Danh sách tour</h1>

<form method="GET" action="">
    <input type="hidden" name="act" value="tour">
    <input type="text" name="search" placeholder="Tìm theo tên tour"
        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Search</button>
</form>

<a href="index.php?act=tour&action=add" class="btn btn-primary mb-3">Thêm tour mới</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên tour</th>
            <th>Loại tour</th>
            <!-- <th>Khách sạn</th>
            <th>Nhà hàng</th> -->
            <th>Thời lượng</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Chính sách</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $tour): ?>
            <tr>
                <td><?= $tour['id_tour'] ?></td>
                <td><?= htmlspecialchars($tour['ten_tour']) ?></td>
                <td><?= htmlspecialchars($tour['ten_danh_muc']) ?></td>
                <!-- <td><?= htmlspecialchars($tour['ten_khach_san'] ?? '') ?></td>
                <td><?= htmlspecialchars($tour['ten_nha_hang'] ?? '') ?></td> -->
                <td><?= htmlspecialchars($tour['thoi_luong'] ?? '') ?></td>
                <td><?= number_format($tour['gia_co_ban'] ?? 0) ?></td>
                <td><?= htmlspecialchars($tour['mo_ta'] ?? '') ?></td>
                <td><?= htmlspecialchars($tour['chinh_sach'] ?? '') ?></td>
                <td><?= htmlspecialchars($tour['trang_thai_tour']) ?></td>
                <!-- <td>
                    <a class="btn btn-info" href="index.php?act=tour&action=view&id=<?= $tour['id_tour'] ?>">Chi tiết</a> |
                    <a class="btn btn-success" href="index.php?act=tour&action=edit&id=<?= $tour['id_tour'] ?>">Sửa</a>

                    <a class="btn btn-danger" href="index.php?act=tour&action=delete&id=<?= $tour['id_tour'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td> -->
                <td class="action-buttons">
                    <a class="btn btn-info btn-sm" href="index.php?act=tour&action=view&id=<?= $tour['id_tour'] ?>">Chi
                        tiết</a>
                    <a class="btn btn-success btn-sm"
                        href="index.php?act=tour&action=edit&id=<?= $tour['id_tour'] ?>">Sửa</a>
                    <a class="btn btn-danger btn-sm" href="index.php?act=tour&action=delete&id=<?= $tour['id_tour'] ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<style>
    /* Form tìm kiếm */
    form {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    form input[type="text"] {
        padding: 6px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        flex: 1;
    }

    form button {
        padding: 6px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.3s;
    }

    form button:hover {
        background-color: #0056b3;
    }

    /* Thêm tour mới */
    a.btn {
        display: inline-block;
        padding: 6px 15px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 10px;
        transition: 0.3s;
    }

    a.btn:hover {
        background-color: #218838;
    }

    /* Bảng danh sách */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
    }

    table th,
    table td {
        padding: 10px 12px;
        border: 1px solid #dee2e6;
        text-align: left;
    }

    table th {
        background-color: #5d5dd2ff;
        font-weight: 600;
    }

    table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tbody tr:hover {
        background-color: #e9ecef;
    }

    /* Hành động */
    table a {
        color: #007bff;
        text-decoration: none;
        margin-right: 5px;
    }

    table a:hover {
        text-decoration: underline;
    }

    .btn-danger {
        background-color: #dc3545 !important;
    }

    .btn-danger:hover {
        background-color: #b52a37 !important;
    }

.action-buttons {
    display: flex;
    align-items: center;
    gap: 4px;            /* khoảng cách giữa nút */
    white-space: nowrap; /* không cho xuống dòng */
}

.action-buttons .btn-sm {
    padding: 12px 10px;   /* nhỏ gọn lại */
    font-size: 13px;
    border-radius: 4px;
}

.action-buttons a {
    margin: 0 !important;
}

</style>