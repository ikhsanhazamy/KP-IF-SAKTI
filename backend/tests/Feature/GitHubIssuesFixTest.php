<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\PAC;
use App\Models\Kegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GitHubIssuesFixTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Bug #10 and #11: Profil columns in migration and User model's fillable.
     */
    public function test_user_profile_columns_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('pengaturan.profil.update'), [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
                'phone' => '08123456789',
                'jabatan' => 'Ketua Umum',
            ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '08123456789',
            'jabatan' => 'Ketua Umum',
        ]);
    }

    /**
     * Test Bug #14: Validation in KegiatanController@update.
     */
    public function test_kegiatan_update_requires_valid_data(): void
    {
        $user = User::factory()->create();
        $kegiatan = Kegiatan::create([
            'judul' => 'Kegiatan Awal',
            'tanggal' => '2026-06-30',
            'waktu' => '08:00',
            'lokasi' => 'Aula Sukabumi',
            'kategori' => 'Kajian',
            'peserta' => 50,
            'status' => 'upcoming',
        ]);

        $response = $this->actingAs($user)
            ->put("/kegiatan/update/{$kegiatan->id}", [
                'judul' => '', // invalid: empty
                'tanggal' => 'not-a-date', // invalid: not date
            ]);

        $response->assertSessionHasErrors(['judul', 'tanggal', 'waktu', 'lokasi', 'kategori', 'peserta', 'status']);
    }

    /**
     * Test Bug #15: sync total_kegiatan in PAC model on update.
     */
    public function test_kegiatan_update_syncs_pac_total_kegiatan(): void
    {
        $user = User::factory()->create();

        $pacA = PAC::create([
            'nama_pac' => 'PAC A',
            'kecamatan' => 'Kec A',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat A',
            'desa' => 'Desa A',
            'ketua_pac' => 'Ketua A',
            'telepon' => '081',
            'total_kegiatan' => 1,
        ]);

        $pacB = PAC::create([
            'nama_pac' => 'PAC B',
            'kecamatan' => 'Kec B',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat B',
            'desa' => 'Desa B',
            'ketua_pac' => 'Ketua B',
            'telepon' => '082',
            'total_kegiatan' => 0,
        ]);

        $kegiatan = Kegiatan::create([
            'judul' => 'Kegiatan Utama',
            'tanggal' => '2026-06-30',
            'waktu' => '08:00',
            'lokasi' => 'Aula Sukabumi',
            'kategori' => 'Kajian',
            'peserta' => 50,
            'status' => 'upcoming',
            'pac_id' => $pacA->id,
        ]);

        // Scenario 1: Change Kegiatan to Pac B
        $response = $this->actingAs($user)
            ->put("/kegiatan/update/{$kegiatan->id}", [
                'judul' => 'Kegiatan Utama',
                'tanggal' => '2026-06-30',
                'waktu' => '08:00',
                'lokasi' => 'Aula Sukabumi',
                'kategori' => 'Kajian',
                'peserta' => 50,
                'status' => 'upcoming',
                'pac_id' => $pacB->id,
            ]);

        $response->assertRedirect('/kegiatan');
        $this->assertEquals(0, $pacA->fresh()->total_kegiatan);
        $this->assertEquals(1, $pacB->fresh()->total_kegiatan);

        // Scenario 2: Change PAC to null (remove PAC association)
        $response = $this->actingAs($user)
            ->put("/kegiatan/update/{$kegiatan->id}", [
                'judul' => 'Kegiatan Utama',
                'tanggal' => '2026-06-30',
                'waktu' => '08:00',
                'lokasi' => 'Aula Sukabumi',
                'kategori' => 'Kajian',
                'peserta' => 50,
                'status' => 'upcoming',
                'pac_id' => null,
            ]);

        $this->assertEquals(0, $pacB->fresh()->total_kegiatan);
    }
}
