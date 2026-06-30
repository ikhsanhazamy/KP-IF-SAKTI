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
* **Status**: **Sudah Diperbaiki** (Menggunakan `process.env.VITE_API_TARGET || 'http://localhost:8000'`).

---

## Daftar Bug Baru yang Terdeteksi & Belum Diperbaiki

### 10. Migrasi Kosong untuk Kolom Profil User
* **Lokasi File**: [2026_06_08_182340_add_profile_columns_to_users_table.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/database/migrations/2026_06_08_182340_add_profile_columns_to_users_table.php)
* **Deskripsi**: File migrasi ini dibuat tetapi isi method `up` dan `down` kosong (`//`). Akibatnya, kolom `phone`, `jabatan`, dan `photo` tidak pernah dibuat di tabel `users` database SQLite.
* **Dampak**: Halaman pengaturan profil admin tidak akan bisa menyimpan atau menampilkan no telepon, jabatan, atau foto profil dari user.
* **Cara Memperbaiki**: Isi method `up` dan `down` pada migrasi tersebut dengan pendefinisian kolom yang sesuai:
  ```php
  public function up(): void
  {
      Schema::table('users', function (Blueprint $table) {
          $table->string('phone')->nullable();
          $table->string('jabatan')->nullable();
          $table->string('photo')->nullable();
      });
  }
  ```

---

### 11. Kolom Profil Belum Ditambahkan pada `$fillable` Model `User`
* **Lokasi File**: [User.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Models/User.php#L21-L25)
* **Deskripsi**: Properti `$fillable` di kelas `User` hanya mencakup `name`, `email`, dan `password`. Kolom profil seperti `phone`, `jabatan`, dan `photo` belum dimasukkan.
* **Dampak**: Ketika admin mengupdate profil di `PengaturanController@updateProfil` menggunakan `$user->update(...)`, kolom-kolom baru tersebut akan diabaikan secara diam-diam oleh Laravel (Mass Assignment Protection).
* **Cara Memperbaiki**: Tambahkan kolom-kolom tersebut ke dalam array `$fillable` di model `User`:
  ```php
  protected $fillable = [
      'name',
      'email',
      'password',
      'phone',
      'jabatan',
      'photo',
  ];
  ```

---

### 12. Ketidaksesuaian Method HTTP Route pada Fitur Hapus Foto Profil
* **Lokasi File**: [profil.blade.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/resources/views/pengaturan/profil.blade.php#L47-L55) dan [web.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/routes/web.php#L148)
* **Deskripsi**: Route untuk hapus foto dikonfigurasi sebagai method `DELETE`. Namun, tombol "Hapus Foto" di form profil menggunakan atribut `formmethod="POST"` tanpa adanya input directive `@method('DELETE')` atau spoofing method.
* **Dampak**: Menekan tombol "Hapus Foto" akan menghasilkan error `405 Method Not Allowed` dari router Laravel.
* **Cara Memperbaiki**: Pisahkan tombol hapus foto ke form tersendiri dengan `@method('DELETE')`, atau ubah route di `web.php` menjadi POST.

---

### 13. Form Restore Database Kurang Input File dan Atribut Enctype
* **Lokasi File**: [sistem.blade.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/resources/views/pengaturan/sistem.blade.php#L90-L103)
* **Deskripsi**: Form untuk memicu aksi `restoreDatabase` hanya berisi tombol submit tanpa ada input file upload (`<input type="file" name="backup_file">`) dan tidak memiliki atribut `enctype="multipart/form-data"`.
* **Dampak**: Menekan tombol "Restore Database" akan mengirimkan request kosong ke backend, yang langsung gagal divalidasi oleh `PengaturanController@restoreDatabase` karena field `backup_file` wajib diisi. Pengguna akan diarahkan kembali (redirect back) tanpa kejelasan.
* **Cara Memperbaiki**: Lengkapi form restore dengan input file dan enctype yang sesuai:
  ```html
  <form action="{{ route('restore.database') }}" method="POST" enctype="multipart/form-data" class="m-0">
      @csrf
      <input type="file" name="backup_file" required class="mb-2 text-xs">
      <button type="submit" class="...">Restore Database</button>
  </form>
  ```

---

### 14. Ketiadaan Validasi Input pada `KegiatanController@update`
* **Lokasi File**: [KegiatanController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/KegiatanController.php#L51-L76)
* **Deskripsi**: Method `update` pada `KegiatanController` memproses dan menyimpan perubahan data secara langsung dari `$request` ke database tanpa validasi input.
* **Dampak**: Jika admin mengosongkan field wajib (seperti `judul`, `tanggal`, dll.), database akan memicu constraint exception yang membuat web crash.
* **Cara Memperbaiki**: Terapkan validasi input yang serupa dengan method `store` sebelum melakukan update:
  ```php
  $validated = $request->validate([
      'judul'    => 'required|string|max:255',
      'tanggal'  => 'required|date',
      'waktu'    => 'required|string',
      'lokasi'   => 'required|string|max:255',
      'kategori' => 'required|string|max:100',
      'peserta'  => 'required|integer|min:0',
      'pac_id'   => 'nullable|exists:pacs,id',
      'deskripsi'=> 'nullable|string',
      'status'   => 'required|in:upcoming,ongoing,completed',
  ]);
  ```

---

### 15. Bug Desinkronisasi `total_kegiatan` PAC Saat Penghapusan Hubungan PAC di Kegiatan
* **Lokasi File**: [KegiatanController.php](file:///Users/mac/kppppp/KP-IF-SAKTI/backend/app/Http/Controllers/KegiatanController.php#L56-L61)
* **Deskripsi**: Pada method `update`, jika kegiatan sebelumnya memiliki asosiasi `pac_id` dan diubah menjadi kosong/tanpa PAC (null), sistem tidak akan mengurangi `total_kegiatan` pada PAC lama. Hal ini karena kode dibungkus dalam blok if `$request->filled('pac_id')`.
* **Dampak**: Statistik total kegiatan pada PAC lama akan tetap bertambah (tidak tersinkronisasi), menyebabkan data desinkronisasi.
* **Cara Memperbaiki**: Ubah logika sinkronisasi PAC agar mendeteksi transisi dari ada PAC menjadi tanpa PAC:
  ```php
  if ($kegiatan->pac_id != $request->pac_id) {
      if ($kegiatan->pac_id) {
          PAC::where('id', $kegiatan->pac_id)->decrement('total_kegiatan');
      }
      if ($request->filled('pac_id')) {
          PAC::where('id', $request->pac_id)->increment('total_kegiatan');
      }
  }
  ```

---

### 16. Penggunaan Anchor Tag Murni untuk Navigasi Internal React
* **Lokasi File**: [DataPAC.jsx](file:///Users/mac/kppppp/KP-IF-SAKTI/frontend/src/Pages/DataPAC.jsx#L394-L400)
* **Deskripsi**: Tautan detail kegiatan di modal PAC menggunakan anchor tag murni (`<a href="...">`) alih-alih komponen `<Link>` dari `react-router-dom`.
* **Dampak**: Menghancurkan performa Single Page Application (SPA) karena memicu reload halaman penuh (full page reload) setiap kali diklik.
* **Cara Memperbaiki**: Ganti tag `<a>` menjadi `<Link>` dengan atribut `to`:
  ```javascript
  <Link
    to={`/kegiatan/${keg.id}`}
    className="text-xs font-semibold text-[#1f7a4d] hover:underline"
  >
    Lihat Detail →
  </Link>
  ```

