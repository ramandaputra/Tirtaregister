<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    /**
     * Tampilan Dashboard Admin Pelayanan
     */
    public function dashboard()
    {
        // Statistik Pelanggan / Pendaftaran
        $totalPendaftaran = \App\Models\Pendaftaran::count();
        $totalPribadi = \App\Models\Pendaftaran::where('tipe', 'REGULER')->count();
        $totalFasilitasUmum = \App\Models\Pendaftaran::where('tipe', '!=', 'REGULER')->orWhereNull('tipe')->count();
        
        // Pendaftaran terbaru
        $recentRequests = \App\Models\Pendaftaran::orderBy('tgldaftar', 'desc')->take(5)->get();

        return view('admin.pelanggan.dashboard', compact(
            'totalPendaftaran',
            'totalPribadi',
            'totalFasilitasUmum',
            'recentRequests'
        ));
    }

    /**
     * Tampilan Daftar Pelanggan
     */
    public function index(Request $request)
    {
        $query = \App\Models\Pendaftaran::query();
        
        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nomorreg', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->orderBy('tgldaftar', 'desc')->paginate(15);
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Tampilan Daftar Prioritas (Fasilitas Umum)
     */
    public function prioritas(Request $request)
    {
        $query = \App\Models\Pendaftaran::where('tipe', '!=', 'REGULER')->orWhereNull('tipe');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nomorreg', 'like', '%' . $request->search . '%');
            });
        }

        $pelanggan = $query->orderBy('tgldaftar', 'desc')->paginate(15);
        return view('admin.pelanggan.prioritas', compact('pelanggan'));
    }
    /**
     * Tampilkan form Tambah Pelanggan
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Simpan data Pelanggan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomorreg' => 'required|unique:pendaftaran,nomorreg',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tipe' => 'nullable|string',
            'tgldaftar' => 'nullable|date',
        ]);

        \App\Models\Pendaftaran::create([
            'nomorreg' => $request->nomorreg,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tipe' => $request->tipe ?? 'REGULER',
            'tgldaftar' => $request->tgldaftar ?? now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data Pendaftaran berhasil ditambahkan!');
    }

    /**
     * Tampilkan form Edit Pelanggan
     */
    public function edit($id)
    {
        $pelanggan = \App\Models\Pendaftaran::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update data Pelanggan
     */
    public function update(Request $request, $id)
    {
        $pelanggan = \App\Models\Pendaftaran::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tipe' => 'nullable|string',
            'tgldaftar' => 'nullable|date',
        ]);

        $pelanggan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tipe' => $request->tipe ?? 'REGULER',
            'tgldaftar' => $request->tgldaftar,
        ]);

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data Pendaftaran berhasil diperbarui!');
    }

    /**
     * Hapus data Pelanggan
     */
    public function destroy($id)
    {
        $pelanggan = \App\Models\Pendaftaran::findOrFail($id);
        $pelanggan->delete();

        return redirect()->back()->with('success', 'Data Pendaftaran berhasil dihapus!');
    }

    /**
     * Detail Pelanggan
     */
    public function show($id)
    {
        $pelanggan = \App\Models\Pendaftaran::findOrFail($id);
        
        // Coba cari data upload & koordinat tambahan dari tabel connection_requests jika ada
        $connectionRequest = \App\Models\ConnectionRequest::where('registration_number', $id)->first();
        
        return view('admin.pelanggan.show', compact('pelanggan', 'connectionRequest'));
    }

    /**
     * Cetak Tanda Terima / Bukti Pendaftaran
     */
    public function print($id)
    {
        $pelanggan = \App\Models\Pendaftaran::findOrFail($id);
        $connectionRequest = \App\Models\ConnectionRequest::where('registration_number', $id)->first();
        $data = $connectionRequest ?? $pelanggan;
        return view('pendaftaran.receipt', compact('pelanggan', 'data'));
    }
}
