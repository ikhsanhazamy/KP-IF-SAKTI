<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah',
            ])->withInput($request->only('email'));
        }

        if ($user->two_factor_enabled) {
            $code = sprintf('%06d', random_int(100000, 999999));

            $request->session()->put('two_factor_user_id', $user->id);
            $request->session()->put('two_factor_code', $code);
            $request->session()->put('two_factor_expires_at', now()->addMinutes(10)->timestamp);
            $request->session()->put('two_factor_remember', (bool) $request->boolean('remember'));

            Log::info('Two factor authentication challenge initiated', ['user_id' => $user->id]);

            return redirect()->route('two-factor.challenge');
        }

        Auth::login($user, (bool) $request->boolean('remember'));
        $request->session()->regenerate();
        $request->session()->put('two_factor_verified', true);

        return redirect('/dashboard');
    }

    public function showTwoFactorChallenge(Request $request)
    {
        if (! $request->session()->has('two_factor_user_id')) {
            return redirect('/login');
        }

        return view('auth.two-factor-challenge');
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        if (! $request->session()->has('two_factor_user_id') || ! $request->session()->has('two_factor_code')) {
            return redirect('/login')->withErrors([
                'email' => 'Sesi verifikasi dua faktor tidak ditemukan. Silakan login kembali.',
            ]);
        }

        $expiresAt = (int) $request->session()->get('two_factor_expires_at', 0);
        if (now()->timestamp > $expiresAt) {
            $request->session()->forget(['two_factor_user_id', 'two_factor_code', 'two_factor_expires_at', 'two_factor_remember']);

            return redirect('/login')->withErrors([
                'email' => 'Kode OTP 2FA telah kadaluwarsa. Silakan login kembali.',
            ]);
        }

        if ($request->input('code') !== (string) $request->session()->get('two_factor_code')) {
            return back()->withErrors([
                'code' => 'Kode verifikasi 2FA tidak valid.',
            ]);
        }

        $userId = $request->session()->get('two_factor_user_id');
        $remember = (bool) $request->session()->get('two_factor_remember', false);

        $request->session()->forget(['two_factor_user_id', 'two_factor_code', 'two_factor_expires_at', 'two_factor_remember']);

        Auth::loginUsingId($userId, $remember);
        $request->session()->regenerate();
        $request->session()->put('two_factor_verified', true);

        Log::info('Two factor authentication completed successfully', ['user_id' => $userId]);

        return redirect('/dashboard');
    }

    public function resendTwoFactorCode(Request $request)
    {
        if (! $request->session()->has('two_factor_user_id')) {
            return redirect('/login');
        }

        $code = sprintf('%06d', random_int(100000, 999999));
        $request->session()->put('two_factor_code', $code);
        $request->session()->put('two_factor_expires_at', now()->addMinutes(10)->timestamp);

        Log::info('Two factor authentication code regenerated', [
            'user_id' => $request->session()->get('two_factor_user_id'),
        ]);

        return back()->with('status', 'Kode OTP 2FA baru berhasil dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
