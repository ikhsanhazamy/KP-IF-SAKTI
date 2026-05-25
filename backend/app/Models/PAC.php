<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'deskripsi',

    ];
}