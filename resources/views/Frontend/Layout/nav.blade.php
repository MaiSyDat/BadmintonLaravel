 <div class="header-topbar">
     Badminton is coming back!!!
 </div>

 <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
     <div class="container">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
             <span class="navbar-toggler-icon"></span>
         </button>
         <a class="navbar-brand header-logo" href="{{ route('home.index') }}">
             <img src="backend/img/logo/LogoDSmash.png" alt="Logo">
         </a>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav mx-auto header-menu">
                 <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">Trang chủ</a></li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Sản phẩm</a>
                     <div class="dropdown-menu">
                         @foreach ($categories as $category)
                             <a class="dropdown-item" href="">
                                 {{ $category->name }}
                             </a>
                         @endforeach
                     </div>

                 </li>
                 <li class="nav-item"><a class="nav-link" href="#">Sale OF</a></li>
                 <li class="nav-item"><a class="nav-link" href="#">Giới thiệu</a></li>
                 <li class="nav-item"><a class="nav-link" href="#">Tin tức</a></li>
                 <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
             </ul>
             <div class="header-actions d-flex align-items-center justify-content-between">
                 <div class="search-icon">
                     <i class="bi bi-search" id="openSearch"></i>
                 </div>
                 <!-- Overlay tìm kiếm -->
                 <div class="search-overlay" id="searchOverlay">
                     <div class="search-box d-flex">
                         <input type="text" class="form-control" id="searchInput"
                             placeholder="Nhập từ khóa tìm kiếm...">
                         <button class="btn btn-danger close-search mx-2" id="closeSearch"><i
                                 class="bi bi-x-lg"></i></button>
                     </div>
                     <!-- Gợi ý tìm kiếm -->
                     <ul class="search-suggestions" id="suggestions">
                         <li>Gợi ý 1</li>
                         <li>Gợi ý 2</li>
                         <li>Gợi ý 3</li>
                     </ul>
                 </div>

                 <i class="bi bi-cart3 mr-5"></i>
                 @if (Auth::check())
                     <!-- Người dùng đã đăng nhập -->
                     <div class="dropdown">
                         <a class="btn-login btn btn-light dropdown-toggle d-flex align-items-center" type="button"
                             id="userDropdown" data-toggle="dropdown" aria-expanded="false">
                             <span class="ms-2">{{ Auth::user()->name }}</span>
                         </a>
                         <ul class="dropdown-menu mt-2" aria-labelledby="userDropdown">
                             {{-- <li><a class="dropdown-item" href="{{ route('profile') }}">Quản lý trang cá nhân</a></li>
                             <li><a class="dropdown-item" href="{{ route('settings') }}">Cài đặt</a></li>
                             <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li> --}}
                             <li><a class="dropdown-item" href="">Quản lý trang cá nhân</a></li>

                             @if (Auth::user()->role == 0)
                                 <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Vào trang quản
                                         trị</a></li>
                             @endif
                             <li><a class="dropdown-item" href="">Cài đặt</a></li>
                             <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Đăng xuất</a></li>
                         </ul>
                     </div>
                 @else
                     <!-- Nếu chưa đăng nhập -->
                     <div class="dropdown">
                         <a class="btn-login btn btn-light dropdown-toggle d-flex align-items-center" type="button"
                             id="userDropdown" data-toggle="dropdown" aria-expanded="false">
                             <span class="ms-2">Tài khoản</span>
                         </a>
                         <ul class="dropdown-menu mt-2" aria-labelledby="userDropdown">
                             <li><a class="dropdown-item" href="{{ route('auth.admin') }}">Đăng nhập</a></li>
                             <li><a class="dropdown-item" href="{{ route('auth.register') }}">Đăng ký</a></li>
                         </ul>
                     </div>
                 @endif
             </div>

         </div>
     </div>
 </nav>
 <!-- End of Topbar -->
