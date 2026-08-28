<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\PAC;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
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
            'status_pernikahan' => 'kawin',
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
            'status_pernikahan' => 'kawin',
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
            'status_pernikahan' => 'belum_kawin',
            'tanggal_bergabung' => '2026-02-01',
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'jumlah_anggota' => 100,
            'alumni_lkd' => 12,
        ]);

        $response = $this->actingAs($user)->get('/laporan');

        $response->assertOk()
            ->assertSee('35 tahun')
            ->assertSee('50%')
            ->assertSee('PAC Cibadak')
            ->assertSee('0,0 kegiatan');
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
            'status_pernikahan' => 'kawin',
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

    public function test_import_anggota_dari_csv_menyimpan_status_pernikahan(): void
    {
        $user = User::factory()->create();
        $csv = UploadedFile::fake()->createWithContent(
            'anggota.csv',
            "nama,email,telepon,tanggal_lahir,pac,profesi,pendidikan,status,status_pernikahan,tanggal_bergabung\n".
            "Aisyah Import,aisyah.import@example.com,081233344455,1991-05-20,PAC Cicurug,Guru,S1,aktif,cerai_hidup,2026-06-30\n"
        );

        $this->actingAs($user)
            ->post(route('anggota.import-csv'), ['csv_file' => $csv])
            ->assertRedirect();

        $this->assertDatabaseHas('anggotas', [
            'email' => 'aisyah.import@example.com',
            'status_pernikahan' => 'cerai_hidup',
        ]);
    }

    public function test_export_csv_dan_excel_mencegah_formula_injection(): void
    {
        $user = User::factory()->create();

        Anggota::create([
            'nama' => '=1+1',
            'email' => 'injection@example.com',
            'telepon' => '+628123456789',
            'tanggal_lahir' => '1995-01-01',
            'pac' => '@PAC Formula',
            'profesi' => '-Wiraswasta',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'status_pernikahan' => 'kawin',
            'tanggal_bergabung' => '2026-01-01',
        ]);

        $csv = $this->actingAs($user)->get('/laporan/export/csv');
        $csv->assertOk();
        $content = $csv->streamedContent();

        // Formula characters =, +, -, @ must be prefixed with single quote '
        $this->assertStringContainsString("'=1+1", $content);
        $this->assertStringContainsString("'+628123456789", $content);
        $this->assertStringContainsString("'@PAC Formula", $content);
        $this->assertStringContainsString("'-Wiraswasta", $content);

        $excel = $this->actingAs($user)->get('/laporan/export/excel');
        $excel->assertOk()
            ->assertSee('&#039;=1+1', false)
            ->assertSee('&#039;+628123456789', false);
    }
}
