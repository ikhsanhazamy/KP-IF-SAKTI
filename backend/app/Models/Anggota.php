<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
    'nama',
    'email',
    'telepon',
    'pac',
    'profesi',
    'tanggal_bergabung',
    'status',
    'pendidikan',

    ];
}
