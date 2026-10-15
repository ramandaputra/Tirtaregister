<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GolonganPelanggan extends Model
{
    protected $table = 'golongan_pelanggan';

    public $timestamps = false;

    protected $guarded = [];

    public function kelompok()
    {
        return $this->belongsTo(KelompokPelanggan::class, 'kelompok_id');
    }
}
