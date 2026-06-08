<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
    public function updateNotifikasi(Request $request)
   {
        Pengaturan::updateOrCreate(

            ['id' => 1],

            [

                'email_notification' =>
                    $request->has('email_notification'),

                'kegiatan_notification' =>
                    $request->has('kegiatan_notification'),

                'anggota_notification' =>
                    $request->has('anggota_notification'),

                'pac_notification' =>
                    $request->has('pac_notification'),

            ]

        );

        return back()->with(
            'success',
            'Preferensi notifikasi berhasil disimpan'
        );
    }
}
