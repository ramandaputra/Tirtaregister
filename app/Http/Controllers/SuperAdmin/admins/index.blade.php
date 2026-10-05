@extends('layouts.admin')

@section('title', 'Daftar Akun Admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-on-surface">Daftar Admin Sistem</h1>
            <p class="text-sm text-gray-500">Kelola daftar akun pengguna dengan hak akses role Admin.</p>
        </div>
        <a href="{{ route('superadmin.admins.create') }}" class="px-4 py-2.5 bg-primary text-white font-semibold rounded-xl text-sm hover:bg-primary/90 transition flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">add</span>
            <span>Tambah Admin</span>
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-green-800 bg-green-50 border border-green-200 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-surface-border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b text-xs font-bold uppercase text-gray-500">
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Tanggal Dibuat</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-sm">
                @forelse($admins as $admin)
                    <tr>
                        <td class="p-4 font-semibold text-on-surface">{{ $admin->name }}</td>
                        <td class="p-4 text-gray-600">{{ $admin->email }}</td>
                        <td class="p-4 text-xs text-gray-500">{{ $admin->created_at->format('d M Y') }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Hapus akun admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500">Belum ada akun admin yang dibuat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection