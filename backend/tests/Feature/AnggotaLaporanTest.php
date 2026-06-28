<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\PAC;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnggotaLaporanTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_tanggal_lahir_disimpan_dan_umur_dihitung(): void
    {
        Carbon::setTestNow('2026-06-12');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/anggota/store', [
            'nama' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1996-06-12',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'tanggal_bergabung' => '2026-01-10',
        ]);

        $response->assertRedirect();

        $anggota = Anggota::where('email', 'siti@example.com')->firstOrFail();
        $this->assertSame('1996-06-12', $anggota->tanggal_lahir->format('Y-m-d'));
        $this->assertSame(30, $anggota->umur);
    }

    public function test_ringkasan_laporan_mengikuti_data_database(): void
    {
        Carbon::setTestNow('2026-06-12');
        $user = User::factory()->create();

        Anggota::create([
            'nama' => 'Anggota Aktif',
            'email' => 'aktif@example.com',
            'telepon' => '081111111111',
            'tanggal_lahir' => '1996-06-12',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'tanggal_bergabung' => '2026-01-01',
        ]);

        Anggota::create([
            'nama' => 'Anggota Tidak Aktif',
            'email' => 'nonaktif@example.com',
            'telepon' => '082222222222',
            'tanggal_lahir' => '1986-06-12',
            'pac' => 'PAC Cicurug',
            'profesi' => 'Wiraswasta',
            'pendidikan' => 'SMA',
            'status' => 'tidak_aktif',
            'tanggal_bergabung' => '2026-02-01',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'jumlah_anggota' => 100,
            'total_kegiatan' => 12,
        ]);

        $response = $this->actingAs($user)->get('/laporan');

        $response->assertOk()
            ->assertSee('35 tahun')
            ->assertSee('50%')
            ->assertSee('PAC Cibadak')
            ->assertSee('12,0 kegiatan');
    }

    public function test_export_csv_excel_dan_generate_pdf_berfungsi(): void
    {
        Carbon::setTestNow('2026-06-12');
        $user = User::factory()->create();

        Anggota::create([
            'nama' => 'Nurhayati',
            'email' => 'nurhayati@example.com',
            'telepon' => '083333333333',
            'tanggal_lahir' => '1990-04-10',
            'pac' => 'PAC Cisaat',
            'profesi' => 'Dosen',
            'pendidikan' => 'S2',
            'status' => 'aktif',
            'tanggal_bergabung' => '2025-03-02',
        ]);

        $csv = $this->actingAs($user)->get('/laporan/export/csv');
        $csv->assertOk()
            ->assertDownload('data-anggota.csv');
        $this->assertStringContainsString('Nurhayati', $csv->streamedContent());

        $excel = $this->actingAs($user)->get('/laporan/export/excel');
        $excel->assertOk()
            ->assertDownload('data-anggota.xls')
            ->assertSee('Nurhayati');

        $pdf = $this->actingAs($user)->get('/laporan/generate/anggota');
        $pdf->assertOk()
            ->assertDownload('laporan-anggota.pdf');
    }
}
