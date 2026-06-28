<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PAC;

class PACSeeder extends Seeder
{
    public function run(): void
    {
        $pacs = [
            [
                'nama_pac' => 'PAC Cibadak',
                'kecamatan' => 'Cibadak',
                'status' => 'aktif',
                'tanggal_berdiri' => '2018-04-12',
                'alamat' => 'Jl. Raya Cibadak No. 123, Cibadak',
                'desa' => 'Cibadak',
                'kode_pos' => '43351',
                'ketua_pac' => 'Hj. Laila Sari, S.Ag',
                'telepon' => '081234567890',
                'email' => 'pac.cibadak@fatayatnu.or.id',
                'jumlah_anggota' => 247,
                'total_kegiatan' => 18,
                'nomor_sk' => 'SK-012/PC/FN/SKB/2024',
                'deskripsi' => 'Pimpinan Anak Cabang Fatayat NU Kecamatan Cibadak yang aktif membina majelis taklim dan UMKM keputrian.',
            ],
            [
                'nama_pac' => 'PAC Cicurug',
                'kecamatan' => 'Cicurug',
                'status' => 'aktif',
                'tanggal_berdiri' => '2019-08-20',
                'alamat' => 'Jl. Siliwangi No. 45, Cicurug',
                'desa' => 'Cicurug',
                'kode_pos' => '43359',
                'ketua_pac' => 'Siti Maryam, S.Pd',
                'telepon' => '082345678901',
                'email' => 'pac.cicurug@fatayatnu.or.id',
                'jumlah_anggota' => 198,
                'total_kegiatan' => 15,
                'nomor_sk' => 'SK-015/PC/FN/SKB/2024',
                'deskripsi' => 'Pimpinan Anak Cabang Fatayat NU Kecamatan Cicurug, fokus pada pelatihan keterampilan remaja putri.',
            ],
            [
                'nama_pac' => 'PAC Parungkuda',
                'kecamatan' => 'Parungkuda',
                'status' => 'aktif',
                'tanggal_berdiri' => '2020-01-15',
                'alamat' => 'Jl. Stasiun Parungkuda No. 10, Parungkuda',
                'desa' => 'Parungkuda',
                'kode_pos' => '43357',
                'ketua_pac' => 'Fatimah Azzahra, M.Pd',
                'telepon' => '083456789012',
                'email' => 'pac.parungkuda@fatayatnu.or.id',
                'jumlah_anggota' => 156,
                'total_kegiatan' => 12,
                'nomor_sk' => 'SK-022/PC/FN/SKB/2024',
                'deskripsi' => 'Pimpinan Anak Cabang Fatayat NU Kecamatan Parungkuda, aktif menyelenggarakan kajian fiqih wanita.',
            ],
            [
                'nama_pac' => 'PAC Palabuhanratu',
                'kecamatan' => 'Palabuhanratu',
                'status' => 'aktif',
                'tanggal_berdiri' => '2015-11-22',
                'alamat' => 'Jl. Siliwangi Palabuhanratu No. 8, Palabuhanratu',
                'desa' => 'Palabuhanratu',
                'kode_pos' => '43366',
                'ketua_pac' => 'Rina Herlina, S.Sos',
                'telepon' => '084567890123',
                'email' => 'pac.pratu@fatayatnu.or.id',
                'jumlah_anggota' => 234,
                'total_kegiatan' => 20,
                'nomor_sk' => 'SK-008/PC/FN/SKB/2024',
                'deskripsi' => 'PAC Fatayat NU pesisir Palabuhanratu yang fokus pada edukasi kesehatan reproduksi dan pemberdayaan ekonomi nelayan perempuan.',
            ],
            [
                'nama_pac' => 'PAC Simpenan',
                'kecamatan' => 'Simpenan',
                'status' => 'tidak_aktif',
                'tanggal_berdiri' => '2021-03-05',
                'alamat' => 'Kampung Cigaru No. 15, Simpenan',
                'desa' => 'Cidadap',
                'kode_pos' => '43361',
                'ketua_pac' => 'Neneng Hasanah',
                'telepon' => '085678901234',
                'email' => 'pac.simpenan@fatayatnu.or.id',
                'jumlah_anggota' => 89,
                'total_kegiatan' => 3,
                'nomor_sk' => 'SK-045/PC/FN/SKB/2024',
                'deskripsi' => 'PAC Fatayat NU Kecamatan Simpenan yang saat ini sedang dalam masa restrukturisasi kepengurusan.',
            ],
            [
                'nama_pac' => 'PAC Jampang Kulon',
                'kecamatan' => 'Jampang Kulon',
                'status' => 'aktif',
                'tanggal_berdiri' => '2017-09-18',
                'alamat' => 'Jl. Jampang Kulon Raya No. 9, Jampang Kulon',
                'desa' => 'Jampang Kulon',
                'kode_pos' => '43178',
                'ketua_pac' => 'Aisyah Humaira, S.Si',
                'telepon' => '086789012345',
                'email' => 'pac.jampangkulon@fatayatnu.or.id',
                'jumlah_anggota' => 178,
                'total_kegiatan' => 14,
                'nomor_sk' => 'SK-019/PC/FN/SKB/2024',
                'deskripsi' => 'PAC Fatayat NU wilayah Jampang Kulon, memiliki progam unggulan pencegahan stunting di pedesaan.',
            ],
            [
                'nama_pac' => 'PAC Cisaat',
                'kecamatan' => 'Cisaat',
                'status' => 'aktif',
                'tanggal_berdiri' => '2016-02-10',
                'alamat' => 'Jl. Kadudampit No. 34, Cisaat',
                'desa' => 'Cisaat',
                'kode_pos' => '43152',
                'ketua_pac' => 'Dr. Hj. Salamah, M.Ag',
                'telepon' => '087890123456',
                'email' => 'pac.cisaat@fatayatnu.or.id',
                'jumlah_anggota' => 310,
                'total_kegiatan' => 25,
                'nomor_sk' => 'SK-005/PC/FN/SKB/2024',
                'deskripsi' => 'PAC Fatayat NU Cisaat merupakan PAC dengan jumlah anggota terbanyak dan aktif dalam berbagai kolaborasi lintas ormas.',
            ],
        ];

        foreach ($pacs as $item) {
            PAC::create($item);
        }
    }
}
