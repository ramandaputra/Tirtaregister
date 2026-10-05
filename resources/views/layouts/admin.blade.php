<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Super Admin') - PERUMDA Tirta Kepri</title>

    <!-- Google Material Icons -->
    <link rel="stylesheet" href="[https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200](https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200)" />

    <!-- Tailwind CSS Play CDN -->
    <script src="[https://cdn.tailwindcss.com](https://cdn.tailwindcss.com)"></script>
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
    <aside class="w-64 bg-white border-r border-surface-border flex flex-col justify-between shrink-0 h-screen sticky top-0">
        <div>
            <!-- Header Brand -->
            <div class="p-6 border-b border-surface-border flex items-center gap-3">
                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-[24px]">water_drop</span>
                </div>
                <div>
                    <h2 class="font-bold text-base text-primary uppercase leading-none">Tirta Kepri</h2>
                    <span class="text-[11px] text-gray-500 font-semibold">Panel Super Admin</span>
                </div>
            </div>

            <!-- Menu Navigasi Sidebar -->
            <nav class="p-4 space-y-1">
                <div class="px-3 py-2 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Navigasi Utama</div>

                <a href="{{ route('superadmin.dashboard') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('superadmin.news.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.news.*') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">newspaper</span>
                    <span>Kelola Berita</span>
                </a>

                <a href="{{ route('superadmin.settings.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.settings.*') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">web</span>
                    <span>Edit Beranda & Site</span>
                </a>

                <div class="px-3 py-2 mt-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Manajemen Pengguna</div>

                <a href="{{ route('superadmin.admins.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.admins.index') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
                    <span>Kelola Admin</span>
                </a>

                <a href="{{ route('superadmin.admins.create') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.admins.create') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                    <span>Buat Akun Admin</span>
                </a>
            </nav>
        </div>

        <!-- Profil User & Logout Footer Sidebar -->
        <div class="p-4 border-t border-surface-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 truncate">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'SA', 0, 2)) }}
                    </div>
                    <div class="truncate text-xs">
                        <p class="font-bold truncate text-on-surface">{{ auth()->user()->name ?? 'PUSINPEL' }}</p>
                        <p class="text-gray-500 truncate">{{ auth()->user()->email ?? 'pusinpel@tirtakepri.co.id' }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg transition" title="Keluar">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
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