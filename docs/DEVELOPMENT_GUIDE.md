# 💻 Panduan Pengembangan Lokal & Onboarding (Development Guide)

Panduan praktis untuk pengembang (*developer onboarding*) dalam menyiapkan lingkungan pengembangan lokal, menjalankan pengujian, serta mengatasi kendala umum (*troubleshooting*).

---

## 🛠️ Persiapan Lingkungan (Prerequisites)

Pilih salah satu metode pengembangan:

### Opsi A: Menggunakan Docker (Direkomendasikan)
- **Docker Desktop** atau Docker Engine 20+
- **Docker Compose** v2+
- Tidak memerlukan instalasi PHP / MySQL di komputer host.

### Opsi B: Menggunakan Host Langsung (Manual)
- **PHP** >= 8.2 (dengan ekstensi: `pdo_mysql`, `pdo_sqlite`, `mbstring`, `gd`, `zip`, `bcmath`, `curl`)
- **Composer** 2.x
- **Node.js** >= 18.x & **npm** >= 9.x
- **MySQL** 8.x atau **SQLite 3**

---

## 🚀 Alur Setup Cepat (Quickstart)

### Menggunakan Docker Compose:
```bash
# 1. Clone repository
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI

# 2. Salin file environment backend
cp backend/.env.example backend/.env

# 3. Jalankan container
docker compose up --build
```
Akses aplikasi:
- **Frontend SPA**: `http://localhost:5173`
- **Admin Dashboard**: `http://localhost:8000`

---

## 🔑 Kredensial Default Login Admin (Seeder)

Setelah database dimigrasi dan di-seed (`php artisan db:seed`):

| Kolom | Nilai Default |
|---|---|
| **URL Login** | `http://localhost:8000/login` |
| **Email** | `admin@fatayatnu.or.id` |
| **Password** | `password` |

---

## 🧪 Perintah Pengujian & Quality Control

### Menjalankan Test Suite Backend:
```bash
cd backend
php artisan test
```

### Menjalankan Pengecekan Gaya Kode (Linting):
```bash
cd backend
vendor/bin/pint --test
```

### Memperbaiki Format Kode Secara Otomatis:
```bash
cd backend
vendor/bin/pint
```

### Memeriksa Build Frontend:
```bash
cd frontend
npm run build
```

---

## 🔍 Menggunakan Shell Artisan & Debugging

### Masuk ke Container Docker Backend:
```bash
docker compose exec app bash
```

### Menjalankan Laravel Tinker (Interactive REPL):
```bash
docker compose exec app php artisan tinker
# atau lokal:
cd backend && php artisan tinker
```
Contoh query di Tinker:
```php
App\Models\PAC::count();
App\Models\PAC::with('anggotas')->first();
```

### Reset Ulang Basis Data dan Isi Data Dummy:
```bash
docker compose exec app php artisan migrate:fresh --seed
```

---

## ❓ FAQ & Solusi Masalah Umum (Troubleshooting)

### 1. Port 8000 atau 5173 Sudah Digunakan (Port Conflict)
**Gejala**: Error `address already in use` saat `docker compose up` atau `php artisan serve`.  
**Solusi**: Matikan proses yang menggunakan port tersebut atau sesuaikan mapping port pada `docker-compose.yml`:
```yaml
ports:
  - "8080:8000" # Mapping port host 8080 ke container 8000
```

### 2. Frontend React Gagal Memanggil API (`Network Error` / `404`)
**Penyebab**: Proxy Vite belum terarah ke alamat backend yang benar.  
**Solusi**:
- **Jika via Docker**: Default proxy `http://app:8000` sudah otomatis terhubung via Docker network.
- **Jika via Local Host**: Jalankan frontend dengan environment variable `VITE_API_TARGET`:
  ```bash
  cd frontend
  VITE_API_TARGET=http://localhost:8000 npm run dev
  ```

### 3. Gambar Upload Tidak Tampil (Broken Image)
**Penyebab**: Storage link simbolik belum dibuat.  
**Solusi**: Buat symbolic link storage Laravel:
```bash
cd backend
php artisan storage:link
# atau di Docker:
docker compose exec app php artisan storage:link
```

### 4. Permasalahan Izin Direktori (Permission Denied pada `storage/` atau `bootstrap/cache/`)
**Solusi**:
```bash
sudo chmod -R 775 backend/storage backend/bootstrap/cache
sudo chown -R $USER:www-data backend/storage backend/bootstrap/cache
```
