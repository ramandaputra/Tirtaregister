<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Super Admin') - PERUMDA Tirta Kepri</title>

    <!-- Google Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#006689",
                        "surface-ice": "#F4F8FA",
                        "surface-border": "#D5E2E8",
                        "on-surface": "#081e2a",
                        "on-surface-variant": "#3e484f",
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface-ice text-on-surface antialiased flex min-h-screen">

    <!-- SIDEBAR NAVIGASI -->
<aside style="width: 260px; min-width: 260px; max-width: 260px; flex-shrink: 0; background-color: #ffffff; border-right: 1px solid #D5E2E8; display: flex; flex-direction: column; justify-content: space-between; height: 100vh; user-select: none;">
    
    <!-- Bagian Atas: Brand & Menu -->
    <div style="display: flex; flex-direction: column; height: 100%; overflow-y: auto;">
        
        <!-- Header Brand -->
        <div style="padding: 1.25rem; border-bottom: 1px solid #D5E2E8; display: flex; align-items: center; gap: 0.75rem; flex-shrink: 0;">
            <div style="width: 2.5rem; height: 2.5rem; background-color: rgba(0, 102, 137, 0.1); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #006689; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px;">water_drop</span>
            </div>
            <div style="display: flex; flex-direction: column; min-width: 0;">
                <h2 style="font-weight: 700; font-size: 1rem; color: #006689; text-transform: uppercase; line-height: 1.25; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">TIRTA KEPRI</h2>
                <span style="font-size: 11px; color: #6b7280; font-weight: 600; tracking-wide: 0.025em; margin-top: 2px;">Panel Super Admin</span>
            </div>
        </div>

        <!-- Menu Navigasi Sidebar -->
            <nav style="padding: 1rem; flex: 1 1 0%; display: flex; flex-direction: column; gap: 0.25rem;">
                <div style="padding-left: 0.875rem; padding-right: 0.875rem; padding-bottom: 0.5rem; font-size: 10px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em;">
                    NAVIGASI UTAMA
                </div>

                <!-- Item 1: Dashboard Utama -->
                <a href="{{ route('superadmin.dashboard') }}" 
                class="{{ request()->routeIs('superadmin.dashboard*') ? 'bg-[#006689] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}"
                style="display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.875rem; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; text-decoration: none; transition: all 0.15s ease;">
                    <span class="material-symbols-outlined" style="font-size: 20px; flex-shrink: 0;">dashboard</span>
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Dashboard Utama</span>
                </a>

                <!-- Item 2: Kelola Berita (AKTIFF BILA BUKA PAGE BERITA/CREATE BERITA) -->
                <a href="{{ route('superadmin.news.index') }}" 
                class="{{ request()->routeIs('superadmin.news*') ? 'bg-[#006689] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}"
                style="display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.875rem; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; text-decoration: none; transition: all 0.15s ease;">
                    <span class="material-symbols-outlined" style="font-size: 20px; flex-shrink: 0;">newspaper</span>
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Kelola Berita</span>
                </a>

                <!-- Item 3: Edit Beranda -->
                <a href="{{ route('superadmin.settings.index') }}" 
                class="{{ request()->routeIs('superadmin.settings*') ? 'bg-[#006689] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}"
                style="display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.875rem; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; text-decoration: none; transition: all 0.15s ease;">
                    <span class="material-symbols-outlined" style="font-size: 20px; flex-shrink: 0;">web</span>
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Edit Beranda & Site</span>
                </a>

                <!-- Header Section -->
                <div style="padding-left: 0.875rem; padding-right: 0.875rem; padding-top: 1.25rem; padding-bottom: 0.5rem; font-size: 10px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em;">
                    MANAJEMEN PENGGUNA
                </div>

                <!-- Item 4: Kelola Admin -->
                <a href="{{ route('superadmin.admins.index') }}" 
                class="{{ request()->routeIs('superadmin.admins*') ? 'bg-[#006689] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}"
                style="display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.875rem; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; text-decoration: none; transition: all 0.15s ease;">
                    <span class="material-symbols-outlined" style="font-size: 20px; flex-shrink: 0;">manage_accounts</span>
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Kelola Admin</span>
                </a>
            </nav>
    </div>

    <!-- Profil User & Logout (Bottom Sidebar) -->
    <div style="padding: 1rem; border-top: 1px solid #D5E2E8; background-color: rgba(249, 250, 251, 0.5); flex-shrink: 0;">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;">
            <div style="display: flex; align-items: center; gap: 0.625rem; min-width: 0;">
                <div style="width: 2.25rem; height: 2.25rem; border-radius: 9999px; background-color: #006689; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; flex-shrink: 0;">
                    PU
                </div>
                <div style="display: flex; flex-direction: column; min-width: 0;">
                    <p style="font-weight: 700; font-size: 0.75rem; color: #111827; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">PUSINPEL</p>
                    <p style="font-size: 11px; color: #6b7280; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">pusinpel@tirtakepri.co.id</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0; flex-shrink: 0;">
                @csrf
                <button type="submit" 
                        style="padding: 0.5rem; color: #9ca3af; border-radius: 0.5rem; border: none; background: transparent; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                        onmouseover="this.style.color='#dc2626'; this.style.backgroundColor='#fef2f2';"
                        onmouseout="this.style.color='#9ca3af'; this.style.backgroundColor='transparent';"
                        title="Keluar">
                    <span class="material-symbols-outlined" style="font-size: 20px;">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-grow p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>