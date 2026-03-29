<!DOCTYPE html>
<html lang="vi">

<head>
    <title>@yield('tieudetrang')</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --primary-yellow: #fed100;
            --light-yellow: #fff9c4;
            --white: #FFFFFF;
            --dark-grey: #333333;
        }

        body {
            background-color: #f4f4f4;
            color: var(--dark-grey);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container-wrapper {
            flex: 1 0 auto;
        }

        .container {
            max-width: 1400px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
            background: var(--white);
            margin-bottom: 0 !important;
        }

        /* Top Banner */
        .top-banner {
            background: linear-gradient(to right, #ffd700, #ffcc00);
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            color: #d0021b;
        }

        .top-banner .badge-promo {
            background-color: #fff;
            padding: 2px 10px;
            border-radius: 20px;
            margin-left: 10px;
            border: 1px solid #d0021b;
        }

        /* Main Header */
        header {
            background-color: var(--primary-yellow);
            padding: 10px 0;
            border-bottom: none;
            height: auto;
            position: relative;
            z-index: 1001;
        }

        .header-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 0 15px;
        }

        .logo-text {
            font-weight: 900;
            font-size: 24px;
            color: #000;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logo-text .icon-logo {
            background-color: #000;
            color: var(--primary-yellow);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .search-box {
            position: relative;
            flex: 0 1 400px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border-radius: 25px;
            border: none;
            font-size: 14px;
        }

        .search-box .bi-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 13px;
        }

        .header-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            white-space: nowrap;
        }

        .header-item:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #000;
        }

        /* Navigation */
        .main-nav {
            background-color: var(--primary-yellow);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-wrapper {
            display: flex;
            justify-content: center;
            padding: 5px 0;
        }

        main {
            display: flex;
            min-height: 600px;
            padding: 20px 0;
        }

        article {
            padding-right: 30px;
        }

        aside {
            border-left: 1px solid #eee;
            padding-left: 20px;
        }

        .sidebar-box {
            background-color: var(--light-yellow);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-yellow);
        }

        .sidebar-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        footer {
            flex-shrink: 0;
            height: 100px;
            background-color: #2c3e50;
            color: var(--white);
        }

        .btn-yellow {
            background-color: var(--primary-yellow);
            color: #333;
            border: none;
        }

        .btn-yellow:hover {
            background-color: #E6B800;
        }

        .user-dropdown:hover .dropdown-menu {
            display: block;
            min-width: 150px;
        }

        .dropdown-item {
            color: #333 !important;
            padding: 10px 15px !important;
        }

        /* Custom Pagination Styling */
        .pagination {
            gap: 5px;
        }

        .page-item .page-link {
            color: #333;
            border: 1px solid #ddd;
            padding: 8px 16px;
            border-radius: 4px !important;
        }

        .page-item.active .page-link {
            background-color: var(--primary-yellow) !important;
            border-color: var(--primary-yellow) !important;
            color: #000 !important;
            font-weight: bold;
        }

        .page-link:hover {
            background-color: var(--light-yellow);
            color: #000;
        }

        .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #ccc;
        }
    </style>
</head>

<body>
    <div class="top-banner">
        <span>Blog cá nhân</span>
    </div>
    <div class="container p-0 shadow-none container-wrapper">
        <header>
            <div class="header-main">
                <a href="/" class="logo-text">
                    <div class="icon-logo"><i class="bi bi-person-walking"></i></div>
                    <span>PHP3</span>
                </a>
                <div class="search-box">
                    <form action="/tim-kiem" method="GET">
                        <input type="text" name="keyword" placeholder="Mở bán Galaxy A57- A37 5G">
                        <i class="bi bi-search"></i>
                    </form>
                </div>
                <div class="header-actions">
                    @if(Session::has('user'))
                    <div class="dropdown user-dropdown">
                        <a href="#" class="header-item dropdown-toggle">
                            <i class="bi bi-person"></i>
                            <span>{{ Session::get('user.hoTen') }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-0">
                            <li><a class="dropdown-item" href="/dang-xuat"><i
                                        class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </div>
                    @else
                    <a href="/dang-nhap" class="header-item">
                        <i class="bi bi-person"></i>
                        <span>Đăng nhập</span>
                    </a>
                    @endif
                    <a href="#" class="header-item">
                        <i class="bi bi-cart2"></i>
                        <span>Giỏ hàng</span>
                    </a>
                </div>
            </div>
        </header>
        <nav class="main-nav">
            @include('menu')
        </nav>
        <main class="row m-0">
            <article class="col-md-9 bg-white" id="main-content">
                @yield('noidung')
            </article>
            <aside class="col-md-3 bg-white">
                <!-- <div class="sidebar-box">
                    <div class="sidebar-title">Danh mục tin</div>
                    @php
                    $loaitin = DB::table('loaitin')->where('AnHien', 1)->get();
                    @endphp
                    <ul class="list-unstyled mb-0">
                        @foreach($loaitin as $lt)
                        <li class="mb-2">
                            <a href="/cat/{{ $lt->id }}" class="text-decoration-none text-dark hover-yellow">
                                <i class="bi bi-chevron-right small text-muted me-1"></i> {{ $lt->ten }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div> -->

                <div class="sidebar-box" style="background-color: #f8f9fa; border-left-color: #6c757d;">
                    <div class="sidebar-title" style="color: #495057;">Tin xem nhiều</div>
                    @php
                    $tinXN = DB::table('tin')->orderBy('xem', 'desc')->limit(5)->get();
                    @endphp
                    <ul class="list-unstyled mb-0 small">
                        @foreach($tinXN as $t)
                        <li class="mb-3 pb-2 border-bottom">
                            <a href="/tin/{{ $t->id }}" class="text-decoration-none text-dark fw-normal">
                                {{ Str::limit($t->tieuDe, 60) }}
                            </a>
                            <div class="text-muted mt-1">{{ $t->xem }} lượt xem</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </main>
        <footer class="d-flex align-items-center justify-content-center flex-column">
            <p class="mb-1">© 2026 Bản quyền thuộc về Dương Thành Công</p>
            <p class="small text-white-50">Lavarel PHP3</p>
        </footer>
    </div>
    <script>
        $(document).ready(function() {
            // Xử lý click vào các liên kết có class "ajax-link" hoặc các thẻ a trong main-content, menu, sidebar
            $(document).on('click', 'a.ajax-link, .navbar-nav a, .sidebar-box a, #main-content a', function(e) {
                var url = $(this).attr('href');

                // Bỏ qua nếu là link trống, link javascript hoặc link tuyệt đối bên ngoài
                if (!url || url === '#' || url.startsWith('javascript:') || url.startsWith('http')) {
                    return;
                }

                e.preventDefault();

                // Hiệu ứng loading đơn giản
                $('#main-content').css('opacity', '0.5');

                // Gọi AJAX lấy nội dung
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Lấy phần nội dung bên trong #main-content từ response
                        // Nếu response là toàn bộ trang, ta chỉ trích xuất phần #main-content
                        var newContent = $(response).find('#main-content').html();

                        // Nếu không tìm thấy #main-content (có thể response chỉ là phần nội dung lẻ)
                        if (!newContent) {
                            newContent = response;
                        }

                        $('#main-content').html(newContent);
                        $('#main-content').css('opacity', '1');

                        // Cập nhật URL trên trình duyệt mà không load lại trang
                        window.history.pushState({
                            path: url
                        }, '', url);

                        // Cuộn lên đầu phần nội dung
                        $('html, body').animate({
                            scrollTop: $("nav").offset().top
                        }, 200);
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi tải nội dung.');
                        $('#main-content').css('opacity', '1');
                    }
                });
            });

            // Xử lý nút Back/Forward của trình duyệt
            window.onpopstate = function() {
                location.reload();
            };
        });
    </script>
</body>

</html>