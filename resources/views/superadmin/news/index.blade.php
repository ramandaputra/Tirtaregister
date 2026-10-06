<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Super Admin Tirta Kepri</title>
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
    <div class="flex h-screen overflow-hidden">
        
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
        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto">
                
<!-- Header Banner persis sesuai gambar -->
<div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold tracking-tight">Manajemen Berita & Pengumuman</h1>
        <p class="text-white/80 text-sm mt-1">Tambah, edit, atau hapus artikel berita publik PERUMDA Air Minum Tirta Kepri.</p>
    </div>
    
    <div class="flex items-center gap-3 shrink-0">
        <a href="{{ route('superadmin.settings.index') }}" 
           class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">settings</span>
            <span>Pengaturan Website</span>
        </a>

        <a href="{{ route('superadmin.news.create') }}" 
           class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Tambah Berita Baru</span>
        </a>
    </div>
</div>
                @if(session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span> {{ session('success') }}
                    </div>
                @endif

                <!-- Table -->
                <div class="bg-white rounded-xl shadow-sm border border-surface-border overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b text-xs font-bold uppercase text-gray-600">
                                <th class="p-4">Gambar</th>
                                <th class="p-4">Judul Berita</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y text-sm">
                            @forelse($news as $item)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="p-4 w-20">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 rounded object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                                <span class="material-symbols-outlined">image</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 font-semibold text-gray-900 max-w-xs truncate">{{ $item->title }}</td>
                                    <td class="p-4"><span class="px-2 py-1 bg-blue-50 text-primary text-xs font-semibold rounded">{{ $item->category }}</span></td>
                                    <td class="p-4">
                                        @if($item->is_published)
                                            <span class="text-green-600 font-semibold text-xs">Published</span>
                                        @else
                                            <span class="text-gray-400 font-semibold text-xs">Draft</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('superadmin.news.edit', $item->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition" title="Edit">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </a>
                                            <form action="{{ route('superadmin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition" title="Hapus">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">Belum ada berita yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $news->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>