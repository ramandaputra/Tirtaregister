<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    // Tampilkan daftar pengajuan di Dashboard Admin
    public function index()
    {
        $requests = ConnectionRequest::latest()->paginate(15);

        return view('admin.requests.index', compact('requests'));
    }

    // Detail pengajuan pendaftaran
    public function show($id)
    {
        $requestData = ConnectionRequest::findOrFail($id);

        return view('admin.requests.show', compact('requestData'));
    }

    // Update status pengajuan (Misal: Disetujui / Ditolak)
    public function update(Request $request, $id)
    {
        $connection = ConnectionRequest::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,survey,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        $connection->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.requests.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    // Hapus data pendaftaran
    public function destroy($id)
    {
        $connection = ConnectionRequest::findOrFail($id);
        $connection->delete();

        return redirect()->route('admin.requests.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
