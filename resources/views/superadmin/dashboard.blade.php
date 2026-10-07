<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama - Super Admin Tirta Kepri</title>

    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Script & Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#006689",
                        "civic-amber": "#FFC10D",
                        "surface-ice": "#F4F8FA",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eaf5ff",
                        "on-surface": "#081e2a",
                        "on-surface-variant": "#3e484f",
                        "primary-container": "#00a4db",
                        "on-primary-container": "#00354a",
                        "on-primary": "#ffffff",
                        "status-success": "#0F9D58",
                        "surface-border": "#D5E2E8",
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-surface-ice text-on-surface antialiased min-h-screen">

    <!-- Mobile Top Bar -->
    <div class="lg:hidden flex items-center justify-between p-4 bg-white border-b border-surface-border sticky top-0 z-40">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                <img src="{{ asset('img/icon.jpg') }}" alt="Logo" class="w-5 h-5 object-contain rounded">
            </div>
            <h2 class="font-bold text-sm text-primary uppercase leading-tight truncate">Tirta Kepri</h2>
        </div>
        <button id="mobile-sidebar-toggle" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <!-- Overlay -->
    <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity"></div>

    <div class="flex min-h-screen relative">
        <!-- SIDEBAR NAVIGASI -->
        <aside id="sidebar" class="w-64 bg-white border-r border-surface-border flex flex-col justify-between shrink-0 h-screen fixed lg:sticky top-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 select-none">
            <!-- Bagian Atas: Brand & Menu -->
            <div class="flex flex-col h-full overflow-y-auto">
                
                <!-- Header Brand -->
                <div class="p-5 border-b border-surface-border flex items-center gap-3 shrink-0">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary shrink-0">
                        <img src="{{ asset('img/icon.jpg') }}" alt="Logo" class="w-6 h-6 object-contain rounded">
                    </div>
                    <div class="flex flex-col min-w-0">
                        <h2 class="font-bold text-base text-primary uppercase leading-tight truncate">Tirta Kepri</h2>
                        <span class="text-[11px] text-gray-500 font-semibold tracking-wide truncate">Panel Super Admin</span>
                    </div>
                </div>

                <!-- Menu Navigasi Sidebar -->
                <nav class="p-4 space-y-1 flex-1">
                    <div class="px-3 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        Navigasi Utama
                    </div>

                    <!-- Item Dashboard -->
                    <a href="{{ route('superadmin.dashboard') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">dashboard</span>
                        <span class="truncate">Dashboard Utama</span>
                    </a>

                    <!-- Item Kelola Berita -->
                    <a href="{{ route('superadmin.news.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.news.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">newspaper</span>
                        <span class="truncate">Kelola Berita</span>
                    </a>

                    <!-- Item Edit Beranda -->
                    <a href="{{ route('superadmin.settings.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.settings.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">web</span>
                        <span class="truncate">Edit Beranda & Site</span>
                    </a>

                    <!-- Header Section Manajemen Pengguna -->
                    <div class="px-3 pt-5 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        Manajemen Pengguna
                    </div>

                    <!-- Item Kelola Admin -->
                    <a href="{{ route('superadmin.admins.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.admins.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">manage_accounts</span>
                        <span class="truncate">Kelola Admin</span>
                    </a>

                    <!-- Item Buat Akun Admin -->
                    <!-- <a href="{{ route('superadmin.admins.create') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.admins.create') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">person_add</span>
                        <span class="truncate">Buat Akun Admin</span>
                    </a> -->
                </nav>
            </div>

            <!-- Profil User & Logout (Footer Sidebar) -->
            <div class="p-4 border-t border-surface-border bg-gray-50/50 shrink-0">
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name ?? 'SA', 0, 2)) }}
                        </div>
                        <div class="flex flex-col min-w-0">
                            <p class="font-semibold text-xs text-gray-900 truncate leading-tight">
                                {{ auth()->user()->name ?? 'PUSINPEL' }}
                            </p>
                            <p class="text-[11px] text-gray-500 truncate leading-tight">
                                {{ auth()->user()->email ?? 'pusinpel@tirtakepri.co.id' }}
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                        @csrf
                        <button type="submit" 
                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors flex items-center justify-center" 
                                title="Keluar">
                            <span class="material-symbols-outlined text-[20px]">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 p-4 lg:p-8 overflow-y-auto w-full max-w-full">
            <div class="max-w-6xl mx-auto space-y-6 lg:space-y-8">
                
                <!-- Welcome Banner -->
                <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-bold">Selamat Datang, {{ auth()->user()->name ?? 'Super Admin' }}! 👋</h1>
                        <p class="text-white/80 text-sm mt-1">Kelola informasi publik, berita, dan hak akses admin PERUMDA Air Minum Tirta Kepri dari panel ini.</p>
                    </div>
                    <a href="/" target="_blank" class="w-full md:w-auto px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shrink-0">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        <span>Lihat Website Publik</span>
                    </a>
                </div>

                <!-- Stat Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Berita</p>
                            <h3 class="text-3xl font-bold text-on-surface">{{ $totalNews ?? 0 }}</h3>
                            <a href="{{ route('superadmin.news.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Kelola Berita →</a>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[28px]">newspaper</span>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Akun Admin</p>
                            <h3 class="text-3xl font-bold text-on-surface">{{ $totalAdmins ?? 0 }}</h3>
                            <a href="{{ route('superadmin.admins.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Kelola Akun →</a>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[28px]">manage_accounts</span>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pengaturan Website</p>
                            <h3 class="text-3xl font-bold text-on-surface">{{ $totalSettings ?? 0 }} <span class="text-xs font-normal text-gray-500">Key</span></h3>
                            <a href="{{ route('superadmin.settings.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Edit Beranda & Site →</a>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[28px]">web</span>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-sidebar-overlay');
        const toggleBtn = document.getElementById('mobile-sidebar-toggle');

        function toggleSidebar() {
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        toggleBtn?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>