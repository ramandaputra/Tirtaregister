<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ConnectionRequestRegistrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasTable('users')) {
            $this->artisan('migrate');
        }

        if (! Schema::hasTable('pekerjaan')) {
            Schema::create('pekerjaan', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('category')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
            DB::table('pekerjaan')->insert([
                ['name' => 'PNS / TNI / POLRI', 'category' => 'Pemerintahan', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Wiraswasta / Pedagang', 'category' => 'Swasta', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        if (! Schema::hasTable('kodwil26')) {
            Schema::create('kodwil26', function (Blueprint $table) {
                $table->string('kelurahan');
                $table->string('kecamatan');
                $table->string('koderayon');
                $table->string('namarayon');
            });
            DB::table('kodwil26')->insert([
                [
                    'kelurahan' => 'TANJUNGPINANG KOTA',
                    'kecamatan' => 'TANJUNGPINANG KOTA',
                    'koderayon' => '01',
                    'namarayon' => 'JL. MERDEKA',
                ],
            ]);
        }

        if (! Schema::hasTable('peruntukan')) {
            Schema::create('peruntukan', function (Blueprint $table) {
                $table->string('peruntukan');
            });
        }

        // Ensure peruntukan has some test data, including attempts to insert KANTOR
        DB::table('peruntukan')->delete();
        DB::table('peruntukan')->insert([
            ['peruntukan' => 'RUMAH TINGGAL'],
            ['peruntukan' => 'RUKO ( RUMAH TOKO )'],
            ['peruntukan' => 'TOKO/PERTOKOAN'],
            ['peruntukan' => 'LAINNYA'],
            ['peruntukan' => 'KANTOR'], // Intentionally insert KANTOR to test global scope & view filtering
        ]);

        if (! Schema::hasTable('jenisbangunanpribadi')) {
            Schema::create('jenisbangunanpribadi', function (Blueprint $table) {
                $table->string('jenis');
                $table->string('kodegol')->default('IIA');
            });
        }
        DB::table('jenisbangunanpribadi')->delete();
        DB::table('jenisbangunanpribadi')->insert([
            ['jenis' => 'RUMAH BIASA', 'kodegol' => 'IIA'],
            ['jenis' => 'KONTRAKAN', 'kodegol' => 'IIA'],
            ['jenis' => 'KOS', 'kodegol' => 'IIA'],
            ['jenis' => 'WARUNG/KEDAI/KIOS', 'kodegol' => 'IIA'],
        ]);

        if (! Schema::hasTable('jenisbangunanfasum')) {
            Schema::create('jenisbangunanfasum', function (Blueprint $table) {
                $table->string('jenis');
            });
            DB::table('jenisbangunanfasum')->insert([
                ['jenis' => 'Permanen Bertingkat'],
            ]);
        }

        if (! Schema::hasTable('kepemilikan')) {
            Schema::create('kepemilikan', function (Blueprint $table) {
                $table->string('kepemilikanbangunan');
            });
            DB::table('kepemilikan')->insert([
                ['kepemilikanbangunan' => 'Milik Sendiri (SHM/HGB)'],
            ]);
        }

        if (! Schema::hasTable('kepemilikanfasum')) {
            Schema::create('kepemilikanfasum', function (Blueprint $table) {
                $table->string('kepemilikanbangunan');
            });
            DB::table('kepemilikanfasum')->insert([
                ['kepemilikanbangunan' => 'Yayasan / Lembaga'],
            ]);
        }

        if (! Schema::hasTable('rayon')) {
            Schema::create('rayon', function (Blueprint $table) {
                $table->string('kodearea');
                $table->string('area');
            });
            DB::table('rayon')->insert([
                ['kodearea' => '01', 'area' => 'AREA 1'],
            ]);
        }

        if (! Schema::hasTable('water_sources')) {
            Schema::create('water_sources', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
            DB::table('water_sources')->insert([
                ['name' => 'Sumur Bor / Galian', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        if (! Schema::hasTable('facility_types')) {
            Schema::create('facility_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
            DB::table('facility_types')->insert([
                ['name' => 'Masjid / Musholla', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    public function test_registration_form_rumah_tangga_does_not_contain_kantor(): void
    {
        $response = $this->get(route('public.register.rumah-tangga'));

        $response->assertStatus(200);
        $response->assertSee('RUMAH TINGGAL');
        $response->assertSee('Peruntukkan');
        $response->assertDontSee('<option value="KANTOR"', false);
        $response->assertDontSee('<option value="kantor"', false);
    }

    public function test_registration_form_rumah_tangga_contains_building_types_kontrakan_kos_warung(): void
    {
        $response = $this->get(route('public.register.rumah-tangga'));

        $response->assertStatus(200);
        $response->assertSee('Jenis Bangunan');
        $response->assertSee('<option value="RUMAH BIASA"', false);
        $response->assertSee('<option value="KONTRAKAN"', false);
        $response->assertSee('<option value="KOS"', false);
        $response->assertSee('<option value="WARUNG/KEDAI/KIOS"', false);
    }

    public function test_registration_form_fasilitas_umum_contains_kantor(): void
    {
        $response = $this->get(route('public.register.fasilitas-umum'));

        $response->assertStatus(200);
        $response->assertSee('Peruntukkan');
        $response->assertSee('<option value="KANTOR"', false);
    }

    public function test_submitting_registration_rumah_tangga_with_kantor_fails_validation(): void
    {
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->post(route('public.register.store'), [
            'connection_type' => 'Rumah Tangga',
            'full_name' => 'Budi Santoso',
            'nik' => '2171012345678901',
            'phone_number' => '081234567890',
            'email' => 'budi@example.com',
            'kk_number' => '2171012345678901',
            'occupation_id' => '1',
            'ktp_file' => $file,
            'kk_file' => $file,
            'house_image_file' => $file,
            'installation_address' => 'Jl. Merdeka No. 10',
            'house_number' => '10',
            'rt' => '01',
            'rw' => '02',
            'village_id' => 'TANJUNGPINANG KOTA',
            'purpose_id' => 'KANTOR',
            'building_type_id' => 'Permanen (Beton/Batu)',
            'ownership_id' => 'Milik Sendiri (SHM/HGB)',
            'land_area' => 120,
            'building_area' => 80,
            'occupants_count' => 4,
            'water_source_id' => 'Sumur Bor / Galian',
        ]);

        $response->assertSessionHasErrors('purpose_id');
    }

    public function test_submitting_registration_fasilitas_umum_with_kantor_is_allowed(): void
    {
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->post(route('public.register.store'), [
            'connection_type' => 'Fasilitas Umum',
            'full_name' => 'PT Tirta Perkasa',
            'company_name' => 'PT Tirta Perkasa',
            'facility_type_id' => '1',
            'nik' => '2171012345678901',
            'phone_number' => '081234567890',
            'email' => 'perusahaan@example.com',
            'kk_number' => '2171012345678901',
            'occupation_id' => '1',
            'ktp_file' => $file,
            'kk_file' => $file,
            'house_image_file' => $file,
            'installation_address' => 'Jl. Merdeka No. 50',
            'house_number' => '50',
            'rt' => '01',
            'rw' => '02',
            'village_id' => 'TANJUNGPINANG KOTA',
            'purpose_id' => 'KANTOR',
            'building_type_id' => 'Permanen Bertingkat',
            'ownership_id' => 'Yayasan / Lembaga',
            'land_area' => 500,
            'building_area' => 400,
            'occupants_count' => 20,
            'water_source_id' => 'Sumur Bor / Galian',
        ]);

        $response->assertSessionDoesntHaveErrors('purpose_id');
    }
}
