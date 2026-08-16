<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $anggota = [
            [
                'nama' => 'Siti Nurhaliza, S.Pd',
                'email' => 'siti.nurhaliza@example.com',
                'pac' => 'Cibadak',
                'profesi' => 'Guru',
                'telepon' => '081234567890',
                'pendidikan' => 'S1',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-01-10',
            ],
            [
                'nama' => 'Rina Herlina, S.Sos',
                'email' => 'rina.herlina@example.com',
                'pac' => 'Palabuhanratu',
                'profesi' => 'Wiraswasta',
                'telepon' => '082345678901',
                'pendidikan' => 'S1',
                'status' => 'aktif',
                'tanggal_bergabung' => '2023-05-15',
            ],
            [
                'nama' => 'Aisyah Humaira, S.Si',
                'email' => 'aisyah.humaira@example.com',
                'pac' => 'Jampang Kulon',
                'profesi' => 'Tenaga Kesehatan',
                'telepon' => '083456789012',
                'pendidikan' => 'S1',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-03-20',
            ],
            [
                'nama' => 'Fatimah Azzahra, M.Pd',
                'email' => 'fatimah.azzahra@example.com',
                'pac' => 'Parungkuda',
                'profesi' => 'Dosen',
                'telepon' => '084567890123',
                'pendidikan' => 'S2',
                'status' => 'aktif',
                'tanggal_bergabung' => '2022-11-12',
            ],
            [
                'nama' => 'Siti Maryam, S.Pd',
                'email' => 'siti.maryam@example.com',
                'pac' => 'Cicurug',
                'profesi' => 'Guru',
                'telepon' => '085678901234',
                'pendidikan' => 'S1',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-06-01',
            ],
            [
                'nama' => 'Dr. Hj. Salamah, M.Ag',
                'email' => 'salamah@example.com',
                'pac' => 'Cisaat',
                'profesi' => 'Dosen',
                'telepon' => '086789012345',
                'pendidikan' => 'S3',
                'status' => 'aktif',
                'tanggal_bergabung' => '2021-08-25',
            ],
            [
                'nama' => 'Neneng Hasanah',
                'email' => 'neneng.hasanah@example.com',
                'pac' => 'Simpenan',
                'profesi' => 'Ibu Rumah Tangga',
                'telepon' => '087890123456',
                'pendidikan' => 'SMA',
                'status' => 'tidak_aktif',
                'tanggal_bergabung' => '2025-02-10',
            ],
            [
                'nama' => 'Dewi Sartika',
                'email' => 'dewi.sartika@example.com',
                'pac' => 'Cibadak',
                'profesi' => 'Wiraswasta',
                'telepon' => '088901234567',
                'pendidikan' => 'Diploma',
                'status' => 'aktif',
                'tanggal_bergabung' => '2024-04-18',
            ],
            [
                'nama' => 'Kartini Putri',
                'email' => 'kartini.putri@example.com',
                'pac' => 'Cisaat',
                'profesi' => 'Mahasiswa',
                'telepon' => '089012345678',
                'pendidikan' => 'SMA',
                'status' => 'aktif',
                'tanggal_bergabung' => '2026-01-05',
            ],
        ];

        foreach ($anggota as $item) {
            Anggota::create($item);
        }
    }
}
