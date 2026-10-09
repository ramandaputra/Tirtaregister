@extends('layouts.admin')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Header Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Pendaftaran Pelanggan</h1>
            <p class="text-white/80 text-sm mt-1">Masukkan data pendaftaran pelanggan secara manual ke dalam sistem.</p>
        </div>
        
        <a href="javascript:history.back()" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0 border border-white/20">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Tambah -->
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-surface-border shadow-xs">
        <form action="{{ route('admin.pelanggan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- No Registrasi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. Registrasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nomorreg" value="{{ old('nomorreg') }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none"
                           placeholder="Contoh: REG-2026-ABCD">
                    @error('nomorreg')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
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
                          placeholder="Detail alamat pemasangan">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tipe -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pendaftaran <span class="text-red-500">*</span></label>
                    <select name="tipe" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                        <option value="REGULER" {{ old('tipe') == 'REGULER' ? 'selected' : '' }}>REGULER (Pribadi)</option>
                        <option value="MBR" {{ old('tipe') == 'MBR' ? 'selected' : '' }}>MBR (Fasilitas Umum)</option>
                    </select>
                </div>

                <!-- Tanggal Daftar -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Daftar</label>
                    <input type="date" name="tgldaftar" value="{{ old('tgldaftar') ?? now()->format('Y-m-d') }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none">
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary/90 text-white rounded-xl font-bold transition flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Pelanggan Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
