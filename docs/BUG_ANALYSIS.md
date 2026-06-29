# Dokumentasi Analisis Bug - Sistem Informasi Fatayat NU Sukabumi

Dokumen ini mencantumkan hasil analisis bug secara menyeluruh pada aplikasi **KP-IF-SAKTI** (Sistem Informasi Fatayat NU Sukabumi) baik di sisi Backend (Laravel) maupun Frontend (React).

---

## Daftar Bug & Masalah Fungsional

### 1. Missing Storage Facade Import di PengaturanController
* **Lokasi File**: [PengaturanController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/PengaturanController.php#L51-L69)
* **Deskripsi**: Method `hapusFoto` menggunakan facade `Storage` (`Storage::disk('public')->delete(...)`) namun class facade tersebut tidak di-import di bagian atas file controller.
* **Dampak**: Ketika admin mencoba menghapus foto profil di halaman pengaturan, aplikasi akan mengalami error runtime (`Class 'App\Http\Controllers\Storage' not found`) dan crash.
* **Cara Memperbaiki**: Tambahkan baris import berikut di bagian atas file `PengaturanController.php`:
  ```php
  use Illuminate\Support\Facades\Storage;
  ```

---

### 2. Fitur Backup Database Menggunakan `mysqldump` pada Lingkungan SQLite
* **Lokasi File**: [PengaturanController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/PengaturanController.php#L122-L156)
* **Deskripsi**: Method `backupDatabase` menjalankan perintah shell `mysqldump` untuk mencadangkan database. Namun, aplikasi ini dikonfigurasi untuk menggunakan driver database SQLite (`DB_CONNECTION=sqlite` di file `.env`). Selain itu, biner `mysqldump` tidak tersedia secara default di image Docker PHP-cli yang digunakan.
* **Dampak**: Tombol "Backup Database" di Dashboard Admin tidak akan berfungsi dan selalu menghasilkan pesan "Backup database gagal".
* **Cara Memperbaiki**: Lakukan pengecekan driver database di runtime. Jika menggunakan SQLite, backup dilakukan dengan cara menyalin (copy) file database SQLite ke direktori backup:
  ```php
  if (config('database.default') === 'sqlite') {
      $sqlitePath = config('database.connections.sqlite.database');
      copy($sqlitePath, $filePath);
  } else {
      // Jalankan perintah mysqldump untuk MySQL/MariaDB
  }
  ```

---

### 3. Route Restore Database Memanggil Method yang Tidak Ada (`restoreDatabase`)
* **Lokasi File**: [web.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/routes/web.php#L166) and [PengaturanController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/PengaturanController.php)
* **Deskripsi**: Route POST `/restore/database` diarahkan ke method `restoreDatabase` di `PengaturanController.php`. Namun, method `restoreDatabase` tidak diimplementasikan sama sekali di controller tersebut.
* **Dampak**: Menekan tombol restore database atau mengirimkan request POST ke endpoint tersebut akan memicu error runtime `BadMethodCallException` (Method does not exist).
* **Cara Memperbaiki**: Implementasikan method `restoreDatabase` di `PengaturanController.php` untuk memproses file SQL/SQLite yang diunggah, atau hapus route tersebut jika fitur restore belum didukung.

---

### 4. Tidak Ada Validasi Request pada Method `update` Anggota
* **Lokasi File**: [AnggotaController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/AnggotaController.php#L170-L189)
* **Deskripsi**: Method `update` melakukan pembaruan data anggota secara langsung dari `$request` tanpa memvalidasi data terlebih dahulu. Berbeda dengan method `store` yang memiliki validasi lengkap.
* **Dampak**: Jika admin mengosongkan field wajib (seperti `nama` atau `email`) atau menginput format email yang salah, database akan melempar integrity constraint exception (seperti SQLITE_CONSTRAINT_NOTNULL) yang mengakibatkan halaman web crash/error 500 bagi pengguna.
* **Cara Memperbaiki**: Tambahkan validasi form di awal method `update` sebelum melakukan update data:
  ```php
  $request->validate([
      'nama' => 'required',
      'email' => 'required|email|unique:anggotas,email,' . $id,
      'pac' => 'required',
      'profesi' => 'required',
      'pendidikan' => 'required',
      'status' => 'required',
      'tanggal_bergabung' => 'required',
  ]);
  ```

---

### 5. Sinkronisasi Jumlah Anggota PAC Tidak Berjalan Saat Update PAC Anggota
* **Lokasi File**: [AnggotaController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/AnggotaController.php#L170-L189)
* **Deskripsi**: Pada method `store`, sistem menambah count `jumlah_anggota` di tabel `pacs`. Pada method `destroy`, sistem mengurangi count tersebut. Namun, di method `update`, jika admin mengubah PAC seorang anggota (misal dari PAC A ke PAC B), tidak ada mekanisme untuk mengurangi jumlah anggota di PAC A dan menambahkannya di PAC B.
* **Dampak**: Data statistik `jumlah_anggota` pada tabel `pacs` menjadi tidak sinkron dan tidak akurat jika ada anggota yang dimutasi/pindah PAC.
* **Cara Memperbaiki**: Di method `update`, bandingkan nilai PAC lama dengan PAC baru sebelum melakukan update. Jika berbeda, sesuaikan jumlah anggotanya:
  ```php
  if ($anggota->pac !== $request->pac) {
      PAC::where('nama_pac', $anggota->pac)->decrement('jumlah_anggota');
      PAC::where('nama_pac', $request->pac)->increment('jumlah_anggota');
  }
  ```

---

## Daftar Bug Lainnya

### 6. Tidak Ada Validasi Request pada Method `update` PAC
* **Lokasi File**: [PACController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/PACController.php#L106-L129)
* **Deskripsi**: Sama seperti pada data anggota, pembaruan data PAC di method `update` tidak memvalidasi input dari user.
* **Dampak**: Potensi runtime exception database jika field wajib (seperti `nama_pac`, `kecamatan`, `alamat`, atau `ketua_pac`) dikirimkan kosong atau bernilai null.
* **Cara Memperbaiki**: Terapkan aturan validasi yang sama dengan method `store` pada method `update`:
  ```php
  $request->validate([
      'nama_pac' => 'required',
      'kecamatan' => 'required',
      'status' => 'required',
      'tanggal_berdiri' => 'required',
      'alamat' => 'required',
      'desa' => 'required',
      'ketua_pac' => 'required',
      'telepon' => 'required',
  ]);
  ```

---

### 7. Perhitungan Jumlah Kecamatan Unik di PACController Salah
* **Lokasi File**: [PACController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/PACController.php#L26)
* **Deskripsi**: Perhitungan jumlah kecamatan dilakukan dengan `$totalKecamatan = PAC::distinct('kecamatan')->count();`. Dalam query builder Eloquent, memanggil `count()` secara langsung setelah `distinct()` akan mengabaikan klausa kolom distinct dan menghitung seluruh baris tabel (sama dengan total PAC).
* **Dampak**: Statistik "Jumlah Kecamatan" pada halaman admin akan menampilkan angka total seluruh PAC (bukan jumlah kecamatan yang unik/berbeda).
* **Cara Memperbaiki**: Berikan nama kolom sebagai parameter di dalam method `count()` agar distinct berfungsi dengan benar:
  ```php
  $totalKecamatan = PAC::distinct('kecamatan')->count('kecamatan');
  ```
  *(Catatan: Ini sudah diimplementasikan dengan benar di route API frontend `routes/api.php` line 50, tetapi masih salah di route web admin)*.

---

### 8. Penggunaan Mass Assignment Tanpa Validasi di KegiatanController@store
* **Lokasi File**: [KegiatanController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/KegiatanController.php#L18-L28)
* **Deskripsi**: Method `store` membuat data kegiatan baru dengan cara `Kegiatan::create($request->all());` tanpa memvalidasi input terlebih dahulu.
* **Dampak**: Jika pengguna mengirimkan data kosong atau format yang salah pada kolom wajib (seperti `judul`, `tanggal`, `waktu`, `lokasi`, atau `peserta`), database akan melempar IntegrityConstraintViolationException.
* **Cara Memperbaiki**: Tambahkan validasi request sebelum `create`:
  ```php
  $request->validate([
      'judul' => 'required|string|max:255',
      'tanggal' => 'required|date',
      'waktu' => 'required',
      'lokasi' => 'required|string',
      'kategori' => 'required|string',
      'peserta' => 'required|integer|min:0',
  ]);
  ```

---

### 9. Hardcoded Target Proxy Vite Menyulitkan Pengembangan Lokal Non-Docker
* **Lokasi File**: [vite.config.js](file:///Users/mac/kppppp/KP-IF-SAKTI/frontend/vite.config.js#L18)
* **Deskripsi**: Konfigurasi proxy server Vite menggunakan target default `http://app:8000` (yang merupakan nama service di dalam Docker).
* **Dampak**: Ketika pengembang mencoba menjalankan frontend secara lokal tanpa Docker (`npm run dev`), request API ke `/api/*` akan gagal terkoneksi (karena hostname `app` tidak dikenal oleh OS host) kecuali pengembang mengetahui bahwa mereka harus menyetel environment variable `VITE_API_TARGET=http://localhost:8000`.
* **Cara Memperbaiki**: Tambahkan petunjuk yang lebih jelas di README atau ubah default proxy target untuk mendeteksi apakah service berjalan di luar docker, atau ubah konfigurasi proxy agar lebih ramah terhadap pengembangan lokal secara default.
