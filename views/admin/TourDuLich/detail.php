<div class="container mt-4">

    <!-- Thông tin tour -->
    <h2 class="text-primary"><?= htmlspecialchars($tour['ten_tour']) ?></h2>
    <p><?= htmlspecialchars($tour['mo_ta']) ?></p>

    <!-- ngày khởi hành và kết thúc tour (từ bảng lich_khoi_hanh) -->
    <div class="alert alert-info">
        <b>Ngày khởi hành:</b> <?= htmlspecialchars($tour['ngay_khoi_hanh'] ?? '') ?><br>
        <b>Ngày kết thúc:</b> <?= htmlspecialchars($tour['ngay_ket_thuc'] ?? '') ?>
    </div>

    <hr>
<!-- Ảnh tour -->
<?php if (!empty($anhTour)): ?>
    <div class="tour-images">
        <?php foreach ($anhTour as $img): ?>
            <div class="tour-img">
                <img src="<?= htmlspecialchars($img) ?>" 
                     alt="<?= htmlspecialchars($tour['ten_tour']) ?>">
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Chưa có ảnh cho tour này.</p>
<?php endif; ?>


    <hr>
    <!-- Các thông tin khác từ lich_khoi_hanh nếu muốn -->
    <h3 class="mt-4 mb-3 text-warning">Thông tin khởi hành</h3>
    <?php if (!empty($lichKhoiHanh)): ?>
        <?php foreach ($lichKhoiHanh as $lkh): ?>
            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Địa điểm khởi hành:</strong> <?= htmlspecialchars($lkh['dia_diem_khoi_hanh']) ?></p>
                <p><strong>Địa điểm đến:</strong> <?= htmlspecialchars($lkh['dia_diem_den']) ?></p>
                <p><strong>Thông tin xe:</strong> <?= htmlspecialchars($lkh['thong_tin_xe']) ?></p>
                <!-- <p><strong>Nhà hàng:</strong> <?= htmlspecialchars($lkh['ten_nha_hang'] ?? 'Chưa chọn') ?></p>
                <p><strong>Khách sạn:</strong> <?= htmlspecialchars($lkh['ten_khach_san'] ?? 'Chưa chọn') ?></p> -->

                <p><strong>Ghi chú:</strong> <?= htmlspecialchars($lkh['ghi_chu']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Chưa có lịch khởi hành cho tour này.</p>
    <?php endif; ?>

    <hr>

    <!-- Lịch trình từng ngày (từ bảng lich_trinh) -->
    <h3 class="mt-4 mb-3 text-success">📅 Lịch trình từng ngày</h3>
    <?php if (!empty($lichTrinh)): ?>
        <?php foreach ($lichTrinh as $lt): ?>
            <div class="card mb-3 shadow-sm p-3">
                <p><strong>Ngày thứ:</strong> <?= htmlspecialchars($lt['ngay_thu']) ?></p>
                <p><strong>Tiêu đề:</strong> <?= htmlspecialchars($lt['tieu_de']) ?></p>
                <p><strong>Hoạt động:</strong> <?= htmlspecialchars($lt['hoat_dong']) ?></p>
                <p><strong>Địa điểm:</strong> <?= htmlspecialchars($lt['dia_diem']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Chưa có lịch trình cho tour này.</p>
    <?php endif; ?>

    <hr>



    <a href="index.php?act=tour" class="btn btn-secondary">Quay lại</a>
</div>
<style>
    /* Container padding */
    .container {
        max-width: 1400px;
        margin: 40px auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Thông tin tour */
    h2.text-primary {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* Mô tả tour */
    p {
        font-size: 1rem;
        color: #555;
    }

    /* Alert info cho ngày khởi hành/kết thúc */
    .alert-info {
        background-color: #e3f2fd;
        border: 1px solid #b6d4fe;
        color: #084298;
        padding: 15px 20px;
        border-radius: 8px;
        font-size: 1rem;
    }

    /* Heading các phần */
    h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 15px;
    }

    /* Card lịch trình và thông tin khởi hành */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        padding: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Các đoạn text trong card */
    .card p {
        margin: 6px 0;
        font-size: 0.95rem;
    }

    /* Strong trong card */
    .card strong {
        color: #333;
    }

    /* Thông tin khởi hành */
    h3.text-warning {
        color: #d48806;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .container {
            margin: 20px 15px;
        }

        h2.text-primary {
            font-size: 1.6rem;
        }

        h3 {
            font-size: 1.1rem;
        }

        .card {
            padding: 15px;
        }
    }

    /* Nút quay lại */
    .btn-secondary {
        display: inline-block;
        background-color: #6c757d;
        /* màu xám chuẩn bootstrap secondary */
        color: #fff;
        text-decoration: none;
        padding: 12px 25px;
        /* tăng padding để to hơn */
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    /* Hover */
    .btn-secondary:hover {
        background-color: #5a6268;
        /* tối hơn khi hover */
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    /* Focus */
    .btn-secondary:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(108, 117, 125, 0.4);
    }
.tour-images {
    display: flex;
    flex-wrap: nowrap;      /* không xuống dòng */
    gap: 10px;              /* khoảng cách giữa ảnh */
    overflow-x: auto;       /* xuất hiện thanh cuộn ngang nếu quá dài */
    padding-bottom: 10px;   /* tránh ảnh bị che bởi scrollbar */
}

.tour-img {
    flex: 0 0 auto;         /* giữ kích thước cố định */
    width: 200px;
    height: 150px;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.tour-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}


</style>