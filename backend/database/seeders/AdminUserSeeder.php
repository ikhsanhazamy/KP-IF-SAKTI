<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@fatayatnu.or.id')->first();

        if (! $admin) {
            User::create([
                'name' => 'Admin Fatayat NU',
                'email' => 'admin@fatayatnu.or.id',
                'jabatan' => 'Super Admin',
                'role' => 'super_admin',
                'password' => Hash::make('password'),
                'two_factor_enabled' => false,
            ]);
        } else {
            $admin->update([
                'role' => 'super_admin',
                'jabatan' => 'Super Admin',
            ]);
        }
    }
}
