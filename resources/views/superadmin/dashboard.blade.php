@extends('layouts.admin')

@section('content')
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

                <!-- Stat Cards Grid (Pelanggan) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Pendaftaran</p>
                            <h3 class="text-3xl font-bold text-on-surface">{{ $totalPendaftaran ?? 0 }}</h3>
                            <a href="{{ route('admin.pelanggan.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Lihat Daftar Pelanggan →</a>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[28px]">receipt_long</span>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pelanggan (Pribadi)</p>
                            <h3 class="text-3xl font-bold text-on-surface">{{ $totalPribadi ?? 0 }}</h3>
                            <a href="{{ route('admin.pelanggan.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Lihat Pelanggan →</a>
                        </div>
                        <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-status-success">
                            <span class="material-symbols-outlined text-[28px]">person</span>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Prioritas (Fasum)</p>
                            <h3 class="text-3xl font-bold text-on-surface">{{ $totalFasilitasUmum ?? 0 }}</h3>
                            <a href="{{ route('admin.pelanggan.prioritas') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Lihat Prioritas →</a>
                        </div>
                        <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-600">
                            <span class="material-symbols-outlined text-[28px]">assignment_late</span>
                        </div>
                    </div>
                </div>

                <!-- Pendaftaran Terbaru -->
                <div class="bg-white rounded-2xl border border-surface-border shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-surface-border flex items-center justify-between">
                        <h3 class="font-bold text-lg text-on-surface">Pendaftaran Pelanggan Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-center text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-surface-border">
                                <tr>
                                    <th class="px-6 py-4">No. Registrasi</th>
                                    <th class="px-6 py-4">Nama Pendaftar</th>
                                    <th class="px-6 py-4">Tipe</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-border">
                                @forelse($recentPendaftaran ?? [] as $req)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-semibold text-primary">
                                            {{ $req->nomorreg ?? '-' }}
                                        </td>
                                        <td class="px-6 py-3 font-medium text-gray-900">
                                            {{ $req->nama }}
                                        </td>
                                        <td class="px-6 py-3">
                                            @if($req->tipe == 'MBR')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800">MBR</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800">{{ $req->tipe ?? 'REGULER' }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3">
                                            @if($req->flagpasang == 1)
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-green-100 text-green-800">Terpasang</span>
                                            @elseif($req->flagproblem == 1)
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-red-100 text-red-800">Bermasalah</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-yellow-100 text-yellow-800">Proses</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3 flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.pelanggan.show', $req->nomorreg) }}" class="p-1.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Lihat Detail">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </a>
                                            <a href="{{ route('admin.requests.edit', $req->nomorreg) }}" class="p-1.5 text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors" title="Edit">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </a>
                                            <form action="{{ route('admin.requests.destroy', $req->nomorreg) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors" title="Hapus">
                                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            Belum ada data pendaftaran terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-surface-border text-center bg-gray-50/50">
                        <a href="{{ route('admin.pelanggan.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-surface-border rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-primary transition shadow-sm gap-2 w-full md:w-auto">
                            <span>Lihat Lebih Banyak</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Log Aktivitas Terbaru -->
                <div class="bg-white rounded-2xl border border-surface-border shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-surface-border flex items-center justify-between">
                        <h3 class="font-bold text-lg text-on-surface">Log Aktivitas Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-center text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-surface-border">
                                <tr>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4">Waktu</th>
                                    <th class="px-6 py-4">Pengguna</th>
                                    <th class="px-6 py-4">Aksi</th>
                                    <th class="px-6 py-4 w-full">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-border">
                                @forelse($latestLogs ?? [] as $log)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 text-gray-500 text-xs">
                                            {{ $log->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-3 text-gray-500 text-xs font-medium">
                                            {{ $log->created_at->format('H:i') }} WIB
                                        </td>
                                        <td class="px-6 py-3 font-medium text-gray-900">
                                            {{ $log->user ? $log->user->name : 'Sistem / Guest' }}
                                        </td>
                                        <td class="px-6 py-3">
                                            @if($log->action == 'Login')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-blue-100 text-blue-800">{{ $log->action }}</span>
                                            @elseif($log->action == 'Create')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-green-100 text-green-800">{{ $log->action }}</span>
                                            @elseif($log->action == 'Update')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-yellow-100 text-yellow-800">{{ $log->action }}</span>
                                            @elseif($log->action == 'Delete')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-red-100 text-red-800">{{ $log->action }}</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold bg-gray-100 text-gray-800">{{ $log->action }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3 text-gray-600 truncate max-w-sm">
                                            {{ $log->description }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            Belum ada log aktivitas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t border-surface-border text-center bg-gray-50/50">
                        <a href="{{ route('superadmin.logs.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-surface-border rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-primary transition shadow-sm gap-2 w-full md:w-auto">
                            <span>Lihat Lebih Banyak</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>
@endsection
