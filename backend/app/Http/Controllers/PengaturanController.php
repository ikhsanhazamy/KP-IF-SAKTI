<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        return redirect('/pengaturan/profil');
    }

    public function profil()
    {
        return view('pengaturan.index', [
            'activeTab' => 'profil'
        ]);
    }

    public function updateProfil(Request $request)
   {
        $user = Auth::user();

        if ($request->hasFile('photo')) {

            $path = $request->file('photo')
                ->store('profiles', 'public');

            $user->photo = $path;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'jabatan' => $request->jabatan,
            'photo' => $user->photo ?? $user->photo
        ]);

        return back()->with(
            'success',
            'Profil berhasil diperbarui'
        );
    }

    public function hapusFoto()
    {
        $user = Auth::user();

        if ($user->photo) {

            Storage::disk('public')
                ->delete($user->photo);

            $user->photo = null;

            $user->save();
        }

        return back()->with(
            'success',
            'Foto berhasil dihapus'
        );
   }

    public function keamanan()
    {
        return view('pengaturan.index', [
            'activeTab' => 'keamanan'
        ]);
    }

    public function notifikasi()
    {
        return view('pengaturan.index', [
            'activeTab' => 'notifikasi'
        ]);
    }

    public function sistem()
    {
        return view('pengaturan.index', [
            'activeTab' => 'sistem'
        ]);
    }

    public function updateNotifikasi(Request $request)
    {
        // sementara hanya simulasi

        return back()->with(
            'success',
            'Preferensi notifikasi berhasil disimpan'
        );
    }

    public function update(Request $request)
    {
        Pengaturan::updateOrCreate(

            ['id' => 1],

            [
                'language'   => $request->language,
                'timezone'   => $request->timezone,
                'date_format'=> $request->date_format,
            ]

        );

        return back()->with(
            'success',
            'Pengaturan berhasil disimpan'
        );
    }

    public function backupDatabase()
    {
        $backupDir = storage_path('app/backups');

        if (!file_exists($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $driver = config('database.default');

        if ($driver === 'sqlite') {
            // SQLite: cukup salin file .sqlite langsung
            $sourcePath = database_path('database.sqlite');

            if (!file_exists($sourcePath)) {
                return back()->with(
                    'error',
                    'File database SQLite tidak ditemukan'
                );
            }

            $filename = 'backup_' . now()->format('Y_m_d_H_i_s') . '.sqlite';
            $filePath = $backupDir . '/' . $filename;

            if (!copy($sourcePath, $filePath)) {
                return back()->with(
                    'error',
                    'Backup database gagal: tidak dapat menyalin file SQLite'
                );
            }

            return response()->download($filePath)->deleteFileAfterSend(true);
        }

        // MySQL / MariaDB: gunakan mysqldump
        $filename = 'backup_' . now()->format('Y_m_d_H_i_s') . '.sql';
        $filePath = $backupDir . '/' . $filename;

        $command = sprintf(
            'mysqldump -u%s %s %s > "%s"',
            env('DB_USERNAME'),
            env('DB_PASSWORD')
                ? '-p' . env('DB_PASSWORD')
                : '',
            env('DB_DATABASE'),
            $filePath
        );

        $process = Process::fromShellCommandline($command);

        $process->run();

        if (!$process->isSuccessful()) {
            return back()->with(
                'error',
                'Backup database gagal'
            );
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    
    public function updatePassword(Request $request)
   {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check(
            $request->old_password,
            $user->password
        )) {

            return back()->with(
                'error',
                'Password lama tidak sesuai'
            );
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with(
            'success',
            'Password berhasil diperbarui'
        );
    }

    public function restoreDatabase(Request $request)
    {
        $driver = config('database.default');

        if ($driver === 'sqlite') {
            $request->validate([
                'backup_file' => 'required|file|mimes:sqlite,db',
            ]);

            $destination = database_path('database.sqlite');

            // Timpa file SQLite aktif dengan file backup yang diupload
            $request->file('backup_file')->move(
                dirname($destination),
                basename($destination)
            );

            return back()->with(
                'success',
                'Database berhasil dipulihkan dari file SQLite'
            );
        }

        // MySQL: pipe .sql ke mysql CLI
        $request->validate([
            'backup_file' => 'required|file|mimes:sql,txt',
        ]);

        $uploadedPath = $request->file('backup_file')->getRealPath();

        $command = sprintf(
            'mysql -u%s %s %s < "%s"',
            env('DB_USERNAME'),
            env('DB_PASSWORD') ? '-p' . env('DB_PASSWORD') : '',
            env('DB_DATABASE'),
            $uploadedPath
        );

        $process = Process::fromShellCommandline($command);
        $process->run();

        if (! $process->isSuccessful()) {
            return back()->with(
                'error',
                'Restore database gagal: ' . $process->getErrorOutput()
            );
        }

        return back()->with(
            'success',
            'Database berhasil dipulihkan'
        );
    }

}