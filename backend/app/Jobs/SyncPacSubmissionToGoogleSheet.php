<?php

namespace App\Jobs;

use App\Models\PAC;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class SyncPacSubmissionToGoogleSheet implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 30;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public PAC $pac,
        public array $payload = []
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $webhookUrl = config('services.google_apps_script.pac_pengajuan_webhook_url');

        if (! $webhookUrl) {
            return;
        }

        $payload = ! empty($this->payload) ? $this->payload : [
            'token' => config('services.google_apps_script.pac_pengajuan_webhook_token'),
            'source' => config('app.name', 'KP-IF-SAKTI'),
            'submitted_at' => now()->toIso8601String(),
            'pac' => [
                'id' => $this->pac->id,
                'nama_pac' => $this->pac->nama_pac,
                'kecamatan' => $this->pac->kecamatan,
                'status' => $this->pac->status,
                'tanggal_berdiri' => (string) $this->pac->tanggal_berdiri,
                'ketua_pac' => $this->pac->ketua_pac,
                'telepon' => $this->pac->telepon,
                'email' => $this->pac->email,
                'desa' => $this->pac->desa,
                'kode_pos' => $this->pac->kode_pos,
                'alamat' => $this->pac->alamat,
                'deskripsi' => $this->pac->deskripsi,
            ],
        ];

        try {
            $response = Http::timeout(15)
                ->withOptions(['allow_redirects' => true])
                ->asJson()
                ->post($webhookUrl, $payload);

            if (! $response->successful()) {
                Log::warning('Sinkronisasi pengajuan PAC ke Google Sheet gagal.', [
                    'pac_id' => $this->pac->id,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            } else {
                Log::info('Sinkronisasi pengajuan PAC ke Google Sheet berhasil.', [
                    'pac_id' => $this->pac->id,
                ]);
            }
        } catch (Throwable $e) {
            Log::warning('Sinkronisasi pengajuan PAC ke Google Sheet error.', [
                'pac_id' => $this->pac->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
