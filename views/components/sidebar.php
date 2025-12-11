<div class="sidebar">
    <h2 class="sidebar-title">QUẢN LÝ TOUR</h2>

    <ul class="menu">
        <li class="menu-item"><a href="index.php?act=dashboard" class="menu-link <?= $act=='dashboard'?'active':'' ?>">Dashboard</a></li>
        <li class="menu-item"><a href="index.php?act=danhMuc" class="menu-link <?= $act=='danhMuc'?'active':'' ?>">Danh mục tour</a></li>
        <li class="menu-item"><a href="index.php?act=tour" class="menu-link <?= $act=='tour'?'active':'' ?>">Tour du lịch</a></li>
        <li class="menu-item"><a href="index.php?act=booking" class="menu-link <?= $act=='booking'?'active':'' ?>">Quản lý Booking</a></li>
        <li class="menu-item"><a href="index.php?act=nhanSu" class="menu-link <?= $act=='nhanSu'?'active':'' ?>">Hướng dẫn viên</a></li>
        <li class="menu-item"><a href="index.php?act=dieuHanhTour" class="menu-link <?= $act=='dieuHanhTour'?'active':'' ?>">Lịch khởi hành</a></li>
        <li class="menu-item"><a href="index.php?act=doanKhach" class="menu-link <?= $act=='doanKhach'?'active':'' ?>">Quản lý khách theo tour</a></li>
        <li class="menu-item"><a href="index.php?act=nhaCungCap" class="menu-link <?= $act=='nhaCungCap'?'active':'' ?>">Quản lý nhà cung cấp</a></li>
        <li class="menu-item"><a href="index.php?act=nhatKy" class="menu-link <?= $act=='nhatKy'?'active':'' ?>">Nhật ký tour</a></li>
        <li class="menu-item"><a href="index.php?act=vanHanh" class="menu-link <?= $act=='vanHanh'?'active':'' ?>">Báo cáo vận hành</a></li>
    </ul>

    <div class="logout-box">
        <a href="index.php?act=logout" class="logout-link">Đăng xuất</a>
    </div>
</div>


<!-- JS mở submenu đặt cuối, sau sidebar -->
<script>
const menuLinks = document.querySelectorAll('.menu-link');

menuLinks.forEach(link => {
    link.addEventListener('click', () => {
        menuLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
    });
});

</script>

<style>
    /* ================= BODY & CONTAINER ================= */
body {
    margin: 0;
    font-family: "Inter", Arial, sans-serif;
    background: #f3f6fb;
    color: #1e293b;
    font-size: 13px;
}

.admin-container {
    display: flex;
    height: 100vh;
    overflow: hidden;
}

/* ================= SIDEBAR ================= */
.sidebar {
    width: 160px;
    background: linear-gradient(180deg, #2563eb 0%, #1d4ed8 100%);
    color: #fff;
    display: flex;
    flex-direction: column;
    height: 100vh;
    box-shadow: 2px 0 6px rgba(0, 0, 0, 0.08);
}

/* Tiêu đề sidebar */
.sidebar-title {
    text-align: center;
    padding: 10px 0;
    font-size: 15px;
    font-weight: 600;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

/* Menu chính */
.menu {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
}

.menu li {
    position: relative;
}

.menu li a {
    display: block;
    padding: 8px 12px;
    font-size: 13px;
    color: #fff;
    text-decoration: none;
    transition: all 0.2s;
}

/* Hover menu */
.menu li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    border-radius: 4px;
}

/* Menu active */
.menu li a.active {
    font-weight: 600;
    background-color: rgba(255, 255, 255, 0.5);
    color: #1d4ed8;
    border-radius: 4px;
}

/* Submenu (nếu thêm) */
.menu li.has-submenu > a::after {
    content: '▾';
    float: right;
    margin-right: 5px;
    font-size: 10px;
}

.menu li.has-submenu .submenu {
    display: none;
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu li.has-submenu.open .submenu {
    display: block;
}

.menu li.has-submenu .submenu li a {
    padding: 6px 20px;
    font-size: 12px;
    color: #fff;
}

/* Hover submenu */
.menu li.has-submenu .submenu li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    border-radius: 4px;
}

/* Active submenu */
.menu li.has-submenu .submenu li a.active {
    font-weight: 600;
    background-color: rgba(255, 255, 255, 0.4);
    color: #1d4ed8;
    border-radius: 4px;
}

/* Logout box */
.logout-box {
    padding: 8px;
    font-size: 13px;
}

.logout-box a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 6px 12px;
    border-radius: 4px;
    transition: all 0.2s;
}

.logout-box a:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

/* ================= PHẦN BÊN PHẢI ================= */
.admin-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* Header */
.admin-header {
    background: #ffffff;
    padding: 8px 12px;
    font-size: 13px;
    border-bottom: 1px solid #e2e8f0;
    text-align: right;
    font-weight: 500;
    color: #1e3a8a;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

/* Nội dung chính */
.admin-content {
    flex: 1;
    padding: 12px;
    background: #f8fafc;
    overflow-y: auto;
}

/* Footer */
.admin-footer {
    background: #ffffff;
    padding: 8px;
    border-top: 1px solid #e2e8f0;
    text-align: center;
    font-size: 12px;
    color: #475569;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.05);
}
.menu li a.active {
    font-weight: 600;
    background-color: rgba(0,0,0,0.2); /* nền tối hơn */
    color: #fff;
    border-radius: 4px;
}
.menu li a.active {
    font-weight: 600;
    background-color: rgba(0,0,0,0.3); /* nền tối hơn */
    color: #fff;
    border-radius: 4px;
}

</style>