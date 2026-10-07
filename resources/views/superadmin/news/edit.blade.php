<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Super Admin Tirta Kepri</title>
    
    <!-- Fonts & CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#006689",
                        "surface-ice": "#F4F8FA",
                        "surface-border": "#D5E2E8"
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-surface-ice text-gray-800 antialiased">

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

    <div class="flex h-screen overflow-hidden relative">
        
        <!-- SIDEBAR NAVIGASI -->
        <aside id="sidebar" class="w-64 bg-white border-r border-surface-border flex flex-col justify-between shrink-0 h-screen fixed lg:sticky top-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 select-none">
            <div class="flex flex-col h-full overflow-y-auto">
                <div class="p-5 border-b border-surface-border flex items-center gap-3 shrink-0">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary shrink-0">
                        <img src="{{ asset('img/icon.jpg') }}" alt="Logo" class="w-6 h-6 object-contain rounded">
                    </div>
                    <div class="flex flex-col min-w-0">
                        <h2 class="font-bold text-base text-primary uppercase leading-tight truncate">Tirta Kepri</h2>
                        <span class="text-[11px] text-gray-500 font-semibold tracking-wide truncate">Panel Super Admin</span>
                    </div>
                </div>

                <nav class="p-4 space-y-1 flex-1">
                    <div class="px-3 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        Navigasi Utama
                    </div>

                    <a href="{{ route('superadmin.dashboard') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">dashboard</span>
                        <span class="truncate">Dashboard Utama</span>
                    </a>

                    <a href="{{ route('superadmin.news.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.news.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">newspaper</span>
                        <span class="truncate">Kelola Berita</span>
                    </a>

                    <a href="{{ route('superadmin.settings.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.settings.*') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">web</span>
                        <span class="truncate">Edit Beranda & Site</span>
                    </a>

                    <div class="px-3 pt-5 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                        Manajemen Pengguna
                    </div>

                    <a href="{{ route('superadmin.admins.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('superadmin.admins.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                        <span class="material-symbols-outlined text-[20px] shrink-0">manage_accounts</span>
                        <span class="truncate">Kelola Admin</span>
                    </a>
                </nav>
            </div>

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

        <!-- KONTEN FORM EDIT -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8 w-full max-w-full">
            <div class="max-w-4xl mx-auto">
                
                <!-- Header Banner -->
                <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Edit Artikel Berita</h1>
                        <p class="text-white/80 text-sm mt-1">Perbarui data artikel berita publik PERUMDA Air Minum Tirta Kepri.</p>
                    </div>
                    <a href="{{ route('superadmin.news.index') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 border border-white/20">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span>Kembali</span>
                    </a>
                </div>

                <!-- Form Card Single -->
                <div class="bg-white rounded-2xl shadow-sm border border-surface-border p-6">
                    <form action="{{ route('superadmin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Judul Berita -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
                            <input type="text" name="title" value="{{ old('title', $news->title) }}" required 
                                   class="w-full px-4 py-2.5 rounded-xl border border-surface-border focus:ring-2 focus:ring-primary focus:outline-none text-sm"
                                   placeholder="Masukkan judul berita">
                        </div>

                        <!-- Kategori Berita -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Berita</label>
                            <input type="text" name="category" value="{{ old('category', $news->category) }}" required 
                                   class="w-full px-4 py-2.5 rounded-xl border border-surface-border focus:ring-2 focus:ring-primary focus:outline-none text-sm"
                                   placeholder="Contoh: Pengumuman, Berita Utama, Gangguan Layanan, dll">
                        </div>

                        <!-- Preview & Upload Gambar -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Sampul</label>
                            @if(isset($news->image) && $news->image)
                                <div class="mb-3 flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $news->image) }}" class="w-24 h-24 rounded-xl object-cover border border-surface-border" alt="Preview">
                                    <span class="text-xs text-gray-500">Gambar saat ini. Upload file baru untuk mengganti.</span>
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        </div>

                        <!-- Isi Konten -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
                            <textarea name="content" rows="6" required 
                                      class="w-full px-4 py-2.5 rounded-xl border border-surface-border focus:ring-2 focus:ring-primary focus:outline-none text-sm"
                                      placeholder="Tuliskan isi artikel berita di sini...">{{ old('content', $news->content ?? '') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end gap-3 pt-4 border-t border-surface-border">
                            <a href="{{ route('superadmin.news.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-semibold transition">
                                Batal
                            </a>
                            <button type="submit" class="px-5 py-2.5 bg-primary hover:bg-primary/90 text-white rounded-xl text-sm font-semibold transition shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
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