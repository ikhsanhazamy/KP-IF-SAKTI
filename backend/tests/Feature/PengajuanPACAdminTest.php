<?php

namespace Tests\Feature;

use App\Models\PAC;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengajuanPACAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_pengajuan_pac(): void
    {
        $response = $this->get(route('pengajuan-pac.index'));
        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_pengajuan_pac_list(): void
    {
        $user = User::factory()->create();

        $pendingPac = PAC::create([
            'nama_pac' => 'PAC Cikembar',
            'kecamatan' => 'Cikembar',
            'status' => 'pending',
            'tanggal_berdiri' => '2024-01-10',
            'alamat' => 'Jl. Raya Cikembar No. 12',
            'desa' => 'Cikembar',
            'ketua_pac' => 'Siti Khodijah',
            'telepon' => '081234567890',
            'deskripsi' => 'Pengajuan PAC baru dengan 20 anggota.',
        ]);

        $response = $this->actingAs($user)->get(route('pengajuan-pac.index'));

        $response->assertOk();
        $response->assertSee('Persetujuan Pengajuan PAC');
        $response->assertSee('PAC Cikembar');
        $response->assertSee('Siti Khodijah');
        $response->assertSee('Menunggu Persetujuan');
    }

    public function test_admin_can_fetch_pengajuan_pac_detail_json(): void
    {
        $user = User::factory()->create();

        $pac = PAC::create([
            'nama_pac' => 'PAC Cibadak Baru',
            'kecamatan' => 'Cibadak',
            'status' => 'pending',
            'tanggal_berdiri' => '2024-02-15',
            'alamat' => 'Jl. Surya Kencana No. 5',
            'desa' => 'Cibadak',
            'ketua_pac' => 'Rina Marlina',
            'telepon' => '085712345678',
            'deskripsi' => 'Rencana pembentukan cabang kader muda.',
        ]);

        $response = $this->actingAs($user)->get(route('pengajuan-pac.show', $pac->id));

        $response->assertOk();
        $response->assertJson([
            'id' => $pac->id,
            'nama_pac' => 'PAC Cibadak Baru',
            'kecamatan' => 'Cibadak',
            'ketua_pac' => 'Rina Marlina',
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_approve_pending_pac(): void
    {
        $user = User::factory()->create();

        $pac = PAC::create([
            'nama_pac' => 'PAC Warungkiara',
            'kecamatan' => 'Warungkiara',
            'status' => 'pending',
            'tanggal_berdiri' => '2024-03-01',
            'alamat' => 'Jl. Pelabuhan II Km 25',
            'desa' => 'Warungkiara',
            'ketua_pac' => 'Aisyah',
            'telepon' => '087812345678',
        ]);

        $response = $this->actingAs($user)->post(route('pengajuan-pac.approve', $pac->id), [
            'nomor_sk' => 'SK-099/PC-FN/III/2026',
        ]);

        $response->assertSessionHas('success');

        $pac->refresh();
        $this->assertEquals('aktif', $pac->status);
        $this->assertEquals('SK-099/PC-FN/III/2026', $pac->nomor_sk);
    }

    public function test_admin_can_reject_pending_pac(): void
    {
        $user = User::factory()->create();

        $pac = PAC::create([
            'nama_pac' => 'PAC Simpenan Uji',
            'kecamatan' => 'Simpenan',
            'status' => 'pending',
            'tanggal_berdiri' => '2024-04-01',
            'alamat' => 'Jl. Cidadap No. 1',
            'desa' => 'Cidadap',
            'ketua_pac' => 'Dewi',
            'telepon' => '089612345678',
        ]);

        $response = $this->actingAs($user)->post(route('pengajuan-pac.reject', $pac->id), [
            'alasan_penolakan' => 'Data persyaratan administrasi belum memenuhi kuorum.',
        ]);

        $response->assertSessionHas('success');

        $pac->refresh();
        $this->assertEquals('ditolak', $pac->status);
        $this->assertStringContainsString('Data persyaratan administrasi belum memenuhi kuorum.', $pac->deskripsi);
    }

    public function test_dashboard_renders_pending_pac_widget(): void
    {
        $user = User::factory()->create();

        PAC::create([
            'nama_pac' => 'PAC Sagaranten',
            'kecamatan' => 'Sagaranten',
            'status' => 'pending',
            'tanggal_berdiri' => '2024-05-01',
            'alamat' => 'Jl. Raya Sagaranten',
            'desa' => 'Sagaranten',
            'ketua_pac' => 'Hj. Halimah',
            'telepon' => '081399887766',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Persetujuan Pengajuan PAC');
        $response->assertSee('PAC Sagaranten');
        $response->assertSee('Perlu Tindakan');
    }
}
