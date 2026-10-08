@extends('layouts.admin')

@section('title', 'Prioritas Pelanggan (Fasilitas Umum)')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 md:gap-0 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-red-600 flex items-center gap-2">
                <span class="material-symbols-outlined text-[28px]">assignment_late</span>
                Prioritas (Fasilitas Umum)
            </h1>
            <p class="text-sm text-gray-600">Daftar pendaftaran pelanggan khusus untuk sambungan Fasilitas Umum.</p>
        </div>
        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.pelanggan.prioritas') }}" class="flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / No. Reg..." class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-l-lg text-sm focus:outline-none focus:ring-1 focus:ring-red-600">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-r-lg text-sm font-semibold hover:bg-red-700">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden border-t-4 border-t-red-600">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="p-4 font-semibold border-b border-surface-border">No. Registrasi</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Tanggal</th>
                        <th class="p-4 font-semibold border-b border-surface-border">Nama Lengkap</th>
                        <th class="p-4 font-semibold border-b border-surface-border text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-border">
                    @forelse($pelanggan as $req)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm font-medium">{{ $req->registration_number }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ $req->created_at->format('d/m/Y') }}</td>
                        <td class="p-4 text-sm">{{ $req->full_name }}</td>
                        <td class="p-4 text-sm text-right">
                            <a href="{{ route('admin.pelanggan.show', $req->id) }}" class="text-red-600 font-semibold hover:underline bg-red-50 px-3 py-1.5 rounded-lg transition hover:bg-red-600 hover:text-white">Detail</a>
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
        
        <div class="p-4 border-t border-surface-border">
            {{ $pelanggan->links() }}
        </div>
    </div>
</div>
@endsection
