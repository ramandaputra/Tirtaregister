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
        Schema::create('occupations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('rayons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('purposes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('building_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('ownerships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('water_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('facility_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('connection_requests', function (Blueprint $table) {
            $table->string('kk_number', 16)->nullable();
            $table->string('kk_file_path')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('occupation_id')->nullable()->constrained('occupations')->nullOnDelete();

            $table->string('house_number')->nullable();
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->foreignId('village_id')->nullable()->constrained('villages')->nullOnDelete();
            $table->foreignId('rayon_id')->nullable()->constrained('rayons')->nullOnDelete();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->foreignId('purpose_id')->nullable()->constrained('purposes')->nullOnDelete();
            $table->foreignId('building_type_id')->nullable()->constrained('building_types')->nullOnDelete();
            $table->foreignId('ownership_id')->nullable()->constrained('ownerships')->nullOnDelete();
            $table->integer('land_area')->nullable();
            $table->integer('building_area')->nullable();
            $table->integer('occupants_count')->nullable();

            $table->foreignId('water_source_id')->nullable()->constrained('water_sources')->nullOnDelete();

            $table->string('company_name')->nullable();
            $table->foreignId('facility_type_id')->nullable()->constrained('facility_types')->nullOnDelete();
        });

        // Seed default data
        $now = now();
        DB::table('occupations')->insert([
            ['name' => 'PNS', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TNI/Polri', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Karyawan Swasta', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Wiraswasta', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pelajar/Mahasiswa', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lainnya', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $v_id = DB::table('villages')->insertGetId(['name' => 'Tanjungpinang Kota', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('rayons')->insert([
            ['village_id' => $v_id, 'name' => 'Rayon 1 Utara', 'created_at' => $now, 'updated_at' => $now],
            ['village_id' => $v_id, 'name' => 'Rayon 2 Selatan', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $v2_id = DB::table('villages')->insertGetId(['name' => 'Bukit Bestari', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('rayons')->insert([
            ['village_id' => $v2_id, 'name' => 'Rayon Bestari Indah', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('purposes')->insert([
            ['name' => 'Tempat Tinggal', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kost/Kontrakan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tempat Usaha', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('building_types')->insert([
            ['name' => 'Permanen', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Semi Permanen', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Darurat', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('ownerships')->insert([
            ['name' => 'Milik Sendiri', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sewa/Kontrak', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Milik Keluarga', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('water_sources')->insert([
            ['name' => 'Sumur Gali', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sumur Bor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tadah Hujan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Beli (Tangki/Galon)', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lainnya', 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('facility_types')->insert([
            ['name' => 'Tempat Ibadah (Masjid/Gereja/Vihara)', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Panti Sosial/Asuhan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sekolah/Lembaga Pendidikan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rumah Sakit/Puskesmas', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fasilitas Warga/Balai Desa', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lainnya', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::table('connection_requests', function (Blueprint $table) {
            $table->dropForeign(['occupation_id']);
            $table->dropForeign(['village_id']);
            $table->dropForeign(['rayon_id']);
            $table->dropForeign(['purpose_id']);
            $table->dropForeign(['building_type_id']);
            $table->dropForeign(['ownership_id']);
            $table->dropForeign(['water_source_id']);
            $table->dropForeign(['facility_type_id']);

            $table->dropColumn([
                'kk_number', 'kk_file_path', 'email', 'occupation_id',
                'house_number', 'rt', 'rw', 'village_id', 'rayon_id', 'latitude', 'longitude',
                'purpose_id', 'building_type_id', 'ownership_id', 'land_area', 'building_area', 'occupants_count',
                'water_source_id', 'company_name', 'facility_type_id',
            ]);
        });

        Schema::dropIfExists('facility_types');
        Schema::dropIfExists('water_sources');
        Schema::dropIfExists('ownerships');
        Schema::dropIfExists('building_types');
        Schema::dropIfExists('purposes');
        Schema::dropIfExists('rayons');
        Schema::dropIfExists('villages');
        Schema::dropIfExists('occupations');
    }
};
