@extends('layouts.admin')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-0 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-primary">Daftar Pendaftaran Pelanggan</h1>
            <p class="text-sm text-gray-600">Semua data pendaftaran pelanggan masuk (Pribadi & Fasilitas Umum).</p>
        </div>
        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.pelanggan.index') }}" class="flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No. Reg..." class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-l-lg text-sm focus:outline-none focus:ring-1 focus:ring-primary">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r-lg text-sm font-semibold hover:bg-primary/90">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="p-4 font-semibold border-b border-surface-border">No. Registrasi</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Tanggal</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Nama Lengkap</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Jenis</th>
                        <th class="p-4 font-semibold border-b border-surface-border text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($pelanggan as $req)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm font-medium">{{ $req->registration_number }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ $req->created_at->format('d/m/Y') }}</td>
                        <td class="p-4 text-sm">{{ $req->full_name }}</td>
                        <td class="p-4 text-sm">
                            @if($req->connection_type == 'fasilitas_umum')
                                <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-bold">Fasilitas Umum</span>
                            @else
                                <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-bold">Pribadi</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-right">
                            <a href="{{ route('admin.pelanggan.show', $req->id) }}" class="text-primary font-semibold hover:underline bg-primary/10 px-3 py-1.5 rounded-lg transition hover:bg-primary hover:text-white">Detail</a>
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
        
        <div class="p-4 border-t border-surface-border">
            {{ $pelanggan->links() }}
        </div>
    </div>
</div>
@endsection
