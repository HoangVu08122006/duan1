<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
    margin: 0;
    
    color: #333;
}

/* Tiêu đề */
h1 {
    text-align: center;
    color: #00796b;
    font-size: 2.3em;
    margin-bottom: 25px;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
}

h1::before {
    content: "🗺️";
    margin-right: 10px;
}

h1::after {
    content: "🚍";
    margin-left: 10px;
}

/* Ô tìm kiếm */
.search-box {
    text-align: center;
    margin-bottom: 25px;
}

#searchInput {
    width: 320px;
    padding: 12px 20px;
    border: 2px solid #009688;
    border-radius: 30px;
    outline: none;
    transition: 0.3s;
    background: #ffffff url('https://cdn-icons-png.flaticon.com/512/751/751463.png') no-repeat 10px center;
    background-size: 20px;
    padding-left: 40px;
}

#searchInput:focus {
    border-color: #004d40;
    box-shadow: 0 0 10px rgba(0, 150, 136, 0.4);
}

/* Nút thêm mới */
.add-btn {
    display: block;
    margin: 0 auto 30px;
    background: linear-gradient(45deg, #009688, #26a69a);
    color: white;
    border: none;
    padding: 12px 35px;
    border-radius: 30px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    position: relative;
}

.add-btn::before {
    content: "🧭";
    margin-right: 8px;
}

.add-btn:hover {
    background: linear-gradient(45deg, #00796b, #004d40);
    transform: translateY(-2px);
}

/* Bảng */
#lichTable {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    border-radius: 12px;
    overflow: hidden;
}

#lichTable thead {
    background: linear-gradient(45deg, #009688, #26a69a);
    color: white;
}

#lichTable th, #lichTable td {
    padding: 14px 16px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

#lichTable tbody tr:nth-child(even) {
    background-color: #f1f8f7;
}

#lichTable tbody tr:hover {
    background-color: #e0f2f1;
    transition: 0.3s;
}

/* Nút hành động */
button.view, button.edit, button.delete {
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
    margin: 0 5px;
    padding: 8px 14px;
    border-radius: 8px;
    transition: 0.3s;
}

/* Nút chi tiết */
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

/* Responsive */
@media (max-width: 768px) {
    #lichTable thead {
        display: none;
    }

    #lichTable, #lichTable tbody, #lichTable tr, #lichTable td {
        display: block;
        width: 100%;
    }

    #lichTable tr {
        margin-bottom: 15px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        padding: 10px;
    }

    #lichTable td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    #lichTable td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        text-align: left;
        font-weight: bold;
        color: #00796b;
    }
}



</style>
<body>
    <h1>Quản lý lịch khởi hành & phân bổ nhân sự</h1>
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Tìm theo Tour/HDV...">
    </div>
    <button class="add-btn" onclick="location.href='index.php?act=dieuHanhTour&action=add'">Thêm lịch mới</button>

    <table id="lichTable">
        <thead>
            <tr>
                <th>Tour</th>
                <th>Ngày KH</th>
                <th>Ngày KT</th>
                <th>HDV chính</th>
                <th>Điểm khởi hành</th>
                <th>Điểm đến</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $today = date('Y-m-d');
                foreach($lichKhoiHanhList as $lich): 
                    if (strtotime($lich['ngay_ket_thuc']) < strtotime($today)) {
                        continue; // bỏ qua lịch đã kết thúc
                    }
                ?>
                <tr>
                    <td><?= $lich['ten_tour'] ?></td>
                    <td><?= $lich['ngay_khoi_hanh'] ?></td>
                    <td><?= $lich['ngay_ket_thuc'] ?></td>
                    <td><?= $lich['hdv_chinh'] ?></td>
                    <td><?= $lich['dia_diem_khoi_hanh'] ?></td>
                    <td><?= $lich['dia_diem_den'] ?></td>
                    <td><?= $lich['ghi_chu'] ?></td>
                    <td><?= $lich['trang_thai_lich_khoi_hanh'] ?></td>
                    <td>
                        <button onclick="location.href='index.php?act=dieuHanhTour&action=view&id=<?= $lich['id_lich'] ?>'" class="view"><i class="fa fa-eye"></i></button>
                        <button onclick="location.href='index.php?act=dieuHanhTour&action=edit&id=<?= $lich['id_lich'] ?>'" class="edit"><i class="fa fa-edit"></i></button>
                        <button onclick="if(confirm('Bạn có chắc muốn xóa?')) location.href='index.php?act=dieuHanhTour&action=delete&id=<?= $lich['id_lich'] ?>'" class="delete"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <script>
    document.getElementById('searchInput').addEventListener('keyup', function(){
        const filter = this.value.toLowerCase();
        document.querySelectorAll('#lichTable tbody tr').forEach(row=>{
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter)?'':'none';
        });
    });
    </script>
</body>
</html>

