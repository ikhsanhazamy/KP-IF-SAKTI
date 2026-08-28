<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeaderInteractionTest extends TestCase
{
    use RefreshDatabase;

    public function test_global_search_returns_members_pacs_and_activities(): void
    {
        $user = User::factory()->create();

        Anggota::create([
            'nama' => 'Siti Cibadak',
            'email' => 'siti@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1990-01-01',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'tanggal_bergabung' => '2025-01-01',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
        ]);

        Kegiatan::create([
            'judul' => 'Pelatihan Cibadak',
            'tanggal' => '2026-06-20',
            'waktu' => '09:00',
            'lokasi' => 'Cibadak',
            'kategori' => 'Pelatihan',
            'peserta' => 50,
            'status' => 'upcoming',
        ]);

        $response = $this->actingAs($user)->getJson('/header/search?q=Cibadak');

        $response->assertOk()
            ->assertJsonCount(3, 'results')
            ->assertJsonPath('results.0.type', 'Anggota')
            ->assertJsonFragment(['title' => 'PAC Cibadak'])
            ->assertJsonFragment(['title' => 'Pelatihan Cibadak']);
    }

    public function test_notifications_follow_saved_preferences(): void
    {
        $user = User::factory()->create();

        Pengaturan::create([
            'language' => 'id',
            'timezone' => 'Asia/Jakarta',
            'date_format' => 'd-m-Y',
            'anggota_notification' => true,
            'pac_notification' => false,
            'kegiatan_notification' => false,
            'email_notification' => true,
        ]);

        Anggota::create([
            'nama' => 'Nurhayati',
            'email' => 'nurhayati@example.com',
            'telepon' => '081234567891',
            'tanggal_lahir' => '1992-02-02',
            'pac' => 'PAC Cisaat',
            'profesi' => 'Dosen',
            'pendidikan' => 'S2',
            'status' => 'aktif',
            'tanggal_bergabung' => '2025-02-01',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cisaat',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2021-01-01',
        ]);

        $response = $this->actingAs($user)->getJson('/header/notifications');

        $response->assertOk()
            ->assertJsonCount(1, 'notifications')
            ->assertJsonPath('notifications.0.type', 'anggota')
            ->assertJsonFragment(['message' => 'Nurhayati bergabung di PAC Cisaat']);
    }

    public function test_header_endpoints_require_authentication(): void
    {
        $this->getJson('/header/search?q=test')->assertUnauthorized();
        $this->getJson('/header/notifications')->assertUnauthorized();
    }

    public function test_search_sanitizes_wildcard_characters(): void
    {
        $user = User::factory()->create();

        Anggota::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1990-01-01',
            'pac' => 'PAC Cisaat',
            'profesi' => 'PNS',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'tanggal_bergabung' => '2025-01-01',
        ]);

        Anggota::create([
            'nama' => 'Rina Marlina',
            'email' => 'rina@example.com',
            'telepon' => '081234567891',
            'tanggal_lahir' => '1990-01-01',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Wiraswasta',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'tanggal_bergabung' => '2025-01-01',
        ]);

        // Regular search should find Budi
        $response = $this->actingAs($user)->getJson('/header/search?q=Budi');
        $response->assertOk();
        $this->assertCount(1, $response->json('results'));
        $this->assertEquals('Budi Santoso', $response->json('results.0.title'));

        // Wildcard search like "___" should not arbitrarily match all 4-letter names
        $responseWildcard = $this->actingAs($user)->getJson('/header/search?q=___');
        $responseWildcard->assertOk();
        $this->assertCount(0, $responseWildcard->json('results'));
    }
}
