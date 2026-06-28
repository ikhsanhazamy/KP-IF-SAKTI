<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $fillable = [

        'language',
        'timezone',
        'date_format',

        'email_notification',
        'kegiatan_notification',
        'anggota_notification',
        'pac_notification',

    ];

    protected function casts(): array
    {
        return [
            'email_notification' => 'boolean',
            'kegiatan_notification' => 'boolean',
            'anggota_notification' => 'boolean',
            'pac_notification' => 'boolean',
        ];
    }
}
