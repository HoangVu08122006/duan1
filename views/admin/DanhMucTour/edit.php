<?php include __DIR__ . '/../components/header.php'; ?>
<div class="container">
    <h2>Sửa danh mục tour</h2>
    <?php if(!empty($errors ?? [])) : ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="index.php?act=danhMuc&action=editSubmit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id_danh_muc'] ?? '') ?>">
        <div class="form-group">
            <label>Tên danh mục</label>
            <input class="form-control" name="ten_danh_muc" value="<?= htmlspecialchars($item['ten_danh_muc'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" name="mo_ta"><?= htmlspecialchars($item['mo_ta'] ?? '') ?></textarea>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a class="btn btn-secondary" href="index.php?act=danhMuc&action=index">Hủy</a>
    </form>
</div>
<?php include __DIR__ . '/../components/footer.php'; ?>
