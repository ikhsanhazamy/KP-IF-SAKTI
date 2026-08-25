# 📋 Catatan Perubahan (Changelog)

Semua perubahan penting pada proyek **KP-IF-SAKTI** akan didokumentasikan di berkas ini.

Format dokumen ini mengacu pada [Keep a Changelog](https://keepachangelog.com/id/1.0.0/), dan proyek ini menganut prinsip [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased] - 2026-08-26

### Perbaikan Bug (Fixed)
- **Rute 2FA Nginx Docker**: Menambahkan rute `two-factor-challenge` ke dalam regex backend handler pada `docker/nginx/default.conf` agar verifikasi 2FA di Docker production tidak terlempar ke 404 SPA fallback.
- **Eager Loading Relasi PAC di API Kegiatan**: Menambahkan `with('pac:id,nama_pac,kecamatan')` pada `GET /api/kegiatan` di `backend/routes/api.php` agar data PAC terkait dapat dimuat pada modal detail di frontend `DataPAC.jsx`.
- **Koreksi Typo View Blade**: Menghapus karakter typo `z` pada awal file `backend/resources/views/partials/modalDetailAnggota.blade.php`.
- **Remember Me Login**: Menambahkan atribut `name="remember"` pada checkbox login di `backend/resources/views/login.blade.php`.
- **Penyelenggara Kegiatan di Admin Dashboard**: Menambahkan dropdown pemilihan `pac_id` (PAC Penyelenggara) pada modal tambah/edit kegiatan dan mengoper `$pacs` dari `KegiatanController.php`.
- **Responsivitas Timeline**: Memperbaiki class dynamic interpolation Tailwind di `frontend/src/components/TimelineSection.jsx` agar class alternating `md:justify-start` / `md:justify-end` terekstrak dengan benar.
- **Dukungan Foto Upload di Landing Page**: Memperbarui mapping foto kegiatan di `frontend/src/components/KegiatanSection.jsx` agar menampilkan gambar kustom yang diunggah admin.
- **Navigasi Navbar**: Menambahkan tautan menu `Data PAC` ke dalam navbar desktop dan mobile di `frontend/src/components/Navbar.jsx`.

### Ditambahkan
- Dokumentasi komprehensif repositori: `CONTRIBUTORS.md`, `CONTRIBUTING.md`, `CODE_OF_CONDUCT.md`, `CHANGELOG.md`, `LICENSE`, `SECURITY.md`.
- Dokumentasi teknis terperinci di direktori `docs/`:
  - `docs/API_DOCUMENTATION.md` — Spesifikasi OpenAPI/REST API lengkap.
  - `docs/DATABASE_SCHEMA.md` — Kamus data skema dan ERD diagram.
  - `docs/ARCHITECTURE.md` — Arsitektur sistem dan sequence diagram.
  - `docs/DEPLOYMENT_GUIDE.md` — Panduan deployment server produksi & SSL.
  - `docs/DEVELOPMENT_GUIDE.md` — Panduan onboarding developer lokal & debugging.

---

## [v1.3.0] - 2026-08-16

### Keamanan (Security Hardening)
- **Rate Limiting**: Menerapkan middleware rate limiter `throttle:api` (60 request/menit) pada seluruh endpoint publik API di `backend/routes/api.php` dan limiter khusus `throttle:pac-pengajuan` (10 request/menit) pada rute submit formulir pengajuan PAC ([#26](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/26)).
- **Auth Rate Limiting**: Membatasi percobaan login admin dengan `throttle:login` (5 percobaan/menit) untuk mencegah serangan brute force.
- **CSRF Token Protection**: Menyediakan endpoint `/csrf-token` untuk pembaruan token asinkron guna mencegah token kadaluarsa saat form terbuka lama.

### Fitur Baru (Added)
- **Backup & Restore Multi-Driver**: Menambahkan dukungan backup dan restore database dengan deteksi otomatis untuk driver `sqlite` dan `mysql` pada `PengaturanController.php` ([#27](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/27)).
- **Pengaturan Keamanan & Profil**: Fitur ganti kata sandi, preferensi otentikasi dua faktor (2FA placeholder), pembaruan notifikasi, dan pengelolaan foto profil admin.

### Perbaikan Bug (Fixed)
- **Perhitungan Statistik PAC**: Memperbaiki kalkulasi `totalKecamatan` di `PACController.php` menggunakan query `distinct('kecamatan')->count('kecamatan')` agar menghitung jumlah kecamatan unik yang valid ([#24](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/24)).
- **Dynamic Admin Login Link**: Mengubah link login admin di Navbar React dari hardcoded `localhost:8000/login` menjadi relative path `/login` dengan dukungan fallback environment `VITE_ADMIN_URL` ([#25](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/25)).

### Performa & Optimasi (Performance)
- **Lazy Loading MapLibre**: Mengoptimalkan ukuran bundle frontend dengan menerapkan `React.lazy()` dan `Suspense` fallback skeleton pada komponen `PopupExample` di `MapSection.jsx` ([#28](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/28)).
- **Database Performance Indexing**: Menambahkan indeks performa pada kolom `status`, `kecamatan`, `kategori`, dan foreign key untuk mempercepat eksekusi query pencarian dan agregasi statistik.

### Refaktor & Pembersihan (Cleanup)
- Menghapus blade view usang (`dataAnggota.blade.php`, `pengaturan.blade.php`, `dashboard/index.blade.php`).
- Menghapus dead import `SettingController` di `backend/routes/web.php`.
- Menghapus komponen unused `Card.jsx` di frontend ([#29](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/29)).

---

## [v1.2.0] - 2026-08-15

### Ditambahkan
- **Docker Compose Production Readiness**: Integrasi service `db` (MySQL 8), `app` (PHP 8.2-FPM/CLI), `node` (Vite dev), dan `backend-assets` (Vite build runner) dengan volume persistensi data.
- **CI/CD Workflow**: GitHub Actions pipeline (`.github/workflows/ci.yml`) untuk menjalankan pengujian otomatis PHPUnit backend dan validasi build frontend pada setiap push dan pull request ke branch `main`.
- **Pengujian Komprehensif**: Test suite fitur Laravel mencakup `GitHubIssuesFixTest`, `FrontendStatsApiTest`, `HeaderInteractionTest`, `PACManagementTest`, `PengaturanTest`, dan `AnggotaLaporanTest`.

---

## [v1.1.0] - 2026-07-04

### Ditambahkan
- **Integrasi Webhook Google Apps Script**: Integrasi pengiriman data pengajuan PAC secara real-time ke Google Spreadsheet dan notifikasi eksternal via webhook Google Apps Script (`docs/google-apps-script/`).
- **Modal CRUD PAC & Hapus PAC**: Penambahan tombol dan modal konfirmasi hapus data PAC pada antarmuka admin dashboard.
- **Validasi Gambar Kegiatan**: Pembatasan ukuran dan format file upload foto kegiatan serta preview instan.
- **Admin Seeder**: Seeder default user administrator (`DatabaseSeeder.php`) untuk inisialisasi instalasi baru.

---

## [v1.0.0] - 2026-06-15

### Rilis Perdana (Initial Release)
- **Frontend SPA (React 18 + Vite + Tailwind CSS)**:
  - Halaman Beranda (*Landing Page*).
  - Halaman Profil Tentang Organisasi (Visi, Misi, Sejarah).
  - Halaman Kegiatan (Pencarian & Filter Kategori).
  - Halaman Peta Interaktif Data PAC (MapLibre GL).
  - Halaman Formulir Pengajuan PAC Baru.
- **Admin Dashboard (Laravel 12 + Blade)**:
  - Dashboard statistik ringkasan PAC, Anggota, dan Kegiatan.
  - CRUD Manajemen Pimpinan Anak Cabang (PAC).
  - CRUD Manajemen Data Anggota Fatayat NU.
  - CRUD Manajemen Kegiatan & Publikasi Dokumentasi.
  - Ekspor Laporan ke format PDF, Excel, dan CSV.
  - Autentikasi dan sesi admin.
