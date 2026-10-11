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
            'nik' => 'required|string|min:10|max:25',
            'phone_number' => 'required|string|max:25',
            'email' => 'nullable|email|max:255',
            'kk_number' => 'required|string|min:10|max:25',
            'occupation_id' => 'required',
            'ktp_file' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'kk_file' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'house_image_file' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',

            'installation_address' => 'required|string',
            'house_number' => 'required|string|max:50',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'village_id' => 'required|string',
            'rayon_id' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',

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

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'mimes' => 'Format file :attribute harus berupa jpg, jpeg, png, webp, atau pdf.',
            'max' => 'Ukuran atau panjang :attribute melebihi batas maksimal.',
        ];
    }
}
