<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConnectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Izinkan publik tanpa autentikasi
    }

    public function rules(): array
    {
        return [
            'connection_type' => 'required|string|in:Rumah Tangga,Fasilitas Umum',
            'full_name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'kk_number' => 'required|numeric|digits:16',
            'occupation_id' => 'required|exists:pekerjaan,id',
            'ktp_file' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Max 2MB
            'kk_file' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Max 2MB
            'house_image_file' => 'required|file|mimes:jpg,jpeg,png|max:5120', // Foto Rumah (Max 5MB)

            'installation_address' => 'required|string',
            'house_number' => 'required|string|max:50',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'village_id' => 'required|exists:kodwil26,kelurahan',
            'rayon_id' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',

            'purpose_id' => 'required|string',
            'building_type_id' => 'required|string',
            'ownership_id' => 'required|string',
            'land_area' => 'required|numeric|min:0',
            'building_area' => 'required|numeric|min:0',
            'occupants_count' => 'required|numeric|min:0',
            'water_source_id' => 'required|string',

            'company_name' => 'nullable|required_if:connection_type,Fasilitas Umum|string|max:255',
            'facility_type_id' => 'nullable|required_if:connection_type,Fasilitas Umum|string',
        ];
    }
}
