<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConnectionRequest;
use App\Models\ConnectionRequest;
use Illuminate\Support\Str;

class ConnectionRequestController extends Controller
{
    // Menampilkan halaman formulir Rumah Tangga
    public function createRumahTangga()
    {
        $occupations = \App\Models\Occupation::all();
        $villages = \App\Models\Village::all();
        $purposes = \App\Models\Purpose::all();
        $buildingTypes = \App\Models\BuildingType::all();
        $ownerships = \App\Models\Ownership::all();
        $waterSources = \App\Models\WaterSource::all();

        return view('public.register-rumah-tangga', compact('occupations', 'villages', 'purposes', 'buildingTypes', 'ownerships', 'waterSources'));
    }

    // Menampilkan halaman formulir Fasilitas Umum
    public function createFasilitasUmum()
    {
        $occupations = \App\Models\Occupation::all();
        $villages = \App\Models\Village::all();
        $purposes = \App\Models\Purpose::all();
        $buildingTypes = \App\Models\BuildingType::all();
        $ownerships = \App\Models\Ownership::all();
        $waterSources = \App\Models\WaterSource::all();
        $facilityTypes = \App\Models\FacilityType::all();

        return view('public.register-fasilitas-umum', compact('occupations', 'villages', 'purposes', 'buildingTypes', 'ownerships', 'waterSources', 'facilityTypes'));
    }

    // Endpoint AJAX untuk mendapatkan Rayon berdasarkan Village
    public function getRayons($villageId)
    {
        $rayons = \App\Models\Rayon::where('village_id', $villageId)->get();
        return response()->json($rayons);
    }

    // Menyimpan data pengajuan
    public function store(StoreConnectionRequest $request)
    {
        // 1. Upload Berkas KTP dan KK
        $ktpPath = $request->file('ktp_file') ? $request->file('ktp_file')->store('ktp_files', 'public') : null;
        $kkPath = $request->file('kk_file') ? $request->file('kk_file')->store('kk_files', 'public') : null;

        // 2. Generate Nomor Pendaftaran Unik
        $regNumber = 'REG-' . date('Ym') . '-' . strtoupper(Str::random(4));

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
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', "Pendaftaran berhasil! Nomor Registrasi Anda: {$regNumber}");
    }
}