<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    // Tampilkan Daftar Admin
    public function index()
    {
        $admins = User::role('admin')->latest()->paginate(10);
        return view('superadmin.admins.index', compact('admins'));
    }

    // Form Buat Akun Admin Baru
    public function create()
    {
        return view('superadmin.admins.create');
    }

    // Simpan Akun Admin Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role Admin menggunakan Spatie
        $user->assignRole('admin');

        return redirect()->route('superadmin.admins.index')->with('success', 'Akun Admin berhasil dibuat!');
    }

    // Hapus Akun Admin
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('superadmin.admins.index')->with('success', 'Akun Admin berhasil dihapus!');
    }
}