@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
                
                <!-- Header Banner -->
                <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Edit Artikel Berita</h1>
                        <p class="text-white/80 text-sm mt-1">Perbarui data artikel berita publik PERUMDA Air Minum Tirta Kepri.</p>
                    </div>
                    <a href="javascript:history.back()" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 border border-white/20">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        <span>Kembali</span>
                    </a>
                </div>

                <!-- Form Card Single -->
                <div class="bg-white rounded-2xl shadow-sm border border-surface-border p-6">
                    <form action="{{ route('superadmin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Judul Berita -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
                            <input type="text" name="title" value="{{ old('title', $news->title) }}" required 
                                   class="w-full px-4 py-2.5 rounded-xl border border-surface-border focus:ring-2 focus:ring-primary focus:outline-none text-sm"
                                   placeholder="Masukkan judul berita">
                        </div>

                        <!-- Kategori Berita -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Berita</label>
                            <input type="text" name="category" value="{{ old('category', $news->category) }}" required 
                                   class="w-full px-4 py-2.5 rounded-xl border border-surface-border focus:ring-2 focus:ring-primary focus:outline-none text-sm"
                                   placeholder="Contoh: Pengumuman, Berita Utama, Gangguan Layanan, dll">
                        </div>

                        <!-- Preview & Upload Gambar -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Sampul</label>
                            @if(isset($news->image) && $news->image)
                                <div class="mb-3 flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $news->image) }}" class="w-24 h-24 rounded-xl object-cover border border-surface-border" alt="Preview">
                                    <span class="text-xs text-gray-500">Gambar saat ini. Upload file baru untuk mengganti.</span>
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        </div>

                        <!-- Isi Konten -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
                            <textarea name="content" rows="6" required 
                                      class="w-full px-4 py-2.5 rounded-xl border border-surface-border focus:ring-2 focus:ring-primary focus:outline-none text-sm"
                                      placeholder="Tuliskan isi artikel berita di sini...">{{ old('content', $news->content ?? '') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end gap-3 pt-4 border-t border-surface-border">
                            <a href="{{ route('superadmin.news.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-semibold transition">
                                Batal
                            </a>
                            <button type="submit" class="px-5 py-2.5 bg-primary hover:bg-primary/90 text-white rounded-xl text-sm font-semibold transition shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
@endsection
