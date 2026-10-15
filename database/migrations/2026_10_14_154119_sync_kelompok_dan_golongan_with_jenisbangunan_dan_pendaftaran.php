<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah kolom kodegol di golongan_pelanggan
        if (Schema::hasTable('golongan_pelanggan') && ! Schema::hasColumn('golongan_pelanggan', 'kodegol')) {
            Schema::table('golongan_pelanggan', function (Blueprint $table) {
                $table->string('kodegol', 20)->nullable()->after('nama_golongan');
            });
        }

        // Isi kodegol standar PDAM
        $kodeGolMap = [
            1 => 'IA',
            2 => 'IA',
            3 => 'IB',
            4 => 'IB',
            5 => 'IB',
            6 => 'IIA',
            7 => 'IIB',
            8 => 'IIC',
            9 => 'IID',
            10 => 'IIIA',
            11 => 'IIB',
            12 => 'IIIA',
            13 => 'IIIA',
            14 => 'IIIB',
            15 => 'IIIC',
            16 => 'IVA',
            17 => 'V',
            18 => 'KHUSUS-1',
            19 => 'KHUSUS-2',
        ];

        foreach ($kodeGolMap as $id => $kode) {
            DB::table('golongan_pelanggan')->where('id', $id)->update(['kodegol' => $kode]);
        }

        // 2. Hubungkan jenisbangunanpribadi dengan golongan_pelanggan
        if (Schema::hasTable('jenisbangunanpribadi')) {
            if (! Schema::hasColumn('jenisbangunanpribadi', 'golongan_pelanggan_id')) {
                Schema::table('jenisbangunanpribadi', function (Blueprint $table) {
                    $table->unsignedInteger('golongan_pelanggan_id')->nullable()->after('kodegol');
                });
            }

            DB::table('jenisbangunanpribadi')->where('jenis', 'RUMAH BIASA')->update(['golongan_pelanggan_id' => 6]);
            DB::table('jenisbangunanpribadi')->where('jenis', 'KONTRAKAN')->update(['golongan_pelanggan_id' => 7]);
            DB::table('jenisbangunanpribadi')->where('jenis', 'KOS')->update(['golongan_pelanggan_id' => 7]);
            DB::table('jenisbangunanpribadi')->where('jenis', 'WARUNG/KEDAI/KIOS')->update(['golongan_pelanggan_id' => 13]);
        }

        // 3. Hubungkan jenisbangunanfasum dengan golongan_pelanggan
        if (Schema::hasTable('jenisbangunanfasum')) {
            if (! Schema::hasColumn('jenisbangunanfasum', 'golongan_pelanggan_id')) {
                Schema::table('jenisbangunanfasum', function (Blueprint $table) {
                    $table->unsignedInteger('golongan_pelanggan_id')->nullable()->after('kodegol');
                });
            }

            $fasumMap = [
                'HIDRANT UMUM' => 1,
                'KAMAR MANDI UMUM' => 2,
                'WC UMUM' => 2,
                'PEMAKAMAN' => 3,
                'TERMINAL UMUM' => 17,
                'BANK SAMPAH' => 3,
                'KLINIK PEMERINTAH' => 5,
                'PUSKESMAS' => 5,
                'RUMAH SAKIT PEMERINTAH' => 5,
                'PANTI ASUHAN' => 3,
                'SEKOLAH' => 3,
                'TEMPAT IBADAH' => 3,
                'YAYASAN SOSIAL' => 3,
                'KANTOR INSTANSI PEMERINTAH,TNI,POLRI' => 11,
                'RUMAH INSTANSI MILIK PEMERINTAH,TNI,POLRI' => 11,
                'LEMBAGA PERGURUAN, KURSUS SWASTA' => 10,
                'RUMAH SAKIT, KLINIK SWASTA' => 12,
                'GEDUNG ACARA' => 14,
                'GELANGGANG OLAHRAGA' => 14,
                'KOLAM RENANG' => 14,
                'KANTIN SEKOLAH' => 13,
                'PELABUHAN DARAT, LAUT, UDARA, SUNGAI' => 17,
            ];

            foreach ($fasumMap as $jenis => $golId) {
                DB::table('jenisbangunanfasum')->where('jenis', $jenis)->update(['golongan_pelanggan_id' => $golId]);
            }
        }

        // 4. Tambah kolom relasi di tabel pendaftaran
        if (Schema::hasTable('pendaftaran')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                if (! Schema::hasColumn('pendaftaran', 'kelompok_pelanggan_id')) {
                    $table->unsignedInteger('kelompok_pelanggan_id')->nullable()->after('golongan');
                }
                if (! Schema::hasColumn('pendaftaran', 'golongan_pelanggan_id')) {
                    $table->unsignedInteger('golongan_pelanggan_id')->nullable()->after('kelompok_pelanggan_id');
                }
            });

            // Sinkronisasi data lama pendaftaran
            // A. Dari jenisbangunanpribadi
            if (Schema::hasTable('jenisbangunanpribadi')) {
                $pribadiItems = DB::table('jenisbangunanpribadi')->whereNotNull('golongan_pelanggan_id')->get();
                foreach ($pribadiItems as $item) {
                    DB::table('pendaftaran')
                        ->where('jenisbangunan', $item->jenis)
                        ->whereNull('golongan_pelanggan_id')
                        ->update([
                            'golongan_pelanggan_id' => $item->golongan_pelanggan_id,
                            'kelompok_pelanggan_id' => 2,
                        ]);
                }
            }

            // B. Dari jenisbangunanfasum
            if (Schema::hasTable('jenisbangunanfasum') && Schema::hasTable('golongan_pelanggan')) {
                $fasumItems = DB::table('jenisbangunanfasum')
                    ->join('golongan_pelanggan', 'jenisbangunanfasum.golongan_pelanggan_id', '=', 'golongan_pelanggan.id')
                    ->select('jenisbangunanfasum.jenis', 'jenisbangunanfasum.golongan_pelanggan_id', 'golongan_pelanggan.kelompok_id')
                    ->get();

                foreach ($fasumItems as $item) {
                    DB::table('pendaftaran')
                        ->where('jenisbangunan', $item->jenis)
                        ->whereNull('golongan_pelanggan_id')
                        ->update([
                            'golongan_pelanggan_id' => $item->golongan_pelanggan_id,
                            'kelompok_pelanggan_id' => $item->kelompok_id,
                        ]);
                }
            }

            // C. Fallback sisa data pendaftaran berdasarkan tipe
            DB::table('pendaftaran')
                ->whereNull('golongan_pelanggan_id')
                ->where(function ($q) {
                    $q->where('tipe', 'REGULER')->orWhereNull('tipe');
                })
                ->update([
                    'golongan_pelanggan_id' => 6,
                    'kelompok_pelanggan_id' => 2,
                ]);

            DB::table('pendaftaran')
                ->whereNull('golongan_pelanggan_id')
                ->where('tipe', '!=', 'REGULER')
                ->update([
                    'golongan_pelanggan_id' => 3,
                    'kelompok_pelanggan_id' => 1,
                ]);
        }

        // 5. Tambah kolom relasi di tabel connection_requests
        if (Schema::hasTable('connection_requests')) {
            Schema::table('connection_requests', function (Blueprint $table) {
                if (! Schema::hasColumn('connection_requests', 'kelompok_pelanggan_id')) {
                    $table->unsignedInteger('kelompok_pelanggan_id')->nullable()->after('facility_type_id');
                }
                if (! Schema::hasColumn('connection_requests', 'golongan_pelanggan_id')) {
                    $table->unsignedInteger('golongan_pelanggan_id')->nullable()->after('kelompok_pelanggan_id');
                }
            });

            // Sinkronkan connection_requests berdasarkan connection_type
            DB::table('connection_requests')
                ->whereNull('golongan_pelanggan_id')
                ->whereIn('connection_type', ['Rumah Tangga', 'rumah-tangga'])
                ->update([
                    'golongan_pelanggan_id' => 6,
                    'kelompok_pelanggan_id' => 2,
                ]);

            DB::table('connection_requests')
                ->whereNull('golongan_pelanggan_id')
                ->update([
                    'golongan_pelanggan_id' => 3,
                    'kelompok_pelanggan_id' => 1,
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('connection_requests')) {
            Schema::table('connection_requests', function (Blueprint $table) {
                $table->dropColumn(['kelompok_pelanggan_id', 'golongan_pelanggan_id']);
            });
        }

        if (Schema::hasTable('pendaftaran')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropColumn(['kelompok_pelanggan_id', 'golongan_pelanggan_id']);
            });
        }

        if (Schema::hasTable('jenisbangunanfasum')) {
            Schema::table('jenisbangunanfasum', function (Blueprint $table) {
                $table->dropColumn(['golongan_pelanggan_id']);
            });
        }

        if (Schema::hasTable('jenisbangunanpribadi')) {
            Schema::table('jenisbangunanpribadi', function (Blueprint $table) {
                $table->dropColumn(['golongan_pelanggan_id']);
            });
        }

        if (Schema::hasTable('golongan_pelanggan')) {
            Schema::table('golongan_pelanggan', function (Blueprint $table) {
                $table->dropColumn(['kodegol']);
            });
        }
    }
};
