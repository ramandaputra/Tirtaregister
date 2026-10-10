@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
                
                <!-- Header Banner -->
                <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Manajemen Berita & Pengumuman</h1>
                        <p class="text-white/80 text-sm mt-1">Tambah, edit, atau hapus artikel berita publik PERUMDA Air Minum Tirta Kepri.</p>
                    </div>
                    
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('superadmin.settings.index') }}" 
                           class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">settings</span>
                            <span>Pengaturan Website</span>
                        </a>

                        <a href="{{ route('superadmin.news.create') }}" 
                           class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            <span>Tambah Berita Baru</span>
                        </a>
                    </div>
                </div>

                <!-- Alert Sukses -->
                @if(session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span> 
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Data Berita -->
                <div class="bg-white rounded-xl shadow-sm border border-surface-border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-center border-collapse">
                            <thead>
                            <tr class="bg-gray-50 border-b text-xs font-bold uppercase text-gray-600">
                                <th class="p-4">Gambar</th>
                                <th class="p-4">Judul Berita</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Tanggal</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y text-sm">
                            @forelse($news as $item)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="p-4 w-20 flex justify-center">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 rounded object-cover mx-auto" alt="Thumb">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 mx-auto">
                                                <span class="material-symbols-outlined">image</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 font-semibold text-gray-900 max-w-xs truncate">{{ $item->title }}</td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 bg-blue-50 text-primary text-xs font-semibold rounded">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        @if($item->is_published ?? true)
                                            <span class="text-green-600 font-semibold text-xs">Published</span>
                                        @else
                                            <span class="text-gray-400 font-semibold text-xs">Draft</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-500">{{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}</td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('superadmin.news.edit', $item->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition" title="Edit">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </a>
                                            <form action="{{ route('superadmin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition" title="Hapus">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">Belum ada berita yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginasi -->
                <div class="mt-4 px-6 py-4 bg-white rounded-xl shadow-sm border border-surface-border">
                    <div class="[&>nav]:flex [&>nav]:items-center [&>nav]:justify-between [&>nav]:gap-4">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
@endsection


