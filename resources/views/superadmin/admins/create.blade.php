@extends('layouts.admin') {{-- Sesuaikan dengan nama file layout Anda jika ada --}}

@section('content')
<!-- KONTEN UTAMA -->
<main class="flex-1 p-8 overflow-y-auto">
    <div class="max-w-[1200px] mx-auto">
        
        <!-- Header Page (Banner Style) -->
        <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Buat Akun Admin Baru</h1>
                <p class="text-white/80 text-sm mt-1">Tambahkan kredensial dan atur tingkat akses untuk pengelola baru.</p>
            </div>
            
            <a href="javascript:history.back()" 
               class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Daftar Admin</span>
            </a>
        </div>

        <!-- Form Tambah Admin -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-surface-border shadow-xs">
            <form action="{{ route('superadmin.admins.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap" 
                               class="w-full px-4 py-2.5 text-sm border @error('name') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@tirtakepri.co.id" 
                               class="w-full px-4 py-2.5 text-sm border @error('email') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Kata Sandi <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter" 
                               class="w-full px-4 py-2.5 text-sm border @error('password') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" 
                               class="w-full px-4 py-2.5 text-sm border border-surface-border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                    </div>

                    <!-- Peran / Role -->
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Peran (Role) <span class="text-red-500">*</span></label>
                        <select name="role" required class="w-full px-4 py-2.5 text-sm border @error('role') border-red-500 @else border-surface-border @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Peran Akses</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Akun -->
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Status Akun</label>
                        <select name="status" class="w-full px-4 py-2.5 text-sm border border-surface-border rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol Aksi Simpan -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-border">
                    <a href="{{ route('superadmin.admins.index') }}" 
                       class="px-5 py-2.5 rounded-xl border border-surface-border text-gray-700 text-sm font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-bold hover:bg-primary/90 transition shadow-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan Akun</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</main>
@endsection