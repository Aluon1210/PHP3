<!DOCTYPE html>
<html lang="vi">

<head>
    <title>@yield('tieudetrang')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-navy: #002147;
            --accent-red: #E61E2A;
            --white: #FFFFFF;
            --light-grey: #f4f4f4;
            --text-dark: #1a1a1a;
            --text-muted: #666666;
            --transition: all 0.3s ease;
        }

        body {
            background-color: var(--white);
            color: var(--text-dark);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }

        /* Top Announcement Bar */
        .top-banner {
            background-color: var(--primary-navy);
            color: var(--white);
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            z-index: 1050;
        }

        /* Main Header */
        header {
            background-color: var(--white);
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1040;
            padding: 15px 0;
            transition: var(--transition);
        }

        .header-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .logo-text {
            font-weight: 800;
            font-size: 24px;
            color: var(--primary-navy);
            text-decoration: none;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        /* Navigation Links (Desktop) */
        .nav-links {
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-links li a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            position: relative;
        }

        .nav-links li a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-red);
            transition: var(--transition);
        }

        .nav-links li a:hover {
            color: var(--accent-red);
        }

        .nav-links li a:hover::after {
            width: 100%;
        }

        .nav-links .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-radius: 0;
            padding: 15px;
            margin-top: 15px;
        }

        .nav-links .dropdown-item {
            font-size: 13px;
            font-weight: 500;
            padding: 8px 15px;
            color: var(--text-dark);
        }

        .nav-links .dropdown-item:hover {
            background-color: var(--light-grey);
            color: var(--accent-red);
        }

        /* Header Icons */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            color: var(--text-dark);
            font-size: 20px;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
        }

        .header-icon:hover {
            color: var(--accent-red);
        }

        .badge-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: var(--accent-red);
            color: var(--white);
            font-size: 10px;
            font-weight: 800;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Search Bar */
        .search-container {
            position: relative;
            width: 250px;
        }

        .search-input {
            width: 100%;
            border: 1px solid #ddd;
            padding: 8px 35px 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            transition: var(--transition);
        }

        .search-input:focus {
            border-color: var(--primary-navy);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 33, 71, 0.05);
        }

        .search-icon-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: var(--text-muted);
        }

        /* Content Area */
        main {
            flex: 1;
            padding: 40px 0;
        }

        .container {
            max-width: 1400px;
        }

        /* Pagination Styling */
        .pagination {
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
        }

        .pagination .page-link {
            border: 1px solid #eee;
            color: var(--text-dark);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px !important;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-navy) !important;
            border-color: var(--primary-navy) !important;
            color: var(--white) !important;
        }

        .pagination .page-link:hover {
            background-color: var(--accent-red);
            border-color: var(--accent-red);
            color: var(--white);
        }

        /* Footer */
        footer {
            background-color: var(--white);
            border-top: 1px solid #eee;
            padding: 60px 0 30px;
            margin-top: 80px;
        }

        .footer-title {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 25px;
            color: var(--primary-navy);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 13px;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent-red);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 35px;
            height: 35px;
            background-color: var(--light-grey);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-navy);
            transition: var(--transition);
            text-decoration: none;
        }

        .social-icon:hover {
            background-color: var(--primary-navy);
            color: var(--white);
        }

        /* Utils */
        .btn-navy {
            background-color: var(--primary-navy);
            color: var(--white);
            border-radius: 4px;
            font-weight: 700;
            padding: 10px 25px;
            transition: var(--transition);
            border: none;
        }

        .btn-navy:hover {
            background-color: var(--accent-red);
            color: var(--white);
        }

        /* Sidebar Styling */
        aside {
            background-color: var(--white);
            padding-right: 15px;
            border-right: 1px solid #f0f0f0;
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-title {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--primary-navy);
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        .sidebar-title::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--accent-red);
        }

        .sidebar-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-list li {
            margin-bottom: 10px;
            padding-bottom: 8px;
        }

        .sidebar-list a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 12px;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-list a:hover {
            color: var(--accent-red);
            transform: translateX(3px);
        }

        .news-sidebar-item {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            text-decoration: none;
            align-items: center;
        }

        .news-sidebar-img {
            width: 50px;
            height: 50px;
            background-color: var(--light-grey);
            flex-shrink: 0;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .news-sidebar-img i {
            font-size: 18px;
            color: #ccc;
        }

        .news-sidebar-info h4 {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-sidebar-info span {
            font-size: 10px;
            color: var(--text-muted);
        }

        .sidebar-banner {
            background-color: var(--primary-navy);
            color: var(--white);
            padding: 20px 15px;
            text-align: center;
            border-radius: 4px;
        }

        .sidebar-banner h3 {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .sidebar-banner p {
            font-size: 11px;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .nav-links, .search-container, aside {
                display: none;
            }
            article {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Top Announcement Bar -->
    <div class="top-banner">
        🚀 FREE SHIP CHO ĐƠN HÀNG TỪ 499K • VOUCHER ONLINE GIẢM ĐẾN -150K
    </div>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-main">
                <!-- Mobile Menu Icon (Placeholder) -->
                <button class="btn d-lg-none p-0"><i class="bi bi-list fs-2"></i></button>

                <!-- Logo -->
                <a href="/" class="logo-text">TECH SHOP</a>

                <!-- Desktop Navigation -->
                <ul class="nav-links d-none d-lg-flex">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/dien-thoai">Cửa hàng</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">Danh mục</a>
                        <ul class="dropdown-menu">
                            @php $loaiSP = DB::table('loaisp')->get(); @endphp
                            @foreach($loaiSP as $loai)
                                <li><a class="dropdown-item" href="/loai-sp/{{ $loai->id }}">{{ $loai->tenLoai }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/tin-tuc">Tin tức</a></li>
                    <li><a href="#">Giới thiệu</a></li>
                </ul>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Search Desktop -->
                    <div class="search-container d-none d-lg-block">
                        <form action="/tim-kiem" method="GET">
                            <input type="text" name="keyword" class="search-input" placeholder="Tìm sản phẩm...">
                            <button type="submit" class="search-icon-btn"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                    <!-- User Actions -->
                    @if(Auth::check())
                        <div class="dropdown">
                            <a href="#" class="header-icon dropdown-toggle no-caret" data-bs-toggle="dropdown">
                                <i class="bi bi-person"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                                <li><span class="dropdown-item-text fw-bold text-navy small">Chào, {{ Auth::user()->name }}</span></li>
                                <li><hr class="dropdown-divider"></li>
                                @if(Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item py-2" href="/admin/tin"><i class="bi bi-shield-lock me-2"></i>Quản trị</a></li>
                                @endif
                                <li><a class="dropdown-item py-2" href="/profile"><i class="bi bi-person-gear me-2"></i>Tài khoản</a></li>
                                <li><a class="dropdown-item py-2 text-danger" href="/dang-xuat"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="/dang-nhap" class="header-icon"><i class="bi bi-person"></i></a>
                    @endif

                    <!-- Cart -->
                    @php
                        $cartCount = 0;
                        $cartData = Session::get('cart', []);
                        if (is_array($cartData)) {
                            foreach ($cartData as $item) { $cartCount += (int) ($item['qty'] ?? 0); }
                        }
                    @endphp
                    <a href="/gio-hang" class="header-icon">
                        <i class="bi bi-bag"></i>
                        @if($cartCount > 0)
                            <span class="badge-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar (Aside) -->
                <aside class="col-lg-2">
                    <!-- Categories -->
                    <div class="sidebar-section">
                        <h3 class="sidebar-title">Danh mục</h3>
                        <ul class="sidebar-list">
                            @php $loaiSP_side = DB::table('loaisp')->get(); @endphp
                            @foreach($loaiSP_side as $loai)
                                <li>
                                    <a href="/loai-sp/{{ $loai->id }}">
                                        {{ $loai->tenLoai }}
                                        <i class="bi bi-chevron-right small"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Latest News -->
                    <div class="sidebar-section">
                        <h3 class="sidebar-title">Tin tức mới</h3>
                        @php $tinMoi_side = DB::table('tin')->orderBy('ngayDang', 'desc')->limit(4)->get(); @endphp
                        @foreach($tinMoi_side as $tin)
                            <a href="/tin/{{ $tin->id }}" class="news-sidebar-item">
                                <div class="news-sidebar-img d-flex align-items-center justify-content-center">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                                <div class="news-sidebar-info">
                                    <h4>{{ $tin->tieuDe }}</h4>
                                    <span>{{ date('d/m/Y', strtotime($tin->ngayDang)) }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Banner -->
                    <div class="sidebar-section">
                        <div class="sidebar-banner">
                            <h3 class="text-white">GIẢM ĐẾN 50%</h3>
                            <p class="small mb-3">Dành cho các dòng sản phẩm cũ. Số lượng có hạn!</p>
                            <a href="/dien-thoai" class="btn btn-outline-light btn-sm w-100">XEM NGAY</a>
                        </div>
                    </div>
                </aside>

                <!-- Article (Main Content) -->
                <article class="col-lg-10">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('noidung')
                </article>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <a href="/" class="logo-text mb-4 d-block">TECH SHOP</a>
                    <p class="text-muted small pe-lg-5">Trải nghiệm mua sắm đồ công nghệ hiện đại, chất lượng và tin cậy nhất. Chúng tôi cam kết mang lại giá trị tốt nhất cho bạn.</p>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h5 class="footer-title">Về Chúng Tôi</h5>
                    <ul class="footer-links">
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Hệ thống cửa hàng</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h5 class="footer-title">Chính Sách</h5>
                    <ul class="footer-links">
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Giao hàng & Thanh toán</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-title">Đăng Ký Nhận Tin</h5>
                    <p class="text-muted small mb-3">Nhận ngay thông báo về các sản phẩm mới và khuyến mãi hấp dẫn nhất.</p>
                    <div class="input-group">
                        <input type="email" class="form-control border-end-0" placeholder="Email của bạn..." style="border-radius: 4px 0 0 4px;">
                        <button class="btn btn-navy" type="button" style="border-radius: 0 4px 4px 0;">ĐĂNG KÝ</button>
                    </div>
                </div>
            </div>
            <div class="border-top mt-5 pt-4 text-center">
                <p class="text-muted" style="font-size: 11px;">© 2026 TECH SHOP. All rights reserved. Designed for Elegance.</p>
            </div>
        </div>
    </footer>

    <!-- AJAX content loader (giữ logic cũ) -->
    <script>
        $(document).on('click', 'a.ajax-link, .nav-links a, .footer-links a, #main-content a', function(e) {
            var url = $(this).attr('href');
            if (!url || url === '#' || url.startsWith('javascript:') || url.startsWith('http') || $(this).data('bs-toggle')) return;
            
            e.preventDefault();
            $('#main-content').css('opacity', '0.5');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    var $html = $($.parseHTML(response));
                    var newContent = $html.find('#main-content').html() || $html.filter('#main-content').html();
                    var newTitle = $html.filter('title').text() || $html.find('title').text();
                    
                    if (newContent) {
                        $('#main-content').html(newContent);
                    } else {
                        // Fallback nếu không tìm thấy #main-content
                        window.location.href = url;
                        return;
                    }
                    if (newTitle) document.title = newTitle;
                    
                    $('#main-content').css('opacity', '1');
                    window.history.pushState({path: url}, '', url);
                    $('html, body').animate({ scrollTop: 0 }, 200);
                },
                error: function() {
                    $('#main-content').css('opacity', '1');
                }
            });
        });
        
        window.onpopstate = function(e) {
            if (e.state) location.reload();
        };
    </script>
</body>

</html>