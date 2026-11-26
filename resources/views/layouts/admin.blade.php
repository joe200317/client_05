<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Panel') | Mind Training</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-canvas: #f5f8f0;
            --bg-surface: #ffffff;
            --bg-tint: #eef5e7;
            --border-soft: #dce6d2;
            --text-ink: #223627;
            --text-muted: #5d6f5e;
            --brand-primary: #2d7542;
            --brand-deep: #215731;
            --brand-soft: #e3f0e5;
            --danger-bg: #fdf0ee;
            --danger-border: #ecc5be;
            --danger-text: #9e2f24;
            --shadow-card: 0 10px 30px rgba(34, 54, 39, .05);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--text-ink);
            background:
                radial-gradient(circle at 88% 4%, rgba(168, 204, 148, .18), transparent 30%),
                var(--bg-canvas);
        }

        .admin-shell {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 256px;
            flex-shrink: 0;
            background: linear-gradient(180deg, #fbfdf7 0%, #f1f6eb 100%);
            border-right: 1px solid var(--border-soft);
            padding: 22px 16px;
            display: flex;
            flex-direction: column;
            gap: 22px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 4px 8px;
            text-decoration: none;
            color: var(--text-ink);
        }

        .admin-brand__mark {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 15px;
            background: linear-gradient(135deg, var(--brand-deep), var(--brand-primary));
            box-shadow: 0 8px 18px rgba(45, 117, 66, .2);
        }

        .admin-brand__title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.15;
        }

        .admin-brand__sub {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .9px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .nav-group__label {
            padding: 0 10px 8px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .9px;
            text-transform: uppercase;
            color: #728472;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: #354b38;
            font-size: 13.5px;
            font-weight: 500;
            transition: background-color .18s ease, color .18s ease;
        }

        .nav-link:hover {
            background: var(--bg-tint);
            color: var(--brand-deep);
        }

        .nav-link.is-active {
            background: var(--brand-soft);
            color: var(--brand-deep);
            font-weight: 700;
        }

        .nav-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 999px;
            background: var(--brand-primary);
            color: #fff;
        }

        /* Main Area */
        .admin-main-wrap {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-soft);
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .drawer-toggle {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--border-soft);
            background: #fff;
            color: var(--text-ink);
            font-size: 18px;
            cursor: pointer;
        }

        .topbar-admin-chip {
            font-size: 12.5px;
            color: var(--text-muted);
        }

        .topbar-admin-chip strong {
            color: var(--text-ink);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .topbar-link {
            text-decoration: none;
            color: #364d39;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 9px;
        }

        .topbar-link:hover {
            background: var(--bg-tint);
            color: var(--brand-deep);
        }

        .btn-signout {
            border: 1px solid var(--border-soft);
            background: #fff;
            color: var(--text-ink);
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: 999px;
            cursor: pointer;
        }

        .btn-signout:hover {
            background: var(--danger-bg);
            border-color: var(--danger-border);
            color: var(--danger-text);
        }

        .admin-content {
            padding: 28px;
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
        }

        .page-kicker {
            margin: 0 0 6px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--brand-primary);
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .page-title {
            margin: 0 0 6px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 3.6vw, 38px);
            line-height: 1.12;
            color: var(--text-ink);
        }

        .page-subtitle {
            margin: 0;
            font-size: 14px;
            color: var(--text-muted);
        }

        .alert-success {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 14px;
            background: var(--brand-soft);
            border: 1px solid #b8d8be;
            color: var(--brand-deep);
            font-size: 13.5px;
            font-weight: 600;
        }

        .alert-error {
            margin-bottom: 20px;
            padding: 13px 16px;
            border-radius: 14px;
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            font-size: 13.5px;
            font-weight: 600;
        }

        .card {
            background: var(--bg-surface);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 24px;
            box-shadow: var(--shadow-card);
        }

        .btn-primary-green {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 999px;
            border: 0;
            background: linear-gradient(115deg, var(--brand-deep), var(--brand-primary));
            color: #fff;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(45, 117, 66, .2);
        }

        .btn-primary-green:hover { filter: brightness(1.04); }

        .btn-secondary-soft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 15px;
            border-radius: 999px;
            border: 1px solid var(--border-soft);
            background: #fff;
            color: var(--text-ink);
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-secondary-soft:hover { background: var(--bg-tint); }

        .admin-table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .admin-table {
            width: 100%;
            min-width: 720px;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .admin-table th,
        .admin-table td {
            padding: 12px 14px;
            text-align: left;
            vertical-align: top;
            border-bottom: 1px solid #edf2e8;
            font-size: 13.5px;
            word-break: break-word;
        }

        .admin-table th {
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .admin-table .col-actions {
            width: 180px;
            white-space: nowrap;
        }

        .admin-table .row-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .theme-select,
        .field select,
        select.theme-select {
            appearance: none;
            -webkit-appearance: none;
            width: 100%;
            min-height: 46px;
            padding: 11px 44px 11px 14px;
            border-radius: 12px;
            border: 1px solid var(--border-soft);
            background-color: #fff;
            background-image:
                linear-gradient(45deg, transparent 50%, var(--brand-primary) 50%),
                linear-gradient(135deg, var(--brand-primary) 50%, transparent 50%),
                linear-gradient(to right, #e7efe1, #e7efe1);
            background-position:
                calc(100% - 20px) calc(50% - 3px),
                calc(100% - 14px) calc(50% - 3px),
                calc(100% - 42px) 50%;
            background-size: 6px 6px, 6px 6px, 1px 55%;
            background-repeat: no-repeat;
            color: var(--text-ink);
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        .theme-select:hover,
        .field select:hover,
        select.theme-select:hover {
            border-color: #b9d0b2;
            background-color: #fcfdf9;
        }

        .theme-select:focus,
        .field select:focus,
        select.theme-select:focus {
            outline: none;
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(45, 117, 66, .12);
            background-color: #fff;
        }

        .thumbnail-preview {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 10px;
            padding: 12px;
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            background: var(--bg-tint);
        }

        .thumbnail-preview img {
            width: 140px;
            height: 96px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--border-soft);
        }

        .thumbnail-remove {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            color: var(--danger-text);
            font-size: 13px;
            font-weight: 600;
            text-transform: none;
            letter-spacing: 0;
            cursor: pointer;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(20, 34, 24, .45);
            z-index: 35;
        }

        @media (max-width: 900px) {
            .drawer-toggle { display: inline-grid; place-items: center; }

            .admin-sidebar {
                position: fixed;
                left: -272px;
                top: 0;
                height: 100vh;
                transition: left .24s ease;
            }

            body.admin-drawer-open .admin-sidebar { left: 0; }
            body.admin-drawer-open .sidebar-backdrop { display: block; }

            .admin-topbar { padding: 12px 16px; }
            .admin-content { padding: 20px 16px; }
        }
    </style>
    @vite([
        'resources/css/components/theme-dropdown.css',
        'resources/css/components/media-upload.css',
        'resources/js/admin-boot.js',
    ])
    @stack('styles')
</head>
<body>
    @php
        $unreadMessages = \App\Models\ContactMessage::query()->where('is_read', false)->count();
        $newBookings = \App\Models\SessionBooking::query()->where('status', 'new')->count();
    @endphp

    <div class="sidebar-backdrop" id="adminSidebarBackdrop"></div>

    <div class="admin-shell">
        <aside class="admin-sidebar" aria-label="Admin Navigation">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <div class="admin-brand__mark" aria-hidden="true">✦</div>
                <div>
                    <div class="admin-brand__title">Mind Training</div>
                    <div class="admin-brand__sub">Administration</div>
                </div>
            </a>

            <div>
                <div class="nav-group__label">Manage</div>
                <nav class="nav-list">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                        <span>Overview</span>
                    </a>
                    @if (Route::has('admin.programs.index'))
                        <a href="{{ route('admin.programs.index') }}" class="nav-link {{ request()->routeIs('admin.programs.*') ? 'is-active' : '' }}">
                            <span>Programs</span>
                        </a>
                    @endif
                    @if (Route::has('admin.gallery.index'))
                        <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'is-active' : '' }}">
                            <span>Gallery</span>
                        </a>
                    @endif
                    @if (Route::has('admin.testimonials.index'))
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'is-active' : '' }}">
                            <span>Testimonials</span>
                        </a>
                    @endif
                    @if (Route::has('admin.blogs.index'))
                        <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'is-active' : '' }}">
                            <span>Blog</span>
                        </a>
                    @endif
                    @if (Route::has('admin.bookings.index'))
                        <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'is-active' : '' }}">
                            <span>Session bookings</span>
                            @if($newBookings > 0)
                                <span class="nav-badge">{{ $newBookings }}</span>
                            @endif
                        </a>
                    @endif
                    @if (Route::has('admin.messages.index'))
                        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'is-active' : '' }}">
                            <span>Contact messages</span>
                            @if($unreadMessages > 0)
                                <span class="nav-badge">{{ $unreadMessages }}</span>
                            @endif
                        </a>
                    @endif
                </nav>
            </div>

            <div>
                <div class="nav-group__label">Administration</div>
                <nav class="nav-list">
                    <a href="{{ route('admin.admins.create') }}" class="nav-link {{ request()->routeIs('admin.admins.*') ? 'is-active' : '' }}">
                        <span>Create admin</span>
                    </a>
                    <a href="{{ route('admin.account.edit') }}" class="nav-link {{ request()->routeIs('admin.account.*') ? 'is-active' : '' }}">
                        <span>Change Password</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="admin-main-wrap">
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button type="button" class="drawer-toggle" id="adminDrawerToggle" aria-label="Toggle menu">☰</button>
                    <div class="topbar-admin-chip">
                        Signed in as <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    </div>
                </div>

                <div class="topbar-actions">
                    <a href="{{ route('admin.account.edit') }}" class="topbar-link">Account settings</a>
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="topbar-link">View website ↗</a>
                    <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-signout">Sign out</button>
                    </form>
                </div>
            </header>

            <main class="admin-content">
                @if(session('status'))
                    <div class="alert-success" role="status">{{ session('status') }}</div>
                @endif

                @if($errors->any() && !request()->routeIs('admin.login'))
                    <div class="alert-error" role="alert">{{ $errors->first() }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('adminDrawerToggle');
            const backdrop = document.getElementById('adminSidebarBackdrop');
            const closeDrawer = () => document.body.classList.remove('admin-drawer-open');

            toggle?.addEventListener('click', () => {
                document.body.classList.toggle('admin-drawer-open');
            });
            backdrop?.addEventListener('click', closeDrawer);
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeDrawer();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>