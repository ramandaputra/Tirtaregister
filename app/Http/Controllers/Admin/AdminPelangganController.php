<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    /**
     * Tampilan Dashboard Admin Pelayanan
     */
    public function dashboard()
    {
        // Statistik Pelanggan / Pendaftaran
        $totalPendaftaran = Pendaftaran::count();
        $totalPribadi = Pendaftaran::where('tipe', 'REGULER')->count();
        $totalFasilitasUmum = Pendaftaran::where('tipe', '!=', 'REGULER')->orWhereNull('tipe')->count();
        $totalTerpasang = Pendaftaran::where('flagpasang', 1)->count();
        $totalBelumTerpasang = Pendaftaran::where(function ($q) {
            $q->where('flagpasang', 0)->orWhereNull('flagpasang');
        })->count();

        // Pendaftaran terbaru
        $recentRequests = Pendaftaran::orderBy('tgldaftar', 'desc')->orderBy('nomorreg', 'desc')->take(5)->get();

        return view('admin.pelanggan.dashboard', compact(
            'totalPendaftaran',
            'totalPribadi',
            'totalFasilitasUmum',
            'totalTerpasang',
            'totalBelumTerpasang',
            'recentRequests'
        ));
    }

    /**
     * Tampilan Daftar Pelanggan
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::where('tipe', 'REGULER');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                    ->orWhere('nomorreg', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'terpasang') {
                $query->where('flagpasang', 1);
            } elseif ($request->status === 'belum') {
                $query->where(function ($q) {
                    $q->where('flagpasang', 0)->orWhereNull('flagpasang');
                });
            }
        }

        $pelanggan = $query->orderBy('tgldaftar', 'desc')->orderBy('nomorreg', 'desc')->paginate(15);

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Tampilan Daftar Prioritas (Fasilitas Umum)
     */
    public function prioritas(Request $request)
    {
        $query = Pendaftaran::where(function ($q) {
            $q->where('tipe', '!=', 'REGULER')->orWhereNull('tipe');
        });

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                    ->orWhere('nomorreg', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'terpasang') {
                $query->where('flagpasang', 1);
            } elseif ($request->status === 'belum') {
                $query->where(function ($q) {
                    $q->where('flagpasang', 0)->orWhereNull('flagpasang');
                });
            }
        }

        $pelanggan = $query->orderBy('tgldaftar', 'desc')->orderBy('nomorreg', 'desc')->paginate(15);

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

        $tipe = $request->tipe ?? 'REGULER';
        $resolved = Pendaftaran::resolveKelompokDanGolongan(null, $tipe);

        Pendaftaran::create([
            'nomorreg' => $request->nomorreg,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tipe' => $tipe,
            'golongan' => $resolved['golongan'],
            'kelompok_pelanggan_id' => $resolved['kelompok_pelanggan_id'],
            'golongan_pelanggan_id' => $resolved['golongan_pelanggan_id'],
            'tgldaftar' => $request->tgldaftar ?? now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data Pendaftaran berhasil ditambahkan!');
    }

    /**
     * Tampilkan form Edit Pelanggan
     */
    public function edit($id)
    {
        $pelanggan = Pendaftaran::findOrFail($id);

        $currentStatus = 'proses';
        if ($pelanggan->flagproblem == 1) {
            $currentStatus = 'bermasalah';
        } elseif ($pelanggan->flagpasang == 1) {
            $currentStatus = 'terpasang';
        }

        return view('admin.pelanggan.edit', compact('pelanggan', 'currentStatus'));
    }

    /**
     * Update data Pelanggan
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pendaftaran::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tipe' => 'nullable|string',
            'tgldaftar' => 'nullable|date',
            'status' => 'required|in:terpasang,proses,bermasalah',
            'keterangan_problem' => 'nullable|string|max:500',
        ]);

        $status = $request->status;
        $flagPasang = $status === 'terpasang' ? 1 : 0;
        $flagProblem = $status === 'bermasalah' ? 1 : 0;
        $keteranganProblem = $status === 'bermasalah' ? $request->keterangan_problem : null;
        $tipe = $request->tipe ?? $pelanggan->tipe ?? 'REGULER';
        $resolved = Pendaftaran::resolveKelompokDanGolongan($pelanggan->jenisbangunan, $tipe);

        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tipe' => $tipe,
            'golongan' => $resolved['golongan'],
            'kelompok_pelanggan_id' => $resolved['kelompok_pelanggan_id'],
            'golongan_pelanggan_id' => $resolved['golongan_pelanggan_id'],
            'tgldaftar' => $request->tgldaftar,
            'flagpasang' => $flagPasang,
            'flagproblem' => $flagProblem,
            'keterangan_problem' => $keteranganProblem,
        ];

        $pelanggan->update($updateData);

        // Sinkronkan ke ConnectionRequest jika ada
        $cr = ConnectionRequest::where('registration_number', $id)->first();
        if ($cr) {
            $crStatus = match ($status) {
                'terpasang' => 'approved',
                'bermasalah' => 'rejected',
                default => 'pending',
            };
            $cr->update([
                'status' => $crStatus,
                'notes' => $keteranganProblem ?? $cr->notes,
            ]);
        }

        if (function_exists('logActivity')) {
            $statusLabel = match ($status) {
                'terpasang' => 'Sudah Terpasang',
                'bermasalah' => 'Bermasalah',
                default => 'Dalam Proses',
            };
            logActivity('UPDATE_PELANGGAN', "Memperbarui data & status pelanggan {$pelanggan->nomorreg} (Status: {$statusLabel})", 'Pendaftaran', $pelanggan->id ?? null);
        }

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pendaftaran dan status berhasil diperbarui!');
    }

    /**
     * Update status pemasangan saja (Quick Update)
     */
    public function updateStatus(Request $request, $id)
    {
        $pelanggan = Pendaftaran::findOrFail($id);

        $request->validate([
            'status' => 'required|in:terpasang,proses,bermasalah',
            'keterangan_problem' => 'nullable|string|max:500',
        ]);

        $status = $request->status;
        $flagPasang = $status === 'terpasang' ? 1 : 0;
        $flagProblem = $status === 'bermasalah' ? 1 : 0;
        $keteranganProblem = $status === 'bermasalah' ? $request->keterangan_problem : null;

        $pelanggan->update([
            'flagpasang' => $flagPasang,
            'flagproblem' => $flagProblem,
            'keterangan_problem' => $keteranganProblem,
        ]);

        // Sinkronkan ke ConnectionRequest jika ada
        $cr = ConnectionRequest::where('registration_number', $id)->first();
        if ($cr) {
            $crStatus = match ($status) {
                'terpasang' => 'approved',
                'bermasalah' => 'rejected',
                default => 'pending',
            };
            $cr->update([
                'status' => $crStatus,
                'notes' => $keteranganProblem ?? $cr->notes,
            ]);
        }

        if (function_exists('logActivity')) {
            $statusLabel = match ($status) {
                'terpasang' => 'Sudah Terpasang',
                'bermasalah' => 'Bermasalah',
                default => 'Dalam Proses',
            };
            logActivity('UPDATE_STATUS', "Memperbarui status pendaftaran {$pelanggan->nomorreg} menjadi {$statusLabel}", 'Pendaftaran', $pelanggan->id ?? null);
        }

        return redirect()->back()->with('success', 'Status pendaftaran pelanggan berhasil diperbarui!');
    }

    /**
     * Hapus data Pelanggan
     */
    public function destroy($id)
    {
        $pelanggan = Pendaftaran::findOrFail($id);
        $pelanggan->delete();

        // Hapus juga dari ConnectionRequest jika ada
        $cr = ConnectionRequest::where('registration_number', $id)->first();
        if ($cr) {
            $cr->delete();
        }

        return redirect()->back()->with('success', 'Data Pendaftaran berhasil dihapus!');
    }

    /**
     * Detail Pelanggan
     */
    public function show($id)
    {
        $pelanggan = Pendaftaran::findOrFail($id);

        // Coba cari data upload & koordinat tambahan dari tabel connection_requests jika ada
        $connectionRequest = ConnectionRequest::where('registration_number', $id)->first();

        return view('admin.pelanggan.show', compact('pelanggan', 'connectionRequest'));
    }

    /**
     * Cetak Tanda Terima / Bukti Pendaftaran
     */
    public function print($id)
    {
        $pelanggan = Pendaftaran::findOrFail($id);
        $connectionRequest = ConnectionRequest::where('registration_number', $id)->first();
        $data = $connectionRequest ?? $pelanggan;

        return view('pendaftaran.receipt', compact('pelanggan', 'data'));
    }
}
