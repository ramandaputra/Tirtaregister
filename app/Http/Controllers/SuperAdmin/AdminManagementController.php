<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class AdminManagementController extends Controller
{
    // Tampilkan semua user dengan role 'admin'
    public function index()
    {
        $admins = User::role('admin')->latest()->paginate(10);
        return view('superadmin.admins.index', compact('admins'));
    }

    // Form buat akun admin baru
    public function create()
    {
        return view('superadmin.admins.create');
    }

    // Simpan akun admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role 'admin'
        $admin->assignRole('admin');

        return redirect()->route('superadmin.admins.index')->with('success', 'Akun Admin berhasil dibuat!');
    }

    // Form edit admin
    public function edit(User $admin)
    {
        return view('superadmin.admins.edit', compact('admin'));
    }

    // Update data admin
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id],
        ]);

        $admin->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('superadmin.admins.index')->with('success', 'Data Admin berhasil diperbarui!');
    }

    // Hapus akun admin
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('superadmin.admins.index')->with('success', 'Akun Admin berhasil dihapus!');
    }
}