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
            'full_name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'phone_number' => 'required|string|max:15',
            'installation_address' => 'required|string',
            'ktp_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Max 2MB
        ];
    }
}