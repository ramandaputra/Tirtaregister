<?php

namespace Tests\Feature;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DashboardStatsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasTable('users')) {
            $this->artisan('migrate');
        }

        if (! Schema::hasTable('pendaftaran')) {
            Schema::create('pendaftaran', function (Blueprint $table) {
                $table->string('nomorreg')->primary();
                $table->string('nama')->nullable();
                $table->string('alamat')->nullable();
                $table->string('tipe')->nullable();
                $table->string('golongan')->nullable();
                $table->unsignedInteger('kelompok_pelanggan_id')->nullable();
                $table->unsignedInteger('golongan_pelanggan_id')->nullable();
                $table->date('tgldaftar')->nullable();
                $table->integer('flagpasang')->default(0);
                $table->integer('flagproblem')->default(0);
                $table->text('keterangan_problem')->nullable();
            });
        }

        Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    }

    public function test_superadmin_dashboard_shows_installation_statistics(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        $response = $this->actingAs($superadmin)->get(route('superadmin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('totalTerpasang');
        $response->assertViewHas('totalBelumTerpasang');
        $response->assertSee('Sudah Terpasang');
        $response->assertSee('Belum Terpasang');
    }

    public function test_admin_pelanggan_dashboard_shows_installation_statistics(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.pelanggan.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('totalTerpasang');
        $response->assertViewHas('totalBelumTerpasang');
        $response->assertSee('Sudah Terpasang');
        $response->assertSee('Belum Terpasang');
    }

    public function test_admin_pelanggan_index_filters_by_installation_status(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        Pendaftaran::create([
            'nomorreg' => 'REG-001',
            'nama' => 'Budi Terpasang',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 1,
        ]);

        Pendaftaran::create([
            'nomorreg' => 'REG-002',
            'nama' => 'Siti Belum',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-02',
            'flagpasang' => 0,
        ]);

        $responseTerpasang = $this->actingAs($admin)->get(route('admin.pelanggan.index', ['status' => 'terpasang']));
        $responseTerpasang->assertStatus(200);
        $responseTerpasang->assertSee('Status: Sudah Terpasang');
        $responseTerpasang->assertSee('Budi Terpasang');
        $responseTerpasang->assertDontSee('Siti Belum');

        $responseBelum = $this->actingAs($admin)->get(route('admin.pelanggan.index', ['status' => 'belum']));
        $responseBelum->assertStatus(200);
        $responseBelum->assertSee('Status: Belum Terpasang');
        $responseBelum->assertSee('Siti Belum');
        $responseBelum->assertDontSee('Budi Terpasang');
    }

    public function test_admin_and_superadmin_can_update_status_via_edit_form(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $p = Pendaftaran::create([
            'nomorreg' => 'REG-EDIT-01',
            'nama' => 'Pelanggan Uji',
            'alamat' => 'Jl. Merdeka No 1',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 0,
            'flagproblem' => 0,
        ]);

        // 1. Update ke 'terpasang'
        $resTerpasang = $this->actingAs($admin)->put(route('admin.pelanggan.update', $p->nomorreg), [
            'nama' => 'Pelanggan Uji',
            'alamat' => 'Jl. Merdeka No 1',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-01',
            'status' => 'terpasang',
        ]);
        $resTerpasang->assertRedirect(route('admin.pelanggan.index'));
        $p->refresh();
        $this->assertEquals(1, $p->flagpasang);
        $this->assertEquals(0, $p->flagproblem);

        // 2. Update ke 'bermasalah' dengan catatan
        $resBermasalah = $this->actingAs($admin)->put(route('admin.pelanggan.update', $p->nomorreg), [
            'nama' => 'Pelanggan Uji',
            'alamat' => 'Jl. Merdeka No 1',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-01',
            'status' => 'bermasalah',
            'keterangan_problem' => 'Pipa belum terpasang di gang',
        ]);
        $resBermasalah->assertRedirect(route('admin.pelanggan.index'));
        $p->refresh();
        $this->assertEquals(0, $p->flagpasang);
        $this->assertEquals(1, $p->flagproblem);
        $this->assertEquals('Pipa belum terpasang di gang', $p->keterangan_problem);

        // 3. Update ke 'proses'
        $resProses = $this->actingAs($admin)->put(route('admin.pelanggan.update', $p->nomorreg), [
            'nama' => 'Pelanggan Uji',
            'alamat' => 'Jl. Merdeka No 1',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-01',
            'status' => 'proses',
        ]);
        $resProses->assertRedirect(route('admin.pelanggan.index'));
        $p->refresh();
        $this->assertEquals(0, $p->flagpasang);
        $this->assertEquals(0, $p->flagproblem);
    }

    public function test_quick_update_status_route(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        $p = Pendaftaran::create([
            'nomorreg' => 'REG-QUICK-01',
            'nama' => 'Pelanggan Quick',
            'alamat' => 'Jl. Melati No 2',
            'tipe' => 'REGULER',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 0,
            'flagproblem' => 0,
        ]);

        $res = $this->actingAs($superadmin)->patch(route('admin.pelanggan.updateStatus', $p->nomorreg), [
            'status' => 'terpasang',
        ]);
        $res->assertSessionHas('success');

        $p->refresh();
        $this->assertEquals(1, $p->flagpasang);
        $this->assertEquals(0, $p->flagproblem);
    }

    public function test_customer_tables_show_golongan_column(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        Pendaftaran::create([
            'nomorreg' => 'REG-GOL-01',
            'nama' => 'Pelanggan Golongan',
            'alamat' => 'Jl. Golongan No 1',
            'tipe' => 'REGULER',
            'golongan' => 'IIA',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 1,
            'flagproblem' => 0,
        ]);

        // 1. Admin Index
        $resIndex = $this->actingAs($admin)->get(route('admin.pelanggan.index'));
        $resIndex->assertStatus(200);
        $resIndex->assertSee('Golongan');
        $resIndex->assertSee('IIA');

        // 2. Admin Prioritas
        Pendaftaran::create([
            'nomorreg' => 'REG-GOL-02',
            'nama' => 'Pelanggan Prioritas Golongan',
            'alamat' => 'Jl. Prioritas No 2',
            'tipe' => 'PRIORITAS',
            'golongan' => 'IB',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 0,
            'flagproblem' => 0,
        ]);
        $resPrioritas = $this->actingAs($admin)->get(route('admin.pelanggan.prioritas'));
        $resPrioritas->assertStatus(200);
        $resPrioritas->assertSee('Golongan');
        $resPrioritas->assertSee('IB');

        // 3. Admin Dashboard
        $resAdminDash = $this->actingAs($admin)->get(route('admin.pelanggan.dashboard'));
        $resAdminDash->assertStatus(200);
        $resAdminDash->assertSee('Golongan');

        // 4. Superadmin Dashboard
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');
        $resSuperDash = $this->actingAs($superadmin)->get(route('superadmin.dashboard'));
        $resSuperDash->assertStatus(200);
        $resSuperDash->assertSee('Golongan');
    }

    public function test_customer_detail_page_shows_golongan_determined_by_system(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $p = Pendaftaran::create([
            'nomorreg' => 'REG-DETAIL-01',
            'nama' => 'Pelanggan Detail Golongan',
            'alamat' => 'Jl. Mawar No 10',
            'tipe' => 'REGULER',
            'golongan' => 'IIA',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 1,
            'flagproblem' => 0,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.pelanggan.show', $p->nomorreg));
        $response->assertStatus(200);
        $response->assertSee('Golongan: IIA');
        $response->assertSee('IIA');
        $response->assertDontSee('(by system)');
    }

    public function test_admin_edit_and_update_determines_golongan_by_system_without_admin_input(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $p = Pendaftaran::create([
            'nomorreg' => 'REG-SYS-01',
            'nama' => 'Pelanggan System Gol',
            'alamat' => 'Jl. Flamboyan No 5',
            'tipe' => 'REGULER',
            'golongan' => 'IIA',
            'tgldaftar' => '2026-01-01',
            'flagpasang' => 0,
            'flagproblem' => 0,
        ]);

        // Edit page must show 'Golongan Tarif' as read-only and should not have an editable input for golongan
        $resEdit = $this->actingAs($admin)->get(route('admin.pelanggan.edit', $p->nomorreg));
        $resEdit->assertStatus(200);
        $resEdit->assertSee('Golongan Tarif');
        $resEdit->assertDontSee('name="golongan"', false);
        $resEdit->assertDontSee('(by system)');

        // Update without providing 'golongan' in request payload
        $resUpdate = $this->actingAs($admin)->put(route('admin.pelanggan.update', $p->nomorreg), [
            'nama' => 'Pelanggan System Gol Updated',
            'alamat' => 'Jl. Flamboyan No 5 Baru',
            'tipe' => 'PRIORITAS',
            'tgldaftar' => '2026-01-01',
            'status' => 'terpasang',
        ]);

        $resUpdate->assertRedirect(route('admin.pelanggan.index'));
        $p->refresh();
        $this->assertEquals('Pelanggan System Gol Updated', $p->nama);
        $this->assertEquals('PRIORITAS', $p->tipe);
        // Tipe PRIORITAS without specific building type resolves to 'IB' by system
        $this->assertEquals('IB', $p->golongan);
        $this->assertEquals(1, $p->flagpasang);
    }

    public function test_pendaftaran_resolves_and_syncs_kelompok_and_golongan_pelanggan_relationships(): void
    {
        $resolved = Pendaftaran::resolveKelompokDanGolongan(null, 'REGULER');
        $this->assertEquals('IIA', $resolved['golongan']);
        $this->assertEquals(6, $resolved['golongan_pelanggan_id']);
        $this->assertEquals(2, $resolved['kelompok_pelanggan_id']);

        $resolvedFasum = Pendaftaran::resolveKelompokDanGolongan(null, 'PRIORITAS');
        $this->assertEquals('IB', $resolvedFasum['golongan']);
        $this->assertEquals(3, $resolvedFasum['golongan_pelanggan_id']);
        $this->assertEquals(1, $resolvedFasum['kelompok_pelanggan_id']);
    }
}
