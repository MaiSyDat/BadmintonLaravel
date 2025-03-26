<!-- Topbar -->
<nav class="topbar">
    <div class="container topbar-container">
        <div class="logo">
            <a href="#">
                <img class="logo-img" src="" alt="Logo DSmash">
            </a>
        </div>
        <button id="sidebarToggleTop" class="menu-toggle">
            <i class="fa fa-bars"></i>
        </button>
        <ul class="nav-links">
            <li><a href="#">Trang chủ</a></li>
            <li class="nav-item"><a href="#">Sản phẩm</a>
                <div class="dropdown-menu">
                    <a href="#">Áo</a>
                    <a href="#">Quần</a>
                    <a href="#">Phụ kiện</a>
                </div>
            <li><a href="#">Sale OF</a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
        <div class="topbar-icons">
            <a href="#" class="icon"><i class="fas fa-search"></i></a>
            <a href="#" class="icon"><i class="fas fa-bell"></i><span class="badge">3+</span></a>
            <a href="#" class="icon"><i class="fas fa-shopping-cart"></i><span class="badge">7</span></a>
        </div>
        <div class="user-menu">
            <span class="user-name">Mai Sỹ Đạt</span>
            <img class="user-avatar" src="backend/img/user/1742454197_dat.jpg" alt="User Avatar">
            <div class="dropdown-menu">
                <a href="#">Trang cá nhân</a>
                <a href="#">Cài đặt</a>
                <a href="#" class="logout">Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>
@include('Frontend.Layout.banner')
<!-- End of Topbar -->
