<h1 class="tour-title">Sửa danh mục tour</h1>

<form action="index.php?act=danhMuc&action=edit&id=<?= $dm['id_danh_muc'] ?>" 
      method="post" enctype="multipart/form-data" class="tour-form">

    <div class="form-group">
        <label for="ten_danh_muc">Tên danh mục</label>
        <input 
            type="text" 
            name="ten_danh_muc" 
            id="ten_danh_muc" 
            value="<?= $dm['ten_danh_muc'] ?>" 
            required
        >
    </div>

    <div class="form-group">
        <label for="mo_ta">Mô tả</label>
        <textarea name="mo_ta" id="mo_ta" rows="3"><?= $dm['mo_ta'] ?></textarea>
    </div>

    <button type="submit" class="submit-btn">Cập nhật</button>
    <a href="index.php?act=danhMuc&action=list" class="back-btn">Quay lại</a>

</form>
<!-- /* Khung tiêu đề */ -->
<style>
.tour-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

/* Khung form */
.tour-form {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    max-width: 600px;
    width: 100%;
}

/* Nhóm form */
.form-group {
    margin-bottom: 18px;
}

/* Label */
.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #444;
}

/* Input + Textarea */
.form-group input[type="text"],
.form-group input[type="file"],
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    font-size: 15px;
    outline: none;
    transition: 0.2s;
    background: #fafafa;
}

.form-group textarea {
    resize: vertical;
}

/* Khi focus */
.form-group input:focus,
.form-group textarea:focus {
    border-color: #1e88e5;
    background: #fff;
    box-shadow: 0 0 0 2px rgba(30, 136, 229, 0.15);
}

/* Nút submit */
.submit-btn {
    background: #1e88e5;
    color: #fff;
    padding: 10px 18px;
    font-size: 15px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
}

.submit-btn:hover {
    background: #1565c0;
}

/* Nút quay lại */
.back-btn {
    display: inline-block;
    padding: 10px 18px;
    background: #aaa;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    margin-left: 10px;
    transition: 0.2s;
}

.back-btn:hover {
    background: #888;
}

/* Ảnh xem trước */
.preview-img {
    margin-top: 8px;
    border-radius: 6px;
    border: 1px solid #ddd;
}
</style>