<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'deskripsi'
    ];

    /**
     * Relasi ke PAC
     */
    public function pac()
    {
        return $this->belongsTo(PAC::class);
    }
}