<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'tanggal_lahir',
        'pac_id',
        'pac',
        'profesi',
        'tanggal_bergabung',
        'status',
        'status_pernikahan',
        'pendidikan',
    ];

    protected $appends = [
        'umur',
    ];

    protected function casts(): array
    {
        return [
            'pac_id' => 'integer',
            'tanggal_lahir' => 'date',
            'tanggal_bergabung' => 'date',
        ];
    }

    public function pac()
    {
        return $this->belongsTo(PAC::class, 'pac_id');
    }

    public function getUmurAttribute(): ?int
    {
        return $this->tanggal_lahir?->age;
    }
}
