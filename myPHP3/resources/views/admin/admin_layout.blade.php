<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        :root {
            --admin-navy: #001529;
            --admin-accent: #1890ff;
            --admin-bg: #f0f2f5;
            --white: #FFFFFF;
            --border-color: #f0f0f0;
            --transition: all 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
        }

        body {
            background-color: var(--admin-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, 0.85);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Style */
        aside {
            width: 240px;
            background-color: var(--admin-navy);
            color: rgba(255, 255, 255, 0.65);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: var(--transition);
            box-shadow: 2px 0 8px 0 rgba(29, 35, 41, 0.05);
        }

        .sidebar-header {
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            background: #002140;
        }

        .sidebar-logo {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--white);
            text-decoration: none;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 16px 0;
        }

        .nav-group-title {
            padding: 8px 24px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: inherit;
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-item-link:hover {
            color: var(--white);
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-item-link.active {
            color: var(--white);
            background-color: var(--admin-accent);
        }

        .nav-item-link i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Main Content Style */
        article {
            flex: 1;
            margin-left: 240px;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            height: 64px;
            background-color: var(--white);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0, 21, 41, 0.08);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .content-area {
            padding: 24px;
        }

        .admin-card {
            background: var(--white);
            padding: 24px;
            border-radius: 2px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        /* Table & Components */
        .table {
            font-size: 14px;
        }
        
        .table thead th {
            background: #fafafa;
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            padding: 16px;
        }

        .table td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .btn {
            border-radius: 2px;
            font-size: 14px;
            padding: 5px 15px;
        }

        .btn-primary {
            background-color: var(--admin-accent);
            border-color: var(--admin-accent);
        }

        /* Responsive */
        @media (max-width: 992px) {
            aside { margin-left: -240px; }
            article { margin-left: 0; }
            aside.show { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside id="adminSidebar">
            <div class="sidebar-header">
                <a href="/admin/tin" class="sidebar-logo">TECH ADMIN</a>
            </div>
            <div class="sidebar-nav">
                <div class="nav-group-title">Nội dung</div>
                <a href="/admin/loaitin" class="nav-item-link {{ Request::is('admin/loaitin*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Loại tin
                </a>
                <a href="/admin/tin" class="nav-item-link {{ Request::is('admin/tin*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Tin tức
                </a>

                <div class="nav-group-title mt-3">Sản phẩm</div>
                <a href="/admin/loaisp" class="nav-item-link {{ Request::is('admin/loaisp*') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Loại sản phẩm
                </a>
                <a href="/admin/sanpham" class="nav-item-link {{ Request::is('admin/sanpham*') ? 'active' : '' }}">
                    <i class="bi bi-phone"></i> Sản phẩm
                </a>
                <a href="/admin/donhang" class="nav-item-link {{ Request::is('admin/donhang*') ? 'active' : '' }}">
                    <i class="bi bi-cart3"></i> Đơn hàng
                </a>

                <div class="nav-group-title mt-3">Hệ thống</div>
                <a href="/admin/users" class="nav-item-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Thành viên
                </a>
                <a href="/" class="nav-item-link mt-4 text-info">
                    <i class="bi bi-arrow-left-circle"></i> Xem Website
                </a>
            </div>
        </aside>

        <article>
            <div class="top-bar">
                <div class="d-flex align-items-center">
                    <button class="btn d-lg-none me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
                    <h4 class="page-title">@yield('title')</h4>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="small fw-bold">{{ Auth::user()->name }}</span>
                    <a href="/dang-xuat" class="btn btn-sm btn-outline-danger">Đăng xuất</a>
                </div>
            </div>

            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
                @endif
                <div class="admin-card">
                    @yield('content')
                </div>
            </div>
        </article>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar')?.addEventListener('click', () => {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>
</body>
</html>