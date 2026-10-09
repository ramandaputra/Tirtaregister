@extends('layouts.admin')

@section('title', 'Dashboard Pelayanan')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 lg:space-y-8">
    
    <!-- Welcome Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl lg:text-2xl font-bold">Selamat Datang, {{ auth()->user()->name ?? 'Admin Pelayanan' }}! 👋</h1>
            <p class="text-white/80 text-sm mt-1">Pantau statistik dan kelola data pendaftaran pelanggan PERUMDA Tirta Kepri dari panel ini.</p>
        </div>
        <a href="{{ route('admin.pelanggan.index') }}" class="w-full md:w-auto px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shrink-0">
            <span class="material-symbols-outlined text-[18px]">groups</span>
            <span>Lihat Semua Pendaftar</span>
        </a>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Pendaftaran</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $totalPendaftaran }}</h3>
                <a href="{{ route('admin.pelanggan.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Semua Data →</a>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[28px]">description</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Sambungan Pribadi</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $totalPribadi }}</h3>
                <a href="{{ route('admin.pelanggan.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Lihat Detail →</a>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                <span class="material-symbols-outlined text-[28px]">home</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between border-l-4 border-l-red-500">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pelanggan Prioritas</p>
                <h3 class="text-3xl font-bold text-red-600">{{ $totalFasilitasUmum }}</h3>
                <a href="{{ route('admin.pelanggan.prioritas') }}" class="text-xs text-red-600 font-semibold hover:underline mt-2 inline-block">Tabel Prioritas →</a>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                <span class="material-symbols-outlined text-[28px]">assignment_late</span>
            </div>
        </div>
    </div>

    <!-- Pendaftaran Terbaru -->
    <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
        <div class="p-6 border-b border-surface-border flex justify-between items-center">
            <h2 class="text-lg font-bold text-on-surface">Pendaftaran Terbaru</h2>
            <a href="{{ route('admin.pelanggan.index') }}" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="p-0 overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="p-4 font-semibold border-b border-surface-border">No. Registrasi</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Nama</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Jenis</th>
                        <th class="p-4 font-semibold border-b border-surface-border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($recentRequests as $req)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm font-medium">{{ $req->nomorreg }}</td>
                        <td class="p-4 text-sm">{{ $req->nama }}</td>
                        <td class="p-4 text-sm">
                            @if($req->tipe == 'MBR')
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-bold">MBR</span>
                            @else
                                <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-bold">{{ $req->tipe ?? 'REGULER' }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.pelanggan.show', $req->nomorreg) }}" class="text-primary font-semibold bg-primary/10 px-3 py-1.5 rounded-lg transition hover:bg-primary hover:text-white flex items-center" title="Detail">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.pelanggan.edit', $req->nomorreg) }}" class="text-amber-600 font-semibold bg-amber-100 px-3 py-1.5 rounded-lg transition hover:bg-amber-500 hover:text-white flex items-center" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.pelanggan.destroy', $req->nomorreg) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)" class="text-red-600 font-semibold bg-red-100 px-3 py-1.5 rounded-lg transition hover:bg-red-600 hover:text-white flex items-center" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada pendaftaran terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data pelanggan ini beserta berkasnya akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }
</script>
@endsection
