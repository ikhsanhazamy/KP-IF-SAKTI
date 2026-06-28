<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $kegiatan = [
            [
                'judul' => 'Seminar Pemberdayaan Perempuan dan Kewirausahaan',
                'tanggal' => '2026-05-15',
                'waktu' => '09:00 - 13:00 WIB',
                'lokasi' => 'Gedung Juang Sukabumi',
                'kategori' => 'Seminar',
                'peserta' => 150,
                'status' => 'completed',
                'deskripsi' => 'Seminar nasional tentang pemberdayaan perempuan melalui kewirausahaan dan UMKM.',
            ],
            [
                'judul' => 'Bakti Sosial dan Santunan Anak Yatim',
                'tanggal' => '2026-05-08',
                'waktu' => '13:00 - 16:00 WIB',
                'lokasi' => 'Kecamatan Cibadak',
                'kategori' => 'Sosial',
                'peserta' => 85,
                'status' => 'completed',
                'deskripsi' => 'Kegiatan sosial rutin memberikan santunan dan bantuan kepada anak yatim di wilayah Sukabumi.',
            ],
            [
                'judul' => 'Pelatihan Kaderisasi dan Leadership',
                'tanggal' => '2026-06-01',
                'waktu' => '08:00 - 17:00 WIB',
                'lokasi' => 'Pondok Pesantren Al-Masthuriyah',
                'kategori' => 'Pelatihan',
                'peserta' => 120,
                'status' => 'completed',
                'deskripsi' => 'Program pelatihan intensif untuk kader muda Fatayat NU dalam kepemimpinan dan manajemen.',
            ],
            [
                'judul' => 'Rapat Koordinasi PAC Se-Sukabumi',
                'tanggal' => '2026-06-22',
                'waktu' => '10:00 - 14:00 WIB',
                'lokasi' => 'Kantor PCNU Kabupaten Sukabumi',
                'kategori' => 'Rapat',
                'peserta' => 95,
                'status' => 'completed',
                'deskripsi' => 'Rapat koordinasi rutin seluruh pengurus PAC untuk evaluasi program dan perencanaan kegiatan.',
            ],
            [
                'judul' => 'Workshop Manajemen Organisasi Modern',
                'tanggal' => '2026-07-10',
                'waktu' => '09:00 - 15:00 WIB',
                'lokasi' => 'Hotel Horizon Sukabumi',
                'kategori' => 'Workshop',
                'peserta' => 75,
                'status' => 'upcoming',
                'deskripsi' => 'Workshop tentang manajemen organisasi modern dengan teknologi digital untuk efisiensi kerja.',
            ],
            [
                'judul' => 'Kajian Rutin Keislaman dan Keputrian',
                'tanggal' => '2026-07-03',
                'waktu' => '15:30 - 17:30 WIB',
                'lokasi' => 'Masjid Agung Sukabumi',
                'kategori' => 'Kajian',
                'peserta' => 200,
                'status' => 'upcoming',
                'deskripsi' => 'Kajian rutin bulanan tentang keislaman dan keputrian dengan ustadzah berpengalaman.',
            ]
        ];

        foreach ($kegiatan as $item) {
            Kegiatan::create($item);
        }
    }
}
