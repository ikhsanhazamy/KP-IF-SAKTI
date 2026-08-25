<?php

namespace Tests\Feature;

use App\Jobs\SyncPacSubmissionToGoogleSheet;
use App\Models\PAC;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PacPengajuanAsyncJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_pac_pengajuan_dispatches_sync_job_asynchronously(): void
    {
        Queue::fake();

        Config::set('services.google_apps_script.pac_pengajuan_webhook_url', 'https://script.google.com/macros/s/test-webhook/exec');
        Config::set('services.google_apps_script.pac_pengajuan_webhook_token', 'secret-token-123');

        $response = $this->postJson('/api/pac/pengajuan', [
            'nama_pac' => 'PAC Pelabuhan Ratu',
            'kecamatan' => 'Pelabuhanratu',
            'tanggal_berdiri' => '2022-05-10',
            'alamat' => 'Jl. Siliwangi No. 10',
            'desa' => 'Pelabuhanratu',
            'kode_pos' => '43364',
            'ketua_pac' => 'Siti Nurhaliza',
            'telepon' => '08123456789',
            'email' => 'pac.pelabuhanratu@example.com',
            'deskripsi' => 'Pengajuan PAC baru',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'google_sheet_synced' => true,
        ]);

        $this->assertDatabaseHas('pacs', [
            'nama_pac' => 'PAC Pelabuhan Ratu',
            'status' => 'pending',
        ]);

        Queue::assertPushed(SyncPacSubmissionToGoogleSheet::class, function ($job) {
            return $job->pac->nama_pac === 'PAC Pelabuhan Ratu';
        });
    }

    public function test_sync_job_executes_webhook_http_post(): void
    {
        Http::fake([
            'https://script.google.com/macros/s/test-webhook/exec' => Http::response(['status' => 'success'], 200),
        ]);

        Config::set('services.google_apps_script.pac_pengajuan_webhook_url', 'https://script.google.com/macros/s/test-webhook/exec');
        Config::set('services.google_apps_script.pac_pengajuan_webhook_token', 'test-token');

        $pac = PAC::create([
            'nama_pac' => 'PAC Surade',
            'kecamatan' => 'Surade',
            'status' => 'pending',
            'tanggal_berdiri' => '2023-01-01',
            'alamat' => 'Jl. Surade',
            'desa' => 'Surade',
            'kode_pos' => '43792',
            'ketua_pac' => 'Aisyah',
            'telepon' => '08987654321',
            'email' => 'pac.surade@example.com',
            'jumlah_anggota' => 0,
            'total_kegiatan' => 0,
            'deskripsi' => 'PAC Surade',
        ]);

        $job = new SyncPacSubmissionToGoogleSheet($pac);
        $job->handle();

        Http::assertSent(function ($request) {
            return $request->url() === 'https://script.google.com/macros/s/test-webhook/exec'
                && $request['pac']['nama_pac'] === 'PAC Surade';
        });
    }
}
