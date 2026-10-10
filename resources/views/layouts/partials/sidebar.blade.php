@extends('layouts.admin')

@section('title', 'Kelola Admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-primary">Kelola Admin</h1>
            <p class="text-sm text-gray-600">Daftar pengguna dengan akses Admin dan Super Admin.</p>
        </div>
        <a href="{{ route('superadmin.admins.create') }}" class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary/90 flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span> Buat Admin Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 text-sm text-red-800 bg-red-100Berikut adalah panduan lengkap untuk membuat **Layout Dashboard Super Admin dengan Sidebar Navigasi** yang terintegrasi untuk mengelola Berita, Beranda, serta Manajemen Akun Admin.

---

### Step 1: Layout Dashboard Utama dengan Sidebar (`resources/views/layouts/admin.blade.php`)

Buat file layout utama admin agar semua halaman dashboard memiliki sidebar yang konsisten:

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Super Admin') - PERUMDA Tirta Kepri</title>

    <!-- Google Fonts & Material Symbols -->
    <link href="[https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap](https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap)" rel="stylesheet">
    <link href="[https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap](https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap)" rel="stylesheet">

    <!-- Tailwind CSS Script & Config -->
    <script src="[https://cdn.tailwindcss.com](https://cdn.tailwindcss.com)"></script>
    <script id="tailwind-config">
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
        };
    </script>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
</head>
<body class="bg-surface-ice text-on-surface antialiased flex min-h-screen">

    <!-- SIDEBAR NAVIGASI SUPER ADMIN -->
    <aside class="w-64 bg-white border-r border-surface-border flex flex-col justify-between shrink-0 h-screen sticky top-0">
        <div>
            <!-- Brand Logo / Title -->
            <div class="p-6 border-b border-surface-border flex items-center gap-3">
                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                    <img src="{{ asset('img/logo tirta.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                </div>
                <div>
                    <h2 class="font-bold text-base text-primary uppercase leading-none">Tirta Kepri</h2>
                    <span class="text-[11px] text-gray-500 font-semibold">Panel Super Admin</span>
                </div>
            </div>

            <!-- Menu Navigation -->
            <nav class="p-4 space-y-1">
                <div class="px-3 py-2 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Navigasi Utama</div>

                <!-- 1. Edit Berita -->
                <a href="{{ route('superadmin.news.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.news.*') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">newspaper</span>
                    <span>Kelola Berita</span>
                </a>

                <!-- 2. Edit Beranda & Tampilan Website -->
                <a href="{{ route('superadmin.settings.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.settings.*') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">web</span>
                    <span>Edit Beranda & Site</span>
                </a>

                <div class="px-3 py-2 mt-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Manajemen Pengguna</div>

                <!-- 3. Kelola Admin -->
                <a href="{{ route('superadmin.admins.index') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.admins.index') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
                    <span>Kelola Admin</span>
                </a>

                <!-- 4. Buat Akun Admin -->
                <a href="{{ route('superadmin.admins.create') }}" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->routeIs('superadmin.admins.create') ? 'bg-primary text-white' : 'text-on-surface-variant hover:bg-gray-100' }}">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                    <span>Buat Akun Admin</span>
                </a>
            </nav>
        </div>

        <!-- User Profile & Logout Section -->
        <div class="p-4 border-t border-surface-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 truncate">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'SA', 0, 2)) }}
                    </div>
                    <div class="truncate text-xs">
                        <p class="font-bold truncate text-on-surface">{{ auth()->user()->name ?? 'Super Admin' }}</p>
                        <p class="text-gray-500 truncate">{{ auth()->user()->email ?? 'superadmin@tirtakepri.co.id' }}</p>
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

    <!-- CONTENT AREA -->
    <main class="flex-grow p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>

