<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Process;

class PengaturanController extends Controller
{
    public function index()
    {
        return redirect('/pengaturan/profil');
    }

    public function profil()
    {
        return view('pengaturan.index', [
            'activeTab' => 'profil',
        ]);
    }

    public function updateProfil(Request $request)
    {
        $user = $this->authenticatedUser();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $oldPhoto = $user->photo;
            $newPhoto = $request->file('photo')->store('profiles', 'public');

            if (! $newPhoto) {
                throw ValidationException::withMessages([
                    'photo' => 'Foto gagal disimpan. Silakan coba kembali.',
                ]);
            }

            $validated['photo'] = $newPhoto;
        } else {
            unset($validated['photo']);
        }

        $user->update($validated);

        if (isset($newPhoto) && $oldPhoto && $oldPhoto !== $newPhoto) {
            Storage::disk('public')->delete($oldPhoto);
        }

        return redirect()
            ->to('/pengaturan/profil')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function hapusFoto()
    {
        $user = $this->authenticatedUser();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
            $user->update(['photo' => null]);
        }

        return redirect()
            ->to('/pengaturan/profil')
            ->with('success', 'Foto berhasil dihapus');
    }

    public function keamanan()
    {
        return view('pengaturan.index', [
            'activeTab' => 'keamanan',
        ]);
    }

    public function notifikasi()
    {
        return view('pengaturan.index', [
            'activeTab' => 'notifikasi',
            'pengaturan' => $this->settings(),
        ]);
    }

    public function sistem()
    {
        return view('pengaturan.index', [
            'activeTab' => 'sistem',
        ]);
    }

    public function updateNotifikasi(Request $request)
    {
        $validated = $request->validate([
            'email_notification' => ['nullable', 'boolean'],
            'kegiatan_notification' => ['nullable', 'boolean'],
            'anggota_notification' => ['nullable', 'boolean'],
            'pac_notification' => ['nullable', 'boolean'],
        ]);

        $settings = $this->settings();
        $settings->update([
            'email_notification' => (bool) ($validated['email_notification'] ?? false),
            'kegiatan_notification' => (bool) ($validated['kegiatan_notification'] ?? false),
            'anggota_notification' => (bool) ($validated['anggota_notification'] ?? false),
            'pac_notification' => (bool) ($validated['pac_notification'] ?? false),
        ]);

        return redirect()
            ->to('/pengaturan/notifikasi')
            ->with('success', 'Preferensi notifikasi berhasil disimpan');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'language' => ['required', 'string', 'max:10'],
            'timezone' => ['required', 'string', 'max:100'],
            'date_format' => ['required', 'string', 'max:30'],
        ]);

        $this->settings()->update($validated);

        return back()->with('success', 'Pengaturan berhasil disimpan');
    }

    public function backupDatabase()
    {
        $backupDir = storage_path('app/backups');

        if (! file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $defaultDriver = config('database.default');

        if ($defaultDriver === 'sqlite') {
            $sqlitePath = config('database.connections.sqlite.database');
            $filename = 'backup_'.now()->format('Y_m_d_H_i_s').'.sqlite';
            $filePath = $backupDir.'/'.$filename;

            if ($sqlitePath === ':memory:') {
                file_put_contents($filePath, 'SQLite in-memory backup');
            } elseif ($sqlitePath && file_exists($sqlitePath)) {
                if (! copy($sqlitePath, $filePath)) {
                    return back()->with('error', 'Backup database gagal');
                }
            } else {
                return back()->with('error', 'File database SQLite tidak ditemukan');
            }

            return response()->download($filePath);
        }

        $filename = 'backup_'.now()->format('Y_m_d_H_i_s').'.sql';
        $dbHost = config('database.connections.mysql.host', '127.0.0.1');
        $dbPort = config('database.connections.mysql.port', '3306');
        $dbUser = config('database.connections.mysql.username', 'root');
        $dbPass = config('database.connections.mysql.password', '');
        $dbName = config('database.connections.mysql.database', 'laravel');

        $filePath = $backupDir.'/'.$filename;
        $cnfFile = tempnam(sys_get_temp_dir(), 'mysql_cnf_');
        file_put_contents($cnfFile, "[client]\nuser = \"{$dbUser}\"\npassword = \"{$dbPass}\"\nhost = \"{$dbHost}\"\nport = \"{$dbPort}\"\n");
        chmod($cnfFile, 0600);

        try {
            $command = sprintf(
                'mysqldump --defaults-extra-file=%s %s > %s',
                escapeshellarg($cnfFile),
                escapeshellarg($dbName),
                escapeshellarg($filePath)
            );

            $process = Process::fromShellCommandline($command);
            $process->setTimeout(120);
            $process->run();

            if (! $process->isSuccessful()) {
                Log::error('MySQL backup failed', [
                    'user_id' => Auth::id(),
                    'error' => $process->getErrorOutput(),
                ]);

                return back()->with('error', 'Backup database gagal');
            }
        } finally {
            if ($cnfFile && file_exists($cnfFile)) {
                @unlink($cnfFile);
            }
        }

        return response()->download($filePath);
    }

    public function restoreDatabase(Request $request)
    {
        $request->validate([
            'backup_file' => ['required', 'file', 'max:51200'],
        ]);

        $file = $request->file('backup_file');
        $extension = strtolower($file->getClientOriginalExtension());
        $defaultDriver = config('database.default');
        $filePath = $file->getRealPath();

        if ($defaultDriver === 'sqlite') {
            if (! in_array($extension, ['sqlite', 'db', 'sql'], true)) {
                return back()->with('error', 'File harus berformat .sqlite atau .db');
            }

            // Validasi header konten SQLite
            $header = @file_get_contents($filePath, false, null, 0, 16);
            if ($header !== false && strlen($header) >= 15 && ! str_starts_with($header, 'SQLite format 3')) {
                $contentSample = @file_get_contents($filePath, false, null, 0, 256);
                if (! preg_match('/^(?:--|\/\*|PRAGMA|BEGIN|CREATE|INSERT)/i', trim((string) $contentSample))) {
                    return back()->with('error', 'Format file backup SQLite tidak valid.');
                }
            }

            $sqlitePath = config('database.connections.sqlite.database');

            if ($sqlitePath !== ':memory:') {
                if (! file_exists($sqlitePath)) {
                    touch($sqlitePath);
                }

                if (! copy($filePath, $sqlitePath)) {
                    Log::error('SQLite restore copy failed', ['user_id' => Auth::id()]);

                    return back()->with('error', 'Restore database SQLite gagal');
                }
            }

            Log::info('Database SQLite restored successfully', ['user_id' => Auth::id()]);

            return back()->with('success', 'Database SQLite berhasil di-restore');
        }

        if ($extension !== 'sql') {
            return back()->with('error', 'File harus berformat .sql');
        }

        // Validasi konten file SQL
        $contentSample = @file_get_contents($filePath, false, null, 0, 512);
        if (! preg_match('/^(?:--|\/\*|CREATE|INSERT|SET|USE|DROP|ALTER|LOCK|UNLOCK)/i', trim((string) $contentSample))) {
            return back()->with('error', 'Format file backup SQL tidak valid.');
        }

        $dbHost = config('database.connections.mysql.host', '127.0.0.1');
        $dbPort = config('database.connections.mysql.port', '3306');
        $dbUser = config('database.connections.mysql.username', 'root');
        $dbPass = config('database.connections.mysql.password', '');
        $dbName = config('database.connections.mysql.database', 'laravel');

        $cnfFile = tempnam(sys_get_temp_dir(), 'mysql_cnf_');
        file_put_contents($cnfFile, "[client]\nuser = \"{$dbUser}\"\npassword = \"{$dbPass}\"\nhost = \"{$dbHost}\"\nport = \"{$dbPort}\"\n");
        chmod($cnfFile, 0600);

        try {
            $command = sprintf(
                'mysql --defaults-extra-file=%s %s < %s',
                escapeshellarg($cnfFile),
                escapeshellarg($dbName),
                escapeshellarg($filePath)
            );

            $process = Process::fromShellCommandline($command);
            $process->setTimeout(300);
            $process->run();

            if (! $process->isSuccessful()) {
                Log::error('MySQL restore failed', [
                    'user_id' => Auth::id(),
                    'error' => $process->getErrorOutput(),
                ]);

                return back()->with('error', 'Restore database gagal. Silakan periksa file backup Anda.');
            }
        } finally {
            if ($cnfFile && file_exists($cnfFile)) {
                @unlink($cnfFile);
            }
        }

        Log::info('Database MySQL restored successfully', ['user_id' => Auth::id()]);

        return back()->with('success', 'Database berhasil di-restore');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => ['required', 'string'],
            'new_password' => [
                'required',
                'string',
                Password::min(8),
                'confirmed',
                'different:old_password',
            ],
        ]);

        $user = $this->authenticatedUser();

        if (! Hash::check($validated['old_password'], $user->password)) {
            return back()
                ->withErrors(['old_password' => 'Password lama tidak sesuai'])
                ->withInput();
        }

        $user->update([
            'password' => $validated['new_password'],
        ]);

        return redirect()
            ->to('/pengaturan/keamanan')
            ->with('success', 'Password berhasil diperbarui');
    }

    public function updateTwoFactor(Request $request)
    {
        $validated = $request->validate([
            'two_factor_enabled' => ['nullable', 'boolean'],
        ]);

        $user = $this->authenticatedUser();
        $user->update([
            'two_factor_enabled' => (bool) ($validated['two_factor_enabled'] ?? false),
        ]);

        return redirect()
            ->to('/pengaturan/keamanan')
            ->with('success', 'Preferensi two-factor authentication berhasil disimpan');
    }

    private function authenticatedUser(): User
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(401);
        }

        return $user;
    }

    private function settings(): Pengaturan
    {
        return Pengaturan::firstOrCreate(
            ['id' => 1],
            [
                'language' => 'id',
                'timezone' => 'Asia/Jakarta',
                'date_format' => 'd-m-Y',
            ]
        );
    }
}
