
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điều hành tour</title>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/tab.css">
</head>
<body>
    <h1>Báo cáo vận hành tuần này</h1>

<div>
    <p>Tổng booking tuần này: <strong><?= $totalBookings ?></strong></p>
    <p>Tổng khách tuần này: <strong><?= $totalCustomers ?></strong></p>
    <p>Tổng doanh thu tuần này: <strong><?= number_format(array_sum($revenueByDay)) ?> VNĐ</strong></p>
</div>

<canvas id="weeklyChart" width="800" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line', // hoặc 'bar'
        data: {
            labels: <?= json_encode($days) ?>,
            datasets: [{
                label: 'Doanh thu theo ngày (VNĐ)',
                data: <?= json_encode($revenueByDay) ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
