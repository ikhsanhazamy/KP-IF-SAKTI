# KP-IF-SAKTI — Sistem Informasi Fatayat NU Kabupaten Sukabumi

Sistem informasi berbasis web untuk mengelola data organisasi **Fatayat NU Kabupaten Sukabumi**. Aplikasi ini mencakup website publik untuk informasi kegiatan dan data PAC (Pimpinan Anak Cabang), serta dashboard admin untuk manajemen data internal organisasi.

> Proyek ini merupakan bagian dari Kerja Praktik (KP) Program Studi Informatika — **IF SAKTI**.

---

## 📋 Daftar Isi

- [Fitur](#-fitur)
- [Tech Stack](#-tech-stack)
- [Struktur Proyek](#-struktur-proyek)
- [Prasyarat](#-prasyarat)
- [Menjalankan Secara Lokal](#-menjalankan-secara-lokal)
- [Menjalankan dengan Docker](#-menjalankan-dengan-docker)
- [Konfigurasi Environment](#-konfigurasi-environment)
- [API Endpoints](#-api-endpoints)
- [Lisensi](#-lisensi)

---

## ✨ Fitur

### Website Publik (Frontend)
- **Beranda** — Landing page organisasi
- **Tentang** — Profil, visi, misi, sejarah, dan nilai-nilai organisasi
- **Kegiatan** — Daftar kegiatan dengan fitur pencarian dan filter kategori
- **Data PAC** — Peta dan data seluruh Pimpinan Anak Cabang
- **Pengajuan PAC** — Formulir pengajuan PAC baru secara online

### Dashboard Admin (Backend)
- **Dashboard** — Ringkasan statistik organisasi
- **Manajemen Anggota** — CRUD data anggota
- **Manajemen PAC** — CRUD data Pimpinan Anak Cabang
- **Manajemen Kegiatan** — CRUD data kegiatan organisasi
- **Laporan** — Export laporan ke PDF, Excel, dan CSV
- **Pengaturan** — Profil admin, keamanan, notifikasi, dan backup database

---

## 🛠 Tech Stack

| Layer        | Teknologi                                                    |
| ------------ | ------------------------------------------------------------ |
| **Frontend** | React 18, Vite 5, Tailwind CSS 4, shadcn/ui, Radix UI       |
| **Backend**  | Laravel 12 (PHP 8.2), Blade Templates                        |
| **Database** | MySQL 8 via Docker Compose                                  |
| **Maps**     | MapLibre GL                                                  |
| **Icons**    | Lucide React, React Icons                                    |
| **PDF**      | Laravel DomPDF                                               |
| **DevOps**   | Docker, Docker Compose                                       |

---

## 📁 Struktur Proyek

```
KP-IF-SAKTI/
├── frontend/                 # React SPA (website publik)
│   ├── src/
│   │   ├── Pages/            # Halaman: Home, Tentang, Kegiatan, DataPAC, PengajuanPAC
│   │   ├── components/       # Komponen reusable (Navbar, Footer, dll.)
│   │   ├── lib/              # Utility functions
│   │   ├── App.jsx           # Router utama
│   │   └── main.jsx          # Entry point
│   ├── vite.config.js        # Konfigurasi Vite + proxy API
│   └── package.json
│
├── backend/                  # Laravel (API + Admin Dashboard)
│   ├── app/
│   │   ├── Http/Controllers/ # AuthController, DashboardController, PACController, dll.
│   │   └── Models/           # Anggota, PAC, Kegiatan, Pengaturan, User
│   ├── database/
│   │   ├── migrations/       # Skema database
│   │   └── seeders/          # Data awal (PAC, Anggota, Kegiatan)
│   ├── routes/
│   │   ├── api.php           # REST API untuk frontend publik
│   │   └── web.php           # Routes admin dashboard (auth-protected)
│   ├── resources/views/      # Blade templates untuk admin
│   └── .env.example          # Template konfigurasi environment
│
├── Dockerfile                # Docker image untuk backend (PHP 8.2)
├── docker-compose.yml        # Orchestration: backend + frontend + MySQL
└── README.md
```

---

## 📦 Prasyarat

### Untuk Menjalankan Lokal

| Software     | Versi Minimum | Cek Instalasi          |
| ------------ | ------------- | ---------------------- |
| **PHP**      | 8.2           | `php -v`               |
| **Composer** | 2.x           | `composer -V`          |
| **Node.js**  | 18+           | `node -v`              |
| **npm**      | 9+            | `npm -v`               |
| **MySQL**    | 8.x           | Disarankan melalui `docker compose` |

Pastikan juga ekstensi PHP berikut sudah aktif jika menjalankan backend tanpa Docker: `pdo_mysql`, `mbstring`, `gd`, `zip`, `bcmath`.

### Untuk Menjalankan dengan Docker

| Software           | Versi Minimum | Cek Instalasi            |
| ------------------ | ------------- | ------------------------ |
| **Docker**         | 20+           | `docker --version`       |
| **Docker Compose** | 2.x           | `docker compose version` |

---

## 🚀 Menjalankan Secara Lokal

> Rekomendasi utama proyek ini adalah menjalankan lewat Docker agar MySQL dibuat otomatis. Mode lokal di bawah hanya diperlukan jika ingin menjalankan backend/frontend langsung dari host dan sudah punya MySQL lokal sendiri.

### 1. Clone Repository

```bash
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI
```

### 2. Setup Backend (Laravel)

```bash
cd backend

# Install dependensi PHP
composer install

# Salin file environment
cp .env.example .env

# Jika menjalankan tanpa Docker, arahkan database ke MySQL lokal
# DB_HOST=127.0.0.1
# DB_USERNAME=root
# DB_PASSWORD=sesuaikan_password_mysql_lokal

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate

# (Opsional) Isi data awal
php artisan db:seed
```

### 3. Jalankan Backend

```bash
# Masih di dalam folder backend/
php artisan serve
```

Backend akan berjalan di **http://localhost:8000**.

### 4. Setup & Jalankan Frontend

Buka terminal baru:

```bash
cd frontend

# Install dependensi Node
npm install

# Jalankan dev server dengan proxy ke backend lokal
VITE_API_TARGET=http://localhost:8000 npm run dev
```

Frontend akan berjalan di **http://localhost:5173**.

> **Catatan:** Environment variable `VITE_API_TARGET` digunakan agar proxy API mengarah ke `localhost:8000` (bukan ke Docker service `app`). Jika tidak diset, default-nya adalah `http://app:8000` yang hanya bekerja di dalam Docker network.

### 5. Akses Aplikasi

| Aplikasi          | URL                        |
| ----------------- | -------------------------- |
| Website Publik    | http://localhost:5173       |
| Admin Dashboard   | http://localhost:8000       |

---

## 🐳 Menjalankan dengan Docker

### 1. Clone Repository

```bash
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI
```

### 2. Setup Environment Backend

```bash
cp backend/.env.example backend/.env
```

### 3. Build & Jalankan Container

```bash
docker compose up --build
```

Docker Compose akan menjalankan empat service:

| Service  | Deskripsi                          | Port   |
| -------- | ---------------------------------- | ------ |
| **app**  | Backend Laravel (PHP 8.2)          | `8000` |
| **node** | Frontend React (Vite dev server)   | `5173` |
| **db**   | MySQL 8 untuk database aplikasi    | internal |
| **backend-assets** | Build aset Vite untuk dashboard admin | internal |

Container `db` otomatis dibuat oleh Docker Compose. Container `backend-assets` akan menjalankan `npm ci && npm run build` untuk aset admin Laravel. Container `app` akan menunggu MySQL siap, membersihkan config cache, membuat `APP_KEY` jika masih kosong, lalu menjalankan `php artisan migrate --force` saat startup. Tidak perlu membuat atau menyambungkan MySQL manual dari host.

### 4. Akses Aplikasi

| Aplikasi          | URL                        |
| ----------------- | -------------------------- |
| Website Publik    | http://localhost:5173       |
| Admin Dashboard   | http://localhost:8000       |

### 5. Perintah Docker Berguna

```bash
# Jalankan di background (detached mode)
docker compose up --build -d

# Lihat log container
docker compose logs -f

# Lihat log service tertentu
docker compose logs -f app
docker compose logs -f node
docker compose logs -f db
docker compose logs -f backend-assets

# Masuk ke container backend
docker compose exec app bash

# Jalankan artisan command di dalam container
docker compose exec app php artisan migrate:fresh --seed

# Hentikan semua container
docker compose down

# Hentikan dan hapus volume (reset database)
docker compose down -v
```

---

## ⚙ Konfigurasi Environment

File konfigurasi backend berada di `backend/.env`. Berikut variabel penting:

| Variabel          | Nilai Default    | Keterangan                        |
| ----------------- | ---------------- | --------------------------------- |
| `APP_ENV`         | `local`          | Environment aplikasi              |
| `APP_DEBUG`       | `true`           | Mode debug                        |
| `APP_URL`         | `http://localhost:8000` | URL dasar aplikasi          |
| `DB_CONNECTION`   | `mysql`          | Driver database                   |
| `DB_HOST`         | `db`             | Host MySQL saat berjalan di Docker Compose |
| `DB_PORT`         | `3306`           | Port MySQL                        |
| `DB_DATABASE`     | `kp_db`          | Nama database Docker              |
| `DB_USERNAME`     | `kp_user`        | User database Docker              |
| `DB_PASSWORD`     | `kp_password`    | Password database Docker          |
| `SESSION_DRIVER`  | `database`       | Driver session                    |
| `QUEUE_CONNECTION`| `database`       | Driver antrian                    |

Untuk frontend, proxy API dikonfigurasi di `frontend/vite.config.js`:

```js
proxy: {
  '/api': {
    target: process.env.VITE_API_TARGET || 'http://app:8000',
  },
}
```

- **Docker:** tidak perlu set apa-apa, default `http://app:8000` sudah benar.
- **Lokal:** set `VITE_API_TARGET=http://localhost:8000` saat menjalankan `npm run dev`.

---

## 🔗 API Endpoints

API publik tersedia di prefix `/api`:

| Method | Endpoint            | Deskripsi                                    |
| ------ | ------------------- | -------------------------------------------- |
| GET    | `/api/kegiatan`     | Daftar kegiatan (query: `search`, `category`) |
| GET    | `/api/pac`          | Daftar semua PAC                             |
| GET    | `/api/stats`        | Statistik ringkasan (total PAC, anggota, dll.) |
| POST   | `/api/pac/pengajuan`| Pengajuan PAC baru                           |

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan Kerja Praktik dan bersifat akademis.
