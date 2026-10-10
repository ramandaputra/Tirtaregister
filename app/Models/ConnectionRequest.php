<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ConnectionRequest extends Model
{
    use LogsActivity;

    protected $fillable = [
        'connection_type',
        'registration_number',
        'full_name',
        'nik',
        'phone_number',
        'email',
        'kk_number',
        'kk_file_path',
        'occupation_id',
        'installation_address',
        'house_number',
        'rt',
        'rw',
        'village_id',
        'rayon_id',
        'latitude',
        'longitude',
        'purpose_id',
        'building_type_id',
        'ownership_id',
        'land_area',
        'building_area',
        'occupants_count',
        'water_source_id',
        'company_name',
        'facility_type_id',
        'ktp_file_path',
        'house_image_path',
        'status',
        'notes',
    ];
}
