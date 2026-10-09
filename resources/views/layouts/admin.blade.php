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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <span class="text-[11px] text-gray-500 font-semibold tracking-wide truncate">Panel Admin</span>
                    </div>
                </div>

                <!-- Menu Navigasi Sidebar -->
                <nav class="p-4 space-y-1 flex-1">
                    <div class="px-3 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        Navigasi Utama
                    </div>

                    <!-- Item Dashboard -->
                    @php 
                        $isSuper = auth()->user()->hasRole('superadmin');
                        $dashboardRoute = $isSuper ? route('superadmin.dashboard') : route('admin.pelanggan.dashboard');
                        $dashboardActive = $isSuper ? request()->routeIs('superadmin.dashboard') : request()->routeIs('admin.pelanggan.dashboard');
                    @endphp
                    <a href="{{ $dashboardRoute }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ $dashboardActive ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">dashboard</span>
                        <span class="truncate">Dashboard Utama</span>
                    </a>

                    <!-- Menus for Pelayanan (admin & superadmin) -->
                    @hasanyrole('superadmin|admin')
                    <!-- Item Daftar Pelanggan -->
                    <a href="{{ route('admin.pelanggan.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('admin.pelanggan.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">groups</span>
                        <span class="truncate">Pelanggan Reguler</span>
                    </a>

                    <!-- Item Prioritas -->
                    <a href="{{ route('admin.pelanggan.prioritas') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('admin.pelanggan.prioritas') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">assignment_late</span>
                        <span class="truncate">Pelanggan Prioritas</span>
                    </a>
                    @endhasanyrole

                    @role('superadmin')
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
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.admins.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">manage_accounts</span>
                        <span class="truncate">Kelola Admin</span>
                    </a>

                    <a href="{{ route('superadmin.logs.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.logs.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">history</span>
                        <span class="truncate">Log Aktivitas</span>
                    </a>
                    @endrole
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
            @yield('content')
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