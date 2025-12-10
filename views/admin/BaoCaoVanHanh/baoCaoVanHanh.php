
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
</head>
<style>
    /* assets/css/tab.css */

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #fdfdfd;
    color: #333;
    
}

h1 {
    text-align: center;
    color: #0078d7;
    margin-bottom: 20px;
}

div p {
    font-size: 16px;
    margin: 5px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    background: #fff;
    border-radius: 6px;
    overflow: hidden;
}

table th {
    background: #0078d7;
    color: #fff;
    padding: 12px;
    text-align: center;
}

table td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

table tr:nth-child(even) {
    background: #f9f9f9;
}

table tr:hover {
    background: #eaf4ff;
}

tr[style] {
    font-style: italic;
    color: #555;
}

canvas {
    margin-top: 30px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 6px;
    padding: 10px;
}

</style>
<body>
    <h1>Báo cáo vận hành tuần này</h1>

<div>
    <p>Tổng booking tuần này: <strong><?= $totalBookings ?></strong></p>
    <p>Tổng khách tuần này: <strong><?= $totalCustomers ?></strong></p>
<p>Tổng doanh thu tuần này: 
   <strong style="color:red"><?= number_format(array_sum(array_column($weeklyRevenue, 'loi_nhuan'))) ?> VNĐ</strong>
</p>

</div>

<table>
    <tr>
        <th>Ngày</th>
        <th>Tên tour</th>
        <th>Số khách</th>
        <th>Giá cơ bản</th>
        <th>Khách sạn</th>
        <th>Nhà hàng</th>
        <th>Xe</th>
        <th>HDV</th>
        <th>Tổng thu</th>
        <th>Tổng chi</th>
        <th>Lợi nhuận</th>
    </tr>
    <?php 
    $tongThuTuan = 0;
    $tongChiTuan = 0;
    $tongLoiNhuanTuan = 0;

    foreach ($weeklyRevenue as $rev): 
        $soKhach = $rev['so_luong_khach'] ?? 0;
        $giaCoBan = $rev['gia_co_ban'] ?? 0;
        $ks = $rev['gia_khach_san'] ?? 0;
        $nh = $rev['gia_nha_hang'] ?? 0;
        $xe = $rev['gia_nha_xe'] ?? 0;
        $hdv = $rev['luong_hdv'] ?? 0;

        $tongThu = $giaCoBan * $soKhach;
        $tongChi = ($ks * $soKhach) + ($nh * $soKhach) + ($xe * $soKhach) + $hdv;
        $loiNhuan = $tongThu - $tongChi;

        $tongThuTuan += $tongThu;
        $tongChiTuan += $tongChi;
        $tongLoiNhuanTuan += $loiNhuan;
    ?>
    <!-- Dòng dữ liệu -->
    <tr>
        <td><?= $rev['ngay'] ?></td>
        <td><?= $rev['ten_tour'] ?></td>
        <td><?= $soKhach ?></td>
        <td><?= number_format($giaCoBan) ?></td>
        <td><?= number_format($ks) ?></td>
        <td><?= number_format($nh) ?></td>
        <td><?= number_format($xe) ?></td>
        <td><?= number_format($hdv) ?></td>
        <td><?= number_format($tongThu) ?></td>
        <td><?= number_format($tongChi) ?></td>
        <td><strong><?= number_format($loiNhuan) ?></strong></td>
    </tr>
    <!-- Dòng công thức -->
    <tr style="background:#f9f9f9;">
        <td colspan="11">
            Công thức: (<?= number_format($giaCoBan) ?> × <?= $soKhach ?>)
            – (<?= number_format($ks) ?> × <?= $soKhach ?>
            + <?= number_format($nh) ?> × <?= $soKhach ?>
            + <?= number_format($xe) ?> × <?= $soKhach ?>
            + <?= number_format($hdv) ?>)
            = <?= number_format($loiNhuan) ?>
        </td>
    </tr>
    <?php endforeach; ?>

    <!-- Tổng tuần -->
    <tr style="background:#d0ffd0; font-weight:bold;">
        <td colspan="8">Tổng tuần</td>
        <td><?= number_format($tongThuTuan) ?></td>
        <td><?= number_format($tongChiTuan) ?></td>
        <td style="color:red"><?= number_format($tongLoiNhuanTuan) ?></td>
    </tr>
</table>




<canvas id="weeklyChart" width="800" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <?php
    // Gom dữ liệu theo ngày và cộng dồn
    $dailyData = [];
    foreach ($weeklyRevenue as $rev) {
        $ngay = $rev['ngay'];
        if (!isset($dailyData[$ngay])) {
            $dailyData[$ngay] = ['tong_thu'=>0,'tong_chi'=>0,'loi_nhuan'=>0];
        }
        $dailyData[$ngay]['tong_thu'] += $rev['tong_thu'];
        $dailyData[$ngay]['tong_chi'] += $rev['tong_chi'];
        $dailyData[$ngay]['loi_nhuan'] += $rev['loi_nhuan'];
    }
    ksort($dailyData);
    $days = array_keys($dailyData);
    $thu = array_column($dailyData, 'tong_thu');
    $chi = array_column($dailyData, 'tong_chi');
    $loiNhuan = array_column($dailyData, 'loi_nhuan');
    ?>

    const ctx = document.getElementById('weeklyChart').getContext('2d');

    // Tạo gradient hiện đại
    const gradientThu = ctx.createLinearGradient(0, 0, 0, 400);
    gradientThu.addColorStop(0, 'rgba(0,200,83,0.6)');
    gradientThu.addColorStop(1, 'rgba(0,200,83,0.1)');

    const gradientChi = ctx.createLinearGradient(0, 0, 0, 400);
    gradientChi.addColorStop(0, 'rgba(255,99,132,0.6)');
    gradientChi.addColorStop(1, 'rgba(255,99,132,0.1)');

    const gradientLoi = ctx.createLinearGradient(0, 0, 0, 400);
    gradientLoi.addColorStop(0, 'rgba(33,150,243,0.6)');
    gradientLoi.addColorStop(1, 'rgba(33,150,243,0.1)');

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($days) ?>,
            datasets: [
                {
                    label: 'Tổng thu (VNĐ)',
                    data: <?= json_encode($thu) ?>,
                    borderColor: 'rgba(0,200,83,1)',
                    backgroundColor: gradientThu,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(0,200,83,1)',
                    pointRadius: 5
                },
                {
                    label: 'Tổng chi (VNĐ)',
                    data: <?= json_encode($chi) ?>,
                    borderColor: 'rgba(255,99,132,1)',
                    backgroundColor: gradientChi,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(255,99,132,1)',
                    pointRadius: 5
                },
                {
                    label: 'Lợi nhuận (VNĐ)',
                    data: <?= json_encode($loiNhuan) ?>,
                    borderColor: 'rgba(33,150,243,1)',
                    backgroundColor: gradientLoi,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(33,150,243,1)',
                    pointRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Biểu đồ hiện đại: Thu - Chi - Lợi nhuận',
                    font: { size: 20 }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw.toLocaleString() + ' VNĐ';
                        }
                    }
                },
                legend: {
                    position: 'bottom'
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' VNĐ';
                        }
                    }
                }
            }
        }
    });
</script>




</body>
</html>
