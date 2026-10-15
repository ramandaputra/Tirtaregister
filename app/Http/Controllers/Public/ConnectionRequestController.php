<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConnectionRequest;
use App\Models\ConnectionRequest;
use App\Models\FacilityType;
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
        $purposes = Purpose::whereRaw('LOWER(peruntukan) != ?', ['kantor'])->get();
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

        $rayonVal = $request->rayon_id ?: ($request->village_id ?: 'JL. SAMUDERA');
        $latVal = $request->latitude ?: '0.9167';
        $lngVal = $request->longitude ?: '104.4500';

        // 3. Simpan ke Database
        $tipe = ($request->connection_type == 'Rumah Tangga' || $request->connection_type == 'rumah-tangga') ? 'REGULER' : 'PRIORITAS';
        $resolved = Pendaftaran::resolveKelompokDanGolongan($request->building_type_id, $tipe);

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
            'rayon_id' => $rayonVal,
            'latitude' => $latVal,
            'longitude' => $lngVal,

            'purpose_id' => $request->purpose_id,
            'building_type_id' => $request->building_type_id,
            'ownership_id' => $request->ownership_id,
            'land_area' => $request->land_area,
            'building_area' => $request->building_area,
            'occupants_count' => $request->occupants_count,
            'water_source_id' => $request->water_source_id,

            'company_name' => $request->company_name,
            'facility_type_id' => $request->facility_type_id,
            'kelompok_pelanggan_id' => $resolved['kelompok_pelanggan_id'],
            'golongan_pelanggan_id' => $resolved['golongan_pelanggan_id'],

            'ktp_file_path' => $ktpPath,
            'house_image_path' => $houseImagePath,
            'status' => 'pending',
        ]);

        // Ambil nama dari relasi jika ada
        $occupationName = DB::table('pekerjaan')->where('id', $request->occupation_id)->first()->name ?? $request->occupation_id;
        $waterSourceName = WaterSource::find($request->water_source_id)->name ?? $request->water_source_id;
        $namaRayon = DB::table('kodwil26')->where('koderayon', $rayonVal)->first()->namarayon ?? $rayonVal;

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
            'koderayon' => $rayonVal,
            'namarayon' => $namaRayon,
            'kodekelurahan' => $request->village_id,
            'latitude' => $latVal,
            'longitude' => $lngVal,
            'luas_tanah' => $request->land_area,
            'luas_rumah' => $request->building_area,
            'penghuni' => $request->occupants_count,
            'pekerjaan' => $occupationName,
            'jenisbangunan' => $request->building_type_id,
            'peruntukan' => $request->purpose_id,
            'kepemilikan' => $request->ownership_id,
            'airyangdigunakansaatini' => $waterSourceName,
            'tipe' => $tipe,
            'golongan' => $resolved['golongan'],
            'kelompok_pelanggan_id' => $resolved['kelompok_pelanggan_id'],
            'golongan_pelanggan_id' => $resolved['golongan_pelanggan_id'],
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
        $latestCR = ConnectionRequest::where('registration_number', 'like', "%/REG/%/{$currentMonthRoman}/{$currentYear}")
            ->get();

        foreach ($latestCR as $cr) {
            $parts = explode('/', str_replace(' ', '', $cr->registration_number));
            if (isset($parts[0]) && is_numeric($parts[0])) {
                $num = (int) $parts[0];
                if ($num > $maxNumber) {
                    $maxNumber = $num;
                }
            }
        }

        // Ambil nomor tertinggi dari Pendaftaran (legacy) bulan dan tahun ini
        $latestPendaftaran = Pendaftaran::where('nomorreg', 'like', "%/REG/%/{$currentMonthRoman}/{$currentYear}")
            ->get();

        foreach ($latestPendaftaran as $p) {
            $parts = explode('/', str_replace(' ', '', $p->nomorreg));
            if (isset($parts[0]) && is_numeric($parts[0])) {
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
        $connectionRequest = ConnectionRequest::where('registration_number', $regNumber)->first()
            ?? Pendaftaran::where('nomorreg', $regNumber)->firstOrFail();

        return view('pendaftaran.receipt', [
            'data' => $connectionRequest,
            'auto_print' => true,
        ]);
    }

    public function previewReceipt($regNumber)
    {
        $connectionRequest = ConnectionRequest::where('registration_number', $regNumber)->first()
            ?? Pendaftaran::where('nomorreg', $regNumber)->firstOrFail();

        return view('pendaftaran.receipt', [
            'data' => $connectionRequest,
            'auto_print' => false,
            'is_preview' => true,
        ]);
    }

    public function trackStatus(Request $request)
    {
        $rawQuery = $request->input('query');
        $clean = trim((string) $rawQuery);
        if ($clean === '') {
            return response()->json(['success' => false, 'message' => 'Query tidak boleh kosong.'], 400);
        }

        // Variasi format input pencarian
        $slashVariant = preg_replace('/\s*[\/\-\\\\]\s*/', '/', $clean);
        $digitsOnly = preg_replace('/[^0-9]/', '', $clean);
        $paddedNum = (strlen($digitsOnly) >= 1 && strlen($digitsOnly) <= 4)
            ? str_pad($digitsOnly, 4, '0', STR_PAD_LEFT)
            : null;

        // 1. Cek di ConnectionRequest (Pendaftaran Baru)
        $cr = ConnectionRequest::where(function ($q) use ($clean, $slashVariant, $digitsOnly, $paddedNum) {
            $q->where('registration_number', $clean)
                ->orWhere('registration_number', $slashVariant)
                ->orWhere('registration_number', 'like', $clean.'%')
                ->orWhere('registration_number', 'like', $slashVariant.'%')
                ->orWhere('nik', $clean);

            if (! empty($digitsOnly)) {
                $q->orWhere('nik', $digitsOnly)
                    ->orWhere('phone_number', $digitsOnly)
                    ->orWhere('phone_number', 'like', '%'.$digitsOnly);
            }

            if (! empty($paddedNum)) {
                $q->orWhere('registration_number', 'like', $paddedNum.'/%')
                    ->orWhere('registration_number', 'like', '%'.$paddedNum.'%');
            }

            if (strlen($clean) >= 3 && ! is_numeric($clean)) {
                $q->orWhere('full_name', 'like', '%'.$clean.'%');
            }
        })->latest()->first();

        if ($cr) {
            $status = $cr->status ?? 'pending';
            $statusLabel = match (strtolower($status)) {
                'approved', 'disetujui' => 'Disetujui',
                'rejected', 'ditolak' => 'Ditolak',
                'verified', 'terverifikasi' => 'Terverifikasi',
                'completed', 'selesai' => 'Selesai Dipasang',
                default => 'Sedang Diproses',
            };
            $msg = 'Pengajuan sedang diproses (Status: '.$statusLabel.')';
            $receiptUrl = route('public.track.receipt', ['regNumber' => $cr->registration_number]);

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan: '.$cr->full_name,
                'status' => $msg,
                'reg_number' => $cr->registration_number,
                'golongan' => $cr->golongan,
                'receipt_url' => $receiptUrl,
            ]);
        }

        // 2. Cek di Pendaftaran (Data Pelanggan / Legacy)
        $legacy = Pendaftaran::where(function ($q) use ($clean, $slashVariant, $digitsOnly, $paddedNum) {
            $q->where('nomorreg', $clean)
                ->orWhere('nomorreg', $slashVariant)
                ->orWhere('nomorreg', 'like', $clean.'%')
                ->orWhere('nomorreg', 'like', $slashVariant.'%')
                ->orWhere('no_ktp', $clean);

            if (! empty($digitsOnly)) {
                $q->orWhere('no_ktp', $digitsOnly)
                    ->orWhere('hp', $digitsOnly)
                    ->orWhere('hp', 'like', '%'.$digitsOnly);
            }

            if (! empty($paddedNum)) {
                $q->orWhere('nomorreg', 'like', $paddedNum.'/%')
                    ->orWhere('nomorreg', 'like', '%'.$paddedNum.'%');
            }

            if (strlen($clean) >= 3 && ! is_numeric($clean)) {
                $q->orWhere('nama', 'like', '%'.$clean.'%');
            }
        })->orderBy('tgldaftar', 'desc')->first();

        if ($legacy) {
            $receiptUrl = route('public.track.receipt', ['regNumber' => $legacy->nomorreg]);
            $tipe = $legacy->tipe ?: 'REGULER';

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan: '.$legacy->nama,
                'status' => 'Terdaftar (Tipe: '.$tipe.')',
                'reg_number' => $legacy->nomorreg,
                'golongan' => $legacy->golongan,
                'receipt_url' => $receiptUrl,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.',
        ], 404);
    }
}
