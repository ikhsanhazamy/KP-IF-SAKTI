<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
     * Kegiatan can update its PAC association without relying on the removed total_kegiatan column.
     */
    public function test_kegiatan_update_updates_pac_association(): void
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
        $this->assertDatabaseHas('kegiatans', [
            'id' => $kegiatan->id,
            'pac_id' => $pacB->id,
        ]);

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

        $this->assertDatabaseHas('kegiatans', [
            'id' => $kegiatan->id,
            'pac_id' => null,
        ]);
    }

    public function test_kegiatan_image_is_compressed_replaced_and_deleted(): void
    {
        if (! function_exists('imagecreatetruecolor') || ! function_exists('imagejpeg')) {
            $this->markTestSkipped('GD extension is not installed on this PHP runtime.');
        }

        Storage::fake('public');

        $user = User::factory()->create();
        $image = UploadedFile::fake()->image('kegiatan.png', 2000, 1200)->size(3000);

        $response = $this->actingAs($user)
            ->post('/kegiatan/store', [
                'judul' => 'Kegiatan Bergambar',
                'tanggal' => '2026-07-03',
                'waktu' => '08:00',
                'lokasi' => 'Aula Sukabumi',
                'kategori' => 'Kajian',
                'peserta' => 100,
                'status' => 'upcoming',
                'deskripsi' => 'Kegiatan dengan gambar',
                'gambar' => $image,
            ]);

        $response->assertRedirect('/kegiatan');

        $kegiatan = Kegiatan::where('judul', 'Kegiatan Bergambar')->firstOrFail();
        $this->assertNotNull($kegiatan->gambar);
        $this->assertStringStartsWith('kegiatan/', $kegiatan->gambar);
        $this->assertStringEndsWith('.jpg', $kegiatan->gambar);
        Storage::disk('public')->assertExists($kegiatan->gambar);

        [$width, $height] = getimagesize(Storage::disk('public')->path($kegiatan->gambar));
        $this->assertLessThanOrEqual(1280, max($width, $height));

        $oldImage = $kegiatan->gambar;
        $replacement = UploadedFile::fake()->image('pengganti.jpg', 900, 900)->size(2000);

        $this->actingAs($user)
            ->put("/kegiatan/update/{$kegiatan->id}", [
                'judul' => 'Kegiatan Bergambar Update',
                'tanggal' => '2026-07-04',
                'waktu' => '09:00',
                'lokasi' => 'Aula Baru',
                'kategori' => 'Pelatihan',
                'peserta' => 120,
                'status' => 'ongoing',
                'deskripsi' => 'Kegiatan dengan gambar baru',
                'gambar' => $replacement,
            ])
            ->assertRedirect('/kegiatan');

        $kegiatan->refresh();
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($kegiatan->gambar);

        $newImage = $kegiatan->gambar;

        $this->actingAs($user)
            ->delete("/kegiatan/delete/{$kegiatan->id}")
            ->assertRedirect('/kegiatan');

        Storage::disk('public')->assertMissing($newImage);
    }

    /**
     * Test export PDF, Excel, and CSV endpoints.
     */
    public function test_exports_work(): void
    {
        $user = User::factory()->create();

        // Create some dummy records
        PAC::create([
            'nama_pac' => 'PAC Cisaat',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Jl Cisaat',
            'desa' => 'Cisaat',
            'ketua_pac' => 'Siti',
            'telepon' => '08123',
        ]);

        Anggota::create([
            'nama' => 'Rina',
            'email' => 'rina@example.com',
            'pac' => 'PAC Cisaat',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'tanggal_bergabung' => '2026-01-01',
        ]);

        Kegiatan::create([
            'judul' => 'Kegiatan Rutin',
            'tanggal' => '2026-06-30',
            'waktu' => '08:00',
            'lokasi' => 'Aula Sukabumi',
            'kategori' => 'Kajian',
            'peserta' => 50,
            'status' => 'upcoming',
        ]);

        $responsePdf = $this->actingAs($user)->get('/laporan/export/pdf');
        $responsePdf->assertStatus(200);
        $responsePdf->assertHeader('Content-Disposition', 'attachment; filename=laporan-anggota.pdf');

        $responseExcel = $this->actingAs($user)->get('/laporan/export/excel');
        $responseExcel->assertStatus(200);
        $responseExcel->assertHeader('Content-Disposition', 'attachment; filename="data-anggota.xls"');

        $responseCsv = $this->actingAs($user)->get('/laporan/export/csv');
        $responseCsv->assertStatus(200);
        $responseCsv->assertHeader('Content-Disposition', 'attachment; filename=data-anggota.csv');

        $responsePacPdf = $this->actingAs($user)->get('/laporan/export/pac/pdf');
        $responsePacPdf->assertStatus(200);
        $responsePacPdf->assertHeader('Content-Disposition', 'attachment; filename=laporan-pac.pdf');

        $responseKegPdf = $this->actingAs($user)->get('/laporan/export/kegiatan/pdf');
        $responseKegPdf->assertStatus(200);
        $responseKegPdf->assertHeader('Content-Disposition', 'attachment; filename=laporan-kegiatan.pdf');
    }

    /**
     * Test local search functionality on PAC and Kegiatan pages.
     */
    public function test_search_features(): void
    {
        $user = User::factory()->create();

        // Create PACs
        $pac1 = PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cibadak',
            'desa' => 'Desa Cibadak',
            'ketua_pac' => 'Fatma',
            'telepon' => '081',
        ]);
        $pac2 = PAC::create([
            'nama_pac' => 'PAC Cisaat',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cisaat',
            'desa' => 'Desa Cisaat',
            'ketua_pac' => 'Salma',
            'telepon' => '082',
        ]);

        // Search PACs
        $response = $this->actingAs($user)->get('/data-pac?search=Cibadak');
        $response->assertStatus(200);
        $response->assertSee('PAC Cibadak');
        $response->assertDontSee('PAC Cisaat');

        // Create Kegiatan
        $keg1 = Kegiatan::create([
            'judul' => 'Kajian Rutin Fatayat',
            'tanggal' => '2026-06-30',
            'waktu' => '08:00',
            'lokasi' => 'Aula Sukabumi',
            'kategori' => 'Kajian',
            'peserta' => 50,
            'status' => 'upcoming',
        ]);
        $keg2 = Kegiatan::create([
            'judul' => 'Workshop IT Pemudi',
            'tanggal' => '2026-06-30',
            'waktu' => '09:00',
            'lokasi' => 'Aula Sukabumi',
            'kategori' => 'Workshop',
            'peserta' => 30,
            'status' => 'upcoming',
        ]);

        // Search Kegiatan
        $response = $this->actingAs($user)->get('/kegiatan?search=Kajian');
        $response->assertStatus(200);
        $response->assertSee('Kajian Rutin Fatayat');
        $response->assertDontSee('Workshop IT Pemudi');
    }

    public function test_kegiatan_update_retains_old_image_when_no_new_file_uploaded(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $kegiatan = Kegiatan::create([
            'judul' => 'Kegiatan Lama',
            'tanggal' => '2026-08-01',
            'waktu' => '09:00',
            'lokasi' => 'Gedung A',
            'kategori' => 'Seminar',
            'peserta' => 50,
            'status' => 'upcoming',
            'gambar' => 'kegiatan/existing-photo.jpg',
        ]);

        $response = $this->actingAs($user)->put("/kegiatan/update/{$kegiatan->id}", [
            'judul' => 'Kegiatan Baru',
            'tanggal' => '2026-08-01',
            'waktu' => '09:00',
            'lokasi' => 'Gedung A',
            'kategori' => 'Seminar',
            'peserta' => 50,
            'status' => 'upcoming',
            // No gambar uploaded
        ]);

        $response->assertRedirect('/kegiatan');
        $kegiatan->refresh();
        $this->assertEquals('Kegiatan Baru', $kegiatan->judul);
        $this->assertEquals('kegiatan/existing-photo.jpg', $kegiatan->gambar);
    }

    public function test_get_pac_api_only_returns_active_pacs(): void
    {
        PAC::create([
            'nama_pac' => 'PAC Aktif',
            'kecamatan' => 'Cicurug',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Aktif',
            'desa' => 'Desa Aktif',
            'ketua_pac' => 'Ketua Aktif',
            'telepon' => '081',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Pending',
            'kecamatan' => 'Cisaat',
            'status' => 'pending',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Pending',
            'desa' => 'Desa Pending',
            'ketua_pac' => 'Ketua Pending',
            'telepon' => '082',
        ]);

        $response = $this->getJson('/api/pac');
        $response->assertOk();
        $response->assertJsonFragment(['nama_pac' => 'PAC Aktif']);
        $response->assertJsonMissing(['nama_pac' => 'PAC Pending']);
    }

    public function test_pac_index_harmonizes_total_anggota_count(): void
    {
        $user = User::factory()->create();

        PAC::create([
            'nama_pac' => 'PAC Jampang',
            'kecamatan' => 'Jampang',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Jampang',
            'desa' => 'Desa Jampang',
            'ketua_pac' => 'Ketua Jampang',
            'telepon' => '081',
            'jumlah_anggota' => 999, // Manual column
        ]);

        // Actual Anggota count = 1
        Anggota::create([
            'nama' => 'Kader Jampang',
            'email' => 'kader.jampang@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1995-05-12',
            'pac' => 'PAC Jampang',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'status_pernikahan' => 'kawin',
            'tanggal_bergabung' => now()->format('Y-m-d'),
        ]);

        $response = $this->actingAs($user)->get('/data-pac');
        $response->assertOk();
        $response->assertViewHas('totalAnggota', 1);
    }

    public function test_get_kegiatan_api_eager_loads_pac(): void
    {
        $pac = PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cibadak',
            'desa' => 'Desa Cibadak',
            'ketua_pac' => 'Ketua Cibadak',
            'telepon' => '081234',
        ]);

        $kegiatan = Kegiatan::create([
            'pac_id' => $pac->id,
            'judul' => 'Kajian Rutin',
            'tanggal' => '2026-08-10',
            'waktu' => '10:00',
            'lokasi' => 'Masjid Cibadak',
            'kategori' => 'Kajian',
            'peserta' => 40,
            'status' => 'completed',
        ]);

        $response = $this->getJson('/api/kegiatan');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => $kegiatan->id,
            'judul' => 'Kajian Rutin',
            'pac' => [
                'id' => $pac->id,
                'nama_pac' => 'PAC Cibadak',
                'kecamatan' => 'Cibadak',
            ],
        ]);
    }

    public function test_kegiatan_index_passes_pacs_to_view(): void
    {
        $user = User::factory()->create();

        PAC::create([
            'nama_pac' => 'PAC Cicurug',
            'kecamatan' => 'Cicurug',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cicurug',
            'desa' => 'Desa Cicurug',
            'ketua_pac' => 'Ketua Cicurug',
            'telepon' => '081234',
        ]);

        $response = $this->actingAs($user)->get('/kegiatan');
        $response->assertOk();
        $response->assertViewHas('pacs');
    }

    public function test_login_page_renders_remember_me_checkbox_with_name_attribute(): void
    {
        $response = $this->get('/login');
        $response->assertOk();
        $response->assertSee('name="remember"', false);
    }

    /**
     * Test Issue #87: Dashboard renders anggota-growth-chart view with anggotaGrowthChart canvas ID.
     */
    public function test_dashboard_renders_anggota_growth_chart_canvas_and_view(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertOk();
        $response->assertSee('id="anggotaGrowthChart"', false);
        $response->assertDontSee('id="pendidikanChart"', false);
    }

    /**
     * Test Issue #85: KegiatanController show method eager loads PAC relation.
     */
    public function test_kegiatan_show_eager_loads_pac_relation(): void
    {
        $user = User::factory()->create();

        $pac = PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cibadak',
            'desa' => 'Desa Cibadak',
            'ketua_pac' => 'Ketua Cibadak',
            'telepon' => '081234',
        ]);

        $kegiatan = Kegiatan::create([
            'pac_id' => $pac->id,
            'judul' => 'Kajian Rutin',
            'tanggal' => '2026-08-10',
            'waktu' => '10:00',
            'lokasi' => 'Masjid Cibadak',
            'kategori' => 'Kajian',
            'peserta' => 40,
            'status' => 'completed',
        ]);

        $response = $this->actingAs($user)->get("/kegiatan/{$kegiatan->id}");
        $response->assertOk();
        $response->assertJson([
            'id' => $kegiatan->id,
            'pac' => [
                'id' => $pac->id,
                'nama_pac' => 'PAC Cibadak',
            ],
        ]);
    }

    /**
     * Test Issue #83: PAC controller rejects future tanggal_berdiri.
     */
    public function test_pac_store_rejects_future_tanggal_berdiri(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('pac.store'), [
            'nama_pac' => 'PAC Masa Depan',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => now()->addDays(5)->format('Y-m-d'),
            'alamat' => 'Alamat',
            'desa' => 'Desa',
            'ketua_pac' => 'Ketua',
            'telepon' => '081234567890',
        ]);

        $response->assertSessionHasErrors('tanggal_berdiri');
    }

    /**
     * Test Issue #83: PAC API pengajuan rejects future tanggal_berdiri.
     */
    public function test_pac_api_pengajuan_rejects_future_tanggal_berdiri(): void
    {
        $response = $this->postJson('/api/pac/pengajuan', [
            'nama_pac' => 'PAC Masa Depan',
            'kecamatan' => 'Cisaat',
            'tanggal_berdiri' => now()->addDays(10)->format('Y-m-d'),
            'ketua_pac' => 'Ketua',
            'telepon' => '081234567890',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('tanggal_berdiri');
    }

    /**
     * Test Issue #82: Anggota index statistics calculation with single quotes in SQL.
     */
    public function test_anggota_stats_query_uses_single_quotes_and_aggregates(): void
    {
        $user = User::factory()->create();

        Anggota::create([
            'nama' => 'Anggota Aktif',
            'email' => 'aktif@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1995-05-12',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'status_pernikahan' => 'kawin',
            'tanggal_bergabung' => now()->format('Y-m-d'),
        ]);

        Anggota::create([
            'nama' => 'Anggota Pasif',
            'email' => 'pasif@example.com',
            'telepon' => null,
            'tanggal_lahir' => null,
            'pac' => 'PAC Cicurug',
            'profesi' => 'Wiraswasta',
            'pendidikan' => 'SMA',
            'status' => 'tidak_aktif',
            'status_pernikahan' => 'belum_kawin',
            'tanggal_bergabung' => now()->subMonth()->format('Y-m-d'),
        ]);

        $response = $this->actingAs($user)->get('/anggota');
        $response->assertOk();
        $response->assertViewHas('totalAnggota', 2);
        $response->assertViewHas('anggotaAktif', 1);
        $response->assertViewHas('anggotaTidakAktif', 1);
        $response->assertViewHas('anggotaBaru', 1);
        $response->assertViewHas('tingkatVerifikasi', 50);
    }
}
