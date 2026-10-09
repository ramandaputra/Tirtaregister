@extends('layouts.admin')

@section('title', 'Prioritas Pelanggan (Fasilitas Umum)')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Banner -->
    <div class="bg-red-600 text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-[28px]">assignment_late</span>
                Prioritas (Fasilitas Umum)
            </h1>
            <p class="text-white/80 text-sm mt-1">Daftar pendaftaran pelanggan khusus untuk sambungan Fasilitas Umum.</p>
        </div>
        
        <div class="flex items-center gap-3 shrink-0">
            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.pelanggan.prioritas') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No. Reg..." class="w-full md:w-64 px-4 py-2 border-0 rounded-l-xl text-sm focus:outline-none focus:ring-2 focus:ring-white/50 text-gray-900 bg-white shadow-inner">
                <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-r-xl text-sm font-semibold transition backdrop-blur-sm border-l border-white/20">Cari</button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden border-t-4 border-t-red-600">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="p-4 font-semibold border-b border-surface-border">No. Registrasi</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Tanggal</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Nama Lengkap</th>
                        <th class="p-4 font-semibold border-b border-surface-border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($pelanggan as $req)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm font-medium">{{ $req->nomorreg }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($req->tgldaftar)->format('d/m/Y') }}</td>
                        <td class="p-4 text-sm">{{ $req->nama }}</td>
                        <td class="p-4 text-sm text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.pelanggan.show', $req->nomorreg) }}" class="text-primary font-semibold bg-primary/10 px-3 py-1.5 rounded-lg transition hover:bg-primary hover:text-white flex items-center" title="Detail">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.pelanggan.edit', $req->nomorreg) }}" class="text-amber-600 font-semibold bg-amber-100 px-3 py-1.5 rounded-lg transition hover:bg-amber-500 hover:text-white flex items-center" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.pelanggan.destroy', $req->nomorreg) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pelanggan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 font-semibold bg-red-100 px-3 py-1.5 rounded-lg transition hover:bg-red-600 hover:text-white flex items-center" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Tidak ada pendaftaran fasilitas umum saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-surface-border bg-gray-50">
            <div class="[&>nav]:flex [&>nav]:items-center [&>nav]:justify-between [&>nav]:gap-4">
                {{ $pelanggan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
