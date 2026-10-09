@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Header Page (Banner / Title Area) -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Berita Baru</h1>
            <p class="text-white/80 text-sm mt-1">Buat artikel, informasi, atau pengumuman baru untuk diterbitkan ke website.</p>
        </div>
        
        <a href="javascript:history.back()" 
           class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Form Tambah Berita -->
    <div class="bg-white rounded-2xl p-6 md:p-8 border border-surface-border shadow-xs">
        <form action="{{ route('superadmin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul Berita -->
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-2">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Masukkan judul berita utama" 
                       class="w-full px-4 py-2.5 text-sm border @error('title') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori Berita -->
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="category" required class="w-full px-4 py-2.5 text-sm border @error('category') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih Kategori Berita</option>
                    <option value="Informasi" {{ old('category') == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                    <option value="Pengumuman" {{ old('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Pemeliharaan" {{ old('category') == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan Jaringan</option>
                    <option value="Kegiatan" {{ old('category') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan Direksi</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar Utama / Sampul -->
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-2">
                    Gambar Utama (Sampul)
                </label>
                <input type="file" name="image" accept="image/*" 
                       class="w-full px-3 py-2 text-sm border @error('image') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG, WEBP (Maksimal 2MB).</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Isi Berita -->
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-2">
                    Isi Berita <span class="text-red-500">*</span>
                </label>
                <textarea name="content" rows="8" required placeholder="Tuliskan detail konten berita di sini..." 
                          class="w-full px-4 py-2.5 text-sm border @error('content') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option Terbitkan -->
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', '1') == '1' ? 'checked' : '' }} 
                       class="w-4 h-4 text-primary border-surface-border rounded focus:ring-primary/20">
                <label for="is_published" class="text-sm font-semibold text-on-surface cursor-pointer select-none">
                    Terbitkan Langsung ke Website
                </label>
            </div>

            <!-- Tombol Aksi Simpan -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-border">
                <a href="{{ route('superadmin.news.index') }}" 
                   class="px-5 py-2.5 rounded-xl border border-surface-border text-gray-700 text-sm font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-bold hover:bg-primary/90 transition shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Berita</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection