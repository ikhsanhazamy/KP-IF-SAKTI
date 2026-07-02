<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Kegiatan extends Model
{
    protected $fillable = [
        'pac_id',
        'judul',
        'tanggal',
        'waktu',
        'lokasi',
        'kategori',
        'peserta',
        'status',
        'deskripsi',
        'gambar',
    ];

    protected $appends = [
        'gambar_url',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? Storage::url($this->gambar) : null;
    }

    /**
     * Relasi ke PAC
     */
    public function pac()
    {
        return $this->belongsTo(PAC::class);
    }
}
