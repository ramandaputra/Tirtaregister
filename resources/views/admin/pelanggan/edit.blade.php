@extends('layouts.admin')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Header Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Edit Pendaftaran Pelanggan</h1>
            <p class="text-white/80 text-sm mt-1">Perbarui data pendaftaran pelanggan yang sudah ada di sistem.</p>
        </div>
        
        <a href="javascript:history.back()" class="w-full sm:w-auto px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shrink-0 border border-white/20">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Edit -->
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-surface-border shadow-xs">
        <form action="{{ route('admin.pelanggan.update', $pelanggan->nomorreg) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- No Registrasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. Registrasi</label>
                    <input type="text" value="{{ $pelanggan->nomorreg }}" disabled
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-500 focus:outline-none cursor-not-allowed">
                    <p class="text-[11px] text-gray-400 mt-1">No. Registrasi tidak dapat diubah (Primary Key).</p>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                           placeholder="Nama Pendaftar">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Pasang <span class="text-red-500">*</span></label>
                <textarea name="alamat" rows="3" required
                          class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                          placeholder="Detail alamat pemasangan">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Tipe -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pendaftaran <span class="text-red-500">*</span></label>
                    <select name="tipe" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                        <option value="REGULER" {{ old('tipe', $pelanggan->tipe) == 'REGULER' ? 'selected' : '' }}>REGULER (Pribadi)</option>
                        <option value="PRIORITAS" {{ old('tipe', $pelanggan->tipe) == 'PRIORITAS' ? 'selected' : '' }}>PRIORITAS (Fasilitas Umum)</option>
                    </select>
                </div>

                <!-- Golongan Tarif -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Golongan Tarif</label>
                    <div class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                            <span class="font-bold text-base text-gray-900">{{ $pelanggan->golongan }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tanggal Daftar -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Daftar</label>
                    <input type="date" name="tgldaftar" value="{{ old('tgldaftar', \Carbon\Carbon::parse($pelanggan->tgldaftar)->format('Y-m-d')) }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                </div>
            </div>

            <!-- Status Pemasangan -->
            <div class="pt-4 border-t border-gray-100">
                <label class="block text-sm font-semibold text-gray-800 mb-3">Status Pemasangan Sambungan Air <span class="text-red-500">*</span></label>
                
                @php
                    $selectedStatus = old('status', $currentStatus ?? 'proses');
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Status: Proses -->
                    <label class="relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 {{ $selectedStatus === 'proses' ? 'border-amber-500 bg-amber-50/50 shadow-sm' : 'border-gray-200 hover:border-gray-300' }}" id="status-card-proses">
                        <input type="radio" name="status" value="proses" class="sr-only" {{ $selectedStatus === 'proses' ? 'checked' : '' }} onchange="toggleStatusView('proses')">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[24px]">pending_actions</span>
                            </span>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">Proses</span>
                        </div>
                        <span class="font-bold text-gray-900 text-sm">Dalam Proses</span>
                        <p class="text-xs text-gray-500 mt-1">Pengajuan sedang diproses atau menunggu survei teknis.</p>
                    </label>

                    <!-- Status: Terpasang -->
                    <label class="relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 {{ $selectedStatus === 'terpasang' ? 'border-emerald-500 bg-emerald-50/50 shadow-sm' : 'border-gray-200 hover:border-gray-300' }}" id="status-card-terpasang">
                        <input type="radio" name="status" value="terpasang" class="sr-only" {{ $selectedStatus === 'terpasang' ? 'checked' : '' }} onchange="toggleStatusView('terpasang')">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[24px]">check_circle</span>
                            </span>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Selesai</span>
                        </div>
                        <span class="font-bold text-gray-900 text-sm">Sudah Terpasang</span>
                        <p class="text-xs text-gray-500 mt-1">Sambungan air dan meteran telah berhasil dipasang & aktif.</p>
                    </label>

                    <!-- Status: Bermasalah -->
                    <label class="relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 {{ $selectedStatus === 'bermasalah' ? 'border-red-500 bg-red-50/50 shadow-sm' : 'border-gray-200 hover:border-gray-300' }}" id="status-card-bermasalah">
                        <input type="radio" name="status" value="bermasalah" class="sr-only" {{ $selectedStatus === 'bermasalah' ? 'checked' : '' }} onchange="toggleStatusView('bermasalah')">
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-10 h-10 rounded-xl bg-red-100 text-red-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[24px]">warning</span>
                            </span>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-800">Kendala</span>
                        </div>
                        <span class="font-bold text-gray-900 text-sm">Ada Masalah / Kendala</span>
                        <p class="text-xs text-gray-500 mt-1">Terdapat kendala fisik, teknis, atau administrasi di lapangan.</p>
                    </label>
                </div>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan Masalah (Kondisional) -->
            <div id="problem-note-container" class="{{ $selectedStatus === 'bermasalah' ? 'block' : 'hidden' }} bg-red-50/60 border border-red-200 rounded-xl p-4 transition-all duration-300">
                <label class="block text-sm font-semibold text-red-800 mb-2 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">error</span>
                    Keterangan Masalah / Kendala Lapangan
                </label>
                <textarea name="keterangan_problem" id="keterangan_problem" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-red-300 bg-white focus:ring-2 focus:ring-red-400 focus:border-red-400 transition outline-none text-sm text-gray-900"
                          placeholder="Jelaskan alasan atau kendala pemasangan (contoh: Alamat tidak dijumpai, belum ada jaringan pipa distribusi, dll)...">{{ old('keterangan_problem', $pelanggan->keterangan_problem) }}</textarea>
                <p class="text-xs text-red-600 mt-1">Keterangan ini akan tampil pada rincian status pendaftaran pelanggan.</p>
                @error('keterangan_problem')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-primary hover:bg-primary/90 text-white rounded-xl font-bold transition flex items-center justify-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleStatusView(selected) {
        const cards = {
            'proses': { id: 'status-card-proses', activeClass: 'border-amber-500 bg-amber-50/50 shadow-sm', inactiveClass: 'border-gray-200' },
            'terpasang': { id: 'status-card-terpasang', activeClass: 'border-emerald-500 bg-emerald-50/50 shadow-sm', inactiveClass: 'border-gray-200' },
            'bermasalah': { id: 'status-card-bermasalah', activeClass: 'border-red-500 bg-red-50/50 shadow-sm', inactiveClass: 'border-gray-200' }
        };

        for (const [key, config] of Object.entries(cards)) {
            const cardEl = document.getElementById(config.id);
            if (cardEl) {
                if (key === selected) {
                    cardEl.className = `relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 ${config.activeClass}`;
                } else {
                    cardEl.className = `relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 ${config.inactiveClass} hover:border-gray-300`;
                }
            }
        }

        const noteBox = document.getElementById('problem-note-container');
        if (noteBox) {
            if (selected === 'bermasalah') {
                noteBox.classList.remove('hidden');
                document.getElementById('keterangan_problem')?.focus();
            } else {
                noteBox.classList.add('hidden');
            }
        }
    }
</script>
@endsection
