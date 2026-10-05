<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConnectionRequest;
use App\Models\ConnectionRequest;
use Illuminate\Support\Str;

class ConnectionRequestController extends Controller
{
    // Menampilkan halaman formulir
    public function create()
    {
        return view('public.register');
    }

    // Menyimpan data pengajuan
    public function store(StoreConnectionRequest $request)
    {
        // 1. Upload Berkas KTP
        $path = $request->file('ktp_file')->store('ktp_files', 'public');

        // 2. Generate Nomor Pendaftaran Unik
        $regNumber = 'REG-' . date('Ym') . '-' . strtoupper(Str::random(4));

        // 3. Simpan ke Database
        $connection = ConnectionRequest::create([
            'registration_number' => $regNumber,
            'full_name' => $request->full_name,
            'nik' => $request->nik,
            'phone_number' => $request->phone_number,
            'installation_address' => $request->installation_address,
            'ktp_file_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', "Pendaftaran berhasil! Nomor Registrasi Anda: {$regNumber}");
    }
}