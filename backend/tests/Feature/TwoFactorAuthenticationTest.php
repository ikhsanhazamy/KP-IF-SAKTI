<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TwoFactorAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_two_factor_can_login_directly(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'two_factor_enabled' => false,
        ]);

        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertOk();
    }

    public function test_user_with_two_factor_is_redirected_to_two_factor_challenge(): void
    {
        $user = User::factory()->create([
            'email' => 'admin2fa@example.com',
            'password' => Hash::make('password123'),
            'two_factor_enabled' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'admin2fa@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('two-factor.challenge'));
        $this->assertGuest();
        $response->assertSessionHas('two_factor_user_id', $user->id);
        $response->assertSessionHas('two_factor_code');
    }

    public function test_user_can_view_two_factor_challenge_page(): void
    {
        $user = User::factory()->create([
            'two_factor_enabled' => true,
        ]);

        // Without session -> redirected to login
        $this->get(route('two-factor.challenge'))
            ->assertRedirect('/login');

        // With session -> challenge page rendered
        $this->withSession(['two_factor_user_id' => $user->id])
            ->get(route('two-factor.challenge'))
            ->assertOk()
            ->assertSee('Verifikasi Dua Faktor');
    }

    public function test_invalid_two_factor_code_is_rejected(): void
    {
        $user = User::factory()->create([
            'two_factor_enabled' => true,
        ]);

        $response = $this->withSession([
            'two_factor_user_id' => $user->id,
            'two_factor_code' => '123456',
            'two_factor_expires_at' => now()->addMinutes(10)->timestamp,
        ])->post(route('two-factor.verify'), [
            'code' => '999999',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('code');
        $this->assertGuest();
    }

    public function test_valid_two_factor_code_authenticates_user_and_grants_dashboard_access(): void
    {
        $user = User::factory()->create([
            'two_factor_enabled' => true,
        ]);

        $response = $this->withSession([
            'two_factor_user_id' => $user->id,
            'two_factor_code' => '654321',
            'two_factor_expires_at' => now()->addMinutes(10)->timestamp,
        ])->post(route('two-factor.verify'), [
            'code' => '654321',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
        $response->assertSessionMissing('two_factor_user_id');
        $response->assertSessionMissing('two_factor_code');

        $dashboardResponse = $this->get('/dashboard');
        $dashboardResponse->assertOk();
    }

    public function test_user_can_resend_two_factor_code(): void
    {
        $user = User::factory()->create([
            'two_factor_enabled' => true,
        ]);

        $response = $this->withSession([
            'two_factor_user_id' => $user->id,
            'two_factor_code' => '111111',
            'two_factor_expires_at' => now()->addMinutes(10)->timestamp,
        ])->post(route('two-factor.resend'));

        $response->assertRedirect();
        $response->assertSessionHas('status');
        $response->assertSessionHas('two_factor_code');
    }

    public function test_two_factor_enabled_user_cannot_access_dashboard_without_2fa_verification_session(): void
    {
        $user = User::factory()->create([
            'two_factor_enabled' => true,
        ]);

        // actingAs without two_factor_verified in session
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_excessive_failed_attempts_locks_out_two_factor_session(): void
    {
        $user = User::factory()->create([
            'two_factor_enabled' => true,
        ]);

        $sessionData = [
            'two_factor_user_id' => $user->id,
            'two_factor_code' => '123456',
            'two_factor_expires_at' => now()->addMinutes(10)->timestamp,
            'two_factor_attempts' => 5, // 5 prior failed attempts
        ];

        // 6th attempt should invalidate the session and redirect to login
        $response = $this->withSession($sessionData)
            ->post(route('two-factor.verify'), [
                'code' => '000000',
            ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
