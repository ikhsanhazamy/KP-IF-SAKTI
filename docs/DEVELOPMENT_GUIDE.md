# 💻 Panduan Pengembangan Lokal & Onboarding (Development Guide)

Panduan praktis bagi pengembang (*developer onboarding*) untuk menyiapkan lingkungan pengembangan lokal, menjalankan pengujian otomatis (*testing*), menjaga standar kualitas kode (*code styling*), dan mengatasi kendala umum (*troubleshooting*).

---

## 🛠️ Persyaratan Lingkungan (Prerequisites)

Pilih salah satu metode pengembangan yang sesuai:

### Opsi A: Menggunakan Docker Compose (Sangat Direkomendasikan)
- **Docker Desktop** atau **Docker Engine 20+**
- **Docker Compose v2+**
- Tidak memerlukan instalasi PHP, Composer, maupun MySQL di komputer host.

### Opsi B: Menggunakan Host Langsung (Manual)
- **PHP** >= 8.2 (dengan ekstensi: `pdo_mysql`, `pdo_sqlite`, `mbstring`, `gd`, `zip`, `bcmath`, `curl`)
- **Composer** 2.x
- **Node.js** >= 18.x & **npm** >= 9.x
- **MySQL 8.x** atau **SQLite 3**

---

## 🚀 Alur Setup Cepat (Quickstart)

### Menggunakan Docker Compose:
```bash
# 1. Clone repositori
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI

# 2. Siapkan file konfigurasi environment
cp backend/.env.example backend/.env

# 3. Jalankan container
docker compose up --build
```

Setelah kontainer berjalan:
- **Frontend SPA Publik**: `http://localhost:5173`
- **Dashboard Admin & API**: `http://localhost:8000`

---

### Menggunakan Manual Host:

```bash
# 1. Setup Backend Laravel
cd backend
composer install
cp .env.example .env
php artisan key:generate

# Migrasi basis data & seeder
php artisan migrate --seed
php artisan storage:link

# Jalankan server backend
php artisan serve --port=8000

# 2. Setup Frontend React (pada terminal baru)
cd ../frontend
npm install
npm run dev
```

---

## 🔑 Kredensial Default Login Admin (Database Seeder)

Setelah database dimigrasi dan di-seed (`php artisan db:seed`):

| Atribut | Nilai Default |
|---|---|
| **URL Login** | `http://localhost:8000/login` |
| **Email** | `admin@fatayatnu.or.id` |
| **Password** | `password` |
| **Hak Akses** | Administrator Penuh (Superadmin) |

> 💡 *Jika fitur Two-Factor Authentication (2FA) diaktifkan melalui menu Pengaturan, kode OTP 6-digit saat pengujian lokal akan otomatis dicatat di `storage/logs/laravel.log` atau ditampilkan di notifikasi sesi.*

---

## 🧪 Perintah Pengujian & Quality Control (Testing Suite)

Sebelum mengajukan Pull Request, seluruh pengujian otomatis wajib dipastikan lulus tanpa error:

### 1. Menjalankan Seluruh Feature & Unit Test Backend:
```bash
cd backend
php artisan test
```
*Test suite mencakup 46 pengujian fitur: autentikasi, 2FA challenge, rate limiting, ekspor laporan, aggregasi PAC, dan sinkronisasi webhook.*

### 2. Memeriksa Standar Gaya Kode (Laravel Pint):
```bash
cd backend
vendor/bin/pint --test
```

### 3. Memperbaiki Format Kode Secara Otomatis:
```bash
cd backend
vendor/bin/pint
```

### 4. Menguji Proses Kompilasi Frontend (Vite Build):
```bash
cd frontend
npm run build
```

---

## 🔍 Menggunakan Shell Artisan & Debugging

### Masuk ke Dalam Kontainer Docker Backend:
```bash
docker compose exec app bash
```

### Menjalankan Laravel Tinker (Interactive REPL):
```bash
cd backend && php artisan tinker
# atau via Docker:
docker compose exec app php artisan tinker
```
Contoh perintah di Tinker:
```php
// Hitung jumlah PAC aktif
App\Models\PAC::where('status', 'aktif')->count();

// Ambil kegiatan beserta relasi PAC penyelenggara
App\Models\Kegiatan::with('pac')->first();

// Cek preferensi admin
App\Models\User::first()->two_factor_enabled;
```

### Reset Ulang Basis Data dan Mengisi Data Dummy Lengkap:
```bash
cd backend && php artisan migrate:fresh --seed
# atau via Docker:
docker compose exec app php artisan migrate:fresh --seed
```

---

## ❓ Solusi Masalah Umum (Troubleshooting FAQ)

### 1. Error `address already in use` (Port Conflict)
- **Penyebab**: Port `8000` atau `5173` sedang digunakan oleh aplikasi lain.
- **Solusi**: Ubah mapping port host pada berkas `docker-compose.yml` (misal: `"8080:80"`).

### 2. Gambar Banner / Foto Profil Tidak Muncul (*Broken Image*)
- **Penyebab**: Symbolic link storage Laravel belum dibuat atau direktori belum dapat dibaca.
- **Solusi**:
  ```bash
  cd backend && php artisan storage:link
  chmod -R 775 storage bootstrap/cache
  ```

### 3. Frontend Gagal Menghubungi API (`Network Error` / `404`)
- **Penyebab**: Vite Dev Server belum meneruskan request `/api` ke alamat backend yang benar.
- **Solusi**:
  - **Docker**: Terhubung otomatis via internal network `http://app:8000`.
  - **Lokal Host**: Jalankan dengan variabel environment:
    ```bash
    cd frontend
    VITE_API_TARGET=http://localhost:8000 npm run dev
    ```

### 4. Git Menolak Push ke Branch `main`
- **Penyebab**: Repositori menerapkan *Strict Branch Policy* dan dilindungi oleh `.githooks/pre-push`.
- **Solusi**: Buat branch fitur baru (`git checkout -b fix/nama-fitur` atau `feat/nama-fitur`) lalu ajukan Pull Request ke `main`.
