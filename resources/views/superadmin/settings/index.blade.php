<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Website - Super Admin Tirta Kepri</title>

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

    <div class="flex min-h-screen">
        <!-- SIDEBAR NAVIGASI -->
        <aside class="w-64 bg-white border-r border-surface-border flex flex-col justify-between shrink-0 h-screen sticky top-0 select-none">
            <!-- Bagian Atas: Brand & Menu -->
            <div class="flex flex-col h-full overflow-y-auto">
                
                <!-- Header Brand -->
                <div class="p-5 border-b border-surface-border flex items-center gap-3 shrink-0">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined text-[24px]">water_drop</span>
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
<main class="flex-1 p-8 overflow-y-auto">
    <div class="max-w-[1200px] mx-auto">
        <!-- Header Page (Banner Style) -->
        <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Manajemen Pengaturan Website</h1>
                <p class="text-white/80 text-sm mt-1">Kelola informasi publik pada Navbar, Footer, dan Banner secara terpusat.</p>
            </div>
            
            <a href="/" target="_blank" 
               class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
                <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                <span>Lihat Website Utama</span>
            </a>
        </div>
                <!-- Alert Notification -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-center gap-3">
                        <span class="material-symbols-outlined text-status-success text-[24px]">check_circle</span>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Form Pengaturan -->
                <form action="{{ route('superadmin.settings.update') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- SECTION 1: HEADER & NAVBAR -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">web</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Navbar & Header</h2>
                                <p class="text-xs text-on-surface-variant">Informasi pada bar navigasi atas website</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-on-surface mb-2">Teks Running / Pengumuman Topbar</label>
                                <input type="text" name="navbar_topbar_text" 
                                       value="{{ $settings['navbar_topbar_text'] ?? 'Portal Resmi Layanan Pelanggan PERUMDA Air Minum Tirta Kepri • Pemerintah Provinsi Kepulauan Riau' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Nomor Call Center</label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">call</span>
                                    <input type="text" name="navbar_call_center" 
                                           value="{{ $settings['navbar_call_center'] ?? '(0771) 21555' }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Nomor WA Pengaduan</label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3 text-status-success text-[20px]">chat</span>
                                    <input type="text" name="navbar_wa_center" 
                                           value="{{ $settings['navbar_wa_center'] ?? '0811-778-2155' }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: FOOTER -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">dock</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Footer</h2>
                                <p class="text-xs text-on-surface-variant">Informasi kontak dan deskripsi di bagian bawah website</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Singkat Perusahaan</label>
                                <textarea name="footer_description" rows="3" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['footer_description'] ?? 'Memberikan pelayanan air bersih yang andal, berkualitas, dan berkelanjutan bagi masyarakat Kepulauan Riau.' }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Alamat Kantor</label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">location_on</span>
                                    <input type="text" name="footer_address" 
                                           value="{{ $settings['footer_address'] ?? 'Tanjungpinang, Kepulauan Riau' }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: BANNER BERITA -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">campaign</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Banner Halaman Berita</h2>
                                <p class="text-xs text-on-surface-variant">Teks headline pada halaman Berita & Pengumuman</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Judul Banner Berita</label>
                                <input type="text" name="news_hero_title" 
                                       value="{{ $settings['news_hero_title'] ?? 'Pusat Berita & Pengumuman' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Subtitle Banner</label>
                                <textarea name="news_hero_subtitle" rows="2" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['news_hero_subtitle'] ?? 'Dapatkan kabar terbaru mengenai operasional, perawatan jaringan, hingga informasi pelayanan pelanggan PERUMDA Air Minum Tirta Kepri.' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-semibold shadow hover:bg-primary/90 transition focus:outline-none">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>