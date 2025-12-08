<h1 style="text-align:center; color:#00796b;">📊 Dashboard Quản trị</h1>

<!-- Cards -->
<div class="cards">
  <a href="index.php?act=tour" class="card-link">
    <div class="card">
      <i class="fas fa-map"></i>
      <h2><?= count($data['totalTours']) ?></h2>
      <p>Tổng số tour</p>
    </div>
  </a>
  <a href="index.php?act=tour&status=active" class="card-link">
    <div class="card">
      <i class="fas fa-check-circle"></i>
      <h2><?= $data['activeTours'] ?></h2>
      <p>Tour đang hoạt động</p>
    </div>
  </a>
  <a href="index.php?act=booking" class="card-link">
    <div class="card">
      <i class="fas fa-ticket-alt"></i>
      <h2><?= count($data['totalBookings']) ?></h2>
      <p>Tổng số booking</p>
    </div>
  </a>
  <a href="index.php?act=nhanSu" class="card-link">
    <div class="card">
      <i class="fas fa-user-tie"></i>
      <h2><?= count($data['totalHDV']) ?></h2>
      <p>Hướng dẫn viên</p>
    </div>
  </a>
  <a href="index.php?act=khachSan" class="card-link">
    <div class="card">
      <i class="fas fa-hotel"></i>
      <h2><?= count($data['totalKhachSan']) ?></h2>
      <p>Khách sạn</p>
    </div>
  </a>
  <a href="index.php?act=nhaHang" class="card-link">
    <div class="card">
      <i class="fas fa-utensils"></i>
      <h2><?= count($data['totalNhaHang']) ?></h2>
      <p>Nhà hàng</p>
    </div>
  </a>
  <a href="index.php?act=nhaXe" class="card-link">
    <div class="card">
      <i class="fas fa-bus"></i>
      <h2><?= count($data['totalNhaXe']) ?></h2>
      <p>Nhà xe</p>
    </div>
  </a>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<!-- Biểu đồ doanh thu -->
<div style="margin:20px; background:#fff; padding:20px; border-radius:10px;">
  <h3 style="color:#00796b;">Doanh thu theo tháng</h3>
  <canvas id="chartRevenue"></canvas>
</div>

<!-- Lịch khởi hành sắp tới -->
<div style="margin:20px; background:#fff; padding:20px; border-radius:10px;">
  <h3 style="color:#00796b;">Lịch khởi hành 7 ngày tới</h3>
  <table style="width:100%; border-collapse:collapse;">
    <tr style="background:#009688; color:#fff;">
      <th>Tour</th><th>HDV</th><th>Ngày khởi hành</th><th>Ngày kết thúc</th>
    </tr>
    <?php foreach($data['upcomingDepartures'] as $lich): ?>
    <tr>
      <td><?= $lich['ten_tour'] ?? '-' ?></td>
      <td><?= $lich['ho_ten'] ?? 'Chưa phân công' ?></td>
      <td><?= $lich['ngay_khoi_hanh'] ?? '-' ?></td>
      <td><?= $lich['ngay_ket_thuc'] ?? '-' ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('chartRevenue').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode(array_keys($data['monthlyRevenue'])) ?>,
      datasets: [{
        label: 'Doanh thu',
        data: <?= json_encode(array_values($data['monthlyRevenue'])) ?>,
        borderColor: '#00796b',
        fill: false
      }]
    }
  });
</script>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center; /* căn giữa nội dung */
  }
  th {
    background-color: #009688;
    color: #fff;
    font-weight: bold;
  }
  tr:nth-child(even) {
    background-color: #f9f9f9; /* màu xen kẽ cho dễ nhìn */
  }
  tr:hover {
    background-color: #f1f1f1; /* hover highlight */
  }
  .cards {
  display: flex;
  justify-content: space-around;
  margin: 20px;
  gap: 20px;
  flex-wrap: nowrap; /* tất cả nằm trên 1 hàng */
  overflow-x: auto;  /* nếu màn hình nhỏ thì cuộn ngang */
}

.card {
  background:#fff;
  padding:20px;
  border-radius:10px;
  box-shadow:0 4px 8px rgba(0,0,0,0.1);
  width:180px;
  text-align:center;
  flex-shrink:0; /* không co lại khi cuộn */
}

.card i {
  font-size: 30px;
  color:#009688;
  margin-bottom: 10px;
}

.card-link {
  text-decoration: none;
  color: inherit;
}

.card-link:hover .card {
  transform: translateY(-5px);
  transition: 0.3s;
  box-shadow:0 6px 12px rgba(0,0,0,0.15);
  cursor: pointer;
}

</style>
