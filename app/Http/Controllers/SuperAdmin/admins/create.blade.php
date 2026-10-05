@extends('layouts.admin')

@section('title', 'Buat Akun Admin Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-on-surface">Buat Akun Admin Baru</h1>
        <p class="text-sm text-gray-500">Tambahkan pengelola baru untuk membantu manajemen sistem.</p>
    </div>

    <form action="{{ route('superadmin.admins.store') }}" method="POST" class="bg-white p-6 rounded-2xl shadow-sm border border-surface-border space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
            <input type="text" name="name" required class="w-full px-4 py-2.5 border border-surface-border rounded-xl text-sm focus:outline-none focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2.5 border border-surface-border rounded-xl text-sm focus:outline-none focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2.5 border border-surface-border rounded-xl text-sm focus:outline-none focus:border-primary">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 border border-surface-border rounded-xl text-sm focus:outline-none focus:border-primary">
        </div>

        <button type="submit" class="w-full py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 transition flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            <span>Simpan Akun Admin</span>
        </button>
    </form>
</div>
@endsection