@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-primary">Detail Pendaftaran</h1>
            <p class="text-sm text-gray-600">No. Registrasi: {{ $pelanggan->registration_number }}</p>
        </div>
        <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white px-4 py-2 rounded-lg border shadow-sm">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden p-6 mb-6">
        <h2 class="text-lg font-bold text-on-surface mb-4 border-b pb-2">Informasi Pendaftar</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500 font-semibold mb-1">Nama Lengkap</p>
                <p class="text-on-surface font-medium uppercase">{{ $pelanggan->full_name }}</p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">NIK</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->nik }}</p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">No. HP / Telepon</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->phone_number ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Email</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->email ?? '-' }}</p>
            </div>
            <div class="sm:col-span-2 mt-2">
                <p class="text-gray-500 font-semibold mb-1">Alamat Pemasangan</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->installation_address }}, No. {{ $pelanggan->house_number ?? '-' }}, RT/RW: {{ $pelanggan->rt ?? '-' }}/{{ $pelanggan->rw ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden p-6">
        <h2 class="text-lg font-bold text-on-surface mb-4 border-b pb-2">Data Teknis & Properti</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500 font-semibold mb-1">Jenis Sambungan</p>
                @if($pelanggan->connection_type == 'fasilitas_umum')
                    <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-bold">Fasilitas Umum</span>
                @else
                    <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-bold">Pribadi</span>
                @endif
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Tanggal Daftar</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Luas Tanah / Bangunan</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->land_area ?? '0' }} m² / {{ $pelanggan->building_area ?? '0' }} m²</p>
            </div>
            <div>
                <p class="text-gray-500 font-semibold mb-1">Jumlah Penghuni</p>
                <p class="text-on-surface font-medium">{{ $pelanggan->occupants_count ?? '-' }} Orang</p>
            </div>
        </div>
    </div>
</div>
@endsection
