<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PAC extends Model
{
    protected $table = 'pacs';

    protected $fillable = [
        'nama_pac',
        'kecamatan',
        'status',
        'tanggal_berdiri',
        'alamat',
        'desa',
        'kode_pos',
        'ketua_pac',
        'telepon',
        'email',
        'jumlah_anggota',
        'alumni_lkd',
        'deskripsi',
        'nomor_sk',
        'tanggal_kedaluwarsa',
    ];

    protected $casts = [
        'tanggal_berdiri' => 'date:Y-m-d',
        'tanggal_kedaluwarsa' => 'date:Y-m-d',
    ];

    /**
     * Hitung status otomatis berdasarkan tanggal kedaluwarsa SK.
     */
    public function computeStatusFromExpiry(?string $defaultStatus = null): string
    {
        $current = $defaultStatus ?? $this->status ?? 'aktif';

        if (! $this->tanggal_kedaluwarsa) {
            return $current;
        }

        $today = now()->startOfDay();
        $expiredDate = \Carbon\Carbon::parse($this->tanggal_kedaluwarsa)->startOfDay();

        if ($expiredDate->lt($today)) {
            return 'tidak_aktif';
        }

        if ($expiredDate->lte($today->copy()->addDays(30))) {
            return 'akan_expire';
        }

        if (! in_array($current, ['pending', 'ditolak'])) {
            return 'aktif';
        }

        return $current;
    }

    /**
     * Relasi ke Kegiatan
     */
    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'pac_id');
    }
}
