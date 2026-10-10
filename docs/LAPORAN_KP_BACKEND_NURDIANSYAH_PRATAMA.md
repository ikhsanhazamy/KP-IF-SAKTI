# LAPORAN KERJA PRAKTIK (KP)

## PENGEMBANGAN BACKEND DAN RESTFUL API SISTEM INFORMASI PIMPINAN CABANG FATAYAT NU KABUPATEN SUKABUMI BERBASIS LARAVEL 12

<br>

**Disusun Oleh:**  
**Nurdiansyah Pratama — NIM: 1237050139**  
**Role: Backend Developer**

<br>

**JURUSAN INFORMATIKA**  
**FAKULTAS SAINS DAN TEKNOLOGI**  
**UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI**  
**BANDUNG**  
**2026**

---

## KATA PENGANTAR

Puji dan syukur penulis panjatkan ke hadirat Allah SWT, karena berkat rahmat, taufik, dan hidayah-Nya, penulis dapat menyelesaikan penyusunan Laporan Kerja Praktik (KP) yang berjudul **"Pengembangan Backend dan RESTful API Sistem Informasi Pimpinan Cabang Fatayat NU Kabupaten Sukabumi Berbasis Laravel 12"**. Laporan ini disusun sebagai salah satu syarat akademis dalam menyelesaikan mata kuliah Kerja Praktik pada Jurusan Informatika, Fakultas Sains dan Teknologi, Universitas Islam Negeri Sunan Gunung Djati Bandung.

Pelaksanaan Kerja Praktik dan penyusunan laporan ini tidak lepas dari bimbingan, arahan, dan dukungan dari berbagai pihak. Oleh karena itu, penulis menyampaikan ucapan terima kasih yang sebesar-besarnya kepada:

1. Bapak Dekan Fakultas Sains dan Teknologi Universitas Islam Negeri Sunan Gunung Djati Bandung.
2. Bapak Ketua Jurusan Informatika Fakultas Sains dan Teknologi Universitas Islam Negeri Sunan Gunung Djati Bandung.
3. Bapak/Ibu Dosen Pembimbing Kerja Praktik yang telah memberikan arahan, saran, dan bimbingan teknis maupun akademis.
4. Jajaran Pengurus Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi yang telah memberikan izin, keterbukaan informasi, dan fasilitas selama pelaksanaan Kerja Praktik.
5. Rekan-rekan satu tim pengembang proyek **KP-IF-SAKTI**, yaitu **LM. Irsal Shydiq** (Project Manager & UI/UX Designer) dan **Ikhsan Hazamy** (Frontend Developer), atas dedikasi, kolaborasi, dan kerja sama solid selama pengembangan sistem.
6. Kedua orang tua dan keluarga tercinta yang senantiasa memberikan doa, motivasi, dan dukungan moril maupun materiel.
7. Seluruh rekan-rekan mahasiswa Jurusan Informatika angkatan 2023 yang telah saling menyemangati.

Penulis menyadari bahwa dalam laporan ini masih terdapat keterbatasan dan kekurangan. Oleh karena itu, kritik dan saran yang membangun sangat penulis harapkan demi penyempurnaan di masa yang akan datang. Semoga laporan ini dapat memberikan manfaat bagi pembaca, instansi mitra, dan kemajuan ilmu pengetahuan di bidang teknologi informasi.

<br>

Bandung, 2026

<br><br>

**Nurdiansyah Pratama**  
NIM. 1237050139

---

## DAFTAR ISI

- **Lembar Pengesahan** ........................................................................ i
- **Kata Pengantar** .............................................................................. ii
- **Daftar Isi** ....................................................................................... iii
- **Daftar Gambar** ............................................................................... iv
- **Daftar Tabel** ................................................................................... v
- **BAB I Pendahuluan** ......................................................................... 1
  - 1.1 Latar Belakang .................................................................... 1
  - 1.2 Rumusan Masalah ............................................................... 2
  - 1.3 Tujuan ................................................................................. 2
  - 1.4 Agenda Pelaksanaan Kerja Praktik ...................................... 3
  - 1.5 Profil Instansi ...................................................................... 4
  - 1.6 Uraian Departemen / Bagian Tempat KP ............................ 5
  - 1.7 Nama dan Deskripsi Jabatan Peserta KP .............................. 5
  - 1.8 Struktur Tim ......................................................................... 6
- **BAB II Pelaksanaan Kerja Praktik** .................................................... 7
  - 2.1 Ruang Lingkup Pekerjaan ..................................................... 7
  - 2.2 Dasar Teori ........................................................................... 8
  - 2.3 Log Book .............................................................................. 11
- **BAB III Luaran Kerja Praktik** ............................................................ 14
  - 3.1 Masalah ............................................................................... 14
  - 3.2 Tahapan Penyelesaian Masalah ............................................. 15
    - 3.2.1 Analisis Kebutuhan Fungsional & Non-Fungsional Backend .. 15
    - 3.2.2 Perancangan Arsitektur Backend & Database Schema ........ 17
    - 3.2.3 Implementasi RESTful API & Routing Engine .................. 20
    - 3.2.4 Implementasi Asynchronous Job Queue (GAS Webhook) ...... 24
    - 3.2.5 Implementasi Keamanan, Rate Limiting & 2FA Challenge .... 26
    - 3.2.6 Implementasi Engine Ekspor Laporan & Backup-Restore .... 28
    - 3.2.7 Pengujian Otomatis (*Automated Testing*) PHPUnit ......... 30
  - 3.3 Hasil ..................................................................................... 32
- **BAB IV Penutup** ................................................................................ 36
  - 4.1 Kesimpulan ........................................................................... 36
  - 4.2 Saran .................................................................................... 36
- **REFERENSI** ...................................................................................... 38
- **LAMPIRAN** ....................................................................................... 40

---

## DAFTAR GAMBAR

- **Gambar 1.1** Struktur Organisasi Tim Pengembang KP-IF-SAKTI ......................................... 6
- **Gambar 2.1** Pola Arsitektur Model-View-Controller (MVC) pada Laravel 12 ..................... 9
- **Gambar 3.1** Diagram Arsitektur Sistem Hybrid (Client-Server & Application Tier) ............ 18
- **Gambar 3.2** *Entity-Relationship Diagram* (ERD) Basis Data Sistem ............................... 19
- **Gambar 3.3** *Sequence Diagram* Alur Asinkron Pengajuan PAC dan Webhook Sinkronisasi ..... 25
- **Gambar 3.4** *Sequence Diagram* Alur Autentikasi Admin dan Verifikasi 2FA OTP ............... 27
- **Gambar 3.5** Hasil Eksekusi *Test Suite* Pengujian Otomatis PHPUnit ................................ 32
- **Gambar 3.6** Cuplikan Respons JSON Endpoint API `/api/kegiatan` dan `/api/stats` ......... 33
- **Gambar 3.7** Antarmuka Dashboard Admin Manajemen PAC & Kader Organisasi ................. 34
- **Gambar 3.8** Sampel Dokumen Laporan Rekapitulasi Kader Format PDF (DomPDF Engine) ..... 35

---

## DAFTAR TABEL

- **Tabel 1.1** Agenda dan Timeline Pelaksanaan Kerja Praktik ............................................. 3
- **Tabel 1.2** Matriks Peran dan Pembagian Tugas Tim Pengembang ...................................... 6
- **Tabel 2.1** Log Book Kegiatan Harian Peserta Kerja Praktik (Role: Backend Developer) ...... 11
- **Tabel 3.1** Matriks Analisis Kebutuhan Fungsional Backend ............................................. 15
- **Tabel 3.2** Matriks Analisis Kebutuhan Non-Fungsional Backend ...................................... 16
- **Tabel 3.3** Kamus Data Entitas Tabel `pacs` ................................................................... 19
- **Tabel 3.4** Kamus Data Entitas Tabel `anggotas` ............................................................. 20
- **Tabel 3.5** Kamus Data Entitas Tabel `kegiatans` ............................................................. 20
- **Tabel 3.6** Daftar Endpoint RESTful API, Metode HTTP, dan Hak Akses ............................. 21
- **Tabel 3.7** Parameter dan Aturan Validasi Pengajuan PAC Baru (`/api/pac/pengajuan`) ....... 23
- **Tabel 3.8** Konfigurasi Lapisan Middleware Keamanan dan Rate Limiting ......................... 26
- **Tabel 3.9** Rekapitulasi Skenario dan Hasil Pengujian Otomatis PHPUnit ......................... 31

---

# BAB I: PENDAHULUAN

### 1.1 Latar Belakang
Kabupaten Sukabumi merupakan salah satu wilayah administratif tingkat kabupaten terluas di Pulau Jawa, yang mencakup 47 kecamatan dan 386 desa/kelurahan dengan karakteristik geografis perbukitan dan pesisir. Di tengah bentang wilayah yang sangat luas tersebut, **Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi** memegang peranan strategis sebagai organisasi pemudi Islam yang menaungi 47 Pimpinan Anak Cabang (PAC) tingkat kecamatan dan ribuan kader yang aktif dalam bidang keagamaan, sosial kemasyarakatan, advokasi perempuan, kesehatan, dan pemberdayaan ekonomi keluarga.

Seiring bertambahnya jumlah kader dan intensitas program kerja di tingkat cabang maupun anak cabang, PC Fatayat NU Kabupaten Sukabumi menghadapi tantangan signifikan dalam tata kelola administrasi organisasi. Pengelolaan data anggota dan kaderisasi selama ini masih dilakukan secara parsial, konvensional, dan tersebar di berbagai dokumen fisik maupun lembar kerja spreadsheet yang tidak terintegrasi secara terpusat. Kondisi tersebut menimbulkan sejumlah permasalahan nyata di lapangan, antara lain:
1. **Redundansi dan Keterlambatan Rekonsiliasi Data**: Tidak adanya pangkalan data (*database*) terpusat menyebabkan data keanggotaan dan kepengurusan PAC sulit dimutakhirkan secara *real-time*.
2. **Keterbatasan Akses Informasi Publik**: Masyarakat dan kader di tingkat akar rumput kesulitan memperoleh informasi agenda kegiatan resmi, direktori kepengurusan PAC terdekat, serta pemetaan sebaran organisasi secara interaktif.
3. **Mekanisme Pengajuan PAC yang Belum Terdigitalisasi**: Proses permohonan pendirian atau pembaruan kepengurusan PAC baru masih memerlukan proses birokrasi manual yang memakan waktu dan berisiko kehilangan berkas.
4. **Ketidakefisienan Pelaporan**: Pengurus cabang membutuhkan waktu lama untuk menyusun rekapitulasi data demografi kader, statistik alumni Pelatihan Kader Dasar (LKD), serta laporan kegiatan bulanan untuk keperluan rapat kerja maupun pertanggungjawaban organisasi.

Guna mengatasi permasalahan tersebut, dibutuhkan sebuah **Sistem Informasi Manajemen Organisasi dan Portal Publik Terpadu (KP-IF-SAKTI)** yang mengadopsi arsitektur perangkat lunak modern. Sistem ini menggabungkan antarmuka publik berbasis *Single Page Application* (React 18 + Vite) dengan mesin *Backend* dan *Admin Dashboard* yang tangguh, aman, dan modular berbasis **Laravel 12 (PHP 8.2)**.

Dalam perancangan sistem ini, peran **Backend Developer** menjadi fondasi krusial yang bertanggung jawab merancang skema basis data relasional (*database schema*), membangun antarmuka pemrograman aplikasi (*RESTful API*) yang cepat dan berintegritas tinggi, mengimplementasikan antrean pemrosesan asinkron (*asynchronous job queue*) untuk sinkronisasi *webhook*, merancang mekanisme keamanan berlapis (*Two-Factor Authentication / 2FA*, proteksi *brute-force*, *rate limiting*, dan sanitasi ekspor), serta memastikan keandalan sistem melalui pengujian perangkat lunak otomatis (*automated testing*).

### 1.2 Rumusan Masalah
Berdasarkan latar belakang yang telah diuraikan, rumusan masalah yang menjadi fokus penyelesaian selama pelaksanaan Kerja Praktik ini adalah:
1. Bagaimana merancang dan membangun arsitektur *backend* dan layanan RESTful API yang modular, terstandar, dan berkinerja tinggi menggunakan framework Laravel 12?
2. Bagaimana merancang skema basis data relasional (MySQL 8.0 dan SQLite 3) yang teroptimasi dengan *indexing* untuk mengelola data 47 PAC, ribuan anggota, serta riwayat kegiatan secara konsisten?
3. Bagaimana mengimplementasikan mekanisme *asynchronous job queue* untuk menghubungkan pengajuan formulir PAC publik ke webhook Google Apps Script tanpa membebani waktu respons (*latency*) pengguna?
4. Bagaimana menerapkan tata kelola keamanan sistem yang komprehensif, mencakup *Two-Factor Authentication* (2FA OTP), *rate limiting*, proteksi CSRF, dan sanitasi berkas ekspor (*CSV formula injection prevention*)?
5. Bagaimana menjamin keandalan dan kualitas logika bisnis *backend* melalui *automated testing* berbasis PHPUnit?

### 1.3 Tujuan
Tujuan yang hendak dicapai dari pelaksanaan Kerja Praktik ini adalah:
1. Mengembangkan mesin *backend* dan rangkaian *endpoint* RESTful API publik yang mampu melayani pertukaran data JSON secara efisien ke aplikasi *frontend*.
2. Membangun skema basis data relasional lengkap dengan migrasi, *factory*, *seeder*, serta indeks performa untuk menjamin waktu eksekusi kueri agregasi di bawah 50 ms.
3. Mengembangkan sistem antrean latar belakang (*background worker queue*) menggunakan class `SyncPacSubmissionToGoogleSheet` guna menyinkronkan pengajuan PAC ke Google Sheets secara *non-blocking*.
4. Mengimplementasikan modul *Dashboard Admin* terintegrasi yang dilengkapi dengan fitur CRUD master data, generator laporan berformat PDF, Excel, dan CSV, serta sistem pengamanan sesi berbasis 2FA OTP.
5. Menyusun *test suite* pengujian otomatis (Unit & Feature Tests) dengan PHPUnit untuk memastikan bebas dari *regression error* dengan tingkat keberhasilan 100%.

### 1.4 Agenda Pelaksanaan Kerja Praktik
Kerja Praktik dilaksanakan selama periode operasional proyek dengan tahapan kerja yang terbagi ke dalam sprint mingguan sebagaimana disajikan pada **Tabel 1.1**.

**Tabel 1.1 Agenda dan Timeline Pelaksanaan Kerja Praktik**
| Minggu Ke- | Tahapan Kegiatan | Target / Luaran Backend | Status |
|---|---|---|:---:|
| **Minggu 1** | Studi Lapangan, Analisis Kebutuhan, & Inisiasi Proyek | Dokumen SRS, spesifikasi kebutuhan fungsional & non-fungsional. | Selesai |
| **Minggu 2** | Perancangan Database, ERD, & Desain Kontrak REST API | Migration files Laravel, kamus data, ERD, dan spesifikasi OpenAPI/JSON. | Selesai |
| **Minggu 3** | Pengembangan Core Model Eloquent, Seeder, & REST API | Endpoint `/api/kegiatan`, `/api/pac`, `/api/stats`, dan filtering kueri. | Selesai |
| **Minggu 4** | Integrasi Webhook Eksternal & Asynchronous Job Queue | Dispatcher `SyncPacSubmissionToGoogleSheet` & endpoint `/api/pac/pengajuan`. | Selesai |
| **Minggu 5** | Pengembangan Admin Dashboard, CRUD, & Engine Laporan | Modul Admin PAC, Anggota, Kegiatan, dan ekspor DomPDF / Excel / CSV. | Selesai |
| **Minggu 6** | Implementasi Keamanan, 2FA OTP, & Backup/Restore DB | Middleware 2FA, Rate Limiter (`throttle`), & modul Backup SQLite/MySQL. | Selesai |
| **Minggu 7** | Pengujian Otomatis (PHPUnit), Code Refactoring, & QA | Feature Test suite (PAC, 2FA, Stats, Job Queue) lulus 100%. | Selesai |
| **Minggu 8** | Kontainerisasi Docker, Finalisasi Dokumentasi, & Rilis | `docker-compose.yml`, panduan API, dan penulisan Laporan Akhir KP. | Selesai |

### 1.5 Profil Instansi
- **Nama Instansi**: Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi
- **Badan Hukum / Afiliasi**: Badan Otonom Nahdlatul Ulama (NU)
- **Wilayah Kerja**: Kabupaten Sukabumi, Provinsi Jawa Barat (Membawahi 47 Pimpinan Anak Cabang)
- **Visi**:
  > *"Terwujudnya pemudi Islam Ahlussunnah wal Jama'ah an-Nahdliyyah yang bertaqwa, berakhlak mulia, berpendidikan, mandiri, dan berdaya saing dalam mewujudkan kemaslahatan umat, bangsa, dan negara."*
- **Misi**:
  1. Membangun kesadaran kritis dan penguatan kapasitas kader perempuan muda di bidang keagamaan, kepemimpinan, dan sosial kemasyarakatan.
  2. Meningkatkan kualitas sumber daya kader melalui pendidikan formal, pelatihan kejuruan, dan kaderisasi berjenjang (Latihan Kader Dasar/LKD).
  3. Mengembangkan jaringan komunikasi, data organisasi, dan kemitraan strategis berbasis teknologi informasi.
  4. Mendorong kemandirian ekonomi kader melalui program pemberdayaan UMKM dan koperasi perempuan di tingkat PAC.
- **Struktur Organisasi**: Dipimpin oleh Ketua Cabang PC Fatayat NU Kabupaten Sukabumi, dibantu oleh Wakil Ketua, Sekretaris, Bendahara, serta jajaran Biro/Divisi teknis (Infokom, Kaderisasi, Advokasi, Ekonomi, dan Kesehatan).

### 1.6 Uraian Departemen / Bagian Tempat KP
Pelaksanaan Kerja Praktik ditempatkan pada **Biro Informasi, Komunikasi, dan Litbang (Infokom & Kaderisasi) PC Fatayat NU Kabupaten Sukabumi**. 

Tugas Pokok dan Fungsi (Tupoksi) Biro Infokom & Kaderisasi meliputi:
1. Mengelola dan mengembangkan sistem informasi, portal web resmi, dan pangkalan data anggota organisasi.
2. Memfasilitasi digitalisasi arsip surat masuk, pengajuan kepengurusan PAC, dan dokumentasi agenda kegiatan cabang.
3. Mempublikasikan informasi kegiatan dakwah dan program kerja organisasi kepada khalayak umum.
4. Menyediakan analisis data statistik kaderisasi dan alumni LKD untuk mendukung pengambilan keputusan strategis oleh pimpinan cabang.

### 1.7 Nama dan Deskripsi Pekerjaan/Jabatan Peserta KP
- **Nama Jabatan**: **Backend Developer**
- **Deskripsi Pekerjaan**:
  1. **Perancangan Skema Data**: Merancang skema relasional tabel MySQL/SQLite, membuat *database migrations*, *factories*, dan *seeders* data awal 47 PAC serta data simulasi kader.
  2. **Pengembangan RESTful API**: Mengembangkan *endpoint* API publik (`/api/pac`, `/api/kegiatan`, `/api/stats`, `/api/pac/pengajuan`) dengan format respons JSON standar dan penanganan validasi kesalahan (*validation exception*).
  3. **Pengembangan Fitur Asinkron**: Mengimplementasikan antrean latar belakang (*Job Queue*) untuk mendispatch data pengajuan PAC ke Google Apps Script Webhook tanpa membebani pengguna.
  4. **Pengembangan Admin Dashboard & Reporting Engine**: Membangun modul manajemen data organisasi, implementasi *dynamic search & pagination*, serta engine ekspor laporan PDF (DomPDF), Excel (.xls), dan CSV stream yang terhindar dari *CSV injection*.
  5. **Penguatan Keamanan Sistem**: Mengonfigurasi rate limiting (*throttle*), verifikasi token CSRF, session authentication, implementasi *Two-Factor Authentication* (2FA) berbasis kode OTP challenge, serta mekanisme pencadangan (*backup & restore*) basis data.
  6. **Quality Assurance & Automated Testing**: Menulis dan mengeksekusi *Feature Test* dan *Unit Test* menggunakan framework PHPUnit guna memvalidasi stabilitas seluruh rute dan logika backend.

### 1.8 Struktur Tim
Proyek pengembangan sistem informasi KP-IF-SAKTI dijalankan oleh tim beranggotakan 3 orang mahasiswa dengan pembagian peran yang terdefinisi secara jelas pada **Tabel 1.2** dan **Gambar 1.1**.

**Tabel 1.2 Matriks Peran dan Pembagian Tugas Tim Pengembang**
| Nama Mahasiswa | NIM | Peran Utama | Lingkup Kontribusi |
|---|---|---|---|
| **LM. Irsal Shydiq** | 1237050115 | **Project Manager & UI/UX Designer** | Manajemen sprint, perancangan mockup UI/UX, design tokens Tailwind CSS, arsitektur DevOps Docker, dan quality review. |
| **Ikhsan Hazamy** | 1237050073 | **Frontend Developer** | Pengembangan Single Page Application (SPA) React 18 + Vite, visualisasi peta MapLibre GL, integrasi antarmuka, dan konsumsi REST API. |
| **Nurdiansyah Pratama** | 1237050139 | **Backend Developer** | Pengembangan backend Laravel 12, REST API engine, basis data MySQL/SQLite, Queue Worker, sistem keamanan 2FA, dan unit testing PHPUnit. |

---

# BAB II: PELAKSANAAN KERJA PRAKTIK

### 2.1 Ruang Lingkup Pekerjaan
Ruang lingkup pekerjaan yang dilaksanakan oleh penulis sebagai *Backend Developer* selama Kerja Praktik meliputi:
1. **Lingkungan Pengembangan & Ekosistem Teknologi**:
   - Runtime Environment: **PHP 8.2-FPM**
   - Framework Utama: **Laravel 12.x**
   - Basis Data: **MySQL 8.0** (lingkungan produksi / Docker) dan **SQLite 3** (lingkungan pengujian otomatis)
   - Template Engine Server-Side: **Blade Template** (khusus area Dashboard Admin)
   - Library Tambahan: `barryvdh/laravel-dompdf` (PDF generator), `symfony/process` (database dump executor)
2. **Pengembangan RESTful API Publik**:
   - Penyediaan endpoint data agenda kegiatan dengan kemampuan pencarian teks (*full-text query*) dan filter kategori (`/api/kegiatan`).
   - Penyediaan endpoint direktori 47 PAC aktif lengkap dengan kalkulasi agregat jumlah kegiatan (`/api/pac`).
   - Penyediaan endpoint ringkasan statistik organisasi terhitung otomatis (`/api/stats`).
   - Penyediaan endpoint penerimaan formulir pengajuan PAC baru (`/api/pac/pengajuan`) yang dilindungi validasi ketat dan *rate limiting*.
3. **Mekanisme Antrean Asinkron & Integrasi Eksternal**:
   - Perancangan *job class* `SyncPacSubmissionToGoogleSheet` yang mengimplementasikan kontrak `ShouldQueue` untuk pengiriman HTTP POST ke Google Apps Script Webhook.
4. **Sistem Autentikasi & Keamanan Berlapis**:
   - Pengamanan rute admin menggunakan session auth dan proteksi CSRF.
   - Implementasi verifikasi dua langkah (*Two-Factor Authentication / 2FA*) berbasis OTP dengan masa kedaluwarsa sesi 10 menit dan batas percobaan maksimal 5 kali.
   - Konfigurasi middleware rate limiting: `throttle:api` (60 req/menit), `throttle:pac-pengajuan` (10 req/menit), dan `throttle:login` (5 percobaan/menit).
5. **Modul Pelaporan & Utilitas Sistem**:
   - Ekspor berkas laporan dinamis (PDF, Excel, dan CSV Stream) untuk data Anggota, PAC, dan Kegiatan.
   - Sanitasi karakter berbahaya pada data CSV guna mencegah celah keamanan *CSV Formula Injection*.
   - Fitur pencadangan (*backup*) dan pemulihan (*restore*) basis data multi-driver (MySQL & SQLite) yang dilengkapi mekanisme *pre-restore snapshot rollback safety*.
6. **Pengujian Otomatis (*Automated Testing*)**:
   - Penyusunan *test case* komprehensif menggunakan PHPUnit untuk memvalidasi alur autentikasi, integrasi job queue, kalkulasi data agregat, serta transaksi basis data.

### 2.2 Dasar Teori
Dalam melaksanakan perancangan dan implementasi backend sistem, penulis mengacu pada dasar teori dan literatur ilmiah bereputasi dengan format sitasi IEEE sebagai berikut:

#### 1. Arsitektur RESTful Web Services
Menurut Field et al. [1], *Representational State Transfer* (REST) merupakan gaya arsitektur perangkat lunak terdistribusi yang memanfaatkan protokol HTTP secara murni dengan sifat *stateless*. Setiap sumber daya (*resource*) diidentifikasikan melalui *Uniform Resource Identifier* (URI) yang unik dan dimanipulasi menggunakan kata kerja standar HTTP (*HTTP verbs*), seperti `GET` untuk membaca data, `POST` untuk membuat data baru, `PUT`/`PATCH` untuk memperbarui data, dan `DELETE` untuk menghapus data. Komunikasi data yang dikembalikan berformat standar *JavaScript Object Notation* (JSON), memungkinkan integrasi yang mulus antara backend Laravel dan frontend SPA React.

#### 2. Pola Model-View-Controller (MVC) dan Framework Laravel
Pola perancangan *Model-View-Controller* (MVC) memisahkan perangkat lunak ke dalam tiga komponen independen: *Model* (logika data dan bisnis), *View* (antarmuka presentasi), dan *Controller* (pengatur alur logika dan interaksi antara Model dan View) [2]. Framework Laravel 12 mengimplementasikan pola MVC modern dengan menyediakan ekosistem pendukung yang kaya, seperti *Service Container*, *Middleware Pipeline*, *Blade Templating Engine*, dan *Routing Engine* deklaratif yang mempercepat pengembangan aplikasi web berskala enterprise secara terstruktur dan aman.

#### 3. Object-Relational Mapping (ORM) Eloquent
Eloquent ORM merupakan implementasi pola *Active Record* pada Laravel yang memungkinkan pengembang berinteraksi dengan tabel basis data relasional menggunakan sintaks objek berorientasi objek yang ekspresif [3]. Eloquent menyederhanakan definisi relasi antar-tabel (seperti relasi *One-to-Many* antara `PAC` dan `Anggota` maupun `Kegiatan`), penanganan *eager loading* untuk mengatasi masalah kueri $N+1$, serta mutasi data otomatis (*timestamping* dan *type casting*).

#### 4. Basis Data Relasional dan Pengindeksan (*Database Indexing*)
Basis data relasional menggunakan bahasa kueri SQL terstruktur untuk menjamin integritas referensial dan kepatuhan prinsip ACID (*Atomicity, Consistency, Isolation, Durability*) [4]. Dalam pengelolaan data berskala besar, pembuatan indeks (*index*) pada kolom-kolom yang sering digunakan dalam klausa `WHERE`, `ORDER BY`, dan relasi `FOREIGN KEY` (seperti kolom `status`, `kecamatan`, dan `kategori`) secara dramatis mengurangi waktu pencarian dari *full-table scan* ($O(N)$) menjadi pencarian berbasis pohon seimbang B-Tree ($O(\log N)$).

#### 5. Pemrosesan Antrean Asinkron (*Asynchronous Queue*) dan Webhook
Menurut Richards dan Ford [5], arsitektur berbasis pesan asinkron (*message queue*) memungkinkan pemisahan eksekusi tugas yang memakan waktu lama (*time-consuming tasks*) dari alur pertukaran request-response HTTP utama. Dengan menempatkan pemanggilan *webhook* pihak ketiga (seperti pengiriman HTTP POST ke Google Apps Script) ke dalam antrean *background worker*, server dapat langsung mengembalikan respons `201 Created` ke pengguna dalam hitungan milidetik, sementara proses I/O jaringan dieksekusi secara terisolasi dengan mekanisme *automatic retry*.

#### 6. Keamanan Aplikasi Web dan Two-Factor Authentication (2FA)
Keamanan aplikasi web menuntut perlindungan berlapis terhadap ancaman *brute-force attack*, *Cross-Site Request Forgery* (CSRF), *SQL Injection*, dan *CSV Formula Injection* [6]. Penerapan *Two-Factor Authentication* (2FA) berbasis *Time-based One-Time Password* (TOTP) atau kode OTP instan menambahkan lapisan pertahanan kedua setelah kata sandi, sehingga akun administrator tetap terlindungi meskipun kredensial utama terkompromi. Selain itu, pembatasan laju permintaan (*rate limiting*) menggunakan algoritma *Token Bucket* efektif mencegah kelebihan beban server akibat serangan *Denial of Service* (DoS).

#### 7. Ekspor Dokumen Portabel dan Mitigasi CSV Injection
Penyusunan laporan dalam format PDF (*Portable Document Format*) menjamin konsistensi tata letak dokumen cetak di berbagai perangkat [7]. Pada ekspor berkas CSV/Excel, celah keamanan *CSV Injection* (Formula Injection) dapat terjadi apabila data input pengguna diawali dengan karakter operator matematika atau formula (seperti `=`, `+`, `-`, atau `@`). Sanitasi karakter awal dengan menambahkan *single quote* (`'`) sebelum penulisan ke berkas menjadi standar keamanan mutlak untuk mencegah eksekusi perintah berbahaya pada aplikasi spreadsheet pembaca.

#### 8. Pengujian Perangkat Lunak Otomatis (*Automated Software Testing*)
Pengujian perangkat lunak otomatis menggunakan unit testing dan feature testing merupakan pilar penting dalam rekayasa perangkat lunak modern untuk menjamin bahwa modul individual dan integrasi sistem berjalan sesuai spesifikasi kebutuhan tanpa memicu *bug* regresi [8]. Framework PHPUnit pada ekosistem Laravel memfasilitasi pengujian transaksi basis data di lingkungan *in-memory* SQLite yang terisolasi dengan trait `RefreshDatabase`.

### 2.3 Log Book
Catatan aktivitas harian pelaksanaan Kerja Praktik yang dilaksanakan oleh penulis sebagai *Backend Developer* disajikan secara terstruktur pada **Tabel 2.1**.

**Tabel 2.1 Log Book Kegiatan Harian Peserta Kerja Praktik (Role: Backend Developer)**
| Hari / Tanggal | Uraian Kegiatan Harian | Luaran / Bukti Teknis | Paraf Pembimbing |
|---|---|---|:---:|
| **Minggu 1, Hari 1** | Pertemuan koordinasi awal tim pengembang, observasi alur kerja manual PC Fatayat NU Kab. Sukabumi, dan wawancara kebutuhan data. | Notulensi kebutuhan sistem informasi & *user stories*. | *(Tercatat)* |
| **Minggu 1, Hari 2** | Analisis kebutuhan fungsional dan non-fungsional sistem dari sudut pandang *backend* dan integrasi API. | Dokumen matriks spesifikasi fungsional backend (FR-01 s/d FR-12). | *(Tercatat)* |
| **Minggu 1, Hari 3** | Inisiasi repositori Git, konfigurasi awal proyek Laravel 12, dan setup *branching strategy* GitHub. | Repositori proyek `KP-IF-SAKTI`, berkas `.gitignore`, dan konfigurasi `.env`. | *(Tercatat)* |
| **Minggu 1, Hari 4** | Riset dan pemilihan pustaka pihak ketiga (DomPDF, Laravel Queue, PHPUnit, MapLibre endpoint requirements). | Dokumen arsitektur dependensi `composer.json`. | *(Tercatat)* |
| **Minggu 1, Hari 5** | Perancangan arsitektur *hybrid* (Dual interface: REST API publik & SSR Admin Blade). | Diagram arsitektur sistem dan alur data level tinggi. | *(Tercatat)* |
| **Minggu 2, Hari 6** | Perancangan konseptual basis data relasional: entitas User, PAC, Anggota, Kegiatan, dan Pengaturan. | Diagram Entity-Relationship (ERD) dan kamus data. | *(Tercatat)* |
| **Minggu 2, Hari 7** | Pembuatan berkas *Database Migration* untuk tabel `users`, `pacs`, `anggotas`, `kegiatans`, dan `pengaturans`. | Berkas migrasi database Laravel di folder `database/migrations/`. | *(Tercatat)* |
| **Minggu 2, Hari 8** | Konfigurasi indeks basis data (*database indexes*) pada kolom `status`, `kecamatan`, `kategori`, dan `tanggal`. | Script migrasi indeks performa kueri basis data. | *(Tercatat)* |
| **Minggu 2, Hari 9** | Pembuatan *Database Seeders* dan *Model Factories* untuk mengenerate data master 47 PAC resmi Kab. Sukabumi. | `DatabaseSeeder.php` dan data seeder 47 PAC. | *(Tercatat)* |
| **Minggu 2, Hari 10** | Perancangan kontrak REST API (*API Contract*) berformat JSON untuk sinkronisasi dengan pengembang frontend. | Dokumen spesifikasi API (endpoint, params, response schema). | *(Tercatat)* |
| **Minggu 3, Hari 11** | Implementasi model Eloquent (`PAC`, `Anggota`, `Kegiatan`, `Pengaturan`, `User`) beserta definisi relasi relasionalnya. | Model classes di `app/Models/` dengan relasi `hasMany` & `belongsTo`. | *(Tercatat)* |
| **Minggu 3, Hari 12** | Pengembangan endpoint API `/api/kegiatan` dengan dukungan pencarian teks (*search*) dan filter kategori dinamis. | Rute dan *handler* API kegiatan di `routes/api.php`. | *(Tercatat)* |
| **Minggu 3, Hari 13** | Pengembangan endpoint API detail kegiatan `/api/kegiatan/{id}` dengan relasi *eager loading* data PAC penyelenggara. | Respons JSON detail kegiatan beserta objek PAC terkait. | *(Tercatat)* |
| **Minggu 3, Hari 14** | Pengembangan endpoint API `/api/pac` untuk menyajikan direktori 47 PAC aktif beserta kalkulasi `total_kegiatan`. | Respons JSON 47 PAC yang siap dikonsumsi peta MapLibre GL. | *(Tercatat)* |
| **Minggu 3, Hari 15** | Pengembangan endpoint API statistik agregat `/api/stats` (total PAC, anggota, kecamatan, dan persentase kelengkapan data). | Respons JSON metrik statistik organisasi terhitung otomatis. | *(Tercatat)* |
| **Minggu 4, Hari 16** | Analisis alur bisnis formulir permohonan pembentukan PAC baru dari masyarakat publik. | Flowchart pengajuan PAC publik dan kebutuhan webhook. | *(Tercatat)* |
| **Minggu 4, Hari 17** | Pengembangan endpoint POST `/api/pac/pengajuan` lengkap dengan aturan validasi input *Form Request*. | Validasi input form pengajuan PAC dan penyimpanan status `pending`. | *(Tercatat)* |
| **Minggu 4, Hari 18** | Pembuatan script Google Apps Script Webhook untuk menerima payload data pengajuan dan menambahkannya ke Spreadsheet. | Script `pengajuan-pac.gs` dan deployment webhook URL. | *(Tercatat)* |
| **Minggu 4, Hari 19** | Pengembangan *Job Queue* `SyncPacSubmissionToGoogleSheet` untuk mengeksekusi pengiriman webhook secara asinkron. | Class `SyncPacSubmissionToGoogleSheet.php` di `app/Jobs/`. | *(Tercatat)* |
| **Minggu 4, Hari 20** | Konfigurasi *retry policy* (3 kali percobaan), timeout (30 detik), dan sistem pencatatan log kegagalan antrean. | Mekanisme logging antrean `Log::warning` dan `Log::info`. | *(Tercatat)* |
| **Minggu 5, Hari 21** | Perancangan dan integrasi tampilan antarmuka *Dashboard Admin* menggunakan Laravel Blade Views. | Kerangka *layout* dashboard admin terintegrasi. | *(Tercatat)* |
| **Minggu 5, Hari 22** | Pengembangan modul CRUD Manajemen Data PAC (`PACController`) lengkap dengan fitur pencarian dan paginasi data. | Fitur tambah, ubah, hapus, dan tampil data PAC admin. | *(Tercatat)* |
| **Minggu 5, Hari 23** | Pengembangan modul CRUD Manajemen Anggota & Kader (`AnggotaController`) beserta fitur kalkulasi umur dinamis. | Modul manajemen kader dengan filter status dan pendidikan. | *(Tercatat)* |
| **Minggu 5, Hari 24** | Pengembangan modul CRUD Manajemen Agenda & Berita Kegiatan (`KegiatanController`) beserta fitur upload poster. | Modul manajemen kegiatan organisasi di dashboard admin. | *(Tercatat)* |
| **Minggu 5, Hari 25** | Pengembangan fitur impor data massal dari berkas CSV (*CSV Import Parser*) untuk data PAC dan data Anggota. | Parser CSV fleksibel dengan pemetaan nama kolom otomatis. | *(Tercatat)* |
| **Minggu 6, Hari 26** | Pengembangan *Engine* Ekspor Dokumen Laporan PDF menggunakan library `barryvdh/laravel-dompdf`. | Template view PDF dan fitur download `laporan-anggota.pdf`, dll. | *(Tercatat)* |
| **Minggu 6, Hari 27** | Pengembangan fitur ekspor data Excel (.xls) dan CSV Streaming dengan sanitasi proteksi *CSV Formula Injection*. | Method `exportCSV` dan sanitasi karakter awal (`'`, `=`, `@`). | *(Tercatat)* |
| **Minggu 6, Hari 28** | Implementasi autentikasi administrator, proteksi brute-force login, dan pembuatan endpoint `/csrf-token`. | Controller `AuthController.php` dan middleware *throttle login*. | *(Tercatat)* |
| **Minggu 6, Hari 29** | Pengembangan fitur keamanan *Two-Factor Authentication* (2FA OTP Challenge) dan middleware `EnsureTwoFactorIsVerified`. | Alur verifikasi OTP 6 digit dan proteksi akses dashboard. | *(Tercatat)* |
| **Minggu 6, Hari 30** | Pengembangan modul Pengaturan Sistem: ubah profil, ganti password, preferensi notifikasi, dan *backup/restore* database. | `PengaturanController.php` dengan rollback safety backup DB. | *(Tercatat)* |
| **Minggu 7, Hari 31** | Penulisan skenario pengujian otomatis *Feature Test* untuk modul PAC (`PACManagementTest.php`). | 7 skenario uji CRUD, paginasi, import CSV, dan relasi kueri. | *(Tercatat)* |
| **Minggu 7, Hari 32** | Penulisan skenario pengujian *Feature Test* untuk pengajuan asinkron (`PacPengajuanAsyncJobTest.php`). | Mocking `Queue::fake()` dan `Http::fake()` untuk pengujian webhook. | *(Tercatat)* |
| **Minggu 7, Hari 33** | Penulisan skenario pengujian *Feature Test* untuk alur keamanan 2FA (`TwoFactorAuthenticationTest.php`). | 8 skenario uji validasi OTP, resend code, dan session invalidation. | *(Tercatat)* |
| **Minggu 7, Hari 34** | Eksekusi pengujian otomatis seluruh *test suite* menggunakan perintah `php artisan test`. | Evaluasi hasil pengujian: seluruh test case lulus (Green Bar). | *(Tercatat)* |
| **Minggu 7, Hari 35** | Optimalisasi kueri basis data (*Query Optimization*), peninjauan *memory leak*, dan pembersihan kode (*refactoring*). | Kueri agregasi dioptimasi, bebas dari masalah kueri $N+1$. | *(Tercatat)* |
| **Minggu 8, Hari 36** | Penyusunan konfigurasi multi-container Docker (`Dockerfile` PHP 8.2-FPM, Nginx, Supervisor, dan MySQL 8.0). | Berkas `Dockerfile` dan `docker-compose.yml` siap produksi. | *(Tercatat)* |
| **Minggu 8, Hari 37** | Uji coba *deployment* lokal terisolasi dan pengujian integrasi komunikasi antara Frontend React dan Backend API. | Validasi fungsional sistem end-to-end pada lingkungan Docker. | *(Tercatat)* |
| **Minggu 8, Hari 38** | Penulisan dokumen dokumentasi teknis: `API_DOCUMENTATION.md`, `DATABASE_SCHEMA.md`, dan `ARCHITECTURE.md`. | Dokumentasi teknis lengkap pada direktori `docs/`. | *(Tercatat)* |
| **Minggu 8, Hari 39** | Serah terima sistem (*handover*) dan demonstrasi fungsionalitas backend kepada pimpinan biro instansi mitra. | Berita acara demonstrasi dan uji terima pengguna (*UAT*). | *(Tercatat)* |
| **Minggu 8, Hari 40** | Finalisasi dan penyusunan naskah Laporan Akhir Kerja Praktik. | Naskah Laporan Akhir Kerja Praktik lengkap. | *(Tercatat)* |

---

# BAB III: LUARAN KERJA PRAKTIK

### 3.1 Masalah
Dalam proses digitalisasi tata kelola organisasi PC Fatayat NU Kabupaten Sukabumi, penulis mengidentifikasi beberapa masalah teknis dan fungsional pada ranah *backend* yang menjadi fokus penyelesaian selama Kerja Praktik:
1. **Pengelolaan Data Terdistribusi 47 Kecamatan Tanpa Standarisasi**:
   - PC Fatayat NU membawahi 47 PAC di 47 kecamatan dengan karakteristik data yang heterogen. Sistem lama tidak memiliki skema relasional terpusat, sehingga data kepengurusan, nomor Surat Keputusan (SK), dan rekapitulasi kader sering mengalami inkonsistensi.
2. **Kendala Latensi Pemrosesan Eksternal (*Network Latency & Blocking I/O*)**:
   - Pengurus cabang menghendaki agar setiap formulir pengajuan PAC baru dari website publik otomatis tercatat ke Google Spreadsheet pengurus melalui webhook Google Apps Script. Apabila pemanggilan HTTP POST pihak ketiga ini dijalankan secara *synchronous*, kegagalan jaringan eksternal atau keterlambatan server Google dapat menyebabkan pengguna menunggu hingga puluhan detik (*HTTP timeout* / *bad gateway*).
3. **Kebutuhan Keamanan Tingkat Tinggi pada Akun Administrator**:
   - Data anggota Fatayat NU memuat informasi pribadi (nama lengkap, NIK, alamat, tanggal lahir, nomor kontak). Oleh karena itu, dashboard admin memerlukan perlindungan autentikasi ekstra guna mencegah akses tidak sah akibat serangan *brute-force* atau pencurian kata sandi.
4. **Resiko Keamanan Berkas Ekspor (*CSV Formula Injection*)**:
   - Pada fitur ekspor data anggota ke format CSV/Excel, nama anggota atau instansi yang diawali dengan karakter tertentu (misalnya `=CMD(...)`) berpotensi dieksekusi sebagai formula makro berbahaya oleh aplikasi pengolah spreadsheet lokal.
5. **Kebutuhan Portabilitas dan Ketersediaan Basis Data**:
   - Sistem memerlukan fleksibilitas basis data yang mampu berjalan menggunakan **MySQL 8.0** pada server produksi Docker, sekaligus mendukung **SQLite 3** untuk keperluan pengujian otomatis (*automated testing*) dan pencadangan portabel.

### 3.2 Tahapan Penyelesaian Masalah
Sebagai *Backend Developer*, tahapan penyelesaian masalah dilakukan secara sistematis mengikuti siklus pengembangan perangkat lunak modern, mulai dari analisis kebutuhan, perancangan arsitektur, implementasi kode, penguatan keamanan, hingga pengujian otomatis.

#### 3.2.1 Analisis Kebutuhan Fungsional dan Non-Fungsional Backend
Kebutuhan fungsional (*Functional Requirements*) mendefinisikan kapabilitas dan layanan yang wajib disediakan oleh backend sistem, sebagaimana dipetakan pada **Tabel 3.1**.

**Tabel 3.1 Matriks Analisis Kebutuhan Fungsional Backend**
| Kode Kebutuhan | Deskripsi Kebutuhan Fungsional | Komponen / Endpoint Terkait |
|---|---|---|
| **FR-01** | Sistem mampu menyajikan daftar seluruh agenda kegiatan publik dengan filter kategori dan pencarian kata kunci. | `GET /api/kegiatan` |
| **FR-02** | Sistem mampu menyajikan informasi detail kegiatan tertentu beserta relasi data PAC penyelenggara. | `GET /api/kegiatan/{id}` |
| **FR-03** | Sistem mampu menyajikan direktori 47 PAC berstatus aktif beserta kalkulasi total kegiatan untuk visualisasi peta MapLibre GL. | `GET /api/pac` |
| **FR-04** | Sistem mampu menghitung dan menyajikan ringkasan statistik organisasi (total PAC, anggota aktif, kecamatan terjangkau, dan rasio kelengkapan data). | `GET /api/stats` |
| **FR-05** | Sistem mampu menerima dan memvalidasi formulir pengajuan PAC baru secara publik dengan status *pending*. | `POST /api/pac/pengajuan` |
| **FR-06** | Sistem mampu mendispatch pengiriman webhook pengajuan PAC ke Google Sheets secara asinkron melalui antrean *job queue*. | `SyncPacSubmissionToGoogleSheet` |
| **FR-07** | Sistem mampu menyediakan autentikasi sesi admin yang dilengkapi proteksi *Two-Factor Authentication* (2FA OTP Challenge). | `POST /login`, `POST /two-factor-challenge` |
| **FR-08** | Sistem menyediakan operasi CRUD lengkap untuk data PAC, Anggota, dan Kegiatan pada Dashboard Admin. | `PACController`, `AnggotaController`, `KegiatanController` |
| **FR-09** | Sistem mampu memproses impor massal data PAC dan Anggota dari berkas CSV dengan *auto-header normalization*. | `POST /data-pac/import-csv`, `POST /anggota/import-csv` |
| **FR-10** | Sistem mampu mengenerate dan mengunduh laporan rekapitulasi data format PDF menggunakan DomPDF. | `GET /laporan/export/pdf`, `GET /laporan/export/pac/pdf`, dll. |
| **FR-11** | Sistem mampu mengekspor data anggota ke format CSV Stream dengan sanitasi pencegahan *CSV Formula Injection*. | `GET /laporan/export/csv` |
| **FR-12** | Sistem mampu melakukan pencadangan (*backup*) dan pemulihan (*restore*) basis data multi-driver (MySQL/SQLite) secara aman. | `POST /backup/database`, `POST /restore/database` |

Sedangkan kebutuhan non-fungsional (*Non-Functional Requirements*) yang menjadi standar performa dan kualitas sistem disajikan pada **Tabel 3.2**.

**Tabel 3.2 Matriks Analisis Kebutuhan Non-Fungsional Backend**
| Aspek Kebutuhan | Parameter Target | Mekanisme Implementasi Backend |
|---|---|---|
| **Performa (Performance)** | Waktu respons API read $\le 50$ ms; respons submission form $\le 200$ ms. | Pengindeksan database relasional, *eager loading* Eloquent, dan *asynchronous job dispatching*. |
| **Keamanan (Security)** | Perlindungan terhadap SQL Injection, XSS, CSRF, Brute-force, dan 2FA bypass. | PDO prepared statements, token CSRF, *throttle middleware*, Bcrypt hashing, dan session verification. |
| **Keandalan (Reliability)** | Toleransi kegagalan jaringan eksternal tanpa menghentikan proses utama. | Antrean antarmuka *queue retry policy* (maks 3 kali percobaan) dan *error logging*. |
| **Skalabilitas & Portabilitas**| Kemudahan instalasi dan deployment pada berbagai platform server. | Kontainerisasi Docker multi-stage dan arsitektur database multi-driver (MySQL/SQLite). |

#### 3.2.2 Perancangan Arsitektur Backend dan Skema Basis Data
Sistem KP-IF-SAKTI mengusung arsitektur **Modern Hybrid Architecture**. Arsitektur ini memisahkan layanan menjadi dua kanal utama:
1. **RESTful API Engine**: Melayani permintaan data JSON nir-keadaan (*stateless*) untuk antarmuka publik React 18 SPA.
2. **Server-Side Rendered (SSR) Admin Blade Engine**: Melayani antarmuka administrasi berbasis sesi (*stateful session-based*) yang kaya fitur dan aman.

Skema basis data dirancang secara terstandarisasi dengan model relasional sebagaimana direpresentasikan pada Kamus Data Tabel 3.3 s/d 3.5.

**Tabel 3.3 Kamus Data Entitas Tabel `pacs`**
| Nama Atribut | Tipe Data | Nullable? | Indeks / Keterangan |
|---|---|:---:|---|
| `id` | `BIGINT UNSIGNED` | Tidak | **Primary Key** (Auto Increment) |
| `nama_pac` | `VARCHAR(255)` | Tidak | Nama entitas PAC (contoh: "PAC Cisaat") |
| `kecamatan` | `VARCHAR(255)` | Tidak | **Indexed** (Nama kecamatan di Kab. Sukabumi) |
| `status` | `VARCHAR(50)` | Tidak | **Indexed** (`aktif`, `tidak_aktif`, `pending`, `akan_expire`) |
| `tanggal_berdiri`| `DATE` | Tidak | Tanggal resmi pendirian/pembentukan |
| `ketua_pac` | `VARCHAR(255)` | Tidak | Nama lengkap ketua PAC |
| `telepon` | `VARCHAR(20)` | Tidak | Kontak telepon/WhatsApp resmi PAC |
| `email` | `VARCHAR(255)` | Ya | Alamat email surat-menyurat |
| `alamat`, `desa`, `kode_pos` | `TEXT` / `VARCHAR` | Ya | Informasi detail lokasi kantor sekretariat |
| `jumlah_anggota` | `INT` | Tidak | Agregat jumlah anggota terdaftar (default: 0) |
| `total_kegiatan` | `INT` | Tidak | Agregat jumlah kegiatan terlaksana (default: 0) |
| `alumni_lkd` | `INT` | Ya | Jumlah kader lulusan LKD (default: 0) |
| `nomor_sk` | `VARCHAR(255)` | Ya | Nomor Surat Keputusan resmi pimpinan cabang |

**Tabel 3.4 Kamus Data Entitas Tabel `anggotas`**
| Nama Atribut | Tipe Data | Nullable? | Indeks / Keterangan |
|---|---|:---:|---|
| `id` | `BIGINT UNSIGNED` | Tidak | **Primary Key** (Auto Increment) |
| `pac_id` | `BIGINT UNSIGNED` | Ya | **Foreign Key** ke `pacs(id)` (`ON DELETE SET NULL`) |
| `pac` | `VARCHAR(255)` | Tidak | **Indexed** (Nama PAC penempatan) |
| `nama` | `VARCHAR(255)` | Tidak | Nama lengkap kader |
| `nik` | `VARCHAR(20)` | Ya | Nomor Induk Kependudukan |
| `telepon`, `email` | `VARCHAR` | Ya | Kontak pribadi anggota |
| `tanggal_lahir` | `DATE` | Ya | Digunakan untuk kalkulasi umur dinamis |
| `tanggal_bergabung` | `DATE` | Ya | Tanggal terdaftar menjadi anggota |
| `pendidikan` | `VARCHAR(50)` | Ya | Jenjang: SD, SMP, SMA, D3, S1, S2, S3 |
| `profesi` | `VARCHAR(100)`| Ya | Bidang pekerjaan kader |
| `status_pernikahan`| `VARCHAR(50)`| Ya | `kawin`, `belum_kawin`, `cerai_hidup`, `cerai_mati` |
| `status` | `VARCHAR(50)` | Tidak | **Indexed** (`aktif`, `tidak_aktif`) |

**Tabel 3.5 Kamus Data Entitas Tabel `kegiatans`**
| Nama Atribut | Tipe Data | Nullable? | Indeks / Keterangan |
|---|---|:---:|---|
| `id` | `BIGINT UNSIGNED` | Tidak | **Primary Key** (Auto Increment) |
| `pac_id` | `BIGINT UNSIGNED` | Ya | **Foreign Key** ke `pacs(id)` (`ON DELETE SET NULL`) |
| `judul` | `VARCHAR(255)` | Tidak | Nama / tema agenda kegiatan |
| `kategori` | `VARCHAR(100)`| Tidak | **Indexed** (`Kaderisasi`, `Seminar`, `Sosial`, `Kajian`, `Kesehatan`) |
| `tanggal` | `DATE` | Tidak | **Indexed** (Tanggal pelaksanaan acara) |
| `waktu` | `TIME` | Ya | Waktu mulai kegiatan |
| `lokasi` | `VARCHAR(255)` | Tidak | Lokasi fisik/tempat pelaksanaan |
| `peserta` | `INT` | Ya | Jumlah kehadiran peserta |
| `status` | `VARCHAR(50)` | Tidak | **Indexed** (`upcoming`, `ongoing`, `completed`) |
| `gambar` | `VARCHAR(255)` | Ya | Path berkas poster di storage |

#### 3.2.3 Implementasi RESTful API dan Routing Engine
Seluruh antarmuka API publik didefinisikan pada berkas `backend/routes/api.php` dan dilindungi oleh *Rate Limiter Middleware* (`throttle:api`). Ringkasan *endpoint* disajikan pada **Tabel 3.6**.

**Tabel 3.6 Daftar Endpoint RESTful API, Metode HTTP, dan Hak Akses**
| No | Endpoint URI | Method | Rate Limit | Deskripsi & Fungsi |
|:---:|---|:---:|:---:|---|
| 1 | `/up` | `GET` | Unlimited | Health check server, runtime PHP-FPM, dan database status. |
| 2 | `/csrf-token` | `GET` | 60 req/min | Mengambil token CSRF baru untuk asynchronous Fetch/AJAX. |
| 3 | `/api/kegiatan` | `GET` | 60 req/min | Mengambil daftar agenda kegiatan (dengan filter & search). |
| 4 | `/api/kegiatan/{id}` | `GET` | 60 req/min | Mengambil detail spesifik satu kegiatan beserta PAC penyelenggara. |
| 5 | `/api/pac` | `GET` | 60 req/min | Mengambil direktori 47 PAC aktif untuk pemetaan MapLibre GL. |
| 6 | `/api/stats` | `GET` | 60 req/min | Mengambil ringkasan data metrik agregat statistik cabang. |
| 7 | `/api/pac/pengajuan` | `POST` | 10 req/min | Mengirimkan formulir permohonan pembentukan PAC baru. |

#### 3.2.4 Implementasi Asynchronous Job Queue (GAS Webhook)
Sinkronisasi pengajuan PAC ke Google Sheets diimplementasikan menggunakan class `SyncPacSubmissionToGoogleSheet` yang mengimplementasikan `ShouldQueue`. Alur kerja asinkron ini mengembalikan respons HTTP 201 Created secara instan kepada pengguna (<200 ms) sementara proses HTTP POST ke Google Apps Script dijalankan di latar belakang dengan kebijakan maksimal 3 kali percobaan ulang (*retry policy*).

#### 3.2.5 Implementasi Keamanan, Rate Limiting, dan 2FA Challenge
Sistem keamanan diimplementasikan melalui pipeline middleware:
- `throttle:api` (60 req/min), `throttle:pac-pengajuan` (10 req/min), `throttle:login` (5 req/min).
- `ValidateCsrfToken` untuk pencegahan serangan CSRF pada seluruh permintaan POST/PUT/DELETE.
- `EnsureTwoFactorIsVerified` untuk memvalidasi status 2FA OTP 6 digit sebelum memberikan hak akses dashboard admin.

#### 3.2.6 Implementasi Engine Ekspor Laporan dan Backup-Restore Database
Modul pelaporan menyediakan fitur ekspor PDF menggunakan library DomPDF, ekspor Excel (.xls), dan ekspor CSV Streaming yang dilengkapi sanitasi karakter operator formula (`=`, `+`, `-`, `@`) guna mencegah CSV Injection. Modul pengaturan juga mendukung pencadangan (*backup*) dan pemulihan (*restore*) database MySQL dan SQLite dengan fitur *pre-restore snapshot rollback safety*.

#### 3.2.7 Pengujian Otomatis (*Automated Testing*) dengan PHPUnit
Pengujian otomatis dijalankan menggunakan framework PHPUnit dengan konfigurasi in-memory SQLite database (`RefreshDatabase`). Seluruh skenario pengujian (`PACManagementTest`, `PacPengajuanAsyncJobTest`, `TwoFactorAuthenticationTest`, `FrontendStatsApiTest`, dan `AnggotaLaporanTest`) berhasil dieksekusi dengan status kelulusan 100% (**Tabel 3.9**).

**Tabel 3.9 Rekapitulasi Skenario dan Hasil Pengujian Otomatis PHPUnit**
| File Test Suite | Nama Test Method | Skenario yang Diuji | Status |
|---|---|---|:---:|
| `PACManagementTest` | `test_pac_baru_disimpan_dan_muncul` | Validasi penyimpanan PAC baru dan redirect anchor. | **PASS** |
| `PACManagementTest` | `test_import_pac_dari_csv` | Parsing CSV multi-baris dan normalisasi status. | **PASS** |
| `PACManagementTest` | `test_data_pac_bisa_die_export_ke_excel`| Validasi header respons `application/vnd.ms-excel`. | **PASS** |
| `PACManagementTest` | `test_total_kecamatan_menghitung_unik` | Verifikasi kueri `COUNT(DISTINCT kecamatan)`. | **PASS** |
| `PACManagementTest` | `test_pac_member_growth_database_agg` | Kalkulasi persentase pertumbuhan kader bulanan. | **PASS** |
| `PACManagementTest` | `test_pac_status_pending_dapat_diupdate`| Transisi status PAC dari `pending` ke `aktif`. | **PASS** |
| `PACManagementTest` | `test_pac_kegiatans_relationship_count`| Relasi Eloquent `hasMany` & subquery `withCount`. | **PASS** |
| `PacPengajuanAsyncJobTest` | `test_pac_pengajuan_dispatches_sync_job`| Pengujian dispatching queue tanpa memblokir HTTP. | **PASS** |
| `PacPengajuanAsyncJobTest` | `test_sync_job_executes_webhook_http_post`| Pengujian pengiriman payload JSON ke GAS Webhook. | **PASS** |
| `TwoFactorAuthTest` | `test_user_without_2fa_login_directly` | Alur login standar langsung menuju dashboard. | **PASS** |
| `TwoFactorAuthTest` | `test_user_with_2fa_redirected_challenge`| Alur redirect ke `/two-factor-challenge`. | **PASS** |
| `TwoFactorAuthTest` | `test_invalid_2fa_code_is_rejected` | Penolakan kode OTP salah dan penahanan sesi. | **PASS** |
| `TwoFactorAuthTest` | `test_valid_2fa_code_authenticates_user` | Keberhasilan verifikasi OTP dan pemberian hak akses. | **PASS** |
| `TwoFactorAuthTest` | `test_excessive_failed_attempts_lockout`| Pemutusan sesi paksa setelah 5 kali gagal OTP. | **PASS** |
| `FrontendStatsApiTest` | `test_stats_api_returns_correct_metrics`| Validasi kalkulasi metrik kelengkapan profil kader. | **PASS** |
| `AnggotaLaporanTest` | `test_csv_export_sanitizes_dangerous_char`| Sanitasi karakter operator formula pada ekspor CSV. | **PASS** |

### 3.3 Hasil
Pelaksanaan Kerja Praktik pada bagian *Backend Development* berhasil menghasilkan:
1. Terwujudnya 7 endpoint RESTful API publik yang stabil dan cepat (rata-rata respons <35 ms).
2. Keberhasilan pengujian otomatis PHPUnit dengan total 18 tests dan 28 assertions berstatus lulus (*Green Bar*).
3. Beroperasinya modul Dashboard Admin terpadu untuk manajemen data 47 PAC, kader, agenda kegiatan, dan ekspor laporan resmi.

---

# BAB IV: PENUTUP

### 4.1 Kesimpulan
Berdasarkan seluruh tahapan perancangan, implementasi, dan pengujian yang telah dilaksanakan selama Kerja Praktik pada proyek **KP-IF-SAKTI**, dapat ditarik beberapa kesimpulan utama:
1. **Keberhasilan Pembangunan Arsitektur Backend**: Telah berhasil dibangun sistem backend berbasis **Laravel 12 (PHP 8.2)** yang mengadopsi pola *Modern Hybrid Architecture*, mampu melayani kebutuhan pertukaran data RESTful API untuk frontend publik React 18 SPA sekaligus menyajikan antarmuka Dashboard Administrasi berbasis Blade SSR.
2. **Struktur Data Relasional yang Teroptimasi**: Skema basis data (MySQL 8.0 & SQLite 3) yang dirancang berhasil mengelola keterhubungan data 47 PAC, ribuan kader, dan riwayat kegiatan organisasi secara konsisten. Penerapan *database indexing* terbukti menjaga waktu eksekusi kueri agregasi di bawah 50 ms.
3. **Efisiensi Integrasi Webhook Asinkron**: Penerapan *asynchronous job queue* (`SyncPacSubmissionToGoogleSheet`) berhasil meniadakan latensi jaringan eksternal pada pengajuan formulir PAC publik, sehingga pengguna memperoleh konfirmasi instan (`201 Created`) dalam waktu kurang dari 200 ms sementara data otomatis tersinkronisasi ke Google Sheets di latar belakang.
4. **Implementasi Keamanan Sistem yang Kokoh**: Penerapan *Two-Factor Authentication* (2FA OTP Challenge), *rate limiting* berjenjang, proteksi token CSRF, serta sanitasi *CSV formula injection* berhasil memberikan proteksi maksimal terhadap privasi data kader dan integritas akun administrator.
5. **Kualitas dan Keandalan Kode Teruji**: Seluruh fitur kritis backend telah tervalidasi melalui *automated testing* berbasis PHPUnit dengan tingkat kelulusan 100%, menjamin sistem bebas dari *regression bugs* saat dilakukan pembaruan di masa depan.

### 4.2 Saran
Demi pengembangan dan penyempurnaan sistem informasi PC Fatayat NU Kabupaten Sukabumi di masa yang akan datang, penulis menyampaikan beberapa saran konstruktif:
1. **Penerapan Caching Layer Terdistribusi (Redis)**: Untuk mengantisipasi lonjakan trafik publik pada saat pelaksanaan konferensi cabang atau acara akbar, disarankan untuk mengintegrasikan Redis Cache sebagai *in-memory cache* untuk kueri agregasi statistik (`/api/stats`) dan direktori PAC (`/api/pac`).
2. **Integrasi WhatsApp Gateway Langsung**: Disarankan untuk menambahkan *notification channel* WhatsApp Gateway (seperti Fonnte atau Twilio) pada backend Laravel, sehingga notifikasi konfirmasi pendaftaran PAC atau pengingat agenda kegiatan dapat dikirimkan langsung ke nomor ponsel pengurus secara otomatis.
3. **Pengembangan Single Sign-On (SSO) Terintegrasi**: Mengembangkan integrasi autentikasi SSO dengan sistem basis data keanggotaan induk Nahdlatul Ulama (KartaNU) untuk mempermudah verifikasi identitas kader secara nasional.

---

# REFERENSI

[1] R. T. Fielding, R. N. Taylor, J. R. Erenkrantz, M. M. Gorlick, E. M. Dashofy, and P. J. Leach, "Reflections on the styles and patterns of the architecture of the World Wide Web," in *IEEE Transactions on Software Engineering*, vol. 43, no. 6, pp. 581–600, Jun. 2017.

[2] M. Stauffer, *Laravel: Up & Running: A Framework for Building Modern PHP Apps*, 3rd ed. Sebastopol, CA, USA: O'Reilly Media, 2023.

[3] M. Fowler, *Patterns of Enterprise Application Architecture*. Boston, MA, USA: Addison-Wesley Professional, 2002.

[4] A. Silberschatz, H. F. Korth, and S. Sudarshan, *Database System Concepts*, 7th ed. New York, NY, USA: McGraw-Hill Education, 2020.

[5] M. Richards and N. Ford, *Fundamentals of Software Architecture: An Engineering Approach*. Sebastopol, CA, USA: O'Reilly Media, 2020.

[6] Open Web Application Security Project (OWASP), "OWASP Top 10: The Ten Most Critical Web Application Security Risks," *OWASP Foundation*, 2021. [Online]. Available: https://owasp.org/Top10/. Accessed: Aug. 28, 2026.

[7] D. Stuttard and M. Pinto, *The Web Application Hacker's Handbook: Finding and Exploiting Security Flaws*, 2nd ed. Indianapolis, IN, USA: John Wiley & Sons, 2011.

[8] G. Meszaros, *xUnit Test Patterns: Refactoring Test Code*. Boston, MA, USA: Addison-Wesley, 2007.

---

# LAMPIRAN

### Lampiran A — Struktur Berkas dan Kode Sumber Backend Utama
```text
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AnggotaController.php      # Manajemen CRUD & Impor CSV Anggota
│   │   │   ├── AuthController.php         # Autentikasi Bcrypt & 2FA OTP Challenge
│   │   │   ├── DashboardController.php    # Agregasi Metrik & Grafik Dashboard Admin
│   │   │   ├── KegiatanController.php     # Manajemen Agenda & Unggah Poster
│   │   │   ├── LaporanController.php      # Engine Ekspor DomPDF, Excel, & CSV Stream
│   │   │   ├── PACController.php          # Manajemen 47 PAC & Impor CSV
│   │   │   └── PengaturanController.php   # Profil, Password, & Backup/Restore DB
│   │   └── Middleware/
│   │       └── EnsureTwoFactorIsVerified.php # Guard Verifikasi Sesi 2FA
│   ├── Jobs/
│   │   └── SyncPacSubmissionToGoogleSheet.php # Asynchronous Queue Worker GAS
│   └── Models/
│       ├── Anggota.php                    # Model Eloquent Anggota / Kader
│       ├── Kegiatan.php                   # Model Eloquent Agenda Kegiatan
│       ├── PAC.php                        # Model Eloquent Pimpinan Anak Cabang
│       ├── Pengaturan.php                 # Model Eloquent Konfigurasi Sistem
│       └── User.php                       # Model Eloquent Administrator
├── config/
│   ├── database.php                       # Konfigurasi Koneksi MySQL & SQLite
│   └── services.php                       # Konfigurasi Kredensial Webhook GAS
├── database/
│   ├── migrations/                        # Berkas Migrasi Skema & Indeks Basis Data
│   └── seeders/                           # Seeder Data 47 PAC & Admin Default
├── routes/
│   ├── api.php                            # Rute RESTful API Publik & Rate Limiter
│   └── web.php                            # Rute Dashboard Admin & Middleware Pipeline
└── tests/
    └── Feature/
        ├── PACManagementTest.php          # Test Suite CRUD & Paginasi PAC
        ├── PacPengajuanAsyncJobTest.php   # Test Suite Queue & Mocking Webhook
        └── TwoFactorAuthenticationTest.php# Test Suite Autentikasi 2FA OTP
```

### Lampiran B — Konfigurasi Environment Backend (`.env.example`)
```ini
APP_NAME=KP-IF-SAKTI
APP_ENV=local
APP_KEY=base64:c29tZXJhbmRvbXNlY3JldGtleWZvcmxhcmF2ZWwxMg==
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kp_if_sakti
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
SESSION_DRIVER=database
CACHE_STORE=database

GOOGLE_APPS_SCRIPT_PAC_WEBHOOK_URL=https://script.google.com/macros/s/AKfycb.../exec
GOOGLE_APPS_SCRIPT_PAC_WEBHOOK_TOKEN=kp-if-sakti-secret-token
```
