<link rel="stylesheet" href="public/css/dashboard.css">

<h1>Dashboard</h1>
<p>Chào mừng bạn đến trang quản trị hệ thống tour du lịch.</p>

<!-- Thống kê nhanh -->
<div class="cards">
  <div class="card">
    <h3>Tours đang hoạt động</h3>
    <div class="value">
      <?= isset($data['activeTours']) ? $data['activeTours'] : 0 ?>
    </div>
  </div>
  <div class="card">
    <h3>Booking hôm nay / tuần này</h3>
    <div class="value">
      <?= isset($data['bookingStats']['today']) ? $data['bookingStats']['today'] : 0 ?>
      /
      <?= isset($data['bookingStats']['week']) ? $data['bookingStats']['week'] : 0 ?>
    </div>
  </div>
</div>

<!-- Lịch khởi hành -->
<div class="schedule">
  <h3>Lịch khởi hành sắp tới</h3>
  <ul>
    <?php if (!empty($data['upcomingDepartures'])): ?>
      <?php foreach ($data['upcomingDepartures'] as $tour): ?>
        <li><?= $tour['ten_tour'] ?> - <?= date('d/m/Y', strtotime($tour['ngay_khoi_hanh'])) ?></li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>Không có lịch khởi hành nào</li>
    <?php endif; ?>
  </ul>
</div>

<!-- Doanh thu -->
<div class="chart">
  <h3>Doanh thu theo tháng</h3>
  <ul>
    <?php if (!empty($data['monthlyRevenue'])): ?>
      <?php foreach ($data['monthlyRevenue'] as $rev): ?>
        <li>Tháng <?= $rev['thang'] ?>: <?= number_format($rev['doanh_thu'], 0, ',', '.') ?> VND</li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>Chưa có dữ liệu doanh thu</li>
    <?php endif; ?>
  </ul>
</div>

<!-- Cảnh báo tour -->
<div class="alerts">
  <h3>Cảnh báo tour</h3>
  <?php if (!empty($data['tourAlerts'])): ?>
    <?php foreach ($data['tourAlerts'] as $alert): ?>
      <div class="warning">
  ⚠️ Tour <?= $alert['ten_tour'] ?> 
  (<?= $alert['trang_thai_tour'] ?>)
</div>

    <?php endforeach; ?>
  <?php else: ?>
    <p>Không có cảnh báo nào</p>
  <?php endif; ?>
</div>

<style>
    body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f4f6f8;
  margin: 0;
}

h1 {
  font-size: 28px;
  margin-bottom: 10px;
}

p {
  font-size: 16px;
  color: #555;
}

.cards {
  display: flex;
  gap: 20px;
  margin: 20px 0;
}

.card {
  flex: 1;
  background-color: #fff;
  border-left: 6px solid #3498db;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.card h3 {
  margin: 0 0 10px;
  font-size: 18px;
  color: #333;
}

.card .value {
  font-size: 32px;
  font-weight: bold;
  color: #3498db;
}

.schedule, .chart, .alerts {
  background-color: #fff;
  padding: 20px;
  margin: 20px 0;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.schedule h3, .chart h3, .alerts h3 {
  font-size: 20px;
  margin-bottom: 10px;
  color: #2c3e50;
}

.schedule ul, .chart ul {
  list-style: none;
  padding-left: 0;
}

.schedule li, .chart li {
  padding: 6px 0;
  border-bottom: 1px solid #eee;
  font-size: 15px;
}

.warning {
  background-color: #f39c12;
  color: white;
  padding: 12px 16px;
  border-radius: 6px;
  margin-bottom: 10px;
  font-weight: bold;
}

@media (max-width: 768px) {
  .cards {
    flex-direction: column;
  }
}

</style>