# 🔒 Kebijakan Keamanan (Security Policy)

Keamanan data organisasi dan keandalan sistem informasi **KP-IF-SAKTI** (Sistem Informasi Fatayat NU Kabupaten Sukabumi) adalah prioritas utama kami. Dokumen ini menjelaskan versi yang didukung, fitur mitigasi keamanan yang diterapkan, serta prosedur pelaporan kerentanan keamanan.

---

## 🛡️ Versi yang Didukung (Supported Versions)

Kami secara aktif memelihara pembaruan keamanan untuk versi-versi berikut:

| Versi Proyek | Didukung Keamanan | Catatan |
|:---|:---:|:---|
| **1.3.x** (Current) | :white_check_mark: | Versi stabil aktif dengan penguatan keamanan & rate limiting |
| **1.2.x** | :white_check_mark: | Didukung untuk patch kritis |
| **1.1.x** | :warning: | Disarankan segera upgrade ke versi terbaru |
| **< 1.1.0** | :x: | Tidak lagi didukung |

---

## 🔐 Fitur Mitigasi Keamanan yang Diterapkan

Sistem informasi ini telah dilengkapi dengan serangkaian lapisan keamanan (*defense-in-depth*):

1. **Proteksi Brute Force & Rate Limiting**:
   - Rute login admin dilindungi dengan batas `throttle:login` (5 percobaan/menit).
   - Rute REST API publik dibatasi dengan `throttle:api` (60 request/menit).
   - Formulir pengajuan PAC dilindungi dengan `throttle:pac-pengajuan` (10 request/menit).
2. **Proteksi Serangan CSRF (Cross-Site Request Forgery)**:
   - Seluruh mutasi HTTP (`POST`, `PUT`, `DELETE`) di dashboard admin diwajibkan menyertakan token CSRF yang valid.
   - Endpoint `/csrf-token` tersedia untuk sinkronisasi token asinkron jika form terbuka dalam waktu lama.
3. **Pencegahan SQL Injection**:
   - Seluruh query database menggunakan Eloquent ORM dan PDO Prepared Parameter Binding.
4. **Proteksi Mass Assignment**:
   - Model Eloquent mendefinisikan whitelist `$fillable` yang ketat untuk mencegah modifikasi kolom tak berizin.
5. **Validasi & Sanitasi Berkas Upload**:
   - File foto profil dan gambar kegiatan divalidasi tipe MIME (`jpg,jpeg,png,webp`), ukuran maksimal (2 MB), dan disimpan di storage terisolasi.
6. **Autentikasi & Session Hardening**:
   - Password disimpan menggunakan algoritma hashing bcrypt / Argon2id yang kuat.
   - Session disimpan secara aman di database (`database` session driver).
7. **Isolasi Driver Database**:
   - Mekanisme backup/restore database mendukung pemeriksaan driver aktif (`mysql` vs `sqlite`) untuk mencegah eksekusi shell yang tidak valid.

---

## 🚨 Pelaporan Kerentanan (Reporting a Vulnerability)

Jika Anda menemukan potensi kerentanan keamanan pada repositori atau aplikasi ini, kami sangat menghargai kerja sama Anda untuk melaporkannya secara bertanggung jawab (*Responsible Disclosure*).

### Prosedur Pelaporan:
1. **JANGAN** membuat public GitHub Issue untuk kerentanan keamanan yang belum tertangani.
2. Kirimkan laporan detail via email ke Tim Pengembang:
   - **Email**: `ichalprov@gmail.com`
   - **Subjek**: `[SECURITY] Laporan Kerentanan KP-IF-SAKTI - <Judul Singkat>`
3. Sertakan informasi berikut dalam laporan Anda:
   - Deskripsi kerentanan dan potensi dampaknya.
   - Langkah-langkah untuk mereproduksi celah (*Proof of Concept* / skenario).
   - Komponen, file, atau endpoint yang terdampak.
   - Saran perbaikan (jika ada).

### Waktu Respons:
- Kami akan mengonfirmasi penerimaan laporan dalam waktu **1x24 jam**.
- Evaluasi dampak dan verifikasi kerentanan dalam waktu **2-3 hari kerja**.
- Perilisan patch/perbaikan keamanan secepat mungkin sebelum pengumuman publik dibuat.
