<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use App\Models\Pengaturan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $query = trim((string) $request->query('q'));

        if (mb_strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $escaped = addcslashes($query, '%_\\');

        $anggota = Anggota::query()
            ->where(function ($builder) use ($escaped) {
                $builder->where('nama', 'like', "%{$escaped}%")
                    ->orWhere('email', 'like', "%{$escaped}%")
                    ->orWhere('pac', 'like', "%{$escaped}%");
            })
            ->limit(5)
            ->get()
            ->map(fn (Anggota $item) => [
                'type' => 'Anggota',
                'title' => $item->nama,
                'subtitle' => trim($item->pac.' · '.$item->email, ' ·'),
                'url' => '/anggota?search='.urlencode($item->email),
            ]);

        $pacs = PAC::query()
            ->where(function ($builder) use ($escaped) {
                $builder->where('nama_pac', 'like', "%{$escaped}%")
                    ->orWhere('kecamatan', 'like', "%{$escaped}%")
                    ->orWhere('ketua_pac', 'like', "%{$escaped}%");
            })
            ->limit(5)
            ->get()
            ->map(fn (PAC $item) => [
                'type' => 'PAC',
                'title' => $item->nama_pac,
                'subtitle' => 'Kecamatan '.$item->kecamatan,
                'url' => '/data-pac#pac-'.$item->id,
            ]);

        $kegiatans = Kegiatan::query()
            ->where(function ($builder) use ($escaped) {
                $builder->where('judul', 'like', "%{$escaped}%")
                    ->orWhere('lokasi', 'like', "%{$escaped}%")
                    ->orWhere('kategori', 'like', "%{$escaped}%");
            })
            ->limit(5)
            ->get()
            ->map(fn (Kegiatan $item) => [
                'type' => 'Kegiatan',
                'title' => $item->judul,
                'subtitle' => trim($item->lokasi.' · '.$item->kategori, ' ·'),
                'url' => '/kegiatan#kegiatan-'.$item->id,
            ]);

        return response()->json([
            'results' => $anggota
                ->concat($pacs)
                ->concat($kegiatans)
                ->take(10)
                ->values(),
        ]);
    }

    public function notifications(): JsonResponse
    {
        $settings = Pengaturan::firstOrCreate(
            ['id' => 1],
            [
                'language' => 'id',
                'timezone' => 'Asia/Jakarta',
                'date_format' => 'd-m-Y',
            ]
        );

        $notifications = collect();

        if ($settings->anggota_notification) {
            $notifications = $notifications->concat(
                Anggota::latest()
                    ->limit(4)
                    ->get()
                    ->map(fn (Anggota $item) => $this->notification(
                        'anggota',
                        $item->id,
                        'Anggota baru',
                        $item->nama.' bergabung di '.$item->pac,
                        '/anggota?search='.urlencode($item->email),
                        $item->created_at
                    ))
            );
        }

        if ($settings->pac_notification) {
            $notifications = $notifications->concat(
                PAC::latest()
                    ->limit(4)
                    ->get()
                    ->map(fn (PAC $item) => $this->notification(
                        'pac',
                        $item->id,
                        'Data PAC diperbarui',
                        $item->nama_pac.' · Kecamatan '.$item->kecamatan,
                        '/data-pac#pac-'.$item->id,
                        $item->updated_at
                    ))
            );
        }

        if ($settings->kegiatan_notification) {
            $notifications = $notifications->concat(
                Kegiatan::latest('tanggal')
                    ->limit(4)
                    ->get()
                    ->map(fn (Kegiatan $item) => $this->notification(
                        'kegiatan',
                        $item->id,
                        'Informasi kegiatan',
                        $item->judul.' · '.$item->lokasi,
                        '/kegiatan#kegiatan-'.$item->id,
                        $item->updated_at
                    ))
            );
        }

        return response()->json([
            'notifications' => $notifications
                ->sortByDesc('timestamp')
                ->take(8)
                ->values(),
        ]);
    }

    private function notification(
        string $type,
        int $id,
        string $title,
        string $message,
        string $url,
        mixed $date
    ): array {
        $timestamp = $date?->timestamp ?? now()->timestamp;

        return [
            'id' => "{$type}:{$id}:{$timestamp}",
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'url' => $url,
            'time' => $date?->locale('id')->diffForHumans() ?? 'baru saja',
            'timestamp' => $timestamp,
        ];
    }
}
