@extends('layouts.admin')

@section('title', 'Dashboard Utama')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    
    <!-- Welcome Banner -->
    <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name ?? 'Super Admin' }}! 👋</h1>
            <p class="text-white/80 text-sm mt-1">Kelola informasi publik, berita, dan hak akses admin PERUMDA Air Minum Tirta Kepri dari panel ini.</p>
        </div>
        <a href="/" target="_blank" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
            <span class="material-symbols-outlined text-[18px]">open_in_new</span>
            <span>Lihat Website Publik</span>
        </a>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Berita</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $totalNews ?? 0 }}</h3>
                <a href="{{ route('superadmin.news.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Kelola Berita →</a>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[28px]">newspaper</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Akun Admin</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $totalAdmins ?? 0 }}</h3>
                <a href="{{ route('superadmin.admins.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Kelola Akun →</a>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[28px]">manage_accounts</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-surface-border shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Pengaturan Website</p>
                <h3 class="text-3xl font-bold text-on-surface">{{ $totalSettings ?? 0 }} <span class="text-xs font-normal text-gray-500">Key</span></h3>
                <a href="{{ route('superadmin.settings.index') }}" class="text-xs text-primary font-semibold hover:underline mt-2 inline-block">Edit Beranda & Site →</a>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[28px]">web</span>
            </div>
        </div>
    </div>

</div>
@endsection