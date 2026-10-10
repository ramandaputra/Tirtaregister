<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConnectionRequest;
use App\Models\ConnectionRequest;
use App\Models\FacilityType;
use App\Models\Occupation;
use App\Models\Pendaftaran;
use App\Models\Purpose;
use App\Models\Rayon;
use App\Models\WaterSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConnectionRequestController extends Controller
{
    public function createRumahTangga()
    {
        $occupations = DB::table('pekerjaan')->get();
        $villages = DB::table('kodwil26')
            ->select('kelurahan as kodekelurahan', 'kelurahan', 'kecamatan as kodekecamatan')
            ->groupBy('kelurahan', 'kecamatan')
            ->orderByRaw('MIN(koderayon) ASC')
            ->get();
        $purposes = Purpose::all();
        $buildingTypes = DB::table('jenisbangunanpribadi')->get();
        $ownerships = DB::table('kepemilikan')->get();
        $waterSources = WaterSource::all();

        return view('public.register-rumah-tangga', compact('occupations', 'villages', 'purposes', 'buildingTypes', 'ownerships', 'waterSources'));
    }

    public function createFasilitasUmum()
    {
        $occupations = DB::table('pekerjaan')->get();
        $villages = DB::table('kodwil26')
            ->select('kelurahan as kodekelurahan', 'kelurahan', 'kecamatan as kodekecamatan')
            ->groupBy('kelurahan', 'kecamatan')
            ->orderByRaw('MIN(koderayon) ASC')
            ->get();
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
        $rayons = DB::table('kodwil26')
            ->where('kelurahan', $villageId)
            ->select('koderayon as id', 'namarayon as name')
            ->orderBy('namarayon')
            ->get();

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

        // Ambil nama dari relasi jika ada
        $occupationName = DB::table('pekerjaan')->where('id', $request->occupation_id)->first()->name ?? null;
        $waterSourceName = WaterSource::find($request->water_source_id)->name ?? null;
        $namaRayon = DB::table('kodwil26')->where('koderayon', $request->rayon_id)->first()->namarayon ?? $request->rayon_id;

        // 4. Sinkronisasi ke tabel Pendaftaran (Legacy) agar muncul di "Daftar Pelanggan"
        Pendaftaran::create([
            'nomorreg' => $regNumber,
            'nama' => $request->full_name,
            'no_ktp' => $request->nik,
            'alamat' => $request->installation_address,
            'hp' => $request->phone_number,
            'email' => $request->email,
            'no_kk' => $request->kk_number,
            'norumah' => $request->house_number,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'koderayon' => $request->rayon_id,
            'namarayon' => $namaRayon,
            'kodekelurahan' => $request->village_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'luas_tanah' => $request->land_area,
            'luas_rumah' => $request->building_area,
            'penghuni' => $request->occupants_count,
            'pekerjaan' => $occupationName,
            'jenisbangunan' => $request->building_type_id,
            'peruntukan' => $request->purpose_id,
            'kepemilikan' => $request->ownership_id,
            'airyangdigunakansaatini' => $waterSourceName,
            'tipe' => ($request->connection_type == 'Rumah Tangga' || $request->connection_type == 'rumah-tangga') ? 'REGULER' : 'PRIORITAS',
            'tgldaftar' => now()->format('Y-m-d H:i:s'),
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

        // Ambil nomor tertinggi dari ConnectionRequest bulan dan tahun ini
        $latestCR = ConnectionRequest::where('registration_number', 'like', "%/REG/%/{$currentYear}")
            ->get();

        foreach ($latestCR as $cr) {
            $parts = explode('/', str_replace(' ', '', $cr->registration_number));
            // parts[0] = XXXX, parts[1] = REG, parts[2] = Rayon, parts[3] = Bulan, parts[4] = Tahun
            if (isset($parts[3]) && $parts[3] === $currentMonthRoman && isset($parts[0]) && is_numeric($parts[0])) {
                $num = (int) $parts[0];
                if ($num > $maxNumber) {
                    $maxNumber = $num;
                }
            }
        }

        // Ambil nomor tertinggi dari Pendaftaran (legacy) bulan dan tahun ini
        $latestPendaftaran = Pendaftaran::where('nomorreg', 'like', "%/REG/%/{$currentYear}")
            ->get();

        foreach ($latestPendaftaran as $p) {
            $parts = explode('/', str_replace(' ', '', $p->nomorreg));
            if (isset($parts[3]) && $parts[3] === $currentMonthRoman && isset($parts[0]) && is_numeric($parts[0])) {
                $num = (int) $parts[0];
                if ($num > $maxNumber) {
                    $maxNumber = $num;
                }
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
            'auto_print' => true,
        ]);
    }

    public function previewReceipt($regNumber)
    {
        $connectionRequest = ConnectionRequest::where('registration_number', $regNumber)->firstOrFail();

        return view('pendaftaran.receipt', [
            'data' => $connectionRequest,
            'auto_print' => false,
            'is_preview' => true,
        ]);
    }

    public function trackStatus(Request $request)
    {
        $query = $request->input('query');
        if (! $query) {
            return response()->json(['success' => false, 'message' => 'Query tidak boleh kosong.'], 400);
        }

        // Cek di ConnectionRequest (Pendaftaran Baru)
        $cr = ConnectionRequest::where('registration_number', $query)
            ->orWhere('nik', $query)
            ->first();

        if ($cr) {
            $status = $cr->status ?? 'pending';
            $msg = 'Pengajuan sedang diproses (Status: '.ucfirst($status).')';
            $receiptUrl = route('public.track.receipt', ['regNumber' => $cr->registration_number]);

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan: '.$cr->full_name,
                'status' => $msg,
                'receipt_url' => $receiptUrl,
            ]);
        }

        // Cek di Pendaftaran (Legacy)
        $legacy = Pendaftaran::where('nomorreg', $query)
            ->orWhere('no_ktp', $query)
            ->first();

        if ($legacy) {
            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan: '.$legacy->nama,
                'status' => 'Terdaftar (Legacy)',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.',
        ], 404);
    }
}

