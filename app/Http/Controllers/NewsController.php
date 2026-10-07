<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita untuk PUBLIK / USER (URL: /berita)
     */
    public function index()
    {
        // Mengambil berita terupdate dengan pagination 9 item per halaman
        $news = News::latest()->paginate(9);

        // Mengembalikan view publik yang kamu sebutkan (pages/news.blade.php)
        return view('pages.news', compact('news'));
    }

    /**
     * Menampilkan daftar berita untuk SUPERADMIN (URL: /superadmin/news)
     */
    public function adminIndex()
    {
        $news = News::latest()->paginate(10);

        return view('superadmin.news.index', compact('news'));
    }

    /**
     * Menampilkan form edit berita untuk SUPERADMIN (URL: /superadmin/news/{id}/edit)
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('superadmin.news.edit', compact('news'));
    }

    /**
     * Memproses update data berita
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content'  => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title'    => $request->title,
            'category' => $request->category,
            'content'  => $request->content,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('superadmin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }
}