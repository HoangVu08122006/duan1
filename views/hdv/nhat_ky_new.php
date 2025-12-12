<!-- views/hdv/nhat_ky.php -->
<link rel="stylesheet" href="hdv.css">

<style>
    .nhat-ky-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .btn-add-nhat-ky {
        display: inline-block;
        padding: 10px 20px;
        background: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 20px;
        border: none;
        cursor: pointer;
        font-size: 1em;
    }

    .btn-add-nhat-ky:hover {
        background: #218838;
    }

    .nhat-ky-list {
        margin-top: 20px;
    }

    .nhat-ky-item {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .nhat-ky-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 2px solid #0066cc;
    }

    .nhat-ky-title {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .nhat-ky-title h4 {
        margin: 0;
        color: #0066cc;
    }

    .nhat-ky-title small {
        color: #666;
    }

    .nhat-ky-actions {
        display: flex;
        gap: 10px;
    }

    .btn-edit, .btn-delete {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.9em;
    }

    .btn-edit {
        background: #17a2b8;
        color: white;
    }

    .btn-edit:hover {
        background: #138496;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .nhat-ky-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .content-section {
        display: flex;
        flex-direction: column;
    }

    .content-label {
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        font-size: 0.9em;
        text-transform: uppercase;
    }

    .content-value {
        background: #f5f5f5;
        padding: 10px;
        border-radius: 4px;
        color: #666;
        line-height: 1.5;
    }

    .no-nhat-ky {
        padding: 40px;
        text-align: center;
        background: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 8px;
        color: #666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }

    .form-group textarea,
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: inherit;
        font-size: 1em;
        box-sizing: border-box;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-submit {
        padding: 10px 20px;
        background: #0066cc;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
    }

    .btn-submit:hover {
        background: #0052a3;
    }

    .btn-cancel {
        padding: 10px 20px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #5a6268;
    }
</style>

<div class="nhat-ky-container">
    <h2>📔 Nhật Ký Tour</h2>

    <?php if (isset($_GET['edit']) || isset($_GET['add'])): ?>
        <!-- FORM VIẾT/SỬA NHẬT KÝ -->
        <div style="background: white; padding: 30px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h3><?= isset($_GET['edit']) ? 'Sửa Nhật Ký' : 'Viết Nhật Ký Mới' ?></h3>

            <form method="POST" action="">
                <?php if (isset($_GET['edit'])): ?>
                    <input type="hidden" name="id_nhat_ky" value="<?= htmlspecialchars($_GET['edit']) ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label>Chọn Lịch Khởi Hành *</label>
                    <select name="id_lich" required>
                        <option value="">-- Chọn Lịch --</option>
                        <?php foreach ($lichList as $lich): ?>
                            <option value="<?= $lich['id_lich'] ?>" 
                                    <?= (isset($editingNhatKy) && $editingNhatKy['id_lich'] == $lich['id_lich']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($lich['ten_tour']) ?> (<?= $lich['ngay_khoi_hanh'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ngày Ghi *</label>
                    <input type="date" name="ngay_ghi" required
                           value="<?= isset($editingNhatKy) ? htmlspecialchars($editingNhatKy['ngay_ghi']) : date('Y-m-d') ?>">
                </div>

                <div class="form-group">
                    <label>Sự Cố</label>
                    <textarea name="su_co" placeholder="Mô tả sự cố nếu có..."><?= isset($editingNhatKy) ? htmlspecialchars($editingNhatKy['su_co']) : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Phản Hồi</label>
                    <textarea name="phan_hoi" placeholder="Phản hồi từ khách, đội nhóm..."><?= isset($editingNhatKy) ? htmlspecialchars($editingNhatKy['phan_hoi']) : '' ?></textarea>
                </div>

                <div class="form-group">
                    <label>Nhận Xét HDV</label>
                    <textarea name="nhan_xet_hdv" placeholder="Nhận xét cá nhân của bạn..."><?= isset($editingNhatKy) ? htmlspecialchars($editingNhatKy['nhan_xet_hdv']) : '' ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="index.php?act=hdv_nhat_ky" class="btn-cancel">Hủy</a>
                    <button type="submit" class="btn-submit">
                        <?= isset($_GET['edit']) ? 'Cập Nhật' : 'Lưu Nhật Ký' ?>
                    </button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <!-- NÚT VIẾT NHẬT KÝ MỚI -->
        <a href="index.php?act=hdv_nhat_ky&add=1" class="btn-add-nhat-ky">+ Viết Nhật Ký Mới</a>

        <!-- DANH SÁCH NHẬT KÝ -->
        <div class="nhat-ky-list">
            <?php if (!empty($nhatkyList)): ?>
                <?php foreach ($nhatkyList as $nk): ?>
                    <div class="nhat-ky-item">
                        <div class="nhat-ky-header">
                            <div class="nhat-ky-title">
                                <h4><?= htmlspecialchars($nk['ten_tour'] ?? 'Tour không xác định') ?></h4>
                                <small>Ghi ngày: <?= htmlspecialchars($nk['ngay_ghi']) ?> | Lịch khởi hành: <?= htmlspecialchars($nk['ngay_khoi_hanh'] ?? 'Chưa xác định') ?></small>
                            </div>
                            <div class="nhat-ky-actions">
                                <a href="index.php?act=hdv_nhat_ky&edit=<?= $nk['id_nhat_ky'] ?>" class="btn-edit">Sửa</a>
                                <a href="index.php?act=hdv_nhat_ky_delete&id=<?= $nk['id_nhat_ky'] ?>" class="btn-delete" 
                                   onclick="return confirm('Bạn có chắc muốn xóa nhật ký này?')">Xóa</a>
                            </div>
                        </div>

                        <div class="nhat-ky-content">
                            <div class="content-section">
                                <span class="content-label">Sự Cố</span>
                                <div class="content-value">
                                    <?= htmlspecialchars($nk['su_co'] ?? 'Không có sự cố') ?>
                                </div>
                            </div>
                            <div class="content-section">
                                <span class="content-label">Phản Hồi</span>
                                <div class="content-value">
                                    <?= htmlspecialchars($nk['phan_hoi'] ?? 'Không có phản hồi') ?>
                                </div>
                            </div>
                            <div class="content-section" style="grid-column: 1 / -1;">
                                <span class="content-label">Nhận Xét HDV</span>
                                <div class="content-value">
                                    <?= htmlspecialchars($nk['nhan_xet_hdv'] ?? 'Không có nhận xét') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-nhat-ky">
                    ⚠️ Chưa có nhật ký nào. <a href="index.php?act=hdv_nhat_ky&add=1" style="color: #0066cc; text-decoration: underline;">Tạo nhật ký mới</a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
