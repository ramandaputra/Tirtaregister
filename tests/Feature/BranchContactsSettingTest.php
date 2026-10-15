<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BranchContactsSettingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasTable('roles')) {
            $this->artisan('migrate');
        }

        Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    }

    public function test_superadmin_can_save_multiple_contact_persons_per_branch(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        $contacts = [
            ['branch' => 'Tanjungpinang', 'name' => 'Arni (Pelayanan 1)', 'wa' => '0812-7018-2886'],
            ['branch' => 'Tanjungpinang', 'name' => 'Budi (Pelayanan 2)', 'wa' => '0811-2222-3333'],
            ['branch' => 'Kijang', 'name' => 'Suhendri (Pelayanan 1)', 'wa' => '0812-7028-3391'],
            ['branch' => 'Tanjung Uban', 'name' => 'Supriadi (Pelayanan 1)', 'wa' => '0812-6164-811'],
        ];

        $response = $this->actingAs($superadmin)->post(route('superadmin.settings.update'), [
            'branch_contacts' => $contacts,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $retrievedContacts = Setting::getBranchContacts();
        $this->assertCount(4, $retrievedContacts);
        $this->assertEquals('Tanjungpinang', $retrievedContacts[0]['branch']);
        $this->assertEquals('Arni (Pelayanan 1)', $retrievedContacts[0]['name']);
        $this->assertEquals('0812-7018-2886', $retrievedContacts[0]['wa']);

        $this->assertEquals('Tanjungpinang', $retrievedContacts[1]['branch']);
        $this->assertEquals('Budi (Pelayanan 2)', $retrievedContacts[1]['name']);
        $this->assertEquals('0811-2222-3333', $retrievedContacts[1]['wa']);

        // Check backwards compatibility
        $this->assertEquals('Tanjungpinang', Setting::get('branch_1_name'));
        $this->assertEquals('0812-7018-2886', Setting::get('branch_1_wa'));
    }

    public function test_customer_home_page_displays_all_contact_persons(): void
    {
        $contacts = [
            ['branch' => 'Tanjungpinang', 'name' => 'Arni', 'wa' => '0812-7018-2886'],
            ['branch' => 'Tanjungpinang', 'name' => 'Budi', 'wa' => '0811-2222-3333'],
            ['branch' => 'Kijang', 'name' => 'Suhendri', 'wa' => '0812-7028-3391'],
            ['branch' => 'Tanjung Uban', 'name' => 'Supriadi', 'wa' => '0812-6164-811'],
        ];

        Setting::updateOrCreate(
            ['key' => 'branch_contacts'],
            ['value' => json_encode($contacts)]
        );

        $response = $this->get('/');
        $response->assertStatus(200);

        // Verify contact persons appear on the page
        $response->assertSee('Tanjungpinang');
        $response->assertSee('Arni');
        $response->assertSee('Budi');
        $response->assertSee('0812-7018-2886');
        $response->assertSee('0811-2222-3333');
        $response->assertSee('https://wa.me/6281270182886', false);
        $response->assertSee('https://wa.me/6281122223333', false);
    }

    public function test_superadmin_can_reduce_contacts(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        // Initial 3 contacts
        Setting::updateOrCreate(
            ['key' => 'branch_contacts'],
            ['value' => json_encode([
                ['branch' => 'Tanjungpinang', 'name' => 'Arni', 'wa' => '0812-7018-2886'],
                ['branch' => 'Kijang', 'name' => 'Suhendri', 'wa' => '0812-7028-3391'],
                ['branch' => 'Tanjung Uban', 'name' => 'Supriadi', 'wa' => '0812-6164-811'],
            ])]
        );

        // Reduce to 2 contacts
        $this->actingAs($superadmin)->post(route('superadmin.settings.update'), [
            'branch_contacts' => [
                ['branch' => 'Tanjungpinang', 'name' => 'Arni', 'wa' => '0812-7018-2886'],
                ['branch' => 'Kijang', 'name' => 'Suhendri', 'wa' => '0812-7028-3391'],
            ],
        ]);

        $contacts = Setting::getBranchContacts();
        $this->assertCount(2, $contacts);
        $this->assertEquals('Tanjungpinang', $contacts[0]['branch']);
        $this->assertEquals('Kijang', $contacts[1]['branch']);
    }

    public function test_customer_news_page_displays_all_contact_persons(): void
    {
        $contacts = [
            ['branch' => 'Tanjungpinang', 'name' => 'Arni', 'wa' => '0812-7018-2886'],
            ['branch' => 'Kijang', 'name' => 'Suhendri', 'wa' => '0812-7028-3391'],
        ];

        Setting::updateOrCreate(
            ['key' => 'branch_contacts'],
            ['value' => json_encode($contacts)]
        );

        $response = $this->get(route('news.index'));
        $response->assertStatus(200);
        $response->assertSee('Tanjungpinang');
        $response->assertSee('Arni');
        $response->assertSee('https://wa.me/6281270182886', false);
    }

    public function test_reordered_contacts_in_superadmin_are_displayed_in_same_order_to_customer(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        // Drag & drop result: Tanjung Uban (#1), Kijang (#2), Tanjungpinang (#3)
        $reorderedContacts = [
            0 => ['branch' => 'Tanjung Uban', 'name' => 'Supriadi (Posisi 1)', 'wa' => '0812-6164-811'],
            1 => ['branch' => 'Kijang', 'name' => 'Suhendri (Posisi 2)', 'wa' => '0812-7028-3391'],
            2 => ['branch' => 'Tanjungpinang', 'name' => 'Arni (Posisi 3)', 'wa' => '0812-7018-2886'],
        ];

        // Save via superadmin controller
        $this->actingAs($superadmin)->post(route('superadmin.settings.update'), [
            'branch_contacts' => $reorderedContacts,
        ])->assertRedirect();

        // 1. Verify Database Model returns exact order
        $savedContacts = Setting::getBranchContacts();
        $this->assertEquals('Tanjung Uban', $savedContacts[0]['branch']);
        $this->assertEquals('Supriadi (Posisi 1)', $savedContacts[0]['name']);
        $this->assertEquals('Kijang', $savedContacts[1]['branch']);
        $this->assertEquals('Suhendri (Posisi 2)', $savedContacts[1]['name']);
        $this->assertEquals('Tanjungpinang', $savedContacts[2]['branch']);
        $this->assertEquals('Arni (Posisi 3)', $savedContacts[2]['name']);

        // 2. Verify Customer Welcome Page displays contacts in the exact same order
        $response = $this->get('/');
        $response->assertStatus(200);
        $html = $response->getContent();

        // Check relative positions in HTML of the WhatsApp section
        $posUban = strpos($html, 'Supriadi (Posisi 1)');
        $posKijang = strpos($html, 'Suhendri (Posisi 2)');
        $posTpi = strpos($html, 'Arni (Posisi 3)');

        $this->assertNotFalse($posUban, 'Tanjung Uban must be present');
        $this->assertNotFalse($posKijang, 'Kijang must be present');
        $this->assertNotFalse($posTpi, 'Tanjungpinang must be present');

        $this->assertTrue($posUban < $posKijang, 'Tanjung Uban should appear before Kijang');
        $this->assertTrue($posKijang < $posTpi, 'Kijang should appear before Tanjungpinang');
    }
}
