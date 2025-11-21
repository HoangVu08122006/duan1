<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục tour</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #eee; }
        a { text-decoration: none; color: #007BFF; }
    </style>
</head>
<body>
<h1 style="text-align:center;">Danh sách danh mục tour</h1>
<p style="text-align:center;"><a href="index.php?act=danhMuc&action=addForm">Thêm danh mục mới</a></p>
<table>
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Mô tả</th>
        <th>Hành động</th>
    </tr>
    <?php if (!empty($list)): ?>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?= $item['id_danh_muc'] ?></td>
                <td><?= htmlspecialchars($item['ten_danh_muc'] ?? '') ?></td>
                <td><?= htmlspecialchars($item['mo_ta'] ?? '') ?></td>
                <td>
                    <a class="btn btn-warning" href="index.php?act=danhMuc&action=editForm&id=<?= $item['id_danh_muc'] ?>">Sửa</a> |
                    <a class="btn btn-danger" href="index.php?act=danhMuc&action=delete&id=<?= $item['id_danh_muc'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Không có danh mục nào</td></tr>
    <?php endif; ?>
</table>
</body>
</html>
