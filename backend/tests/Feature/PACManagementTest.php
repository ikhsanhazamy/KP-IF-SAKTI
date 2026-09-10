<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PACManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_pac_baru_disimpan_dan_muncul_bersama_tiga_data_sebelumnya(): void
    {
        $user = User::factory()->create();

        foreach (range(1, 3) as $index) {
            PAC::create([
                'nama_pac' => 'PAC Lama '.$index,
                'kecamatan' => 'Kecamatan '.$index,
                'status' => 'aktif',
                'tanggal_berdiri' => '2020-01-01',
                'alamat' => 'Alamat '.$index,
                'desa' => 'Desa '.$index,
                'ketua_pac' => 'Ketua '.$index,
                'telepon' => '08123456789'.$index,
            ]);
        }

        $response = $this->actingAs($user)->post(route('pac.store'), [
            'nama_pac' => 'PAC Baru',
            'kecamatan' => 'Kecamatan Baru',
            'status' => 'aktif',
            'tanggal_berdiri' => '2026-06-15',
            'alamat' => 'Jalan Baru',
            'desa' => 'Desa Baru',
            'kode_pos' => '43100',
            'ketua_pac' => 'Ketua Baru',
            'telepon' => '081299999999',
            'email' => 'pacbaru@example.com',
            'jumlah_anggota' => 25,
            'nomor_sk' => 'SK-004',
            'alumni_lkd' => 2,
            'deskripsi' => 'PAC yang baru ditambahkan',
        ]);

        $pacBaru = PAC::where('nama_pac', 'PAC Baru')->firstOrFail();
        $response->assertRedirect(route('pac.index').'#pac-'.$pacBaru->id);
        $this->assertDatabaseCount('pacs', 4);
        $this->assertDatabaseHas('pacs', [
            'nama_pac' => 'PAC Baru',
            'ketua_pac' => 'Ketua Baru',
            'alumni_lkd' => 2,
        ]);

        $this->actingAs($user)
            ->get(route('pac.index'))
            ->assertOk()
            ->assertSee('PAC Baru')
            ->assertSee('PAC Lama 1')
            ->assertSee('PAC Lama 2')
            ->assertSee('PAC Lama 3');
    }

    public function test_form_tambah_pac_menggunakan_nama_field_yang_sesuai_controller(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('pac.index'))
            ->assertOk()
            ->assertSee('name="ketua_pac"', false);
    }

    public function test_import_pac_dari_csv_menyimpan_alumni_lkd_dan_status_akan_expire(): void
    {
        $user = User::factory()->create();
        $csv = UploadedFile::fake()->createWithContent(
            'pac.csv',
            "nama_pac,kecamatan,status,tanggal_berdiri,alamat,desa,ketua_pac,telepon,jumlah_anggota,alumni_lkd\n".
            "PAC Import,Cisaat,akan_expire,2026-06-30,Jalan Import,Desa Import,Ketua Import,081200000001,30,12\n"
        );

        $this->actingAs($user)
            ->post(route('pac.import-csv'), ['csv_file' => $csv])
            ->assertRedirect(route('pac.index'));

        $this->assertDatabaseHas('pacs', [
            'nama_pac' => 'PAC Import',
            'status' => 'akan_expire',
            'alumni_lkd' => 12,
        ]);
    }

    public function test_data_pac_bisa_die_export_ke_excel(): void
    {
        $user = User::factory()->create();

        PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'akan_expire',
            'tanggal_berdiri' => '2026-06-30',
            'alamat' => 'Jalan Cibadak',
            'desa' => 'Cibadak',
            'ketua_pac' => 'Ketua Cibadak',
            'telepon' => '081234567890',
            'jumlah_anggota' => 247,
            'alumni_lkd' => 18,
            'nomor_sk' => 'SK-001',
        ]);

        $this->actingAs($user)
            ->get(route('pac.export-excel'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->assertSee('PAC Cibadak')
            ->assertSee('Akan Expire')
            ->assertSee('Alumni LKD');
    }

    public function test_total_kecamatan_menghitung_kecamatan_secara_unik(): void
    {
        $user = User::factory()->create();

        PAC::create([
            'nama_pac' => 'PAC Cibadak 1',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2026-01-01',
            'alamat' => 'Alamat 1',
            'desa' => 'Desa 1',
            'ketua_pac' => 'Ketua 1',
            'telepon' => '081234567891',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cibadak 2',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2026-01-02',
            'alamat' => 'Alamat 2',
            'desa' => 'Desa 2',
            'ketua_pac' => 'Ketua 2',
            'telepon' => '081234567892',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cisaat',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2026-01-03',
            'alamat' => 'Alamat 3',
            'desa' => 'Desa 3',
            'ketua_pac' => 'Ketua 3',
            'telepon' => '081234567893',
        ]);

        $response = $this->actingAs($user)->get(route('pac.index'));
        $response->assertOk();
        $response->assertViewHas('totalPAC', 3);
        $response->assertViewHas('totalKecamatan', 2);
    }

    public function test_pac_member_growth_uses_database_aggregation(): void
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
            'telepon' => '081234567890',
        ]);

        Anggota::create([
            'nama' => 'Anggota Bulan Ini',
            'email' => 'bulanini@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1995-05-12',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'status_pernikahan' => 'kawin',
            'tanggal_bergabung' => now()->format('Y-m-d'),
        ]);

        $response = $this->actingAs($user)->get(route('pac.index'));
        $response->assertOk();
        $pacs = $response->viewData('pacs');
        $this->assertEquals(100.0, $pacs->first()->growth);
    }

    public function test_pac_dengan_status_pending_dapat_diupdate_dan_ditampilkan(): void
    {
        $user = User::factory()->create();

        $pac = PAC::create([
            'nama_pac' => 'PAC Cisolok',
            'kecamatan' => 'Cisolok',
            'status' => 'pending',
            'tanggal_berdiri' => '2026-01-01',
            'alamat' => 'Jl. Raya Cisolok',
            'desa' => 'Cisolok',
            'ketua_pac' => 'Ketua Cisolok',
            'telepon' => '081234567899',
        ]);

        $response = $this->actingAs($user)->get(route('pac.index'));
        $response->assertOk()
            ->assertSee('PAC Cisolok')
            ->assertSee('Pending / Verifikasi');

        $updateResponse = $this->actingAs($user)->put(route('pac.update', $pac->id), [
            'nama_pac' => 'PAC Cisolok',
            'kecamatan' => 'Cisolok',
            'status' => 'aktif',
            'tanggal_berdiri' => '2026-01-01',
            'alamat' => 'Jl. Raya Cisolok No. 1',
            'desa' => 'Cisolok',
            'ketua_pac' => 'Ketua Cisolok Baru',
            'telepon' => '081234567899',
        ]);

        $updateResponse->assertRedirect(route('pac.index'));
        $this->assertDatabaseHas('pacs', [
            'id' => $pac->id,
            'status' => 'aktif',
            'ketua_pac' => 'Ketua Cisolok Baru',
        ]);
    }

    public function test_pac_kegiatans_relationship_and_api_total_kegiatan_count(): void
    {
        $pac = PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cibadak',
            'desa' => 'Desa Cibadak',
            'ketua_pac' => 'Ketua Cibadak',
            'telepon' => '081234567890',
        ]);

        Kegiatan::create([
            'pac_id' => $pac->id,
            'judul' => 'Kegiatan PAC 1',
            'tanggal' => '2026-06-01',
            'waktu' => '09:00',
            'lokasi' => 'Aula',
            'kategori' => 'Seminar',
            'peserta' => 50,
            'status' => 'completed',
        ]);

        Kegiatan::create([
            'pac_id' => $pac->id,
            'judul' => 'Kegiatan PAC 2',
            'tanggal' => '2026-06-02',
            'waktu' => '10:00',
            'lokasi' => 'Gedung',
            'kategori' => 'Pelatihan',
            'peserta' => 70,
            'status' => 'completed',
        ]);

        $this->assertCount(2, $pac->kegiatans);
        $this->assertInstanceOf(Kegiatan::class, $pac->kegiatans->first());

        $response = $this->getJson('/api/pac');
        $response->assertOk();
        $response->assertJsonFragment([
            'id' => $pac->id,
            'nama_pac' => 'PAC Cibadak',
            'total_kegiatan' => 2,
        ]);
    }

    public function test_label_tanggal_penetapan_sk_dan_input_tanggal_kedaluwarsa_tersedia(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('pac.index'));

        $response->assertOk();
        $response->assertSee('Tanggal Penetapan SK');
        $response->assertSee('Tanggal Kedaluwarsa');
        $response->assertSee('name="tanggal_kedaluwarsa"', false);
    }

    public function test_tambah_pac_dengan_tanggal_kedaluwarsa_otomatis_menentukan_status(): void
    {
        $user = User::factory()->create();

        // 1. Kedaluwarsa di masa lalu -> harus menjadi tidak_aktif
        $this->actingAs($user)->post(route('pac.store'), [
            'nama_pac' => 'PAC Kadaluarsa',
            'kecamatan' => 'Cicurug',
            'status' => 'aktif', // User pilih aktif di UI, tapi sistem harus mengoreksi
            'tanggal_berdiri' => '2020-01-01',
            'tanggal_kedaluwarsa' => now()->subDays(5)->format('Y-m-d'),
            'alamat' => 'Alamat Kadaluarsa',
            'desa' => 'Desa Kadaluarsa',
            'ketua_pac' => 'Ketua Kadaluarsa',
            'telepon' => '081234567801',
        ]);

        $this->assertDatabaseHas('pacs', [
            'nama_pac' => 'PAC Kadaluarsa',
            'status' => 'tidak_aktif',
        ]);

        // 2. Kedaluwarsa dalam 15 hari (<= 30 hari) -> harus menjadi akan_expire
        $this->actingAs($user)->post(route('pac.store'), [
            'nama_pac' => 'PAC Mau Expire',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2022-01-01',
            'tanggal_kedaluwarsa' => now()->addDays(15)->format('Y-m-d'),
            'alamat' => 'Alamat Mau Expire',
            'desa' => 'Desa Mau Expire',
            'ketua_pac' => 'Ketua Mau Expire',
            'telepon' => '081234567802',
        ]);

        $this->assertDatabaseHas('pacs', [
            'nama_pac' => 'PAC Mau Expire',
            'status' => 'akan_expire',
        ]);

        // 3. Kedaluwarsa masih 1 tahun lagi (> 30 hari) -> aktif
        $this->actingAs($user)->post(route('pac.store'), [
            'nama_pac' => 'PAC Masih Aktif',
            'kecamatan' => 'Cisaat',
            'status' => 'tidak_aktif', // User salah pilih, sistem set ke aktif
            'tanggal_berdiri' => '2024-01-01',
            'tanggal_kedaluwarsa' => now()->addYear()->format('Y-m-d'),
            'alamat' => 'Alamat Masih Aktif',
            'desa' => 'Desa Masih Aktif',
            'ketua_pac' => 'Ketua Masih Aktif',
            'telepon' => '081234567803',
        ]);

        $this->assertDatabaseHas('pacs', [
            'nama_pac' => 'PAC Masih Aktif',
            'status' => 'aktif',
        ]);
    }

    public function test_update_pac_menyesuaikan_status_secara_dinamis_berdasarkan_tanggal_kedaluwarsa(): void
    {
        $user = User::factory()->create();

        $pac = PAC::create([
            'nama_pac' => 'PAC Dinamis',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'tanggal_kedaluwarsa' => now()->addYear()->format('Y-m-d'),
            'alamat' => 'Alamat Dinamis',
            'desa' => 'Desa Dinamis',
            'ketua_pac' => 'Ketua Dinamis',
            'telepon' => '081234567899',
        ]);

        // Perpanjang tapi hanya 10 hari lagi -> status otomatis jadi akan_expire
        $this->actingAs($user)->put(route('pac.update', $pac->id), [
            'nama_pac' => 'PAC Dinamis',
            'kecamatan' => 'Cisaat',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'tanggal_kedaluwarsa' => now()->addDays(10)->format('Y-m-d'),
            'alamat' => 'Alamat Dinamis',
            'desa' => 'Desa Dinamis',
            'ketua_pac' => 'Ketua Dinamis',
            'telepon' => '081234567899',
        ]);

        $this->assertDatabaseHas('pacs', [
            'id' => $pac->id,
            'status' => 'akan_expire',
        ]);
    }

    public function test_halaman_index_auto_sync_status_pac_yang_sudah_kedaluwarsa(): void
    {
        $user = User::factory()->create();

        // PAC yang tersimpan statusnya aktif tapi tanggal kedaluwarsanya sudah lewat
        $pac = PAC::create([
            'nama_pac' => 'PAC Expired di DB',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'tanggal_kedaluwarsa' => now()->subDay()->format('Y-m-d'),
            'alamat' => 'Alamat Expired',
            'desa' => 'Desa Expired',
            'ketua_pac' => 'Ketua Expired',
            'telepon' => '081234567888',
        ]);

        // Kunjungi halaman index admin
        $this->actingAs($user)->get(route('pac.index'))->assertOk();

        // Status di database harus otomatis tersinkronisasi menjadi tidak_aktif
        $this->assertDatabaseHas('pacs', [
            'id' => $pac->id,
            'status' => 'tidak_aktif',
        ]);
    }
}
