<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Mengambil berita yang dipublikasikan dari database
        $news = News::where('is_published', true)->latest()->paginate(6);

        return view('pages.news', compact('news'));
    }
}