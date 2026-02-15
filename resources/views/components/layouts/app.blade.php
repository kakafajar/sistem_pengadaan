<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengadaan Bulog</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            border-right: 1px solid rgba(0,0,0,0.05);
            box-shadow: 2px 0 10px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #333;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
        }

        .brand-text {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #1a1a1a;
        }

        .brand-text span {
            color: #d97706;
        }

        .sidebar-menu {
            padding: 20px 16px;
            flex-grow: 1;
        }

        .menu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            font-weight: 600;
            margin-bottom: 12px;
            padding-left: 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #4b5563;
            border-radius: 8px;
            margin-bottom: 4px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background-color: #f3f4f6;
            color: #1f2937;
        }

        .nav-link.active {
            background: linear-gradient(to right, #fff7ed, #fff);
            color: #d97706;
            border-left: 3px solid #d97706;
            border-radius: 4px 8px 8px 4px;
        }

        .nav-link i {
            font-size: 1.25rem;
            margin-right: 12px;
            width: 24px; /* Fixed width for alignment */
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(0,0,0,0.05);
            font-size: 0.8rem;
            color: #9ca3af;
            text-align: center;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        /* Card Styling for Content */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            background: white;
            margin-bottom: 24px;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 20px 24px;
            border-radius: 12px 12px 0 0 !important;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="brand-logo">
                <div class="logo-icon">B</div>
                <div class="brand-text">SP <span class="text-warning">Bulog</span></div>
            </a>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-label">Menu Utama</div>
            
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Input Penawaran</span>
            </a>
            
            <a href="/spp" class="nav-link {{ request()->routeIs('spp.*') ? 'active' : '' }}">
                <i class="bi bi-inboxes"></i>
                <span>Data SPP & PO</span>
            </a>
        </div>

        <div class="sidebar-footer">
            &copy; 2026 Kerja Praktik Bulog
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Mobile Toggle Button (Optional logic needed for JS, kept simple for now) -->
        <div class="d-md-none mb-4">
             <button class="btn btn-light shadow-sm" onclick="document.querySelector('.sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i> Menu
            </button>
        </div>

        {{ $slot }}
    </main>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>