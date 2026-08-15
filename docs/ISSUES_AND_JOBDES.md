# Pembagian Jobdesk & Daftar Issue Repository (Antara Backend & Frontend)

Dokumen ini memetakan seluruh temuan bug dan hasil audit ke dalam bentuk **Daftar GitHub Issues** yang aktif di repositori `ikhsanhazamy/KP-IF-SAKTI`, beserta pembagian tanggung jawab antara developer **Backend** (Laravel/Blade) dan **Frontend** (React/SPA).

---

## 🗺️ Matriks Issue Aktif (Active Issues Matrix)

| Issue GitHub | Prioritas | Tipe | Deskripsi Singkat | PIC | File Terkait |
|---|---|---|---|---|---|
| [**#24**](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/24) | **P1 (High)** | Bug | Perhitungan `totalKecamatan` di PACController mengabaikan `distinct` | **Backend** | `backend/app/Http/Controllers/PACController.php` |
| [**#25**](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/25) | **P1 (High)** | Bug | Link "Admin Login" di Navbar Frontend hardcoded ke `localhost:8000` | **Frontend** | `frontend/src/components/Navbar.jsx` |
| [**#26**](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/26) | **P2 (Medium)** | Security | Penerapan middleware rate limiting (`throttle:api`) pada rute publik API | **Backend** | `backend/routes/api.php`<br>`backend/bootstrap/app.php` |
| [**#27**](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/27) | **P2 (Medium)** | Enhancement | Dukungan driver SQLite pada fitur Backup dan Restore Database | **Backend** | `backend/app/Http/Controllers/PengaturanController.php` |
| [**#28**](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/28) | **P3 (Low)** | Performance | Optimasi lazy loading komponen MapLibre GL (`MapSection`) | **Frontend** | `frontend/src/components/MapSection.jsx`<br>`frontend/src/components/PopupExample.jsx` |
| [**#29**](https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/29) | **P3 (Low)** | Clean Code | Pembersihan file orphaned (views usang, migrasi kosong, dead imports) | **Fullstack** | `backend/resources/views/*`<br>`frontend/src/components/Card.jsx` |

---

## 🛠️ Detail Issue - BACKEND (Laravel)

### [Issue #24] [BE] Bug: Perhitungan `totalKecamatan` di PACController Mengabaikan distinct
* **Prioritas**: **P1 (Tinggi)**
* **Link GitHub**: https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/24
* **Deskripsi**: Di `backend/app/Http/Controllers/PACController.php:38`, query `$totalKecamatan = PAC::distinct('kecamatan')->count();` mengabaikan kolom distinct sehingga menghitung seluruh baris tabel PAC.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Ubah query menjadi `PAC::distinct('kecamatan')->count('kecamatan');`
  - [ ] Pastikan nilai statistik pada tampilan admin merefleksikan jumlah kecamatan unik secara akurat.
  - [ ] Tambahkan unit/feature test untuk memverifikasi kalkulasi kecamatan unik di PACController.

---

### [Issue #26] [BE] Security: Pasang Middleware Rate Limiting (Throttle) pada Rute Publik API
* **Prioritas**: **P2 (Sedang)**
* **Link GitHub**: https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/26
* **Deskripsi**: Rate limiter `api` (`Limit::perMinute(60)`) sudah didefinisikan di `backend/bootstrap/app.php`, namun belum dipasang sebagai middleware pada rute-rute di `backend/routes/api.php`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Terapkan middleware `throttle:api` pada rute-rute di `backend/routes/api.php` atau daftarkan secara global di grup middleware API.
  - [ ] Uji respons HTTP 429 Too Many Requests saat request melebihi batas rate per menit.

---

### [Issue #27] [BE] Enhancement: Dukungan Driver SQLite pada Fitur Backup dan Restore Database
* **Prioritas**: **P2 (Sedang)**
* **Link GitHub**: https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/27
* **Deskripsi**: Method `backupDatabase` dan `restoreDatabase` di `PengaturanController.php` saat ini mengeksekusi shell command `mysqldump` dan `mysql` dengan konfigurasi MySQL secara hardcoded.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Lakukan deteksi driver database aktif melalui `config('database.default')`.
  - [ ] Jika driver SQLite: lakukan backup dengan menyalin berkas database SQLite (`copy()`) ke direktori penyimpanan backup, dan restore dengan memvalidasi lalu mengganti berkas SQLite.
  - [ ] Jika driver MySQL/MariaDB: tetap gunakan pipeline `mysqldump` / `mysql` yang sudah ada.

---

## 🎨 Detail Issue - FRONTEND (React)

### [Issue #25] [FE] Bug: Link Admin Login di Navbar Frontend Hardcoded ke localhost:8000
* **Prioritas**: **P1 (Tinggi)**
* **Link GitHub**: https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/25
* **Deskripsi**: Di `frontend/src/components/Navbar.jsx` baris 56 dan 97, tag `<a>` untuk tombol Admin Login mengarah ke URL hardcoded `http://localhost:8000/login`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Ganti link hardcoded `http://localhost:8000/login` menjadi relative path `/login` atau gunakan environment variable `import.meta.env.VITE_ADMIN_URL || '/login'`.
  - [ ] Pastikan navigasi ke halaman login admin berfungsi dengan benar pada desktop nav maupun mobile hamburger nav.

---

### [Issue #28] [FE] Performance: Optimasi Lazy Loading Komponen MapLibre GL (MapSection)
* **Prioritas**: **P3 (Rendah)**
* **Link GitHub**: https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/28
* **Deskripsi**: Chunk `vendor-map` berukuran 1,053.53 kB (1.05 MB) saat dibuild karena library WebGL MapLibre di-bundle dan di-import secara statis di dalam `MapSection.jsx`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Gunakan `React.lazy` dan `Suspense` untuk me-load komponen `PopupExample` di dalam `MapSection`.
  - [ ] Berikan loading skeleton/placeholder di dalam area container peta saat library MapLibre sedang diunduh.
  - [ ] Pastikan chunk `vendor-map` hanya diunduh secara on-demand saat komponen MapSection dimuat.

---

## 🧹 Detail Issue - FULLSTACK & CLEANUP

### [Issue #29] [CLEANUP] Pembersihan File Orphaned, Migrasi Kosong, dan Unused Imports
* **Prioritas**: **P3 (Rendah)**
* **Link GitHub**: https://github.com/ikhsanhazamy/KP-IF-SAKTI/issues/29
* **Deskripsi**: Menghapus file blade view yang sudah tidak terpakai, migrasi kosong, dead import, dan komponen dummy di frontend.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Hapus view blade usang di backend (`dataAnggota.blade.php`, `pengaturan.blade.php`, `dashboard/index.blade.php`).
  - [ ] Hapus dead import `SettingController` pada `backend/routes/web.php`.
  - [ ] Hapus komponen unused `Card.jsx` di frontend.
  - [ ] Pastikan seluruh test suite backend (`php artisan test`) dan frontend build (`npm run build`) tetap berjalan sukses (PASS).

---

## 📜 Riwayat Issue Terselesaikan (Resolved Issues)
- **#1 - #10**: Perbaikan Bug 1 - Bug 9 (Storage facade, mass assignment, proxy Vite, validasi anggota).
- **#11 - #17**: Perbaikan Bug 10 - Bug 16 (Migrasi profil user, `$fillable`, HTTP DELETE route, enctype restore form, validasi update kegiatan, sinkronisasi PAC kegiatan, SPA Link).
- **#22**: Production Readiness Audit & Roadmap.
