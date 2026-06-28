<?php

namespace Tests\Feature;

use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PengaturanTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_setting_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/pengaturan/profil')
            ->assertOk();

        $this->actingAs($user)
            ->get('/pengaturan/keamanan')
            ->assertOk();

        $this->actingAs($user)
            ->get('/pengaturan/notifikasi')
            ->assertOk();
    }

    public function test_user_can_update_profile_information(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('pengaturan.profil.update'), [
            'name' => 'Admin Fatayat',
            'email' => 'admin.fatayat@example.com',
            'phone' => '081234567890',
            'jabatan' => 'Super Admin',
        ]);

        $response->assertRedirect('/pengaturan/profil');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Admin Fatayat',
            'email' => 'admin.fatayat@example.com',
            'phone' => '081234567890',
            'jabatan' => 'Super Admin',
        ]);
    }

    public function test_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-lama'),
        ]);

        $response = $this->actingAs($user)->post(route('pengaturan.password.update'), [
            'old_password' => 'password-lama',
            'new_password' => 'password-baru',
            'new_password_confirmation' => 'password-baru',
        ]);

        $response->assertRedirect('/pengaturan/keamanan');
        $this->assertTrue(Hash::check('password-baru', $user->fresh()->password));
    }

    public function test_user_can_upload_and_delete_profile_photo(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $photo = UploadedFile::fake()->createWithContent(
            'avatar.png',
            base64_decode(
                'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII='
            )
        );

        $this->actingAs($user)->post(route('pengaturan.profil.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '081234567890',
            'jabatan' => 'Admin',
            'photo' => $photo,
        ])->assertRedirect('/pengaturan/profil');

        $photoPath = $user->fresh()->photo;
        $this->assertNotNull($photoPath);
        Storage::disk('public')->assertExists($photoPath);

        $this->actingAs($user)
            ->get('/pengaturan/profil')
            ->assertOk()
            ->assertSee('/storage/'.$photoPath, false)
            ->assertSee('profilePhotoPreview', false);

        $this->actingAs($user)
            ->delete(route('pengaturan.profil.foto.delete'))
            ->assertRedirect('/pengaturan/profil');

        Storage::disk('public')->assertMissing($photoPath);
        $this->assertNull($user->fresh()->photo);
    }

    public function test_user_can_save_two_factor_preference(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('pengaturan.two-factor.update'), [
            'two_factor_enabled' => '1',
        ]);

        $response->assertRedirect('/pengaturan/keamanan');
        $this->assertTrue($user->fresh()->two_factor_enabled);
    }

    public function test_user_can_save_notification_preferences(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('pengaturan.notifikasi.update'), [
            'email_notification' => '1',
            'kegiatan_notification' => '0',
            'anggota_notification' => '1',
            'pac_notification' => '1',
        ]);

        $response->assertRedirect('/pengaturan/notifikasi');

        $settings = Pengaturan::firstOrFail();
        $this->assertTrue($settings->email_notification);
        $this->assertFalse($settings->kegiatan_notification);
        $this->assertTrue($settings->anggota_notification);
        $this->assertTrue($settings->pac_notification);
    }
}
