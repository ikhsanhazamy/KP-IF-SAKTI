<?php

namespace Tests\Feature;

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
}
