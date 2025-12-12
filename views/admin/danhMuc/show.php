<div class="container-fluid px-4">
    <h3 class="mt-4 mb-4">Chi tiết loại tour: <?= htmlspecialchars($category['ten_danh_muc'] ?? '') ?></h3>

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Tên loại tour</label>
                <input type="text" class="form-control" 
                       value="<?= htmlspecialchars($category['ten_danh_muc'] ?? '') ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control" rows="3" disabled><?= htmlspecialchars($category['mo_ta'] ?? '') ?></textarea>
            </div>

            <a href="?mode=admin&action=viewsdanhmuc" class="btn btn-secondary">Quay lại</a>

        </div>
    </div>
</div>
