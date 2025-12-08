<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Danh sách nhân sự</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<style>
/* Tổng thể */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
    margin: 0;
    color: #333;
}

/* Khung chính */
.container {
    max-width: 1200px;
    margin: auto;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    padding: 30px;
    position: relative;
}

/* Tiêu đề */
.header {
    text-align: center;
    margin-bottom: 30px;
    position: relative;
}

.header h1 {
    color: #00796b;
    font-size: 2.5em;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.header h1::before {
    content: "🌴";
    margin-right: 10px;
}

.header h1::after {
    content: "✈️";
    margin-left: 10px;
}

/* Thanh công cụ */
.toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.search-box {
    position: relative;
}

.search-box input {
    padding: 10px 40px 10px 15px;
    border: 2px solid #009688;
    border-radius: 25px;
    outline: none;
    transition: 0.3s;
    width: 250px;
}

.search-box input:focus {
    border-color: #004d40;
    box-shadow: 0 0 8px rgba(0, 121, 107, 0.4);
}

.search-box i {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #009688;
}

/* Nút thêm */
.add-btn {
    background: linear-gradient(45deg, #009688, #26a69a);
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.add-btn:hover {
    background: linear-gradient(45deg, #00796b, #004d40);
    transform: translateY(-2px);
}

/* Bảng */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

thead {
    background: linear-gradient(45deg, #009688, #26a69a);
    color: white;
}

th, td {
    padding: 14px 16px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

tbody tr:hover {
    background-color: #e0f2f1;
    transition: 0.3s;
}

/* Ảnh đại diện */
td img {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #009688;
}

/* Nút hành động */
.action-btns button {
    border: none;
    background: none;
    cursor: pointer;
    font-size: 18px;
    margin: 0 6px;
    transition: 0.3s;
}

.action-btns .view i { color: #0288d1; }
.action-btns .edit i { color: #fbc02d; }
.action-btns .delete i { color: #e53935; }

.action-btns button:hover i {
    transform: scale(1.2);
}

/* Responsive */
@media (max-width: 768px) {
    .toolbar {
        flex-direction: column;
        gap: 15px;
    }

    table thead {
        display: none;
    }

    table, tbody, tr, td {
        display: block;
        width: 100%;
    }

    tr {
        margin-bottom: 15px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        padding: 10px;
    }

    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        text-align: left;
        font-weight: bold;
        color: #00796b;
    }
}
/* Nút hành động có màu nền riêng biệt */
button.view, button.edit, button.delete {
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    margin: 0 5px;
    padding: 8px 12px;
    border-radius: 8px;
    transition: 0.3s;
}

/* Nút xem */
button.view {
    background-color: #0288d1;
}
button.view:hover {
    background-color: #01579b;
    transform: scale(1.05);
}

/* Nút sửa */
button.edit {
    background-color: #fbc02d;
    color: #333;
}
button.edit:hover {
    background-color: #f9a825;
    transform: scale(1.05);
}

/* Nút xóa */
button.delete {
    background-color: #e53935;
}
button.delete:hover {
    background-color: #b71c1c;
    transform: scale(1.05);
}

/* Biểu tượng trong nút */
button i {
    pointer-events: none;
}
.alert {
    padding: 15px 20px;
    border-radius: 8px;
    font-weight: 600;
    margin: 10px 0;
    cursor: pointer;
    animation: fadeIn 0.5s ease;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left: 5px solid #28a745;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border-left: 5px solid #dc3545;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
}


</style>
<body>
<div class="container">
    <div class="header">
        <h1>Danh sách nhân sự</h1>
    </div>


<div class="toolbar">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Tìm theo tên hoặc SĐT...">
            <i class="fa fa-search"></i>
        </div>
        <button class="add-btn" onclick="location.href='index.php?act=nhanSu&action=add'">
            <i class="fa fa-user-plus"></i> Thêm HDV mới
        </button>
    </div>
     <div class="table-container">
        <table id="nhanSuTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>SĐT</th>
                    <th>Chuyên môn</th>
                    <th>Tình trạng</th>
                    <th>Lương</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($nhanSuList as $hdv): ?>
                <tr>
                    <td data-label="ID"><?= $hdv['id_hdv'] ?></td>
                    <td data-label="Avatar"><?php if($hdv['avatar']): ?><img src="<?= $hdv['avatar'] ?>" alt="Avatar"><?php endif; ?></td>
                    <td data-label="Họ và tên"><?= $hdv['ho_ten'] ?></td>
                    <td data-label="Giới tính"><?= $hdv['gioi_tinh'] ?></td>
                    <td data-label="Ngày sinh"><?= $hdv['ngay_sinh'] ?></td>
                    <td data-label="SĐT"><?= $hdv['so_dien_thoai'] ?></td>
                    <td data-label="Chuyên môn"><?= $hdv['loai_hdv'] ?></td>
                    <td data-label="Tình trạng"><?= $hdv['trang_thai_lam_viec_hdv'] ?></td>
                    <td data-label="Lương"><?= $hdv['luong_hdv'] ?></td>
                    <td data-label="Ghi chú"><?= $hdv['mo_ta'] ?></td>
                    <td data-label="Hành động">
                        <button  onclick="location.href='index.php?act=nhanSu&action=view&id=<?= $hdv['id_hdv'] ?>'" class="view"><i class="fa fa-eye"></i></button>

                        <button onclick="location.href='index.php?act=nhanSu&action=edit&id=<?= $hdv['id_hdv'] ?>'" class="edit"><i class="fa fa-edit"></i></button>

                        <button 
                            onclick="return confirm('Bạn có chắc muốn xóa?') 
                            ? location.href='index.php?act=nhanSu&action=delete&id=<?= $hdv['id_hdv'] ?>' 
                            : false;" class="delete"><i class="fa fa-trash"></i>
                        </button>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
// Lọc bảng theo input
document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#nhanSuTable tbody tr');
    rows.forEach(row => {
        const name = row.querySelector('td[data-label="Họ và tên"]').textContent.toLowerCase();
        const phone = row.querySelector('td[data-label="SĐT"]').textContent.toLowerCase();
        if(name.includes(filter) || phone.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-error" onclick="this.style.display='none'">
        🚫 <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success" onclick="this.style.display='none'">
        ✅ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>


</body>
</html>
