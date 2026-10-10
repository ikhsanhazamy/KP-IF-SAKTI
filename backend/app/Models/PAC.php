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
        'latitude',
        'longitude',
        'ketua_pac',
        'telepon',
        'email',
        'jumlah_anggota',
        'alumni_lkd',
        'deskripsi',
        'nomor_sk',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    /**
     * Relasi ke Kegiatan
     */
    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'pac_id');
    }

    /**
     * Relasi ke Anggota
     */
    public function anggotas(): HasMany
    {
        return $this->hasMany(Anggota::class, 'pac_id');
    }
}
