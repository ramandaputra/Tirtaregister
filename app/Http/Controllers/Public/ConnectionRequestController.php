<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConnectionRequest;
use App\Models\ConnectionRequest;
use App\Models\FacilityType;
use App\Models\Occupation;
use App\Models\Purpose;
use App\Models\Rayon;
use App\Models\Village;
use App\Models\WaterSource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConnectionRequestController extends Controller
{
    // Menampilkan halaman formulir Rumah Tangga
    public function createRumahTangga()
    {
        $occupations = Occupation::all();
        $villages = Village::all();
        $purposes = Purpose::all();
        $buildingTypes = DB::table('jenisbangunanpribadi')->get();
        $ownerships = DB::table('kepemilikan')->get();
        $waterSources = WaterSource::all();

        return view('public.register-rumah-tangga', compact('occupations', 'villages', 'purposes', 'buildingTypes', 'ownerships', 'waterSources'));
    }

    // Menampilkan halaman formulir Fasilitas Umum
    public function createFasilitasUmum()
    {
        $occupations = Occupation::all();
        $villages = Village::all();
        $purposes = Purpose::all();
        $buildingTypes = DB::table('jenisbangunanfasum')->get();
        $ownerships = DB::table('kepemilikanfasum')->get();
        $waterSources = WaterSource::all();
        $facilityTypes = FacilityType::all();

        return view('public.register-fasilitas-umum', compact('occupations', 'villages', 'purposes', 'buildingTypes', 'ownerships', 'waterSources', 'facilityTypes'));
    }

    // Endpoint AJAX untuk mendapatkan Rayon
    public function getRayons($villageId)
    {
        // Temukan kelurahan berdasarkan kodekelurahan
        $village = Village::where('kodekelurahan', $villageId)->first();
        
        $kodearea = $village ? $village->kodekecamatan : '-';

        // Filter rayon berdasarkan kodearea (kecamatan) dari kelurahan
        $rayons = Rayon::where('kodearea', $kodearea)->get()->map(function ($r) {
            return [
                'id' => $r->koderayon,
                'name' => $r->namarayon,
            ];
        });

        return response()->json($rayons);
    }

    // Menyimpan data pengajuan
    public function store(StoreConnectionRequest $request)
    {
        // 1. Upload Berkas KTP dan KK
        $ktpPath = $request->file('ktp_file') ? $request->file('ktp_file')->store('ktp_files', 'public') : null;
        $kkPath = $request->file('kk_file') ? $request->file('kk_file')->store('kk_files', 'public') : null;
        $houseImagePath = $request->file('house_image_file') ? $request->file('house_image_file')->store('house_images', 'public') : null;

        // 2. Generate Nomor Pendaftaran Unik (Melanjutkan urutan Pendaftaran)
        $regNumber = $this->generateRegistrationNumber();

        // 3. Simpan ke Database
        $connection = ConnectionRequest::create([
            'connection_type' => $request->connection_type,
            'registration_number' => $regNumber,
            'full_name' => $request->full_name,
            'nik' => $request->nik,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'kk_number' => $request->kk_number,
            'kk_file_path' => $kkPath,
            'occupation_id' => $request->occupation_id,

            'installation_address' => $request->installation_address,
            'house_number' => $request->house_number,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'village_id' => $request->village_id,
            'rayon_id' => $request->rayon_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'purpose_id' => $request->purpose_id,
            'building_type_id' => $request->building_type_id,
            'ownership_id' => $request->ownership_id,
            'land_area' => $request->land_area,
            'building_area' => $request->building_area,
            'occupants_count' => $request->occupants_count,
            'water_source_id' => $request->water_source_id,

            'company_name' => $request->company_name,
            'facility_type_id' => $request->facility_type_id,

            'ktp_file_path' => $ktpPath,
            'house_image_path' => $houseImagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('public.register.success', ['regNumber' => $regNumber])
            ->with('success', "Pendaftaran berhasil! Nomor Registrasi Anda: {$regNumber}");
    }

    private function generateRegistrationNumber()
    {
        $currentYear = date('Y');
        $romanMonths = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $currentMonthRoman = $romanMonths[date('n')];

        $maxNumber = 0;

        // Ambil nomor tertinggi dari ConnectionRequest tahun ini
        $latestCR = \App\Models\ConnectionRequest::where('registration_number', 'like', "%/REG/%/{$currentYear}")
            ->get();
        
        foreach ($latestCR as $cr) {
            $parts = explode('/', str_replace(' ', '', $cr->registration_number));
            if (isset($parts[0]) && is_numeric($parts[0])) {
                $num = (int)$parts[0];
                if ($num > $maxNumber) $maxNumber = $num;
            }
        }

        // Ambil nomor tertinggi dari Pendaftaran (legacy) tahun ini
        $latestPendaftaran = \App\Models\Pendaftaran::where('nomorreg', 'like', "%/REG/%/{$currentYear}")
            ->get();
            
        foreach ($latestPendaftaran as $p) {
            $parts = explode('/', str_replace(' ', '', $p->nomorreg));
            if (isset($parts[0]) && is_numeric($parts[0])) {
                $num = (int)$parts[0];
                if ($num > $maxNumber) $maxNumber = $num;
            }
        }

        $nextNumber = str_pad($maxNumber + 1, 4, '0', STR_PAD_LEFT);
        
        // Format standar: 0172/REG/1/X/2026
        return "{$nextNumber}/REG/1/{$currentMonthRoman}/{$currentYear}";
    }

    // Menampilkan halaman resi sukses
    public function success($regNumber)
    {
        $connectionRequest = ConnectionRequest::where('registration_number', $regNumber)->firstOrFail();
        return view('pendaftaran.receipt', [
            'data' => $connectionRequest,
            'auto_print' => true
        ]);
    }

    public function trackStatus(\Illuminate\Http\Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return response()->json(['success' => false, 'message' => 'Query tidak boleh kosong.'], 400);
        }

        // Cek di ConnectionRequest (Pendaftaran Baru)
        $cr = ConnectionRequest::where('registration_number', $query)
            ->orWhere('nik', $query)
            ->first();

        if ($cr) {
            $status = $cr->status ?? 'pending';
            $msg = 'Pengajuan sedang diproses (Status: ' . ucfirst($status) . ')';
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan: ' . $cr->full_name,
                'status' => $msg
            ]);
        }

        // Cek di Pendaftaran (Legacy)
        $legacy = \App\Models\Pendaftaran::where('nomorreg', $query)
            ->orWhere('nik', $query)
            ->first();
            
        if ($legacy) {
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan: ' . $legacy->nama,
                'status' => 'Terdaftar (Legacy)'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.'
        ], 404);
    }
}
