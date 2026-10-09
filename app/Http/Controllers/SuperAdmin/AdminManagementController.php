<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    // 1. Tampilkan Halaman Tabel Admin
    public function index()
    {
        // Menggunakan eager loading 'roles' agar query ringan
        $admins = User::with('roles')->paginate(15);
        return view('superadmin.admins.index', compact('admins'));
    }

    // 2. Tampilkan Form Tambah Admin
    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('superadmin.admins.create', compact('roles'));
    }

    // 3. Simpan Data Admin Baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|string',
        ]);

        // 1. Buat User baru (tanpa memasukkan 'role' ke kolom users)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 2. Assign Role menggunakan Spatie
        $user->assignRole($request->role);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin berhasil ditambahkan.');
    }

    // 4. Tampilkan Form Edit Admin
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $roles = \Spatie\Permission\Models\Role::all();
        return view('superadmin.admins.edit', compact('admin', 'roles'));
    }

    // 5. Simpan Perubahan Data Admin
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|string',
        ]);

        // 1. Update data dasar user
        $admin->name  = $request->name;
        $admin->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        // 2. Update role pengguna di tabel relasi Spatie
        $admin->syncRoles([$request->role]);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    // 6. Hapus Admin
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        
        // Hapus relasi role terlebih dahulu sebelum menghapus user
        $admin->syncRoles([]);
        $admin->delete();

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin berhasil dihapus.');
    }
}