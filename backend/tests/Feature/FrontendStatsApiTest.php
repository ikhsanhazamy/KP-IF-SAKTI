<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\PAC;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendStatsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_frontend_stats_follow_admin_member_pac_and_kecamatan_data(): void
    {
        PAC::create([
            'nama_pac' => 'PAC Cibadak',
            'kecamatan' => 'Cibadak',
            'status' => 'aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cibadak',
            'desa' => 'Cibadak',
            'ketua_pac' => 'Ketua Cibadak',
            'telepon' => '081',
            'jumlah_anggota' => 999,
        ]);

        PAC::create([
            'nama_pac' => 'PAC Cisaat',
            'kecamatan' => 'Cisaat',
            'status' => 'tidak_aktif',
            'tanggal_berdiri' => '2020-01-01',
            'alamat' => 'Alamat Cisaat',
            'desa' => 'Cisaat',
            'ketua_pac' => 'Ketua Cisaat',
            'telepon' => '082',
            'jumlah_anggota' => 888,
        ]);

        Anggota::create([
            'nama' => 'Anggota Lengkap',
            'email' => 'lengkap@example.com',
            'telepon' => '081234567890',
            'tanggal_lahir' => '1995-05-12',
            'pac' => 'PAC Cibadak',
            'profesi' => 'Guru',
            'pendidikan' => 'S1',
            'status' => 'aktif',
            'status_pernikahan' => 'kawin',
            'tanggal_bergabung' => '2026-01-01',
        ]);

        Anggota::create([
            'nama' => 'Anggota Belum Lengkap',
            'email' => 'belum@example.com',
            'telepon' => null,
            'tanggal_lahir' => null,
            'pac' => 'PAC Cisaat',
            'profesi' => 'Wiraswasta',
            'pendidikan' => 'SMA',
            'status' => 'tidak_aktif',
            'status_pernikahan' => 'belum_kawin',
            'tanggal_bergabung' => '2026-01-02',
        ]);

        $this->getJson('/api/stats')
            ->assertOk()
            ->assertJson([
                'total_pac' => 2,
                'pac_aktif' => 1,
                'total_anggota' => 2,
                'anggota_aktif' => 1,
                'total_kecamatan' => 2,
                'tingkat_verifikasi' => 50,
                'kepuasan' => 50,
            ])
            ->assertJsonMissingPath('kegiatan_bulan_ini')
            ->assertJsonMissingPath('total_kegiatan');
    }
}
