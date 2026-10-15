@extends('layouts.admin')

@section('title', 'Detail Pendaftaran Pelanggan')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <!-- Header Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2.5 flex-wrap">
                <h1 class="text-2xl font-bold tracking-tight">Detail Pendaftaran</h1>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-white/20 text-white font-bold text-xs tracking-wide uppercase border border-white/30 backdrop-blur-xs">
                    <span class="material-symbols-outlined text-[15px]">sell</span>
                    Golongan: {{ $pelanggan->golongan }}
                </span>
            </div>
            <p class="text-white/80 text-sm mt-1">No. Registrasi: <span class="font-semibold">{{ $pelanggan->nomorreg }}</span></p>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3 w-full sm:w-auto shrink-0">
            <a href="javascript:history.back()" class="px-3.5 sm:px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs sm:text-sm font-semibold transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </a>
            <button type="button" onclick="openStatusModal()" class="px-3.5 sm:px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">published_with_changes</span>
                Ubah Status
            </button>
            <a href="{{ route('admin.pelanggan.edit', $pelanggan->nomorreg) }}" class="px-3.5 sm:px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                Edit Lengkap
            </a>
            <a href="{{ route('admin.pelanggan.print', $pelanggan->nomorreg) }}" class="px-3.5 sm:px-4 py-2 bg-white text-primary hover:bg-gray-100 rounded-xl text-xs sm:text-sm font-bold shadow-sm transition flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">print</span>
                Cetak Bukti
            </a>
        </div>
    </div>

    <!-- Status Banner Aktif -->
    @php
        $currentStatus = 'proses';
        if ($pelanggan->flagproblem == 1) {
            $currentStatus = 'bermasalah';
        } elseif ($pelanggan->flagpasang == 1) {
            $currentStatus = 'terpasang';
        }
    @endphp

    <div class="rounded-2xl p-4 md:p-5 border shadow-xs transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 {{ $currentStatus === 'terpasang' ? 'bg-emerald-50/70 border-emerald-200 text-emerald-900' : ($currentStatus === 'bermasalah' ? 'bg-red-50/70 border-red-200 text-red-900' : 'bg-amber-50/70 border-amber-200 text-amber-900') }}">
        <div class="flex items-start sm:items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 {{ $currentStatus === 'terpasang' ? 'bg-emerald-500 text-white' : ($currentStatus === 'bermasalah' ? 'bg-red-500 text-white' : 'bg-amber-500 text-white') }}">
                <span class="material-symbols-outlined text-[26px]">
                    {{ $currentStatus === 'terpasang' ? 'check_circle' : ($currentStatus === 'bermasalah' ? 'warning' : 'pending_actions') }}
                </span>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-xs font-bold uppercase tracking-wider opacity-75">Status Pemasangan:</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $currentStatus === 'terpasang' ? 'bg-emerald-100 text-emerald-800' : ($currentStatus === 'bermasalah' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                        {{ $currentStatus === 'terpasang' ? 'SUDAH TERPASANG' : ($currentStatus === 'bermasalah' ? 'BERMASALAH / ADA KENDALA' : 'DALAM PROSES') }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm mt-1 opacity-90">
                    @if($currentStatus === 'terpasang')
                        Sambungan air dan meteran telah berhasil dipasang serta aktif untuk pelanggan ini.
                    @elseif($currentStatus === 'bermasalah')
                        <span class="font-semibold">Kendala:</span> {{ $pelanggan->keterangan_problem ?: 'Ada kendala pada berkas/teknis di lapangan. Silakan periksa catatan atau hubungi pelanggan.' }}
                    @else
                        Pendaftaran sedang dalam proses antrean, survei teknis, atau jadwal pemasangan pipa.
                    @endif
                </p>
            </div>
        </div>

        <button type="button" onclick="openStatusModal()" class="px-3.5 py-2 rounded-xl text-xs font-bold border transition shrink-0 flex items-center gap-1.5 {{ $currentStatus === 'terpasang' ? 'bg-white text-emerald-700 border-emerald-300 hover:bg-emerald-100' : ($currentStatus === 'bermasalah' ? 'bg-white text-red-700 border-red-300 hover:bg-red-100' : 'bg-white text-amber-700 border-amber-300 hover:bg-amber-100') }}">
            <span class="material-symbols-outlined text-[16px]">edit</span>
            Ganti Status
        </button>
    </div>

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
                    <p class="text-gray-500 font-semibold mb-1">Golongan Tarif</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $pelanggan->golongan }}
                        </span>
                    </div>
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
                    <p class="text-gray-500 font-semibold mb-1">Golongan Tarif</p>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            {{ $pelanggan->golongan }}
                        </span>
                    </div>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Kelompok Pelanggan</p>
                    <p class="text-on-surface font-medium">
                        {{ $pelanggan->kelompokPelanggan->nama_kelompok ?? '-' }}
                        @if(!empty($pelanggan->kelompokPelanggan->kode))
                            <span class="text-xs text-gray-400">({{ $pelanggan->kelompokPelanggan->kode }})</span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-gray-500 font-semibold mb-1">Kategori Golongan</p>
                    <p class="text-on-surface font-medium">
                        {{ $pelanggan->golonganPelanggan->nama_golongan ?? '-' }}
                        @if(!empty($pelanggan->golonganPelanggan->sub_kategori))
                            <span class="text-xs text-blue-600 block sm:inline">({{ $pelanggan->golonganPelanggan->sub_kategori }})</span>
                        @endif
                    </p>
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

<!-- Modal Ubah Status -->
<div id="statusModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-surface-border transition-all transform animate-in fade-in zoom-in-95 duration-200">
        <div class="flex items-center justify-between pb-4 border-b border-surface-border mb-4">
            <div class="flex items-center gap-2.5">
                <span class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[20px]">published_with_changes</span>
                </span>
                <div>
                    <h3 class="text-base font-bold text-gray-900">Ubah Status Pemasangan</h3>
                    <p class="text-xs text-gray-500">{{ $pelanggan->nomorreg }} &bull; {{ $pelanggan->nama }}</p>
                </div>
            </div>
            <button type="button" onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg hover:bg-gray-100 transition">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <form action="{{ route('admin.pelanggan.updateStatus', $pelanggan->nomorreg) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pilih Status Baru <span class="text-red-500">*</span></label>
                <div class="space-y-2.5">
                    <!-- Option: Proses -->
                    <label class="flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50 {{ $currentStatus === 'proses' ? 'border-amber-500 bg-amber-50/40' : 'border-gray-200' }}" id="modal-card-proses">
                        <input type="radio" name="status" value="proses" class="text-primary focus:ring-primary" {{ $currentStatus === 'proses' ? 'checked' : '' }} onchange="onModalStatusChange('proses')">
                        <span class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[18px]">pending_actions</span>
                        </span>
                        <div class="flex-1 text-left">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-900">Dalam Proses</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">Proses</span>
                            </div>
                            <p class="text-[11px] text-gray-500">Antrean survei / instalasi sambungan baru.</p>
                        </div>
                    </label>

                    <!-- Option: Terpasang -->
                    <label class="flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50 {{ $currentStatus === 'terpasang' ? 'border-emerald-500 bg-emerald-50/40' : 'border-gray-200' }}" id="modal-card-terpasang">
                        <input type="radio" name="status" value="terpasang" class="text-primary focus:ring-primary" {{ $currentStatus === 'terpasang' ? 'checked' : '' }} onchange="onModalStatusChange('terpasang')">
                        <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        </span>
                        <div class="flex-1 text-left">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-900">Sudah Terpasang</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Selesai</span>
                            </div>
                            <p class="text-[11px] text-gray-500">Meteran air aktif dan sudah dipasang.</p>
                        </div>
                    </label>

                    <!-- Option: Bermasalah -->
                    <label class="flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50 {{ $currentStatus === 'bermasalah' ? 'border-red-500 bg-red-50/40' : 'border-gray-200' }}" id="modal-card-bermasalah">
                        <input type="radio" name="status" value="bermasalah" class="text-primary focus:ring-primary" {{ $currentStatus === 'bermasalah' ? 'checked' : '' }} onchange="onModalStatusChange('bermasalah')">
                        <span class="w-8 h-8 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[18px]">warning</span>
                        </span>
                        <div class="flex-1 text-left">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-900">Ada Masalah / Kendala</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-800">Kendala</span>
                            </div>
                            <p class="text-[11px] text-gray-500">Ada kendala teknis / administrasi lapangan.</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Problem Note in Modal -->
            <div id="modal-problem-note" class="{{ $currentStatus === 'bermasalah' ? 'block' : 'hidden' }} space-y-1.5 pt-1">
                <label class="block text-xs font-bold text-red-700 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    Keterangan Masalah / Kendala
                </label>
                <textarea name="keterangan_problem" id="modal_keterangan_problem" rows="3"
                          class="w-full px-3 py-2 text-xs rounded-xl border border-red-300 focus:ring-2 focus:ring-red-400 focus:border-red-400 outline-none text-gray-900"
                          placeholder="Jelaskan alasan atau kendala pemasangan...">{{ old('keterangan_problem', $pelanggan->keterangan_problem) }}</textarea>
            </div>

            <div class="pt-3 border-t border-surface-border flex items-center justify-end gap-2">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-primary hover:bg-primary/90 transition flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">save</span>
                    Simpan Status
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openStatusModal() {
        document.getElementById('statusModal')?.classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal')?.classList.add('hidden');
    }

    function onModalStatusChange(status) {
        const modalCards = {
            'proses': { id: 'modal-card-proses', border: 'border-amber-500 bg-amber-50/40' },
            'terpasang': { id: 'modal-card-terpasang', border: 'border-emerald-500 bg-emerald-50/40' },
            'bermasalah': { id: 'modal-card-bermasalah', border: 'border-red-500 bg-red-50/40' }
        };

        for (const [key, cfg] of Object.entries(modalCards)) {
            const el = document.getElementById(cfg.id);
            if (el) {
                if (key === status) {
                    el.className = `flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition ${cfg.border}`;
                } else {
                    el.className = 'flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition hover:bg-gray-50 border-gray-200';
                }
            }
        }

        const noteContainer = document.getElementById('modal-problem-note');
        if (noteContainer) {
            if (status === 'bermasalah') {
                noteContainer.classList.remove('hidden');
                document.getElementById('modal_keterangan_problem')?.focus();
            } else {
                noteContainer.classList.add('hidden');
            }
        }
    }

    // Close on escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeStatusModal();
    });
</script>
@endsection
