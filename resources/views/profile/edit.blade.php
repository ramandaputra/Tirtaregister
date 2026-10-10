@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-3xl">manage_accounts</span>
            </div>
            <div>
                <h1 class="text-xl lg:text-2xl font-bold">Pengaturan Akun</h1>
                <p class="text-white/80 text-sm mt-1">Kelola foto profil, informasi pribadi, dan keamanan kata sandi Anda di sini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
            <!-- Kolom Kiri: Informasi Profil & Foto -->
            <div class="bg-white border border-surface-border shadow-sm rounded-2xl p-6 lg:p-8 flex flex-col h-full">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Kolom Kanan: Kata Sandi -->
            <div class="bg-white border border-surface-border shadow-sm rounded-2xl p-6 lg:p-8 flex flex-col h-full">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
@endsection
