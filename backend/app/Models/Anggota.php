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
            'tanggal_lahir' => 'date',
            'tanggal_bergabung' => 'date',
        ];
    }

    public function getUmurAttribute(): ?int
    {
        return $this->tanggal_lahir?->age;
    }
}
