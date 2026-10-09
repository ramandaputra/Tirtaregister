@extends('layouts.admin')

@section('title', 'Detail Pendaftaran Pelanggan')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <!-- Header Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Detail Pendaftaran</h1>
            <p class="text-white/80 text-sm mt-1">No. Registrasi: <span class="font-semibold">{{ $pelanggan->nomorreg }}</span></p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </a>
            <a href="{{ route('admin.pelanggan.print', $pelanggan->nomorreg) }}" target="_blank" class="px-4 py-2 bg-white text-primary hover:bg-gray-100 rounded-xl text-sm font-bold shadow-sm transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">print</span>
                Cetak Bukti
            </a>
        </div>
    </div>

    @if($pelanggan->flagproblem || $pelanggan->flagpasang)
    <!-- Status Flags -->
    <div class="flex flex-wrap gap-3">
        @if($pelanggan->flagpasang)
            <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-2 rounded-xl flex items-center gap-2 text-sm font-semibold">
                <span class="material-symbols-outlined text-green-600 text-[20px]">check_circle</span>
                Sudah Terpasang
            </div>
        @endif
        @if($pelanggan->flagproblem)
            <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-2 rounded-xl flex items-center gap-2 text-sm font-semibold">
                <span class="material-symbols-outlined text-red-600 text-[20px]">warning</span>
                Ada Masalah / Problem
            </div>
        @endif
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Informasi Umum -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">badge</span>
                <h2 class="text-lg font-bold text-on-surface">Informasi Umum</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div class="sm:col-span-2">
                    <p class="text-gray-500 font-semibold mb-1">Nama Lengkap / Instansi</p>
                    <p class="text-on-surface font-medium uppercase">{{ $pelanggan->nama ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Tipe Sambungan</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->tipe ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Tanggal Daftar</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->tgldaftar ? \Carbon\Carbon::parse($pelanggan->tgldaftar)->format('d/m/Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">No KTP (NIK)</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->no_ktp ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">No KK</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->no_kk ?: '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Kontak & Pekerjaan -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-blue-500">contact_phone</span>
                <h2 class="text-lg font-bold text-on-surface">Kontak & Pekerjaan</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div>
                    <p class="text-gray-500 font-semibold mb-1">No HP</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->hp ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">No Telepon</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->telp ?: '-' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-gray-500 font-semibold mb-1">Email</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->email ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Pekerjaan</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->pekerjaan ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Jumlah Penghuni</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->penghuni ? $pelanggan->penghuni . ' Orang' : '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Alamat Pemasangan -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden md:col-span-2">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-amber-500">home_pin</span>
                <h2 class="text-lg font-bold text-on-surface">Alamat Pemasangan & Wilayah</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-5 gap-x-6 text-sm">
                <div class="sm:col-span-2 lg:col-span-4 border-b pb-4">
                    <p class="text-gray-500 font-semibold mb-1">Alamat Lengkap Pemasangan</p>
                    <p class="text-on-surface font-medium leading-relaxed">
                        {{ $pelanggan->alamat ?: '-' }}<br>
                        @if($pelanggan->gang) Gang {{ $pelanggan->gang }}<br> @endif
                        No. Rumah: {{ $pelanggan->norumah ?: '-' }}, RT/RW: {{ $pelanggan->rt ?: '-' }}/{{ $pelanggan->rw ?: '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Kode / Nama Rayon</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->koderayon ?: '-' }} / {{ $pelanggan->namarayon ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Kelurahan / Banjar</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->kodekelurahan ?: '-' }} / {{ $pelanggan->kodebanjar ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Kode Blok / Zona</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->kodeblok ?: '-' }} / {{ $pelanggan->zona ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Titik Koordinat</p>
                    <p class="text-on-surface font-medium">Lat: {{ $pelanggan->latitude ?: '-' }}<br>Long: {{ $pelanggan->longitude ?: '-' }}</p>
                </div>
                
                @if($pelanggan->nama_pemilik)
                <div class="sm:col-span-2 lg:col-span-4 mt-2 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-gray-500 font-semibold mb-2">Informasi Pemilik Bangunan (Bila Beda)</p>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-400 block text-xs uppercase tracking-wide">Nama Pemilik</span>
                            <span class="font-medium">{{ $pelanggan->nama_pemilik }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs uppercase tracking-wide">Alamat Pemilik</span>
                            <span class="font-medium">{{ $pelanggan->alamat_pemilik ?: '-' }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Data Teknis Properti -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-500">architecture</span>
                <h2 class="text-lg font-bold text-on-surface">Data Teknis Properti</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Jenis Bangunan</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->jenisbangunan ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Peruntukan</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->peruntukan ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Kepemilikan</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->kepemilikan ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Daya Listrik</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->daya_listrik ? $pelanggan->daya_listrik . ' Watt' : '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Luas Tanah</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->luas_tanah ? $pelanggan->luas_tanah . ' m²' : '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Luas Rumah</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->luas_rumah ? $pelanggan->luas_rumah . ' m²' : '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Riwayat Air & Utilitas -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-cyan-500">water_drop</span>
                <h2 class="text-lg font-bold text-on-surface">Informasi Utilitas Air</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Sumber Air Saat Ini</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->airyangdigunakansaatini ?: '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Pernah Jadi Pelanggan?</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->sudahpernahmenjadipelangganpdam ?: '-' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-gray-500 font-semibold mb-1">No. Sambungan Terdahulu</p>
                    <p class="text-on-surface font-medium">{{ $pelanggan->nosambdulu ?: '-' }}</p>
                </div>
                <div class="sm:col-span-2 border-t pt-4 mt-2">
                    <p class="text-gray-500 font-semibold mb-2">Posisi Pipa Persil (Tetangga)</p>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-gray-50 p-2 rounded border"><span class="block text-gray-400">Utara</span><span class="font-bold">{{ $pelanggan->nosamb_utara ?: '-' }}</span></div>
                        <div class="bg-gray-50 p-2 rounded border"><span class="block text-gray-400">Selatan</span><span class="font-bold">{{ $pelanggan->nosamb_selatan ?: '-' }}</span></div>
                        <div class="bg-gray-50 p-2 rounded border"><span class="block text-gray-400">Timur</span><span class="font-bold">{{ $pelanggan->nosamb_timur ?: '-' }}</span></div>
                        <div class="bg-gray-50 p-2 rounded border"><span class="block text-gray-400">Barat</span><span class="font-bold">{{ $pelanggan->nosamb_barat ?: '-' }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        @if($pelanggan->keterangan || $pelanggan->keterangan_problem || $pelanggan->keterangan_pipa)
        <!-- Catatan / Keterangan -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden md:col-span-2">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-purple-500">notes</span>
                <h2 class="text-lg font-bold text-on-surface">Catatan Tambahan</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-y-4 gap-x-6 text-sm">
                @if($pelanggan->keterangan)
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Keterangan Umum</p>
                    <p class="text-on-surface">{{ $pelanggan->keterangan }}</p>
                </div>
                @endif
                @if($pelanggan->keterangan_pipa)
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Keterangan Pipa</p>
                    <p class="text-on-surface">{{ $pelanggan->keterangan_pipa }}</p>
                </div>
                @endif
                @if($pelanggan->keterangan_problem)
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Keterangan Problem</p>
                    <p class="text-red-600 font-medium">{{ $pelanggan->keterangan_problem }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Geolocation & Lampiran File -->
        <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden md:col-span-2">
            <div class="bg-gray-50 border-b border-surface-border px-6 py-4 flex items-center gap-3">
                <span class="material-symbols-outlined text-pink-500">perm_media</span>
                <h2 class="text-lg font-bold text-on-surface">Lampiran Berkas & Lokasi Geolocation</h2>
            </div>
            <div class="p-6">
                <!-- Map -->
                @php
                    $lat = $pelanggan->latitude ?? ($connectionRequest->latitude ?? null);
                    $lng = $pelanggan->longitude ?? ($connectionRequest->longitude ?? null);
                @endphp
                @if($lat && $lng && $lat != '-' && $lng != '-')
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-gray-700 font-semibold">Titik Lokasi (Map)</p>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $lat }},{{ $lng }}" target="_blank" class="text-xs bg-primary/10 text-primary px-3 py-1.5 rounded-lg hover:bg-primary hover:text-white transition font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span> Buka di Google Maps
                        </a>
                    </div>
                    <div class="w-full h-64 bg-gray-200 rounded-xl overflow-hidden border border-gray-300">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            style="border:0" 
                            src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&hl=id&z=16&amp;output=embed" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                @else
                <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100 text-center text-sm text-gray-500">
                    Titik koordinat (Latitude/Longitude) belum tersedia.
                </div>
                @endif

                <!-- Lampiran Foto -->
                <p class="text-gray-700 font-semibold mb-3">Dokumen yang Diunggah Pendaftar</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- KTP -->
                    <div class="border border-gray-200 rounded-xl p-3 bg-gray-50 flex flex-col">
                        <p class="text-xs font-bold text-gray-500 uppercase mb-2 text-center">Scan KTP</p>
                        @if(isset($connectionRequest) && $connectionRequest->ktp_file_path)
                            <a href="{{ Storage::url($connectionRequest->ktp_file_path) }}" target="_blank" class="flex-1 min-h-[150px] relative group overflow-hidden rounded-lg border border-gray-300 bg-white">
                                <img src="{{ Storage::url($connectionRequest->ktp_file_path) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110" alt="KTP">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 drop-shadow-md">zoom_in</span>
                                </div>
                            </a>
                        @else
                            <div class="flex-1 min-h-[150px] flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg border border-gray-200">
                                <span class="text-sm">Tidak Ada File</span>
                            </div>
                        @endif
                    </div>

                    <!-- KK -->
                    <div class="border border-gray-200 rounded-xl p-3 bg-gray-50 flex flex-col">
                        <p class="text-xs font-bold text-gray-500 uppercase mb-2 text-center">Scan Kartu Keluarga (KK)</p>
                        @if(isset($connectionRequest) && $connectionRequest->kk_file_path)
                            <a href="{{ Storage::url($connectionRequest->kk_file_path) }}" target="_blank" class="flex-1 min-h-[150px] relative group overflow-hidden rounded-lg border border-gray-300 bg-white">
                                <img src="{{ Storage::url($connectionRequest->kk_file_path) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110" alt="KK">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 drop-shadow-md">zoom_in</span>
                                </div>
                            </a>
                        @else
                            <div class="flex-1 min-h-[150px] flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg border border-gray-200">
                                <span class="text-sm">Tidak Ada File</span>
                            </div>
                        @endif
                    </div>

                    <!-- Foto Rumah -->
                    <div class="border border-gray-200 rounded-xl p-3 bg-gray-50 flex flex-col">
                        <p class="text-xs font-bold text-gray-500 uppercase mb-2 text-center">Foto Depan Rumah</p>
                        @if(isset($connectionRequest) && $connectionRequest->house_image_path)
                            <a href="{{ Storage::url($connectionRequest->house_image_path) }}" target="_blank" class="flex-1 min-h-[150px] relative group overflow-hidden rounded-lg border border-gray-300 bg-white">
                                <img src="{{ Storage::url($connectionRequest->house_image_path) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110" alt="Rumah">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 drop-shadow-md">zoom_in</span>
                                </div>
                            </a>
                        @else
                            <div class="flex-1 min-h-[150px] flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg border border-gray-200">
                                <span class="text-sm">Tidak Ada File</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
