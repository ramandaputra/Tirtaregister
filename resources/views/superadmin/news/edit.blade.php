<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: "#006689", "surface-ice": "#F4F8FA", "surface-border": "#D5E2E8" } } } }
    </script>
</head>
<body class="bg-surface-ice text-gray-800 p-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-primary">Edit Berita</h1>
            <a href="{{ route('superadmin.news.index') }}" class="text-sm text-gray-600 hover:underline">← Kembali ke Daftar</a>
        </div>

        <form action="{{ route('superadmin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-surface-border space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold mb-1">Judul Berita</label>
                <input type="text" name="title" value="{{ $news->title }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary text-sm">
                    <option value="Informasi" {{ $news->category == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                    <option value="Pengumuman" {{ $news->category == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="Pemeliharaan" {{ $news->category == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan Jaringan</option>
                    <option value="Kegiatan" {{ $news->category == 'Kegiatan' ? 'selected' : '' }}>Kegiatan Direksi</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Gambar Utama Sekarang</label>
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" class="w-32 h-20 object-cover rounded mb-2 border">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border rounded-lg p-2 text-sm">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Isi Berita</label>
                <textarea name="content" rows="8" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary text-sm">{{ $news->content }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ $news->is_published ? 'checked' : '' }} class="w-4 h-4 text-primary rounded">
                <label for="is_published" class="text-sm font-medium">Terbitkan Langsung ke Website</label>
            </div>

            <button type="submit" class="w-full py-2.5 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition">
                Perbarui Berita
            </button>
        </form>
    </div>
</body>
</html>