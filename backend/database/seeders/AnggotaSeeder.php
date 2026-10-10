<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\PAC;
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
                'tanggal_lahir' => '1995-04-12',
                'status_pernikahan' => 'Menikah',
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
                'tanggal_lahir' => '1993-08-25',
                'status_pernikahan' => 'Menikah',
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
                'tanggal_lahir' => '1997-12-05',
                'status_pernikahan' => 'Belum Menikah',
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
                'tanggal_lahir' => '1990-01-15',
                'status_pernikahan' => 'Menikah',
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
                'tanggal_lahir' => '1994-06-30',
                'status_pernikahan' => 'Menikah',
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
                'tanggal_lahir' => '1985-09-18',
                'status_pernikahan' => 'Menikah',
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
                'tanggal_lahir' => '1998-02-14',
                'status_pernikahan' => 'Menikah',
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
                'tanggal_lahir' => '1996-11-20',
                'status_pernikahan' => 'Belum Menikah',
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
                'tanggal_lahir' => '2001-05-02',
                'status_pernikahan' => 'Belum Menikah',
                'pendidikan' => 'SMA',
                'status' => 'aktif',
                'tanggal_bergabung' => '2026-01-05',
            ],
        ];

        foreach ($anggota as $item) {
            $pacRecord = PAC::where('nama_pac', 'like', "%{$item['pac']}%")
                ->orWhere('kecamatan', 'like', "%{$item['pac']}%")
                ->first();

            $item['pac_id'] = $pacRecord?->id;
            Anggota::create($item);
        }
    }
}
