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

        $this->actingAs($user)
            ->get('/pengaturan/sistem')
            ->assertOk()
            ->assertViewHas('pengaturan');
    }

    public function test_user_can_save_and_view_sistem_settings(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('pengaturan.update'), [
            'language' => 'en',
            'timezone' => 'Asia/Makassar',
            'date_format' => 'Y-m-d',
        ])->assertRedirect();

        $this->actingAs($user)
            ->get('/pengaturan/sistem')
            ->assertOk()
            ->assertSee('value="en" selected', false)
            ->assertSee('value="Asia/Makassar" selected', false)
            ->assertSee('value="Y-m-d" selected', false);
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

    public function test_user_can_backup_and_restore_sqlite_database(): void
    {
        $user = User::factory()->create();

        // Test Backup
        $response = $this->actingAs($user)->post(route('backup.database'));
        $response->assertOk();
        $response->assertHeader('content-disposition');

        // Test Restore with SQLite file
        $tempDb = tempnam(sys_get_temp_dir(), 'test_restore_');
        file_put_contents($tempDb, 'SQLite format 3');
        $uploadedFile = new UploadedFile($tempDb, 'backup.sqlite', 'application/x-sqlite3', null, true);

        $restoreResponse = $this->actingAs($user)->post(route('restore.database'), [
            'backup_file' => $uploadedFile,
        ]);

        $restoreResponse->assertRedirect();
        $restoreResponse->assertSessionHas('success');

        if (file_exists($tempDb)) {
            @unlink($tempDb);
        }
    }

    public function test_restore_invalid_file_format_returns_error_session(): void
    {
        $user = User::factory()->create();

        $invalidTemp = tempnam(sys_get_temp_dir(), 'test_invalid_');
        file_put_contents($invalidTemp, 'Corrupted binary data content');
        $uploadedFile = new UploadedFile($invalidTemp, 'invalid.txt', 'text/plain', null, true);

        $response = $this->actingAs($user)->post(route('restore.database'), [
            'backup_file' => $uploadedFile,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        if (file_exists($invalidTemp)) {
            @unlink($invalidTemp);
        }
    }
}
