<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@fatayatnu.or.id'],
            [
                'name' => 'Admin Fatayat NU',
                'jabatan' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
    }
}
