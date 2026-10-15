<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $primaryKey = 'nomorreg';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saving(function (Pendaftaran $pendaftaran) {
            $resolved = static::resolveKelompokDanGolongan(
                $pendaftaran->jenisbangunan ?? null,
                $pendaftaran->tipe ?? null
            );

            if (empty($pendaftaran->attributes['golongan'])) {
                $pendaftaran->attributes['golongan'] = $resolved['golongan'];
            }

            try {
                if (Schema::hasColumn('pendaftaran', 'golongan_pelanggan_id') && empty($pendaftaran->attributes['golongan_pelanggan_id'])) {
                    $pendaftaran->attributes['golongan_pelanggan_id'] = $resolved['golongan_pelanggan_id'];
                }
                if (Schema::hasColumn('pendaftaran', 'kelompok_pelanggan_id') && empty($pendaftaran->attributes['kelompok_pelanggan_id'])) {
                    $pendaftaran->attributes['kelompok_pelanggan_id'] = $resolved['kelompok_pelanggan_id'];
                }
            } catch (\Throwable $e) {
                // Ignore
            }
        });
    }

    /**
     * Resolusi golongan, golongan_pelanggan_id, dan kelompok_pelanggan_id secara otomatis
     */
    public static function resolveKelompokDanGolongan(?string $jenisbangunan, ?string $tipe): array
    {
        $golongan = static::determineGolongan($jenisbangunan, $tipe);
        $golonganPelangganId = null;
        $kelompokPelangganId = null;

        if (! empty($jenisbangunan)) {
            try {
                if (DB::getSchemaBuilder()->hasTable('jenisbangunanpribadi')) {
                    $pribadi = DB::table('jenisbangunanpribadi')
                        ->where('jenis', $jenisbangunan)
                        ->first();

                    if ($pribadi && ! empty($pribadi->golongan_pelanggan_id)) {
                        $golonganPelangganId = $pribadi->golongan_pelanggan_id;
                        $kelompokPelangganId = 2;
                    }
                }

                if (! $golonganPelangganId && DB::getSchemaBuilder()->hasTable('jenisbangunanfasum')) {
                    $fasum = DB::table('jenisbangunanfasum')
                        ->where('jenis', $jenisbangunan)
                        ->first();

                    if ($fasum && ! empty($fasum->golongan_pelanggan_id)) {
                        $golonganPelangganId = $fasum->golongan_pelanggan_id;
                        $golModel = DB::table('golongan_pelanggan')->where('id', $golonganPelangganId)->first();
                        $kelompokPelangganId = $golModel->kelompok_id ?? 1;
                    }
                }
            } catch (\Throwable $e) {
                // Fallback
            }
        }

        if (! $golonganPelangganId) {
            if ($tipe === 'PRIORITAS') {
                $golonganPelangganId = 3;
                $kelompokPelangganId = 1;
            } else {
                $golonganPelangganId = 6;
                $kelompokPelangganId = 2;
            }
        }

        return [
            'golongan' => $golongan,
            'golongan_pelanggan_id' => $golonganPelangganId,
            'kelompok_pelanggan_id' => $kelompokPelangganId,
        ];
    }

    /**
     * Tentukan golongan secara otomatis oleh sistem berdasarkan jenis bangunan dan tipe sambungan.
     */
    public static function determineGolongan(?string $jenisbangunan, ?string $tipe): string
    {
        if (! empty($jenisbangunan)) {
            try {
                if (DB::getSchemaBuilder()->hasTable('jenisbangunanpribadi')) {
                    $pribadi = DB::table('jenisbangunanpribadi')
                        ->where('jenis', $jenisbangunan)
                        ->value('kodegol');

                    if ($pribadi) {
                        return $pribadi;
                    }
                }

                if (DB::getSchemaBuilder()->hasTable('jenisbangunanfasum')) {
                    $fasum = DB::table('jenisbangunanfasum')
                        ->where('jenis', $jenisbangunan)
                        ->value('kodegol');

                    if ($fasum) {
                        return $fasum;
                    }
                }
            } catch (\Throwable $e) {
                // Fallback default
            }
        }

        return ($tipe === 'PRIORITAS') ? 'IB' : 'IIA';
    }

    public function getGolonganAttribute(?string $value): ?string
    {
        if (! empty($value)) {
            return $value;
        }

        return static::determineGolongan($this->jenisbangunan ?? null, $this->tipe ?? null);
    }

    public function kelompokPelanggan()
    {
        return $this->belongsTo(KelompokPelanggan::class, 'kelompok_pelanggan_id');
    }

    public function golonganPelanggan()
    {
        return $this->belongsTo(GolonganPelanggan::class, 'golongan_pelanggan_id');
    }
}
