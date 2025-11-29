<div class="sidebar">
    <h2 class="sidebar-title">QUẢN LÝ TOUR</h2>

    <ul class="menu">
        <li><a href="index.php?act=dashboard">Dashboard</a></li>
        <li><a href="index.php?act=danhMuc">Danh mục tour</a></li>
        <li><a href="index.php?act=tour">Tour du lịch</a></li>
        <!-- Menu Booking có submenu -->
        <!-- <li class="has-submenu">
            <a href="javascript:void(0)">Booking </a>
            <ul class="submenu">
                <li><a href="index.php?act=taoBooking">Tạo booking mới</a></li>
                <li><a href="index.php?act=trangThaiBooking">Tình trạng booking</a></li>
            </ul>
        </li> -->
        <li><a href="index.php?act=booking">Quản lý Booking</a></li>
        <li><a href="index.php?act=nhanSu">Danh sách nhân sự</a></li>
        <li><a href="index.php?act=dieuHanhTour">Quản lý lịch khởi hành</a></li>
        <li><a href="index.php?act=doanKhach">Quản lý đoàn khách</a></li>
        <li><a href="index.php?act=nhaCungCap">Quản lý nhà cung cấp</a></li>
        <li><a href="index.php?act=nhatKy">Nhật ký tour</a></li>
        <li><a href="index.php?act=vanHanh">Báo cáo vận hành</a></li>
    </ul>

    <div class="logout-box">
        <a href="index.php?act=logout">Đăng xuất</a>
    </div>
</div>

<!-- JS mở submenu đặt cuối, sau sidebar -->
<script>
const submenuItems = document.querySelectorAll('.has-submenu > a');

submenuItems.forEach(item => {
    item.addEventListener('click', () => {
        const parent = item.parentElement;
        parent.classList.toggle('open'); // bật/tắt class 'open'
    });
});
</script>
