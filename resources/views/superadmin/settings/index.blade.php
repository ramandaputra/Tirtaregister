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

    <div class="max-w-[1280px] mx-auto px-6 py-8">
        
        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-primary font-semibold text-sm mb-1">
                    <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                    <span>Panel Super Admin</span>
                </div>
                <h1 class="text-2xl font-bold text-on-surface">Manajemen Pengaturan Website</h1>
                <p class="text-on-surface-variant text-sm mt-1">Kelola informasi publik pada Navbar, Footer, dan Banner secara terpusat.</p>
            </div>
            
            <a href="/" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-surface-border bg-white text-primary text-sm font-semibold hover:bg-surface-container-low transition">
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

</body>
</html>