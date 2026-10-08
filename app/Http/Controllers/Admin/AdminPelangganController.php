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
        $totalPendaftaran = ConnectionRequest::count();
        $totalPribadi = ConnectionRequest::where('connection_type', 'pribadi')->count();
        $totalFasilitasUmum = ConnectionRequest::where('connection_type', 'fasilitas_umum')->count();
        
        // Pendaftaran terbaru
        $recentRequests = ConnectionRequest::latest()->take(5)->get();

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
        $query = ConnectionRequest::query();
        
        if ($request->has('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%');
        }

        $pelanggan = $query->latest()->paginate(15);
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Tampilan Daftar Prioritas (Fasilitas Umum)
     */
    public function prioritas(Request $request)
    {
        $query = ConnectionRequest::where('connection_type', 'fasilitas_umum');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%');
            });
        }

        $pelanggan = $query->latest()->paginate(15);
        return view('admin.pelanggan.prioritas', compact('pelanggan'));
    }

    /**
     * Detail Pelanggan
     */
    public function show($id)
    {
        $pelanggan = ConnectionRequest::findOrFail($id);
        return view('admin.pelanggan.show', compact('pelanggan'));
    }
}
