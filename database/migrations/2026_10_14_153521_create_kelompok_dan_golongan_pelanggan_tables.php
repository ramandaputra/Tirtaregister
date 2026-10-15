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
        if (! Schema::hasTable('kelompok_pelanggan')) {
            Schema::create('kelompok_pelanggan', function (Blueprint $table) {
                $table->increments('id');
                $table->string('kode', 10)->unique();
                $table->string('nama_kelompok', 50);
            });
        }

        if (! Schema::hasTable('golongan_pelanggan')) {
            Schema::create('golongan_pelanggan', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('kelompok_id');
                $table->string('sub_kategori', 50)->nullable();
                $table->string('nama_golongan', 150);

                $table->foreign('kelompok_id')
                    ->references('id')
                    ->on('kelompok_pelanggan')
                    ->onDelete('cascade');
            });
        }

        // Insert Data Kelompok Utama
        DB::table('kelompok_pelanggan')->insertOrIgnore([
            ['id' => 1, 'kode' => 'KEL-I', 'nama_kelompok' => 'KELOMPOK I'],
            ['id' => 2, 'kode' => 'KEL-II', 'nama_kelompok' => 'KELOMPOK II'],
            ['id' => 3, 'kode' => 'KEL-III', 'nama_kelompok' => 'KELOMPOK III'],
            ['id' => 4, 'kode' => 'KEL-KHUSUS', 'nama_kelompok' => 'KELOMPOK KHUSUS'],
        ]);

        // Insert Data Golongan Pelanggan
        DB::table('golongan_pelanggan')->insertOrIgnore([
            // Kelompok I
            ['kelompok_id' => 1, 'sub_kategori' => 'SOSIAL UMUM', 'nama_golongan' => 'HIDRAN UMUM / KRAN UMUM'],
            ['kelompok_id' => 1, 'sub_kategori' => 'SOSIAL UMUM', 'nama_golongan' => 'KAMAR MANDI UMUM / WC UMUM'],
            ['kelompok_id' => 1, 'sub_kategori' => 'SOSIAL KHUSUS', 'nama_golongan' => 'TEMPAT IBADAH / YAYASAN SOSIAL / SEKOLAH NEGERI / SWASTA / BANK SAMPAH'],
            ['kelompok_id' => 1, 'sub_kategori' => 'SOSIAL KHUSUS', 'nama_golongan' => 'KELOMPOK MBR'],
            ['kelompok_id' => 1, 'sub_kategori' => 'SOSIAL KHUSUS', 'nama_golongan' => 'RSU PEMERINTAH / PUSKESMAS / KLINIK PEMERINTAH'],

            // Kelompok II
            ['kelompok_id' => 2, 'sub_kategori' => null, 'nama_golongan' => 'RUMAH TANGGA I'],
            ['kelompok_id' => 2, 'sub_kategori' => null, 'nama_golongan' => 'RUMAH TANGGA II'],
            ['kelompok_id' => 2, 'sub_kategori' => null, 'nama_golongan' => 'RUMAH TANGGA III'],
            ['kelompok_id' => 2, 'sub_kategori' => null, 'nama_golongan' => 'RUMAH TANGGA IV'],

            // Kelompok III
            ['kelompok_id' => 3, 'sub_kategori' => null, 'nama_golongan' => 'PERGURUAN TINGGI NEGERI / SWASTA'],
            ['kelompok_id' => 3, 'sub_kategori' => null, 'nama_golongan' => 'PEMERINTAHAN / HANKAM / TNI / POLRI / ASING / PARPOL'],
            ['kelompok_id' => 3, 'sub_kategori' => null, 'nama_golongan' => 'RUMAH SAKIT SWASTA / KLINIK'],
            ['kelompok_id' => 3, 'sub_kategori' => null, 'nama_golongan' => 'NIAGA KECIL'],
            ['kelompok_id' => 3, 'sub_kategori' => null, 'nama_golongan' => 'NIAGA MENENGAH'],
            ['kelompok_id' => 3, 'sub_kategori' => null, 'nama_golongan' => 'NIAGA BESAR'],

            // Kelompok Khusus
            ['kelompok_id' => 4, 'sub_kategori' => null, 'nama_golongan' => 'INDUSTRI'],
            ['kelompok_id' => 4, 'sub_kategori' => null, 'nama_golongan' => 'PELABUHAN DARAT, LAUT, UDARA, SUNGAI'],
            ['kelompok_id' => 4, 'sub_kategori' => null, 'nama_golongan' => 'NON KOMERSIL (DOMESTIK)'],
            ['kelompok_id' => 4, 'sub_kategori' => null, 'nama_golongan' => 'KOMERSIL'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongan_pelanggan');
        Schema::dropIfExists('kelompok_pelanggan');
    }
};
