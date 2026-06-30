# Pembagian Jobdesk & Daftar Issue Repository (Antara Backend & Frontend)

Dokumen ini memetakan seluruh bug yang teridentifikasi ke dalam bentuk **Issue Template** siap pakai untuk repositori (GitHub/GitLab) serta membagi tanggung jawab pengerjaannya antara developer **Backend** (Laravel/Blade) dan **Frontend** (React/SPA).

---

## 🗺️ Matriks Pembagian Kerja (Job Description Matrix)

| ID Bug | Deskripsi Singkat | Jenis Pekerjaan | Penanggung Jawab | File Terkait |
|---|---|---|---|---|
| **Bug #10** | Migrasi kosong kolom profil user | Database / Migration | **Backend** | `backend/database/migrations/..._add_profile_columns_to_users_table.php` |
| **Bug #11** | `$fillable` Model `User` tidak lengkap | Model / Mass Assignment | **Backend** | `backend/app/Models/User.php` |
| **Bug #12** | Route mismatch "Hapus Foto" (DELETE vs POST) | View & Routing | **Backend** | `backend/resources/views/pengaturan/profil.blade.php`<br>`backend/routes/web.php` |
| **Bug #13** | Form restore database tidak memiliki input file & enctype | View / Blade Form | **Backend** | `backend/resources/views/pengaturan/sistem.blade.php` |
| **Bug #14** | Ketiadaan validasi di `KegiatanController@update` | Controller / Security | **Backend** | `backend/app/Http/Controllers/KegiatanController.php` |
| **Bug #15** | Bug desinkronisasi `total_kegiatan` saat hapus PAC | Controller / Logic | **Backend** | `backend/app/Http/Controllers/KegiatanController.php` |
| **Bug #16** | Navigasi `<a>` tag memicu reload halaman pada React | React Navigation | **Frontend** | `frontend/src/Pages/DataPAC.jsx` |

---

## 🛠️ Detail Issue Templates - BACKEND (Laravel)

### [Issue BE-10] Perbaikan Migrasi Kolom Profil User
* **Deskripsi**: File migrasi `add_profile_columns_to_users_table.php` dibuat kosong tanpa mendefinisikan kolom `phone`, `jabatan`, dan `photo`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Lengkapi method `up()` pada migrasi untuk menambahkan kolom `phone`, `jabatan`, dan `photo` secara nullable ke tabel `users`.
  - [ ] Lengkapi method `down()` untuk menjamin migrasi dapat di-rollback dengan aman (`dropColumn`).
  - [ ] Jalankan `php artisan migrate` dan pastikan schema database SQLite terupdate.

---

### [Issue BE-11] Pendaftaran Atribut Profil ke `$fillable` Model User
* **Deskripsi**: Laravel Mass Assignment memblokir pengisian kolom baru (`phone`, `jabatan`, `photo`) karena belum terdaftar di `$fillable` di model `User.php`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Tambahkan `'phone'`, `'jabatan'`, dan `'photo'` ke dalam properti `$fillable` pada [User.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Models/User.php).
  - [ ] Uji pengisian form profil dan pastikan data tersimpan dengan benar di database.

---

### [Issue BE-12] Perbaikan Route Mismatch Hapus Foto Profil (DELETE vs POST)
* **Deskripsi**: Tombol hapus foto profil mengirim HTTP POST, sedangkan route Laravel didefinisikan sebagai `DELETE` di `web.php`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Pisahkan tombol "Hapus Foto" di [profil.blade.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/resources/views/pengaturan/profil.blade.php) menjadi form mandiri atau gunakan form method spoofing `@method('DELETE')`.
  - [ ] Pastikan saat tombol diklik, foto berhasil dihapus dari storage publik dan field di database diset `null`.

---

### [Issue BE-13] Kelengkapan Input File & Enctype Form Restore Database
* **Deskripsi**: Form restore database di [sistem.blade.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/resources/views/pengaturan/sistem.blade.php) tidak memiliki input untuk berkas backup dan tidak ber-enctype `multipart/form-data`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Tambahkan atribut `enctype="multipart/form-data"` pada tag `<form>` restore.
  - [ ] Tambahkan input file `<input type="file" name="backup_file" required>` sebelum tombol restore.
  - [ ] Uji fungsionalitas restore dengan berkas database `.sqlite` hasil backup.

---

### [Issue BE-14] Validasi Input Request pada `KegiatanController@update`
* **Deskripsi**: Method `update` pada `KegiatanController.php` tidak melakukan pengecekan atau validasi request sehingga rentan terhadap database crash (error 500) jika ada parameter kosong.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Tambahkan validasi `$request->validate([...])` di awal method `update()` serupa dengan method `store()`.
  - [ ] Pastikan error validasi dikembalikan ke pengguna dengan benar jika ada field wajib yang kosong.

---

### [Issue BE-15] Perbaikan Desinkronisasi `total_kegiatan` PAC di Kegiatan
* **Deskripsi**: Menghapus/mengosongkan PAC (`pac_id` di-set null) pada suatu kegiatan tidak mengurangi `total_kegiatan` pada PAC lama karena terlewat oleh logika pengecekan `$request->filled('pac_id')`.
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Ubah logika sinkronisasi di `update()` agar mendeteksi transisi perubahan PAC secara tepat (termasuk jika `pac_id` baru bernilai null).
  - [ ] Uji perubahan PAC pada kegiatan dan verifikasi kesesuaian nilai statistik di tabel `pacs`.

---

## 🎨 Detail Issue Templates - FRONTEND (React)

### [Issue FE-16] Penggunaan Link Component untuk Navigasi Internal di Modal PAC
* **Deskripsi**: Tautan ke detail kegiatan di modal [DataPAC.jsx](file:///Users/mac/kppppp/KP-IF-SAKTI/frontend/src/Pages/DataPAC.jsx) masih menggunakan tag anchor html murni (`<a>`), mengakibatkan reload halaman penuh (full page reload).
* **Kriteria Penerimaan (Acceptance Criteria)**:
  - [ ] Ganti tag `<a>` menjadi komponen `<Link>` dari `react-router-dom`.
  - [ ] Ganti atribut `href` menjadi `to`.
  - [ ] Pastikan navigasi berjalan mulus secara instan tanpa ada indikator pemuatan browser penuh (SPA transition).
