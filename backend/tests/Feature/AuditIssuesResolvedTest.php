<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditIssuesResolvedTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_login_rejects_invalid_credentials_and_no_bypass(): void
    {
        $user = User::factory()->superAdmin()->create([
            'email' => 'admin@fatayat.org',
            'password' => bcrypt('RealSecret123!'),
        ]);

        // Attempt login with wrong password (no defaultPasswords bypass)
        $response = $this->post('/login', [
            'email' => 'admin@fatayat.org',
            'password' => 'admin123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_auth_2fa_resend_preserves_attempts_counter(): void
    {
        $user = User::factory()->superAdmin()->create([
            'two_factor_enabled' => true,
        ]);

        $response = $this->withSession([
            'two_factor_user_id' => $user->id,
            'two_factor_code' => '111111',
            'two_factor_expires_at' => now()->addMinutes(10)->timestamp,
            'two_factor_attempts' => 2,
        ])->post(route('two-factor.resend'));

        $response->assertRedirect();
        $response->assertSessionHas('status');
        $response->assertSessionHas('two_factor_attempts', 2);
    }

    public function test_rbac_operator_cannot_access_super_admin_backup_routes(): void
    {
        $operator = User::factory()->operator()->create();

        $this->actingAs($operator);
        session(['two_factor_verified' => true]);

        // Operator attempting to backup database
        $response = $this->post('/backup/database');
        $response->assertStatus(403);

        // Operator attempting to restore database
        $restoreResponse = $this->post('/restore/database', []);
        $restoreResponse->assertStatus(403);
    }

    public function test_rbac_operator_cannot_delete_pac_or_approve_pac(): void
    {
        $operator = User::factory()->operator()->create();
        $pac = PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'pending',
            'tanggal_berdiri' => '2020-01-01',
            'ketua_pac' => 'Siti',
            'telepon' => '08123456789',
        ]);

        $this->actingAs($operator);
        session(['two_factor_verified' => true]);

        // Operator attempting to approve pending PAC
        $response = $this->post(route('pengajuan-pac.approve', $pac->id));
        $response->assertStatus(403);

        // Operator attempting to delete PAC
        $deleteResponse = $this->delete(route('pac.destroy', $pac->id));
        $deleteResponse->assertStatus(403);
    }

    public function test_pac_approval_fails_if_status_is_not_pending(): void
    {
        $admin = User::factory()->superAdmin()->create();
        $pac = PAC::create([
            'nama_pac' => 'PAC Cikidang',
            'kecamatan' => 'Cikidang',
            'status' => 'aktif', // already active
            'tanggal_berdiri' => '2020-01-01',
            'ketua_pac' => 'Aisyah',
            'telepon' => '08123456789',
        ]);

        $this->actingAs($admin);
        session(['two_factor_verified' => true]);

        $response = $this->post(route('pengajuan-pac.approve', $pac->id));
        $response->assertSessionHas('error');

        $pac->refresh();
        $this->assertEquals('aktif', $pac->status);
    }

    public function test_api_pac_pengajuan_honeypot_mitigation(): void
    {
        $response = $this->postJson('/api/pac/pengajuan', [
            'nama_pac' => 'PAC Bot Spam',
            'kecamatan' => 'Kecamatan Spam',
            'tanggal_berdiri' => '2021-01-01',
            'ketua_pac' => 'Spam Bot',
            'telepon' => '08123456789',
            'website' => 'http://spam-link.com', // honeypot filled
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('pacs', ['nama_pac' => 'PAC Bot Spam']);
    }

    public function test_api_pac_pengajuan_deduplication_per_district(): void
    {
        PAC::create([
            'nama_pac' => 'PAC Sukabumi Barat',
            'kecamatan' => 'Sukabumi Barat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'ketua_pac' => 'Fatimah',
            'telepon' => '08123456789',
        ]);

        // Attempting second submission for same kecamatan
        $response = $this->postJson('/api/pac/pengajuan', [
            'nama_pac' => 'PAC Sukabumi Barat Kedua',
            'kecamatan' => 'sukabumi barat', // case-insensitive duplicate
            'tanggal_berdiri' => '2022-01-01',
            'ketua_pac' => 'Khadijah',
            'telepon' => '08129876543',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('kecamatan');
    }

    public function test_api_kegiatan_supports_pagination(): void
    {
        $pac = PAC::create([
            'nama_pac' => 'PAC Warungkiara',
            'kecamatan' => 'Warungkiara',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'ketua_pac' => 'Zahra',
            'telepon' => '08123456789',
        ]);

        for ($i = 1; $i <= 15; $i++) {
            Kegiatan::create([
                'judul' => "Kegiatan Test {$i}",
                'deskripsi' => "Deskripsi {$i}",
                'tanggal' => now()->toDateString(),
                'waktu' => '09:00',
                'lokasi' => 'Sukabumi',
                'status' => 'upcoming',
                'kategori' => 'Kajian',
                'peserta' => 20,
                'pac_id' => $pac->id,
            ]);
        }

        $response = $this->getJson('/api/kegiatan?per_page=10');
        $response->assertOk();
        $response->assertJsonStructure([
            'data',
            'current_page',
            'per_page',
            'total',
        ]);
        $this->assertCount(10, $response->json('data'));
    }

    public function test_api_stats_returns_verification_and_backward_compatible_fields(): void
    {
        $response = $this->getJson('/api/stats');
        $response->assertOk();
        $response->assertJsonStructure([
            'total_pac',
            'pac_aktif',
            'total_anggota',
            'anggota_aktif',
            'total_kecamatan',
            'tingkat_verifikasi',
            'kelengkapan_data',
            'kepuasan',
        ]);
    }

    public function test_anggota_pac_relationship(): void
    {
        $pac = PAC::create([
            'nama_pac' => 'PAC Nagrak',
            'kecamatan' => 'Nagrak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'ketua_pac' => 'Nurul',
            'telepon' => '08123456789',
            'latitude' => -6.8833,
            'longitude' => 106.8167,
        ]);

        $anggota = Anggota::create([
            'pac_id' => $pac->id,
            'pac' => $pac->nama_pac,
            'nama' => 'Dewi Sartika',
            'status' => 'aktif',
            'tanggal_bergabung' => '2023-01-01',
            'telepon' => '081234567890',
            'email' => 'dewi@example.com',
            'tanggal_lahir' => '1995-05-15',
            'status_pernikahan' => 'Menikah',
            'pendidikan' => 'S1',
            'profesi' => 'Guru',
        ]);

        $this->assertEquals($pac->id, $anggota->pac()->first()->id);
        $this->assertTrue($pac->anggotas->contains($anggota));
        $this->assertEquals(-6.8833, (float) $pac->latitude);
        $this->assertEquals(106.8167, (float) $pac->longitude);
    }
}
