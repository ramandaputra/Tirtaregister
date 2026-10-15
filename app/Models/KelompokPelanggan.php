<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokPelanggan extends Model
{
    protected $table = 'kelompok_pelanggan';

    public $timestamps = false;

    protected $guarded = [];

    public function golongan()
    {
        return $this->hasMany(GolonganPelanggan::class, 'kelompok_id');
    }
}
