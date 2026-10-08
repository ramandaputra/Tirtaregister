@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    
    <!-- Header Page / Banner Utama -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Kelola Admin 👋</h1>
            <p class="text-white/80 text-sm mt-1">Atur hak akses dan kelola akun pengguna admin PERUMDA Air Minum Tirta Kepri.</p>
        </div>
        <a href="{{ route('superadmin.admins.create') }}" 
           class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
            <span class="material-symbols-outlined text-[18px]">person_add</span>
            <span>Buat Akun Admin</span>
        </a>
    </div>

    <!-- Section Ringkasan Stat Tambahan -->
    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Admin</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $admins->count() ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary shrink-0">
                <span class="material-symbols-outlined text-[28px]">group</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Admin Aktif</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $admins->where('status', 'active')->count() ?? $admins->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-status-success shrink-0">
                <span class="material-symbols-outlined text-[28px]">verified_user</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Super Admin</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $admins->where('role', 'superadmin')->count() ?? 1 }}</h3>
            </div>
            <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                <span class="material-symbols-outlined text-[28px]">admin_panel_settings</span>
            </div>
        </div>
    </div> -->

    <!-- Tabel Data Admin -->
    <div class="bg-white rounded-2xl border border-surface-border shadow-sm overflow-hidden">
        <div class="p-5 border-b border-surface-border flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <h3 class="font-bold text-lg text-on-surface">Daftar Akun Admin</h3>
            
            <!-- Filter Search -->
            <div class="relative w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                <input type="text" placeholder="Cari admin..." class="w-full pl-9 pr-3 py-1.5 text-xs border border-surface-border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-surface-border text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="py-3.5 px-6">Nama Admin</th>
                        <th class="py-3.5 px-6">Email</th>
                        <th class="py-3.5 px-6">Peran (Role)</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border text-sm">
                    @forelse($admins as $admin)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="py-4 px-6 font-semibold text-gray-900">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 text-primary font-bold flex items-center justify-center text-xs shrink-0">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </div>
                                    <span>{{ $admin->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-600">{{ $admin->email }}</td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-primary/10 text-primary capitalize">
                                    {{ $admin->role_label }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-status-success">
                                    <span class="w-1.5 h-1.5 rounded-full bg-status-success"></span>
                                    Aktif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('superadmin.admins.edit', $admin->id) }}" class="p-2 text-gray-400 hover:text-primary hover:bg-gray-100 rounded-lg transition" title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-400">Belum ada data admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection