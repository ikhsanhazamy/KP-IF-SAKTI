<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\PAC;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        // Temukan PAC untuk relasi penugasan/lokasi kegiatan
        $pacCicurug = PAC::where('kecamatan', 'Cicurug')->first();
        $pacCisaat = PAC::where('kecamatan', 'Cisaat')->first();
        $pacCibadak = PAC::where('kecamatan', 'Cibadak')->first();

        $kegiatan = [
            [
                'pac_id' => $pacCicurug?->id,
                'judul' => 'Kegiatan Santunan Bagi Anak Yatim di Majelis Ta\'lim Siti Saodah Musthafa',
                'tanggal' => '2026-07-05',
                'waktu' => '09:00:00',
                'lokasi' => 'Majelis Ta\'lim Siti Saodah Musthafa, Bangbayang, Cicurug, Kab. Sukabumi',
                'kategori' => 'Sosial',
                'peserta' => 120,
                'status' => 'completed',
                'deskripsi' => 'Alhamdulillah dalam rangka memperingati Tahun Baru Islam 1448 H, PC Fatayat NU Kabupaten Sukabumi kembali berbagi kebahagiaan melalui kegiatan santunan bagi anak yatim di Majelis Ta\'lim Siti Saodah Musthafa, Bangbayang, Cicurug, Kab. Sukabumi. Semoga setiap uluran tangan yang diberikan menjadi ladang amal, membawa keberkahan, serta menghadirkan senyum dan harapan bagi mereka yang membutuhkan.',
                'gambar' => 'kegiatan/ig-DaaKPXBC5pr.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'Kunjungan ke Keraton Kasepuhan Cirebon dalam Rangka Harlah ke-76 Fatayat Nahdlatul Ulama',
                'tanggal' => '2026-05-14',
                'waktu' => '08:30:00',
                'lokasi' => 'Keraton Kasepuhan Cirebon, Jawa Barat',
                'kategori' => 'Kajian',
                'peserta' => 80,
                'status' => 'completed',
                'deskripsi' => 'Kunjungan ke Keraton Kasepuhan Cirebon dalam rangka Harlah ke-76 Fatayat Nahdlatul Ulama. Menapaki jejak sejarah, merawat budaya, dan memperkuat nilai kebersamaan dalam semangat khidmat untuk NU dan bangsa.',
                'gambar' => 'kegiatan/ig-DYTYLS3i0-S.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'Menapak Jejak Perjuangan Ulama, Doa dan Harapan di Makbarah Sunan Gunung Jati Cirebon',
                'tanggal' => '2026-05-14',
                'waktu' => '13:30:00',
                'lokasi' => 'Makbarah Sunan Gunung Jati Cirebon, Jawa Barat',
                'kategori' => 'Kajian',
                'peserta' => 85,
                'status' => 'completed',
                'deskripsi' => 'Menapak jejak perjuangan ulama, menautkan doa dan harapan di makbarah Sunan Gunung Jati Cirebon. Dalam rangka Harlah ke-76 Fatayat Nahdlatul Ulama, PC Fatayat NU Kab. Sukabumi melaksanakan ziarah sebagai bentuk penghormatan kepada para wali dan ulama yang telah berjasa dalam syiar Islam Ahlussunnah wal Jamaah. Semoga semangat perjuangan, keikhlasan, dan keteladanan beliau senantiasa menginspirasi langkah kami dalam berkhidmat untuk agama, bangsa, dan organisasi.',
                'gambar' => 'kegiatan/ig-DYTXTqCCklM.jpg',
            ],
            [
                'pac_id' => $pacCisaat?->id,
                'judul' => 'PC Fatayat NU Kab. Sukabumi Melaksanakan Ziarah Makbarah Pendiri Pondok Pesantren Al-Masthuriyah',
                'tanggal' => '2026-05-14',
                'waktu' => '16:00:00',
                'lokasi' => 'Pondok Pesantren Al-Masthuriyah, Cisaat, Kab. Sukabumi',
                'kategori' => 'Kajian',
                'peserta' => 100,
                'status' => 'completed',
                'deskripsi' => 'PC Fatayat NU Kab. Sukabumi melaksanakan ziarah makbarah pendiri Pondok Pesantren Al-Masthuriyah. Sebagai bentuk penghormatan dan mengenang jasa para ulama perintis dakwah dan pendidikan Islam, serta meneladani integritas dan keikhlasan beliau dalam membina umat.',
                'gambar' => 'kegiatan/ig-DYTWAIUC4DX.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'Kegiatan Berbagi Takjil dan Santunan Anak Yatim PC Fatayat NU Kabupaten Sukabumi',
                'tanggal' => '2026-03-07',
                'waktu' => '16:30:00',
                'lokasi' => 'Sukabumi, Jawa Barat',
                'kategori' => 'Sosial',
                'peserta' => 150,
                'status' => 'completed',
                'deskripsi' => 'Kegiatan Berbagi Takjil dan Santunan Anak Yatim PC Fatayat NU Kabupaten Sukabumi telah terlaksana dengan lancar dan khidmat di bulan suci Ramadhan. Kader Fatayat bergerak bersama menebar senyum dan kebaikan kepada masyarakat sekitar dan anak-anak yatim.',
                'gambar' => 'kegiatan/kegiatan-takjil-santunan-2026.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'LKD II Fatayat NU Kab. Sukabumi',
                'tanggal' => '2025-09-03',
                'waktu' => '08:00:00',
                'lokasi' => 'Aula PCNU Kabupaten Sukabumi',
                'kategori' => 'Pelatihan',
                'peserta' => 110,
                'status' => 'completed',
                'deskripsi' => 'Pelaksanaan Latihan Kader Dasar II (LKD II) PC Fatayat NU Kab. Sukabumi. Pelatihan ini ditujukan untuk menguatkan wawasan kebangsaan, kepemimpinan organisasi perempuan, dan militansi kader berbasis nilai Ahlussunnah wal Jamaah An-Nahdliyah.',
                'gambar' => 'kegiatan/ig-DYT5sc4GQGe.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'Peringatan Bulan Muharram 1447 H dan Santunan Anak Yatim PC Fatayat NU Kabupaten Sukabumi',
                'tanggal' => '2025-07-08',
                'waktu' => '09:30:00',
                'lokasi' => 'Gedung Serbaguna PC Fatayat NU Kabupaten Sukabumi',
                'kategori' => 'Sosial',
                'peserta' => 130,
                'status' => 'completed',
                'deskripsi' => 'Dalam Rangka Memperingati Bulan Muharram 1447 H, PC Fatayat NU Kabupaten Sukabumi melaksanakan kegiatan santunan anak yatim serta doa bersama untuk keberkahan, kerukunan, dan kemaslahatan masyarakat di Kabupaten Sukabumi.',
                'gambar' => 'kegiatan/ig-DY0U-hyTck5.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'Kegiatan Latihan Kader Dasar (LKD) PC Fatayat NU Kabupaten Sukabumi',
                'tanggal' => '2025-06-03',
                'waktu' => '08:30:00',
                'lokasi' => 'Pondok Pesantren Modern Sukabumi',
                'kategori' => 'Pelatihan',
                'peserta' => 95,
                'status' => 'completed',
                'deskripsi' => 'Kegiatan Latihan Kader Dasar (LKD) PC Fatayat NU Kabupaten Sukabumi sebagai gerbang utama pengkaderan anggota, membekali kader muda perempuan dengan keterampilan manajemen kepemimpinan, komunikasi publik, dan advokasi sosial.',
                'gambar' => 'kegiatan/ig-DXfp7k9Ap2H.jpg',
            ],
            [
                'pac_id' => $pacCibadak?->id,
                'judul' => 'Kegiatan Skrinning Pap Smear dan Glukosa Gratis Dalam Rangka Memperingati Hari Santri Nasional Tahun 2024',
                'tanggal' => '2025-02-14',
                'waktu' => '08:00:00',
                'lokasi' => 'Klinik Pratama PCNU Kabupaten Sukabumi',
                'kategori' => 'Sosial',
                'peserta' => 175,
                'status' => 'completed',
                'deskripsi' => 'Kegiatan Skrinning Pap Smear dan Glukosa Gratis Dalam Rangka Memperingati Hari Santri Nasional Tahun 2024. Wujud nyata kepedulian PC Fatayat NU Kabupaten Sukabumi terhadap kesehatan perempuan dan deteksi dini penyakit degeneratif serta kanker serviks.',
                'gambar' => 'kegiatan/ig-DW3364FgiU2.jpg',
            ],
            [
                'pac_id' => null,
                'judul' => 'Pelantikan & Rapat Kerja PC Fatayat NU Kabupaten Sukabumi Masa Khidmat 2023-2028',
                'tanggal' => '2024-12-16',
                'waktu' => '09:00:00',
                'lokasi' => 'Gedung Islamic Centre Kabupaten Sukabumi',
                'kategori' => 'Rapat',
                'peserta' => 200,
                'status' => 'completed',
                'deskripsi' => 'Pelantikan & Rapat Kerja PC Fatayat NU Kabupaten Sukabumi Masa Khidmat 2023-2028. Mengukuhkan kepengurusan baru sekaligus merumuskan agenda aksi pemberdayaan perempuan, pendidikan keagamaan, dan sinergi kemitraan lintas sektor.',
                'gambar' => 'kegiatan/ig-DchToLnTU-L.jpg',
            ],
            [
                'pac_id' => $pacCicurug?->id,
                'judul' => 'PC Fatayat NU Kab Sukabumi Berbagi Takjil 2024',
                'tanggal' => '2024-04-08',
                'waktu' => '16:30:00',
                'lokasi' => 'Jl. Raya Siliwangi, Cicurug, Kab. Sukabumi',
                'kategori' => 'Sosial',
                'peserta' => 120,
                'status' => 'completed',
                'deskripsi' => 'PC Fatayat NU Kab Sukabumi Berbagi Takjil 2024. Semarak Ramadhan berbagi kebahagiaan berupa paket makanan berbuka puasa gratis kepada para musafir dan warga masyarakat sekitar Sukabumi.',
                'gambar' => 'kegiatan/ig-DcIJYLNic3l.jpg',
            ],
            [
                'pac_id' => $pacCisaat?->id,
                'judul' => 'Kegiatan dalam Rangka Memperingati Isra Mi\'raj Nabi Muhammad SAW 2024',
                'tanggal' => '2024-03-04',
                'waktu' => '13:00:00',
                'lokasi' => 'Masjid Agung Cisaat, Kab. Sukabumi',
                'kategori' => 'Kajian',
                'peserta' => 250,
                'status' => 'completed',
                'deskripsi' => 'Kegiatan dalam rangka memperingati Isra Mi\'raj Nabi Muhammad SAW 2024 yang diselenggarakan PC Fatayat NU Kabupaten Sukabumi. Mengisi momentum agung ini dengan dzikir, shalawat, dan ceramah keagamaan guna mempererat ukhuwah.',
                'gambar' => 'kegiatan/ig-Dcc4oZTiX72.jpg',
            ],
        ];

        foreach ($kegiatan as $item) {
            Kegiatan::create($item);
        }
    }
}
