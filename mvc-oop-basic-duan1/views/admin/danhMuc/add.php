<h1 class="tour-title">Thêm danh mục tour mới</h1>

<form action="index.php?act=danhMuc&action=add" method="post">


    <div class="form-group">
        <label for="ten_danh_muc">Tên danh mục</label>
        <input type="text" name="ten_danh_muc" id="ten_danh_muc" required>
    </div>

   
    <div class="form-group">
        <label for="mo_ta">Mô tả</label>
        <textarea name="mo_ta" id="mo_ta" rows="3"></textarea>
    </div>

    <button type="submit" class="submit-btn">Thêm mới</button>
    <a href="index.php?act=danhMucTour&action=list" class="back-btn">Quay lại</a>

</form>
<style>
    .tour-title {
        font-size: 24px;
        margin-bottom: 20px;
    }
    .tour-form {
        max-width: 600px;
        display: flex;
        flex-direction: column;
    }
    .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }
    .form-group label {
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-group input,
    .form-group textarea {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .submit-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
    }
    .back-btn {
        display: inline-block;
        margin-top: 10px;
        color: #007bff;
        text-decoration: none;
    }
</style>