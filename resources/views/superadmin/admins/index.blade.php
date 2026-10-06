@extends('layouts.admin') {{-- atau layouts.dashboard --}}


@section('content')
<!-- KONTEN UTAMA -->
<main class="flex-1 p-8 overflow-y-auto">
    <div class="max-w-[1200px] mx-auto">
        
        <!-- Header Page (Banner Style) -->
        <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Manajemen Akun Admin</h1>
                <p class="text-white/80 text-sm mt-1">Kelola daftar pengguna, peran (role), dan hak akses sistem PERUMDA Air Minum Tirta Kepri.</p>
            </div>
            
            <a href="{{ route('superadmin.admins.create') }}" 
               class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                <span>Buat Akun Admin</span>
            </a>
        </div>

        <!-- Filter & Pencarian -->
        <div class="bg-white rounded-2xl p-4 border border-surface-border shadow-xs mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-80">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input type="text" placeholder="Cari nama atau email..." 
                       class="w-full pl-10 pr-4 py-2 text-sm border border-surface-border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
        </div>

        <!-- Tabel Daftar Admin -->
        <div class="bg-white rounded-2xl border border-surface-border shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-surface-border text-gray-600 font-semibold">
                        <tr>
                            <th class="py-3.5 px-6">Pengguna</th>
                            <th class="py-3.5 px-6">Peran (Role)</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6">Tanggal Dibuat</th>
                            <th class="py-3.5 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-border text-on-surface">
                        @forelse($admins as $admin)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary/10 text-primary font-bold flex items-center justify-center shrink-0 uppercase">
                                            {{ substr($admin->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-on-surface">{{ $admin->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $admin->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 uppercase">
                                        {{ $admin->role ?? 'Admin' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    @if(($admin->status ?? 'active') == 'active')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-gray-500 text-xs">
                                    {{ $admin->created_at ? $admin->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('superadmin.admins.edit', $admin->id) }}" title="Edit Admin" class="p-1.5 text-gray-500 hover:text-primary hover:bg-gray-100 rounded-lg transition">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>
                                        <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Admin" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500 text-sm">
                                    Belum ada data admin.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@endsection