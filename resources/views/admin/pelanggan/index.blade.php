@extends('layouts.admin')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Daftar Pendaftaran Pelanggan</h1>
            <p class="text-white/80 text-sm mt-1">Semua data pendaftaran pelanggan masuk (Pribadi & Fasilitas Umum).</p>
        </div>
        
        <div class="flex items-center gap-3 shrink-0">
            <!-- Tambah Data -->
            <a href="{{ route('admin.pelanggan.create') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 border border-white/20 backdrop-blur-sm">
                <span class="material-symbols-outlined text-[18px]">add</span>
                <span>Tambah Pelanggan</span>
            </a>
            
            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.pelanggan.index') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No. Reg..." class="w-full md:w-64 px-4 py-2 border-0 rounded-l-xl text-sm focus:outline-none focus:ring-2 focus:ring-white/50 text-gray-900 bg-white shadow-inner">
                <button type="submit" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-r-xl text-sm font-semibold transition backdrop-blur-sm border-l border-white/20">Cari</button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="p-4 font-semibold border-b border-surface-border">No. Registrasi</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Tanggal</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Nama Lengkap</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Jenis</th>
                        <th class="p-4 font-semibold border-b border-surface-border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($pelanggan as $req)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm font-medium">{{ $req->nomorreg }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($req->tgldaftar)->format('d/m/Y') }}</td>
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
                        <td colspan="5" class="p-8 text-center text-gray-500">Tidak ada data pendaftaran ditemukan.</td>
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
