<div align="center">

# 🌿 KP-IF-SAKTI — Sistem Informasi Fatayat NU Kabupaten Sukabumi

[![CI Pipeline](https://github.com/ikhsanhazamy/KP-IF-SAKTI/actions/workflows/ci.yml/badge.svg)](https://github.com/ikhsanhazamy/KP-IF-SAKTI/actions/workflows/ci.yml)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![React](https://img.shields.io/badge/React-18.x-61DAFB?style=flat-square&logo=react&logoColor=black)](https://react.dev)
[![Vite](https://img.shields.io/badge/Vite-5.x-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vitejs.dev)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

<p align="center">
  Platform sistem informasi berbasis web terintegrasi untuk pengelolaan data organisasi, pemetaan Pimpinan Anak Cabang (PAC), publikasi agenda kegiatan, serta digitalisasi administrasi keanggotaan <strong>Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi</strong>.
</p>

> 🎓 *Proyek ini dikembangkan dalam rangka **Kerja Praktik (KP)** Program Studi Teknik Informatika — **Informatika SAKTI (IF SAKTI)**.*

</div>

---

## 📋 Daftar Isi

- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Tech Stack & Ekosistem](#️-tech-stack--ekosistem)
- [📁 Struktur Repositori](#-struktur-repositori)
- [📦 Prasyarat Sistem](#-prasyarat-sistem)
- [🐳 Menjalankan dengan Docker (Rekomendasi)](#-menjalankan-dengan-docker-rekomendasi)
- [🚀 Menjalankan Secara Manual (Host Lokal)](#-menjalankan-secara-manual-host-lokal)
- [⚙️ Konfigurasi Environment](#️-konfigurasi-environment)
- [🌐 REST API & Integrasi Eksternal](#-rest-api--integrasi-eksternal)
- [👥 Tim Pengembang & Kontributor](#-tim-pengembang--kontributor)
- [📚 Dokumentasi Teknis Lanjutan](#-dokumentasi-teknis-lanjutan)
- [🤝 Kontribusi & Kode Etik](#-kontribusi--kode-etik)
- [📄 Lisensi](#-lisensi)

---

## ✨ Fitur Utama

### 🌐 1. Website Publik (Frontend React SPA)
* **Beranda Interaktif**: Hero banner dengan statistik organisasi terkini (total PAC, kader terverifikasi, sebaran kecamatan).
* **Profil & Sejarah**: Informasi visi, misi, struktur nilai, dan sejarah perjuangan Fatayat NU Kabupaten Sukabumi.
* **Agenda Kegiatan**: Direktori kegiatan organisasi dengan pencarian instan dan filter kategori (*Kaderisasi*, *Sosial*, *Keagamaan*, *Kesehatan*).
* **Peta Sebaran PAC (MapLibre GL)**: Pemetaan geografis interaktif 47 kecamatan di Kabupaten Sukabumi dengan detail pengurus dan kontak.
* **Formulir Pengajuan PAC Baru**: Formulir permohonan pembentukan PAC secara online yang terhubung otomatis ke sistem backend dan notifikasi Google Sheets.

### 🛡️ 2. Admin Dashboard (Backend Laravel 12)
* **Statistik & Visualisasi Data**: Ringkasan data kader, status keaktifan PAC, dan metrik organisasi berbasis Chart.js.
* **Manajemen Pimpinan Anak Cabang (PAC)**: CRUD data PAC, nomor SK, legalitas, jumlah kader alumni LKD, serta import/export CSV & Excel.
* **Manajemen Anggota / Kader**: CRUD biodata lengkap anggota (NIK, tanggal lahir, kontak, pendidikan, profesi, status perkawinan).
* **Manajemen Agenda & Berita**: Publikasi kegiatan, upload foto dokumentasi dengan validasi ketat, serta status pelaksanaan acara.
* **Pusat Laporan & Ekspor**: Cetak laporan rekapitulasi data anggota, PAC, dan kegiatan ke format **PDF (DomPDF)**, **Excel**, dan **CSV**.
* **Pengaturan Sistem & Keamanan**: Pembaruan profil admin, upload avatar, ubah password, preferensi notifikasi, serta fitur **Backup & Restore Database** otomatis (mendukung engine MySQL & SQLite).

---

## 🛠️ Tech Stack & Ekosistem

| Lapisan (Layer) | Teknologi / Library | Fungsi Utama |
|---|---|---|
| **Frontend UI** | **React 18**, **Vite 5**, **Tailwind CSS 4** | Single Page Application publik yang cepat dan modern |
| **UI Components** | **shadcn/ui**, **Radix UI**, **Lucide Icons** | Komponen UI aksesibel, modular, dan konsisten |
| **Peta Digital** | **MapLibre GL** (Lazy Loaded) | Rendering peta vektor interaktif sebaran wilayah PAC |
| **Backend & API** | **Laravel 12 (PHP 8.2)** | RESTful API, otentikasi sesi, dan manajemen logika bisnis |
| **Admin Views** | **Laravel Blade Engine** + **Tailwind CSS** | Server-side rendered dashboard terproteksi |
| **Basis Data** | **MySQL 8.0** & **SQLite 3** | Penyimpanan relasional dengan indeks performa tinggi |
| **Dokumen / Export** | **Barryvdh Laravel DomPDF** | Generator berkas laporan cetak format PDF resmi |
| **Integrasi Cloud** | **Google Apps Script Webhook** | Sinkronisasi asinkron data form publik ke Google Sheets |
| **Kontainerisasi** | **Docker & Docker Compose** | Lingkungan pengembangan & deployment terisolasi |
| **Otomasi CI/CD** | **GitHub Actions** | Automated testing PHPUnit dan build verification |

---

## 📁 Struktur Repositori

```
KP-IF-SAKTI/
├── .github/
│   └── workflows/ci.yml       # Pipeline otomatisasi CI GitHub Actions
├── backend/                   # Backend Laravel 12 (REST API & Admin Dashboard)
│   ├── app/
│   │   ├── Http/Controllers/  # Controller autentikasi, PAC, anggota, kegiatan, dll.
│   │   └── Models/            # Eloquent ORM Models (PAC, Anggota, Kegiatan, Pengaturan, User)
│   ├── database/
│   │   ├── migrations/        # Skema migrasi database & indeks performa
│   │   └── seeders/           # Seeder awal akun admin & data PAC
│   ├── resources/views/       # Template Blade untuk Dashboard Admin
│   ├── routes/
│   │   ├── api.php            # Endpoint publik REST API (Rate Limited)
│   │   └── web.php            # Endpoint web admin (Auth Guard & CSRF Protected)
│   └── tests/                 # Unit & Feature automated test suites
├── frontend/                  # Frontend SPA React 18
│   ├── src/
│   │   ├── Pages/             # Halaman: Home, Tentang, Kegiatan, DataPAC, PengajuanPAC
│   │   ├── components/        # Komponen UI: Navbar, Footer, MapSection, dll.
│   │   └── App.jsx            # Routing utama aplikasi
│   ├── vite.config.js         # Konfigurasi bundler Vite & API Proxy
│   └── package.json
├── docs/                      # Dokumentasi Teknis Terperinci
│   ├── API_DOCUMENTATION.md   # Spesifikasi lengkap REST API JSON
│   ├── DATABASE_SCHEMA.md     # Kamus data & diagram ERD basis data
│   ├── ARCHITECTURE.md        # Arsitektur sistem & alur kerja data
│   ├── DEPLOYMENT_GUIDE.md    # Panduan deployment server produksi & SSL
│   ├── DEVELOPMENT_GUIDE.md   # Panduan onboarding developer & debugging
│   └── google-apps-script/    # Script webhook Google Spreadsheet
├── docker-compose.yml         # Konfigurasi orkestrasi Docker multi-container
├── Dockerfile                 # Image Docker backend PHP 8.2
├── CONTRIBUTING.md            # Panduan kontribusi dan alur kerja Git
├── CONTRIBUTORS.md            # Daftar pengembang & tim Kerja Praktik
├── CODE_OF_CONDUCT.md         # Kode etik komunitas pengembang
├── CHANGELOG.md               # Catatan rilis dan riwayat perbaikan bug
├── SECURITY.md                # Kebijakan keamanan & pelaporan kerentanan
└── LICENSE                    # Lisensi Open Source MIT
```

---

## 📦 Prasyarat Sistem

| Kebutuhan | Versi Rekomendasi | Keterangan |
|---|---|---|
| **Docker** | >= 20.10 | Sangat disarankan untuk instalasi tanpa konfigurasi manual |
| **Docker Compose** | >= 2.0 | Pengelola multi-container backend, frontend, dan database |
| **PHP** *(khusus non-Docker)* | >= 8.2 | Ekstensi: `pdo_mysql`, `pdo_sqlite`, `mbstring`, `gd`, `zip`, `bcmath` |
| **Composer** *(khusus non-Docker)* | >= 2.x | Manajemen dependensi PHP |
| **Node.js** *(khusus non-Docker)* | >= 18.x (LTS) | Runtime JavaScript frontend |

---

## 🐳 Menjalankan dengan Docker (Rekomendasi)

Metode ini adalah cara termudah dan tercepat untuk menjalankan seluruh ekosistem aplikasi tanpa perlu menginstal PHP, MySQL, atau Composer di komputer lokal Anda.

### 1. Clone Repositori
```bash
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI
```

### 2. Siapkan Berkas Konfigurasi Environment Backend
```bash
cp backend/.env.example backend/.env
```

### 3. Bangun dan Jalankan Kontainer
```bash
docker compose up --build
```
> 💡 *Docker Compose akan secara otomatis menyalakan service `db` (MySQL), menginisialisasi database `kp_db`, menjalankan migrasi tabel (`php artisan migrate --force`), membangun aset Vite backend, dan menyalakan frontend React.*

### 4. Akses Aplikasi
* 🌐 **Website Publik**: [http://localhost:5173](http://localhost:5173)
* 🔐 **Admin Dashboard**: [http://localhost:8000](http://localhost:8000) (Kredensial: `admin@fatayatnu.or.id` / `password`)

---

## 🚀 Menjalankan Secara Manual (Host Lokal)

Jika Anda ingin menjalankan backend dan frontend langsung pada komputer host:

### 1. Setup Backend (Laravel)
```bash
cd backend
composer install
cp .env.example .env

# Generate Application Key
php artisan key:generate

# Konfigurasikan koneksi database di .env (misal MySQL lokal atau SQLite), lalu jalankan migrasi:
php artisan migrate --seed

# Jalankan server backend:
php artisan serve
```
Backend akan aktif di `http://localhost:8000`.

### 2. Setup Frontend (React)
Buka terminal baru:
```bash
cd frontend
npm install

# Jalankan dev server dengan target proxy ke backend lokal:
VITE_API_TARGET=http://localhost:8000 npm run dev
```
Frontend akan aktif di `http://localhost:5173`.

---

## ⚙️ Konfigurasi Environment

Variabel penting pada berkas `backend/.env`:

| Variabel | Default (Docker) | Keterangan |
|---|---|---|
| `APP_ENV` | `local` | Lingkungan aplikasi (`local`, `production`) |
| `APP_KEY` | *(auto-generated)* | Kunci enkripsi sesi Laravel |
| `DB_CONNECTION` | `mysql` | Driver basis data (`mysql`, `sqlite`) |
| `DB_HOST` | `db` *(atau `127.0.0.1` jika lokal)* | Host database server |
| `DB_PORT` | `3306` | Port database server |
| `DB_DATABASE` | `kp_db` | Nama database |
| `GAS_PAC_WEBHOOK_URL` | `null` | URL webhook Google Apps Script untuk sinkronisasi form PAC |
| `GAS_PAC_WEBHOOK_TOKEN`| `null` | Token otentikasi webhook Google Apps Script |

---

## 🌐 REST API & Integrasi Eksternal

Endpoint publik API tersedia dengan awalan `/api` dan dilindungi oleh rate limiting:

| Method | Endpoint | Rate Limit | Deskripsi |
|:---:|---|:---:|---|
| `GET` | `/api/kegiatan` | 60 req/min | Ambil daftar agenda kegiatan (dukungan parameter `search` & `category`) |
| `GET` | `/api/kegiatan/{id}` | 60 req/min | Ambil detail satu kegiatan beserta data PAC terkait |
| `GET` | `/api/pac` | 60 req/min | Ambil seluruh daftar 47 PAC se-Kabupaten Sukabumi untuk peta |
| `GET` | `/api/stats` | 60 req/min | Ambil ringkasan statistik (total PAC, kader, sebaran kecamatan) |
| `POST` | `/api/pac/pengajuan` | 10 req/min | Pengajuan pendirian PAC baru & memicu webhook Google Sheets |

> 📖 *Dokumentasi REST API lengkap beserta contoh request/response cURL dapat dibaca di [docs/API_DOCUMENTATION.md](docs/API_DOCUMENTATION.md).*

---

## 👥 Tim Pengembang & Kontributor

Proyek ini dibangun dan dikembangkan oleh tim mahasiswa **Kerja Praktik Program Studi Informatika (IF SAKTI)**:

<div align="center">

| Foto | Kontributor | Peran / Tanggung Jawab Utama | Kontak |
| :---: | :---: | :---: | :---: |
| <img src="https://github.com/irsalshydiq.png?size=80" width="80px;" alt="LM. Irsal Shydiq"/><br /> | **[LM. Irsal Shydiq](https://github.com/irsalshydiq)** | **Project Manager (PM) & UI/UX Designer**<br />Manajemen sprint proyek, desain UI/UX antarmuka, design system & QA. | [![GitHub](https://img.shields.io/badge/GitHub-irsalshydiq-181717?style=flat-square&logo=github)](https://github.com/irsalshydiq) |
| <img src="https://github.com/ikhsanhazamy.png?size=80" width="80px;" alt="Ikhsan Hazamy"/><br /> | **[Ikhsan Hazamy](https://github.com/ikhsanhazamy)** | **Frontend Developer**<br />Pengembangan antarmuka React 18, peta interaktif MapLibre, & konsumsi API. | [![GitHub](https://img.shields.io/badge/GitHub-ikhsanhazamy-181717?style=flat-square&logo=github)](https://github.com/ikhsanhazamy) |
| <img src="https://github.com/predator45.png?size=80" width="80px;" alt="Nurdiansyah Pratama"/><br /> | **[Nurdiansyah Pratama](https://github.com/predator45)** | **Backend Developer**<br />Arsitektur backend Laravel 12, REST API, database MySQL/SQLite, & Google Apps Script. | [![GitHub](https://img.shields.io/badge/GitHub-predator45-181717?style=flat-square&logo=github)](https://github.com/predator45) |

</div>

> 🤝 *Daftar kontributor lengkap, peran detail, dan panduan bergabung dapat dibaca pada berkas [CONTRIBUTORS.md](CONTRIBUTORS.md).*

---

## 📚 Dokumentasi Teknis Lanjutan

Untuk mempelajari arsitektur teknis dan panduan operasional lebih mendalam, silakan merujuk ke dokumen berikut:

* 🌐 **[Dokumentasi REST API](docs/API_DOCUMENTATION.md)** — Spesifikasi endpoint, parameter, format JSON, dan kode status HTTP.
* 🗄️ **[Skema Basis Data & ERD](docs/DATABASE_SCHEMA.md)** — Kamus data tabel, indeks performa, dan relasi entitas.
* 🏛️ **[Arsitektur Sistem & Aliran Data](docs/ARCHITECTURE.md)** — Diagram komponen, aliran sequence pengajuan PAC, dan topologi jaringan.
* 🚀 **[Panduan Deployment Produksi](docs/DEPLOYMENT_GUIDE.md)** — Prosedur rilis ke server VPS Linux, konfigurasi Nginx Reverse Proxy, SSL HTTPS, dan backup berkala.
* 💻 **[Panduan Pengembangan & Onboarding](docs/DEVELOPMENT_GUIDE.md)** — Panduan setup lokal, debugging, pengujian otomatis, dan FAQ troubleshooting.
* 📊 **[Webhook Google Apps Script](docs/google-apps-script/README.md)** — Panduan konfigurasi spreadsheet dan script webhook pengajuan PAC.

---

## 🤝 Kontribusi & Kode Etik

Kami menyambut setiap kontribusi yang bertujuan meningkatkan keandalan, performa, dan kegunaan sistem ini:
1. Silakan pelajari alur kerja Git, standar penulisan kode, dan konvensi commit di **[CONTRIBUTING.md](CONTRIBUTING.md)**.
2. Seluruh interaksi dan kolaborasi dalam repositori ini diatur oleh **[CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)**.
3. Untuk melihat riwayat pembaruan dan rilis versi sistem, silakan cek **[CHANGELOG.md](CHANGELOG.md)**.

---

## 🔒 Kebijakan Keamanan

Jika Anda menemukan potensi kerentanan keamanan pada sistem ini, mohon untuk tidak mempublikasikannya melalui issue publik. Silakan ikuti prosedur pelaporan bertanggung jawab pada **[SECURITY.md](SECURITY.md)**.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **[MIT License](LICENSE)** © 2026 Tim Kerja Praktik IF SAKTI & Kontributor KP-IF-SAKTI.
Didedikasikan untuk kemajuan digitalisasi organisasi **PC Fatayat NU Kabupaten Sukabumi**.
