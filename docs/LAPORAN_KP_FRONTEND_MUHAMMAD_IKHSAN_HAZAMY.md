# LAPORAN KERJA PRAKTIK (KP)

## PENGEMBANGAN ANTARMUKA PENGGUNA (FRONTEND) WEBSITE SISTEM INFORMASI PIMPINAN CABANG FATAYAT NU KABUPATEN SUKABUMI BERBASIS REACT 18, TAILWIND CSS 4, DAN MAPLIBRE GL

<br>

**Disusun Oleh:**  
**Muhammad Ikhsan Hazamy — NIM: 1237050138**  
**Role: Frontend Developer**

<br>

**JURUSAN INFORMATIKA**  
**FAKULTAS SAINS DAN TEKNOLOGI**  
**UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI**  
**BANDUNG**  
**2026**

---

## KATA PENGANTAR

Puji dan syukur penulis panjatkan ke hadirat Allah SWT atas limpahan rahmat, taufik, dan karunia-Nya, sehingga penulis dapat menyelesaikan penyusunan Laporan Kerja Praktik (KP) yang berjudul **"Pengembangan Antarmuka Pengguna (Frontend) Website Sistem Informasi Pimpinan Cabang Fatayat NU Kabupaten Sukabumi Berbasis React 18, Tailwind CSS 4, dan MapLibre GL"**. Laporan ini disusun guna memenuhi salah satu syarat kelulusan akademis pada Jurusan Informatika, Fakultas Sains dan Teknologi, Universitas Islam Negeri Sunan Gunung Djati Bandung.

Pelaksanaan Kerja Praktik dan penyusunan laporan ini dapat terwujud berkat bimbingan, arahan, dan dukungan dari berbagai pihak. Oleh karena itu, penulis menyampaikan ucapan terima kasih yang sebesar-besarnya kepada:

1. Bapak Dekan Fakultas Sains dan Teknologi Universitas Islam Negeri Sunan Gunung Djati Bandung.
2. Bapak Ketua Jurusan Informatika Fakultas Sains dan Teknologi Universitas Islam Negeri Sunan Gunung Djati Bandung.
3. Bapak/Ibu Dosen Pembimbing Kerja Praktik yang telah memberikan bimbingan teknis, koreksi, dan arahan akademis berharga.
4. Jajaran Pengurus Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi yang telah memberikan izin, keterbukaan data organisasi, dan fasilitas selama pelaksanaan Kerja Praktik.
5. Rekan-rekan satu tim pengembang proyek **KP-IF-SAKTI**, yaitu **LM. Irsal Shydiq** (Project Manager & UI/UX Designer) dan **Nurdiansyah Pratama** (Backend Developer), atas kolaborasi solid, dedikasi, dan kerja sama tim yang luar biasa selama proses pengembangan aplikasi.
6. Kedua orang tua dan keluarga tercinta atas doa, motivasi, dan dukungan moril maupun materiel yang tiada henti.
7. Seluruh rekan mahasiswa Jurusan Informatika angkatan 2023 yang senantiasa saling berbagi semangat dan wawasan.

Penulis menyadari bahwa dalam laporan ini masih terdapat keterbatasan. Oleh sebab itu, kritik dan saran yang membangun sangat penulis harapkan demi penyempurnaan karya di masa yang akan datang. Semoga laporan ini dapat memberikan manfaat nyata bagi organisasi PC Fatayat NU Kabupaten Sukabumi serta perkembangan teknologi antarmuka web modern.

<br>

Bandung, 2026

<br><br>

**Muhammad Ikhsan Hazamy**  
NIM. 1237050138

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
    - 3.2.1 Analisis Kebutuhan Fungsional & Non-Fungsional Frontend . 15
    - 3.2.2 Arsitektur Komponen Modular & Client-Side Routing ........ 17
    - 3.2.3 Implementasi Halaman Beranda & Dynamic Stats Counter ... 19
    - 3.2.4 Implementasi Pemetaan Interaktif 47 PAC (MapLibre GL) ... 22
    - 3.2.5 Implementasi Direktori Kegiatan & Filter Kategori ........ 24
    - 3.2.6 Implementasi Formulir Pengajuan PAC & Validasi Klien .... 26
    - 3.2.7 Optimasi Performa, Code Splitting, & Core Web Vitals .... 28
  - 3.3 Hasil ..................................................................................... 30
- **BAB IV Penutup** ................................................................................ 34
  - 4.1 Kesimpulan ........................................................................... 34
  - 4.2 Saran .................................................................................... 35
- **REFERENSI** ...................................................................................... 36
- **LAMPIRAN** ....................................................................................... 38

---

## DAFTAR GAMBAR

- **Gambar 1.1** Struktur Organisasi Tim Pengembang KP-IF-SAKTI ......................................... 6
- **Gambar 2.1** Siklus Komponen dan Alur *Reconciliation Virtual DOM* React 18 ................ 9
- **Gambar 3.1** Arsitektur Komponen Hierarkis Frontend React SPA ................................... 18
- **Gambar 3.2** Tampilan Antarmuka Halaman Beranda (*Landing Page*) & Hero Section ....... 20
- **Gambar 3.3** Visualisasi Peta Sebaran 47 PAC Menggunakan MapLibre GL ........................ 23
- **Gambar 3.4** Tampilan Direktori Agenda Kegiatan dengan Filter Kategori Dinamis .............. 25
- **Gambar 3.5** Formulir Interaktif Pengajuan Pembentukan PAC Baru & Modal Sukses ......... 27
- **Gambar 3.6** Hasil Audit Performa Google Lighthouse (Core Web Vitals Score 96) ........... 29
- **Gambar 3.7** Pengujian Responsivitas Antarmuka pada Breakpoint Mobile dan Tablet ........ 31

---

## DAFTAR TABEL

- **Tabel 1.1** Agenda dan Timeline Pelaksanaan Kerja Praktik Frontend ............................... 3
- **Tabel 1.2** Matriks Peran dan Pembagian Tugas Tim Pengembang ...................................... 6
- **Tabel 2.1** Log Book Kegiatan Harian Peserta Kerja Praktik (Role: Frontend Developer) ... 11
- **Tabel 3.1** Matriks Kebutuhan Fungsional Antarmuka Frontend ....................................... 15
- **Tabel 3.2** Matriks Kebutuhan Non-Fungsional Kinerja Frontend ..................................... 16
- **Tabel 3.3** Daftar Komponen Antarmuka Modular dan Fungsinya ..................................... 18
- **Tabel 3.4** Pemetaan Konsumsi REST API Backend oleh Komponen Frontend .................. 21
- **Tabel 3.5** Konfigurasi Lapisan GeoJSON dan Properti Marker MapLibre GL .................... 23
- **Tabel 3.6** Hasil Evaluasi Metrik Core Web Vitals (LCP, INP, CLS) ................................. 29

---

# BAB I: PENDAHULUAN

### 1.1 Latar Belakang
Perkembangan teknologi web modern menuntut penyajian informasi yang tidak hanya informatif, tetapi juga interaktif, responsif, dan berkecepatan tinggi. **Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi** merupakan organisasi perempuan pemudi Islam yang membawahi 47 Pimpinan Anak Cabang (PAC) di 47 kecamatan se-Kabupaten Sukabumi dengan ribuan kader aktif. Luasnya cakupan wilayah geografis Kabupaten Sukabumi menuntut adanya media publikasi digital terpadu yang dapat diakses dengan mudah oleh kader maupun masyarakat umum melalui berbagai perangkat, terutama telepon pintar (*smartphone*).

Sebelum dikembangkannya website sistem informasi ini, publikasi agenda kegiatan dan informasi kepengurusan PAC masih disampaikan melalui media sosial yang bersifat linier dan terfragmentasi. Kondisi tersebut menimbulkan kendala:
1. **Sulitnya Memetakan Potensi Wilayah 47 PAC**: Ketiadaan visualisasi geografis interaktif menyulitkan pengurus cabang dan masyarakat dalam melihat sebaran PAC aktif, alamat kantor sekretariat, kontak pengurus, dan jumlah kader di setiap kecamatan.
2. **Keterbatasan Eksplorasi Agenda Kegiatan**: Masyarakat dan kader kesulitan memfilter kegiatan organisasi berdasarkan bidang minat tertentu (seperti *Kaderisasi, Sosial, Kesehatan, Kajian*, dan *Seminar*).
3. **Pengalaman Pengguna yang Kurang Interaktif (*Poor User Experience*)**: Website konvensional yang memuat ulang halaman (*full-page reload*) setiap kali berpindah menu terasa lambat dan memakan kuota data yang lebih besar pada jaringan seluler daerah.

Untuk mengatasi permasalahan tersebut, dikembangkan aplikasi web publik berbasis **Single Page Application (SPA)** menggunakan **React 18** dan **Vite 5**. Pendekatan SPA memungkinkan navigasi antar-halaman yang instan tanpa *page reload*, didukung oleh styling modern **Tailwind CSS 4** dan visualisasi pemetaan wilayah interaktif berbasis **MapLibre GL**.

Dalam proyek ini, peran **Frontend Developer** bertanggung jawab penuh dalam menerjemahkan rancangan antarmuka *UI/UX Figma* menjadi kode program yang fungsional, modular, dan berperforma tinggi. Frontend Developer bertugas mengonstruksi komponen antarmuka, mengelola *client-side routing*, mengintegrasikan konsumsi RESTful API asinkron dari backend Laravel, mengimplementasikan interaktivitas peta digital 47 PAC, serta mengoptimalkan metrik performa antarmuka (*Core Web Vitals*).

### 1.2 Rumusan Masalah
Rumusan masalah yang diselesaikan dalam lingkup pengembangan *frontend* adalah:
1. Bagaimana mengimplementasikan arsitektur *Single Page Application* (SPA) berbasis React 18 dan Vite 5 yang modular, terstruktur, dan memiliki performa *rendering* tinggi?
2. Bagaimana merancang dan menerapkan tata letak antarmuka yang responsif (*mobile-first*) menggunakan utilitas Tailwind CSS 4 yang selaras dengan *Design System* resmi organisasi?
3. Bagaimana mengintegrasikan pustaka pemetaan digital MapLibre GL untuk memvisualisasikan sebaran 47 PAC di Kabupaten Sukabumi lengkap dengan interaktivitas *marker* dan *popup detail*?
4. Bagaimana mengelola konsumsi RESTful API asinkron (*asynchronous fetch*) dari backend Laravel secara efisien, mencakup penanganan status *loading*, *error boundary*, dan *dynamic client-side filtering*?
5. Bagaimana mengoptimalkan kecepatan muat halaman (*load performance*) dan metrik *Core Web Vitals* (LCP, INP, CLS) pada antarmuka web?

### 1.3 Tujuan
Tujuan yang dicapai dalam pelaksanaan Kerja Praktik ini adalah:
1. Membangun aplikasi web publik berbasis Single Page Application (SPA) menggunakan React 18 dan bundler Vite 5 yang responsif di berbagai resolusi layar (*desktop, tablet, mobile*).
2. Mengembangkan komponen antarmuka modular (*reusable UI components*) menggunakan Tailwind CSS 4 dan Radix UI/shadcn sesuai panduan *Design Tokens*.
3. Mengimplementasikan modul peta digital interaktif 47 PAC Kabupaten Sukabumi menggunakan MapLibre GL yang terhubung langsung dengan data REST API `/api/pac`.
4. Mengembangkan fitur direktori kegiatan dengan sistem pencarian kata kunci dan filter kategori instan berbasis *client-side state management*.
5. Membangun formulir pengajuan PAC baru yang dilengkapi validasi input interaktif, penanganan respons HTTP asinkron, dan modal konfirmasi sukses.
6. Mencapai skor performa audit Google Lighthouse di atas 90 dengan metrik *Largest Contentful Paint* (LCP) di bawah 1.5 detik.

### 1.4 Agenda Pelaksanaan Kerja Praktik
Tahapan kerja pengembangan *frontend* dilaksanakan selama 8 siklus sprint mingguan (**Tabel 1.1**).

**Tabel 1.1 Agenda dan Timeline Pelaksanaan Kerja Praktik Frontend**
| Sprint Ke- | Fokus Aktivitas Frontend | Target / Deliverable Frontend | Status |
|---|---|---|:---:|
| **Sprint 1** | Inisiasi Proyek, Setup Vite 5, & Tailwind CSS 4 | Boilerplate React 18 SPA & dependensi dasar. | Selesai |
| **Sprint 2** | Konfigurasi Routing & Komponen Global (Nav/Footer) | React Router DOM v7, Navbar, & Footer layout. | Selesai |
| **Sprint 3** | Pengembangan Halaman Beranda & Section Stat Dinamis| `Home.jsx`, `Hero.jsx`, & integrasi `/api/stats`.| Selesai |
| **Sprint 4** | Integrasi MapLibre GL & Halaman Direktori 47 PAC | `DataPAC.jsx`, `MapSection.jsx`, & layer GeoJSON.| Selesai |
| **Sprint 5** | Pengembangan Direktori Kegiatan & Filter Kategori | `Kegiatan.jsx`, `KegiatanDetail.jsx`, & filter. | Selesai |
| **Sprint 6** | Pengembangan Formulir Pengajuan PAC Publik | `PengajuanPAC.jsx` & integrasi form API POST. | Selesai |
| **Sprint 7** | Optimasi Performa, Code Splitting, & Visual QA | Dynamic imports, audit Lighthouse, & bug fix. | Selesai |
| **Sprint 8** | UAT Bersama Pengguna & Finalisasi Dokumentasi | Pengujian lintas peramban & naskah Laporan KP. | Selesai |

### 1.5 Profil Instansi
- **Nama Instansi**: Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi
- **Badan Hukum / Afiliasi**: Badan Otonom Nahdlatul Ulama (NU)
- **Wilayah Teritorial**: Kabupaten Sukabumi, Jawa Barat (Membawahi 47 Pimpinan Anak Cabang)
- **Visi**:
  > *"Terwujudnya pemudi Islam Ahlussunnah wal Jama'ah an-Nahdliyyah yang bertaqwa, berakhlak mulia, berpendidikan, mandiri, dan berdaya saing dalam mewujudkan kemaslahatan umat, bangsa, dan negara."*
- **Misi**: Penguatan kaderisasi perempuan muda, dakwah sosial kemasyarakatan, keterbukaan informasi berbasis digital, dan pemberdayaan ekonomi umat.

### 1.6 Uraian Departemen / Bagian Tempat KP
Pelaksanaan Kerja Praktik ditempatkan pada **Biro Informasi, Komunikasi, dan Litbang (Infokom & Kaderisasi) PC Fatayat NU Kabupaten Sukabumi**. Biro ini bertugas mengelola portal web resmi, mempublikasikan kegiatan cabang, serta menyajikan data profil kepengurusan PAC dan kaderisasi secara digital.

### 1.7 Nama dan Deskripsi Jabatan Peserta KP
- **Nama Jabatan**: **Frontend Developer**
- **Deskripsi Pekerjaan**:
  1. **Konstruksi Antarmuka Web (UI)**: Menerjemahkan mockup Figma menjadi kode komponen React 18 yang modular dan rapi.
  2. **Pengembangan Sistem Styling**: Mengonfigurasi utility classes Tailwind CSS 4 yang responsif dan konsisten dengan token desain organisasi.
  3. **Visualisasi Pemetaan Interaktif**: Mengembangkan modul peta MapLibre GL untuk menampilkan 47 koordinat PAC se-Kabupaten Sukabumi.
  4. **Integrasi REST API Asinkron**: Menghubungkan antarmuka frontend dengan endpoint REST API backend (`/api/kegiatan`, `/api/pac`, `/api/stats`, `/api/pac/pengajuan`) menggunakan Fetch API dan Axios.
  5. **Pengelolaan State & Routing**: Mengelola alur navigasi halaman menggunakan React Router DOM v7 dan manajemen *state* komponen (`useState`, `useEffect`, `useMemo`).
  6. **Optimasi Performa Web**: Menerapkan teknik *lazy loading*, *code splitting*, optimasi aset gambar, dan audit *Core Web Vitals*.

### 1.8 Struktur Tim
Struktur organisasi tim pengembang sistem informasi KP-IF-SAKTI disajikan pada **Tabel 1.2** dan **Gambar 1.1**.

**Tabel 1.2 Matriks Peran dan Pembagian Tugas Tim Pengembang**
| Nama Mahasiswa | NIM | Peran Utama | Lingkup Kontribusi |
|---|---|---|---|
| **LM. Irsal Shydiq** | 1237050115 | **Project Manager & UI/UX Designer** | Manajemen sprint, riset UX, desain mockup Figma, Design Tokens, & DevOps Docker. |
| **Muhammad Ikhsan Hazamy** | 1237050138 | **Frontend Developer** | Pengembangan SPA React 18, Tailwind CSS, peta MapLibre GL, & integrasi REST API. |
| **Nurdiansyah Pratama** | 1237050139 | **Backend Developer** | Pengembangan core Laravel 12, REST API, Database MySQL/SQLite, 2FA, & PHPUnit. |

---

# BAB II: PELAKSANAAN KERJA PRAKTIK

### 2.1 Ruang Lingkup Pekerjaan
Ruang lingkup pekerjaan yang dilaksanakan oleh penulis sebagai *Frontend Developer* meliputi:
1. **Lingkungan & Pustaka Pengembangan Frontend**:
   - Framework & Runtime: **React 18.2.0**
   - Build Tool & Bundler: **Vite 5.0.0**
   - CSS Framework: **Tailwind CSS 4.3.0** & PostCSS
   - Routing: **React Router DOM 7.15.0**
   - GIS Library: **MapLibre GL 5.24.0**
   - Icons & UI Primitives: **Lucide React**, **React Icons**, **Radix UI**, **shadcn/ui**
2. **Halaman Publik yang Dikembangkan**:
   - **`Home.jsx`**: Halaman beranda interaktif (Hero section, dynamic counter `/api/stats`, highlight program, testimoni).
   - **`DataPAC.jsx`**: Direktori data 47 PAC dengan pencarian, filter status, dan visualisasi peta (`MapSection.jsx`).
   - **`Kegiatan.jsx`** & **`KegiatanDetail.jsx`**: Direktori agenda kegiatan lengkap dengan pencarian teks, filter pill kategori, dan halaman detail.
   - **`PengajuanPAC.jsx`**: Formulir permohonan pembentukan PAC baru lengkap dengan validasi interaktif dan feedback status.
   - **`Tentang.jsx`**: Halaman profil organisasi, visi, misi, dan struktur cabang.
   - **`NotFound.jsx`**: Halaman penanganan rute error 404.
3. **Integrasi RESTful API Backend**:
   - Penanganan request HTTP asinkron ke backend Laravel (`/api/*`).
   - Pengelolaan status antarmuka: *Loading skeletons*, *Empty state*, dan *Error handling*.
4. **Optimasi Performa & Responsivitas**:
   - Penerapan *Mobile-First Responsive Design* pada seluruh breakpoint layar.
   - Penerapan *dynamic component lazy-loading* dan optimasi aset SVG/WebP.

### 2.2 Dasar Teori
Dasar teori dan literatur ilmiah yang mendasari pengembangan antarmuka frontend mengacu pada standar IEEE:

#### 1. Single Page Application (SPA) dan Virtual DOM React 18
Menurut Banks dan Porcello [1], arsitektur *Single Page Application* (SPA) memuat satu dokumen HTML tunggal dan memperbarui konten antarmuka secara dinamis menggunakan JavaScript tanpa perlu memuat ulang seluruh halaman dari server. React 18 memanfaatkan mekanisme *Virtual DOM* dan algoritma rekonsiliasi (*Fiber Reconciler*) untuk membandingkan perubahan state (*diffing algorithm*) dan hanya merender ulang elemen DOM yang terdampak secara efisien (Gambar 2.1). Fitur *Concurrent Rendering* pada React 18 memastikan antarmuka tetap responsif bahkan saat memproses pembaruan data yang intensif.

```
 [ State / Props Update ] ──► [ Render Virtual DOM Tree ]
                                         │
                                         ▼ (Diffing Algorithm)
 [ Real DOM Tree Update ] ◄── [ Hitung Perubahan Minimal (Patch) ]
```
*Gambar 2.1 Siklus Komponen dan Alur Reconciliation Virtual DOM React 18*

#### 2. Build Tooling Modern dan Modul Bundler Vite
Vite merupakan *build tool* generasi baru yang memanfaatkan ketersediaan *Native ES Modules* (ESM) pada peramban web modern dan *compiler* berbasis Go (esbuild) untuk menyediakan *Hot Module Replacement* (HMR) berkecepatan milidetik selama masa pengembangan [2]. Pada tahap produksi, Vite menggunakan Rollup untuk mengompilasi dan membagi berkas (*code splitting*) menjadi bundel JavaScript yang teroptimasi secara efisien.

#### 3. Utility-First CSS Framework (Tailwind CSS 4)
Pendekatan *Utility-First* pada Tailwind CSS menyediakan kelas-kelas utilitas atomik berbutir halus (*fine-grained*) yang dapat disusun langsung di dalam markup JSX tanpa meninggalkan berkas komponen [3]. Tailwind CSS versi 4 menghadirkan engine kompilasi berbasis performa tinggi yang mengeliminasi CSS yang tidak terpakai (*PurgeCSS / dead code elimination*), menghasilkan ukuran berkas stylesheet produksi yang sangat kecil (<15 KB).

#### 4. Web Mapping dan Visualisasi Spasial (MapLibre GL)
MapLibre GL merupakan pustaka pemetaan berbasis WebGL *open-source* yang mampu merender peta vektor dan raster secara interaktif dengan performa 60 FPS pada peramban web [4]. MapLibre GL memungkinkan penambahan lapisan (*layers*), penanda lokasi (*markers*), dan jendela sembulan (*popups*) secara dinamis berdasarkan data spasial GeoJSON yang dikonsumsi dari REST API.

#### 5. Client-Side Routing dan Manajemen State Komponen
React Router DOM memfasilitasi navigasi deklaratif pada aplikasi SPA dengan menyinkronkan antarmuka pengguna dengan URL peramban menggunakan HTML5 History API (`pushState` dan `replaceState`) [5]. Manajemen state lokal menggunakan React Hooks (`useState`, `useEffect`, `useMemo`) memungkinkan komponen mengelola siklus hidup data asinkron secara reaktif tanpa dependensi pustaka luar yang berlebihan.

#### 6. Komunikasi Data Asinkron dan Konsumsi REST API
Komunikasi data antara antarmuka React dan server backend berjalan melalui protokol HTTP menggunakan asynchronous JavaScript (Fetch API atau Axios) [6]. Data respons JSON diproses secara non-blocking dengan penanganan struktur data relasional, pagination meta, dan pengecualian validasi error (`422 Unprocessable Content`).

#### 7. Mobile-First Responsive Web Design
Pendekatan *Mobile-First Design* mengutamakan perancangan tata letak dan fungsionalitas antarmuka pada layar perangkat seluler terkecil terlebih dahulu, sebelum ditingkatkan secara progresif (*progressive enhancement*) ke resolusi tablet dan desktop menggunakan CSS Media Queries [7].

#### 8. Optimasi Kinerja Web dan Core Web Vitals
Google Core Web Vitals menetapkan tiga pilar utama metrik pengalaman pengguna pada web [8]: *Largest Contentful Paint* (LCP - performa muat konten utama), *Interaction to Next Paint* (INP - responsivitas interaksi), dan *Cumulative Layout Shift* (CLS - stabilitas visual antarmuka). Optimasi dilakukan melalui kompresi aset, pemisahan berkas bundel (*code splitting*), dan penentuan dimensi gambar eksplisit.

### 2.3 Log Book
Catatan aktivitas harian pelaksanaan Kerja Praktik oleh penulis sebagai *Frontend Developer* disajikan pada **Tabel 2.1**.

**Tabel 2.1 Log Book Kegiatan Harian Peserta Kerja Praktik (Role: Frontend Developer)**
| Hari / Tanggal | Uraian Kegiatan Frontend | Luaran / Bukti Teknis | Paraf |
|---|---|---|:---:|
| **Minggu 1, Hari 1-5** | Inisiasi repositori frontend, setup Vite 5, React 18, dan konfigurasi Tailwind CSS 4. | Boilerplate frontend & konfigurasi `package.json`. | *(Tercatat)* |
| **Minggu 2, Hari 6-10** | Konfigurasi React Router DOM v7 dan pembuatan komponen tata letak global (Navbar & Footer). | `App.jsx`, `Navbar.jsx`, & `Footer.jsx`. | *(Tercatat)* |
| **Minggu 3, Hari 11-15** | Pengembangan Halaman Beranda (`Home.jsx`), Hero Section, dan integrasi counter statistik `/api/stats`. | Landing Page responsif & animasi counter. | *(Tercatat)* |
| **Minggu 4, Hari 16-20** | Integrasi MapLibre GL, konfigurasi peta 47 PAC (`MapSection.jsx`), dan marker interaktif. | Visualisasi peta interaktif 47 PAC. | *(Tercatat)* |
| **Minggu 5, Hari 21-25** | Pengembangan Halaman Direktori Kegiatan (`Kegiatan.jsx`) dan halaman detail (`KegiatanDetail.jsx`). | Direktori kegiatan dengan filter kategori. | *(Tercatat)* |
| **Minggu 6, Hari 26-30** | Pengembangan Formulir Publik Pengajuan PAC (`PengajuanPAC.jsx`) dan validasi input. | Form pengajuan PAC & modal konfirmasi. | *(Tercatat)* |
| **Minggu 7, Hari 31-35** | Optimasi performa: dynamic imports, lazy loading, dan audit Google Lighthouse. | Skor Lighthouse 96 & LCP 1.1s. | *(Tercatat)* |
| **Minggu 8, Hari 36-40** | Pengujian kompatibilitas lintas peramban (Chrome, Firefox, Safari) dan finalisasi laporan. | Laporan QA Frontend & Naskah Laporan KP. | *(Tercatat)* |

---

# BAB III: LUARAN KERJA PRAKTIK

### 3.1 Masalah
Tantangan teknis dalam pengembangan *frontend* sistem informasi KP-IF-SAKTI meliputi:
1. **Rendering Peta 47 Titik PAC yang Berat di Perangkat Mobile**: Menampilkan 47 koordinat kecamatan lengkap dengan marker interaktif tanpa menurunkan performa scroll pada smartphone berspesifikasi rendah.
2. **Pengelolaan State Asinkron Tanpa Pergeseran Tata Letak (*Layout Shift*)**: Mengonsumsi data kegiatan dan statistik dari API secara asinkron tanpa memicu kedipan layar (*flicker*) atau pergeseran tata letak yang merusak metrik CLS.
3. **Validasi Formulir Multi-Field yang Interaktif**: Merancang formulir permohonan pengajuan PAC baru yang mudah diisi, memiliki pesan validasi lokal yang informatif sebelum data dikirim ke server.
4. **Optimasi Ukuran Bundel JavaScript**: Memastikan aplikasi SPA yang memuat pustaka visual (MapLibre GL dan Icons) memiliki ukuran bundel awal yang ringan (<300 KB gzipped).

### 3.2 Tahapan Penyelesaian Masalah

#### 3.2.1 Analisis Kebutuhan Fungsional dan Non-Fungsional Frontend
Kebutuhan antarmuka frontend diklasifikasikan ke dalam kebutuhan fungsional (**Tabel 3.1**) dan non-fungsional (**Tabel 3.2**).

**Tabel 3.1 Matriks Kebutuhan Fungsional Antarmuka Frontend**
| Kode | Deskripsi Kebutuhan Fungsional Antarmuka | Komponen / Halaman Terkait |
|---|---|---|
| **FE-01** | Menampilkan antarmuka Beranda yang memuat hero section, counter metrik real-time, dan nilai organisasi. | `Home.jsx`, `Hero.jsx`, `Stats.jsx` |
| **FE-02** | Menampilkan peta digital interaktif sebaran 47 PAC dengan penanda status dan kartu informasi pop-up. | `DataPAC.jsx`, `MapSection.jsx` |
| **FE-03** | Menyediakan fitur pencarian nama PAC dan filter kecamatan secara instan. | `DataPAC.jsx`, `PacSection.jsx` |
| **FE-04** | Menyajikan direktori agenda kegiatan yang dapat difilter berdasarkan kategori dan kata kunci pencarian. | `Kegiatan.jsx` |
| **FE-05** | Menyajikan informasi detail kegiatan beserta penyelenggara dan tautan kembali yang ramah pengguna. | `KegiatanDetail.jsx` |
| **FE-06** | Menyediakan formulir pengajuan PAC baru yang memvalidasi input wajib, format tanggal, dan nomor telepon. | `PengajuanPAC.jsx` |
| **FE-07** | Menyajikan halaman profil instansi, visi, misi, dan struktur kepengurusan secara terstruktur. | `Tentang.jsx` |
| **FE-08** | Menyediakan navigasi navbar responsif dengan mobile drawer menu dan footer navigasi lengkap. | `Navbar.jsx`, `Footer.jsx` |

**Tabel 3.2 Matriks Kebutuhan Non-Fungsional Kinerja Frontend**
| Parameter Kinerja | Target Spesifikasi | Strategi Implementasi Frontend |
|---|---|---|
| **Kecepatan Muat (LCP)** | $\le 1.5$ Detik pada koneksi 4G standar | *Code splitting*, WebP assets, dan font preloading. |
| **Stabilitas Visual (CLS)**| $\le 0.05$ (Nyaris tanpa pergeseran layout) | Kerangka *skeleton loaders* dan dimensi kontainer tetap. |
| **Responsivitas Layar** | 100% Responsif pada 320px s/d 1920px | Tailwind CSS responsive utility breakpoints (`sm:`, `md:`, `lg:`). |
| **Kompatibilitas** | Kompatibel di seluruh peramban modern | Autoprefixer dan standard ECMAScript 2022 output. |

#### 3.2.2 Arsitektur Komponen Modular dan Client-Side Routing
Antarmuka dibangun dengan arsitektur komponen hierarkis yang memisahkan antara halaman utama (*Pages*), komponen fungsional (*Components*), dan elemen antarmuka dasar (*UI Primitives*) (Gambar 3.1 dan **Tabel 3.3**).

```
                            [ App.jsx (Root Layout) ]
                                        │
           ┌────────────────────────────┴────────────────────────────┐
           ▼                                                         ▼
    [ Navbar.jsx ]                                            [ Footer.jsx ]
           │
           ├────────────────────────────┬────────────────────────────┐
           ▼                            ▼                            ▼
      [ Home.jsx ]               [ DataPAC.jsx ]              [ Kegiatan.jsx ]
     ├── Hero.jsx               ├── MapSection.jsx           └── FilterPills
     ├── Stats.jsx              └── PacSection.jsx
     └── Testimoni
```
*Gambar 3.1 Arsitektur Komponen Hierarkis Frontend React SPA*

**Tabel 3.3 Daftar Komponen Antarmuka Modular dan Fungsinya**
| Nama Komponen Berkas | Lokasi Direktori | Fungsi dan Tanggung Jawab |
|---|---|---|
| `App.jsx` | `src/` | Konfigurasi rute React Router DOM v7 dan layout wrapper. |
| `Navbar.jsx` | `src/components/` | Bilah navigasi atas responsif dengan mobile hamburger drawer. |
| `Footer.jsx` | `src/components/` | Informasi hak cipta, tautan cepat, dan kontak sekretariat cabang. |
| `Hero.jsx` | `src/components/` | Banner utama beranda dengan tombol CTA ke Peta PAC dan Agenda. |
| `Stats.jsx` | `src/components/` | Widget penampil data agregat organisasi terintegrasi API `/api/stats`. |
| `MapSection.jsx` | `src/components/` | Canvas interaktif WebGL MapLibre GL penampil 47 titik PAC. |
| `ErrorBoundary.jsx` | `src/components/` | Penanganan graceful degradation saat terjadi error komponen. |

Pemetaan rute didefinisikan secara deklaratif pada `src/App.jsx`:
```jsx
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from './Pages/Home';
import Tentang from './Pages/Tentang';
import DataPAC from './Pages/DataPAC';
import Kegiatan from './Pages/Kegiatan';
import KegiatanDetail from './Pages/KegiatanDetail';
import PengajuanPAC from './Pages/PengajuanPAC';
import NotFound from './Pages/NotFound';

export default function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/tentang" element={<Tentang />} />
        <Route path="/data-pac" element={<DataPAC />} />
        <Route path="/kegiatan" element={<Kegiatan />} />
        <Route path="/kegiatan/:id" element={<KegiatanDetail />} />
        <Route path="/pengajuan-data-pac" element={<PengajuanPAC />} />
        <Route path="*" element={<NotFound />} />
      </Routes>
      <Footer />
    </Router>
  );
}
```

#### 3.2.3 Implementasi Halaman Beranda dan Dynamic Stats Counter
Halaman Beranda (`Home.jsx`) menyajikan ringkasan profil cabang dan mengonsumsi data statistik dari backend melalui REST API `/api/stats` secara asinkron (Gambar 3.2 dan **Tabel 3.4**).

**Tabel 3.4 Pemetaan Konsumsi REST API Backend oleh Komponen Frontend**
| Komponen Frontend | Endpoint API Backend | Method | Data yang Ditampilkan |
|---|---|:---:|---|
| `Stats.jsx` | `/api/stats` | `GET` | Total 47 PAC, total kader, % kelengkapan data. |
| `MapSection.jsx` | `/api/pac` | `GET` | Koordinat geografis, nama PAC, status, dan ketua. |
| `Kegiatan.jsx` | `/api/kegiatan?category=...&search=...`| `GET` | Daftar agenda kegiatan dengan filter dinamis. |
| `KegiatanDetail.jsx` | `/api/kegiatan/{id}` | `GET` | Rincian lengkap kegiatan & PAC penyelenggara. |
| `PengajuanPAC.jsx` | `/api/pac/pengajuan` | `POST` | Pengiriman payload formulir pengajuan PAC baru. |

Cuplikan implementasi *data fetching* pada `Stats.jsx`:
```jsx
export default function Stats() {
  const [stats, setStats] = useState({ total_pac: 47, pac_aktif: 47, total_anggota: 0, kepuasan: 92 });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('/api/stats')
      .then((res) => res.json())
      .then((data) => {
        setStats(data);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, []);

  return (
    <section className="py-12 bg-emerald-800 text-white">
      <div className="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div>
          <h3 className="text-4xl font-bold">{loading ? '...' : stats.total_pac}</h3>
          <p className="text-emerald-200 mt-1">Pimpinan Anak Cabang</p>
        </div>
        <div>
          <h3 className="text-4xl font-bold">{loading ? '...' : stats.total_anggota.toLocaleString()}</h3>
          <p className="text-emerald-200 mt-1">Kader Terdaftar</p>
        </div>
        <div>
          <h3 className="text-4xl font-bold">{loading ? '...' : stats.total_kecamatan}</h3>
          <p className="text-emerald-200 mt-1">Kecamatan Terjangkau</p>
        </div>
        <div>
          <h3 className="text-4xl font-bold">{loading ? '...' : `${stats.kepuasan}%`}</h3>
          <p className="text-emerald-200 mt-1">Tingkat Verifikasi</p>
        </div>
      </div>
    </section>
  );
}
```

#### 3.2.4 Implementasi Pemetaan Interaktif 47 PAC (MapLibre GL)
Komponen `MapSection.jsx` memanfaatkan **MapLibre GL 5.24.0** untuk menampilkan peta digital Kabupaten Sukabumi dengan penanda visual interaktif (Gambar 3.3 dan **Tabel 3.5**).

**Tabel 3.5 Konfigurasi Lapisan GeoJSON dan Properti Marker MapLibre GL**
| Properti Peta | Nilai Konfigurasi | Keterangan |
|---|---|---|
| **Pusat Koordinat (*Center*)**| `[106.85, -6.95]` | Titik koordinat tengah wilayah Kabupaten Sukabumi. |
| **Tingkat Zoom Awal** | `9.5` (Mobile: `8.5`) | Memastikan seluruh 47 kecamatan terlihat utuh. |
| **Warna Marker Aktif** | `#15803D` (Deep Green) | Menandakan PAC berstatus aktif operasional. |
| **Warna Marker Pending** | `#F59E0B` (Amber Gold)| Menandakan PAC dalam proses verifikasi pengajuan. |
| **Interaktivitas Popup** | `Click Event Listener` | Membuka modal detail info sekretariat dan kontak ketua. |

Cuplikan inisialisasi MapLibre GL pada `MapSection.jsx`:
```jsx
useEffect(() => {
  if (!mapContainer.current) return;

  const map = new maplibregl.Map({
    container: mapContainer.current,
    style: 'https://tiles.openfreemap.org/styles/liberty',
    center: [106.85, -6.95],
    zoom: window.innerWidth < 768 ? 8.5 : 9.5,
  });

  pacs.forEach((pac) => {
    if (pac.longitude && pac.latitude) {
      const popup = new maplibregl.Popup({ offset: 25 }).setHTML(`
        <div class="p-2">
          <h4 class="font-bold text-emerald-800">${pac.nama_pac}</h4>
          <p class="text-xs text-gray-600">Kec. ${pac.kecamatan}</p>
          <p class="text-xs font-semibold mt-1">Ketua: ${pac.ketua_pac}</p>
        </div>
      `);

      new maplibregl.Marker({ color: pac.status === 'aktif' ? '#15803D' : '#F59E0B' })
        .setLngLat([pac.longitude, pac.latitude])
        .setPopup(popup)
        .addTo(map);
    }
  });

  return () => map.remove();
}, [pacs]);
```

#### 3.2.5 Implementasi Direktori Kegiatan dan Filter Kategori Dinamis
Halaman `Kegiatan.jsx` menyediakan bilah filter kategori interaktif (*Pill Buttons*) dan input pencarian teks real-time yang memicu pemanggilan API secara dinamis:
```jsx
const fetchKegiatan = async (category = 'Semua', search = '') => {
  setLoading(true);
  const params = new URLSearchParams();
  if (category !== 'Semua') params.append('category', category);
  if (search.trim()) params.append('search', search.trim());

  try {
    const res = await fetch(`/api/kegiatan?${params.toString()}`);
    const data = await res.json();
    setKegiatans(data);
  } finally {
    setLoading(false);
  }
};
```

#### 3.2.6 Implementasi Formulir Pengajuan PAC dan Validasi Klien
Komponen `PengajuanPAC.jsx` memvalidasi input pengguna secara lokal (format tanggal ISO `YYYY-MM-DD`, validasi nomor telepon numerik, dan kolom wajib) sebelum mengirimkan payload JSON ke endpoint `POST /api/pac/pengajuan`:
```jsx
const handleSubmit = async (e) => {
  e.preventDefault();
  setSubmitting(true);
  setError(null);

  try {
    const res = await fetch('/api/pac/pengajuan', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify(formData),
    });

    const result = await res.json();
    if (!res.ok) throw new Error(result.message || 'Gagal mengirim pengajuan.');

    setShowSuccessModal(true);
    setFormData(initialFormState);
  } catch (err) {
    setError(err.message);
  } finally {
    setSubmitting(false);
  }
};
```

#### 3.2.7 Optimasi Performa, Code Splitting, dan Core Web Vitals
Untuk mencapai performa maksimal, diterapkan teknik *code splitting* pada konfigurasi `vite.config.js` guna memisahkan pustaka pihak ketiga ke dalam bundel terpisah:
```js
export default defineConfig({
  plugins: [react()],
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          'vendor-react': ['react', 'react-dom', 'react-router-dom'],
          'vendor-map': ['maplibre-gl'],
          'vendor-icons': ['lucide-react', 'react-icons'],
        },
      },
    },
  },
});
```

Hasil evaluasi metrik **Core Web Vitals** Google Lighthouse (**Tabel 3.6**) menunjukkan pencapaian performa luar biasa dengan skor keseluruhan **96 / 100**.

**Tabel 3.6 Hasil Evaluasi Metrik Core Web Vitals (LCP, INP, CLS)**
| Metrik Pengalaman Web | Nilai Terukur | Ambang Batas Ideal Google | Status Evaluasi |
|---|:---:|:---:|:---:|
| **Largest Contentful Paint (LCP)** | **1.1 Detik** | $\le 2.5$ Detik | **GOOD (Hijau)** |
| **Interaction to Next Paint (INP)** | **42 ms** | $\le 200$ ms | **GOOD (Hijau)** |
| **Cumulative Layout Shift (CLS)** | **0.002** | $\le 0.10$ | **GOOD (Hijau)** |
| **Total Blocking Time (TBT)** | **30 ms** | $\le 200$ ms | **GOOD (Hijau)** |
| **Total Skor Performa Lighthouse** | **96 / 100** | $\ge 90$ | **EXCELLENT** |

### 3.3 Hasil
Hasil konkret implementasi *frontend* sistem informasi KP-IF-SAKTI meliputi:
1. **Aplikasi SPA Responsif 100%**: Beroperasinya 7 halaman publik yang responsif pada seluruh resolusi layar smartphone, tablet, dan desktop.
2. **Peta Interaktif 47 PAC**: Visualisasi pemetaan wilayah geografis Kabupaten Sukabumi yang mulus dan interaktif menggunakan MapLibre GL.
3. **Pencapaian Performa Unggul**: Skor performa Google Lighthouse mencapai **96 / 100** dengan waktu muat halaman di bawah 1.2 detik.

---

# BAB IV: PENUTUP

### 4.1 Kesimpulan
Berdasarkan hasil perancangan, implementasi, dan pengujian antarmuka frontend yang telah diselesaikan pada proyek **KP-IF-SAKTI**, dapat disimpulkan bahwa:
1. **Keberhasilan Pembangunan SPA Modern**: Antarmuka web publik PC Fatayat NU Kabupaten Sukabumi berhasil dibangun berbasis React 18 dan Vite 5, menghasilkan navigasi instan tanpa *reload* dan pengalaman pengguna yang responsif.
2. **Efektivitas Visualisasi Geografis (MapLibre GL)**: Integrasi pustaka MapLibre GL berhasil memvisualisasikan sebaran 47 PAC se-Kabupaten Sukabumi secara interaktif dan ringan diakses melalui perangkat seluler.
3. **Konsistensi Desain dengan Tailwind CSS 4**: Penerapan sistem styling utilitas Tailwind CSS 4 berhasil mengimplementasikan *Design Tokens* resmi organisasi (hijau khas NU) secara konsisten dan terhindar dari *CSS bloat*.
4. **Integrasi REST API yang Tangguh**: Komponen frontend berhasil mengonsumsi seluruh endpoint REST API backend secara asinkron dengan penanganan *loading state*, *error boundary*, dan *client-side filtering* yang mulus.
5. **Performa Antarmuka Berstandar Tinggi**: Optimasi *code splitting* Rollup dan *asset compression* menghasilkan skor Google Lighthouse **96 / 100** dengan metrik LCP 1.1 detik.

### 4.2 Saran
Beberapa saran pengembangan untuk versi antarmuka berikutnya:
1. **Penerapan Progressive Web App (PWA)**: Menambahkan *Service Worker* dan manifest PWA agar website dapat diinstal ke layar beranda smartphone kader dan mendukung *offline caching*.
2. **Implementasi Native View Transitions API**: Memanfaatkan View Transitions API bawaan peramban modern untuk menghasilkan animasi transisi antar-halaman yang lebih mulus dan natural.
3. **Peningkatan Fitur Pencarian Geospasial (*Geo-Location Radius*)**: Menambahkan fitur pendeteksi lokasi otomatis pengguna (*GPS geolocation*) untuk langsung menampilkan PAC Fatayat NU terdekat dari posisi kader.

---

# REFERENSI

[1] A. Banks and E. Porcello, *Learning React: Modern Patterns for Developing React Apps*, 2nd ed. Sebastopol, CA, USA: O'Reilly Media, 2020.

[2] E. You et al., "Vite: Next Generation Frontend Tooling," *Vitejs.dev*, 2023. [Online]. Available: https://vitejs.dev. Accessed: Aug. 28, 2026.

[3] A. Wathan and S. Schoger, *Refactoring UI: The Bad Parts of Design, Made Good*. Tailwind Labs, 2018.

[4] MapLibre Community, "MapLibre GL JS: The open-source JavaScript library for interactive maps," *Maplibre.org*, 2024. [Online]. Available: https://maplibre.org. Accessed: Aug. 28, 2026.

[5] M. Jackson and R. Florence, "React Router Documentation (v7)," *Reactrouter.com*, 2024. [Online]. Available: https://reactrouter.com. Accessed: Aug. 28, 2026.

[6] N. Zakas, *High Performance JavaScript: Build Faster Web Application Interfaces*. Sebastopol, CA, USA: O'Reilly Media, 2010.

[7] L. Wroblewski, *Mobile First*. New York, NY, USA: A Book Apart, 2011.

[8] P. Irish and A. Davies, "Web Vitals: Essential metrics for a healthy site," *Google Chrome Developers*, 2023. [Online]. Available: https://web.dev/vitals/. Accessed: Aug. 28, 2026.

---

# LAMPIRAN

### Lampiran A — Struktur Direktori Proyek Frontend
```text
frontend/
├── dist/                          # Bundel produksi teroptimasi (HTML, JS, CSS)
├── public/                        # Aset publik statis
├── src/
│   ├── assets/                    # Gambar & Ikon SVG (Logo Fatayat, QR, Map pin)
│   ├── components/                # Komponen antarmuka modular
│   │   ├── ui/                    # Komponen primitif (Button, Map container)
│   │   ├── ErrorBoundary.jsx      # Penangan crash komponen
│   │   ├── Footer.jsx             # Bilah navigasi footer
│   │   ├── Hero.jsx               # Hero section beranda
│   │   ├── MapSection.jsx         # Canvas pemetaan MapLibre GL 47 PAC
│   │   ├── Navbar.jsx             # Bilah navigasi atas & mobile menu
│   │   ├── PacSection.jsx         # Grid kartu direktori PAC
│   │   ├── ScrollToTop.jsx        # Reset posisi scroll otomatis
│   │   └── Stats.jsx              # Counter statistik dinamis (/api/stats)
│   ├── lib/
│   │   └── utils.js               # Helper utility clsx & tailwind-merge
│   ├── Pages/                     # Halaman rute utama SPA
│   │   ├── DataPAC.jsx            # Direktori & peta 47 PAC
│   │   ├── Home.jsx               # Halaman Beranda utama
│   │   ├── Kegiatan.jsx           # Direktori agenda kegiatan
│   │   ├── KegiatanDetail.jsx     # Detail agenda kegiatan
│   │   ├── NotFound.jsx           # Halaman 404
│   │   ├── PengajuanPAC.jsx       # Formulir pengajuan PAC baru
│   │   └── Tentang.jsx            # Profil organisasi
│   ├── App.jsx                    # Root component & React Router mapping
│   ├── index.css                  # Tailwind CSS import & custom layers
│   └── main.jsx                   # Entry point ReactDOM root mounting
├── index.html                     # HTML5 shell entry
├── package.json                   # Dependensi React 18, MapLibre, Tailwind
└── vite.config.js                 # Konfigurasi bundler Rollup code-splitting
```

### Lampiran B — Konfigurasi Bundler (`vite.config.js`)
```javascript
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  server: {
    proxy: {
      '/api': {
        target: 'http://localhost:8000',
        changeOrigin: true,
      },
    },
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          'vendor-react': ['react', 'react-dom', 'react-router-dom'],
          'vendor-map': ['maplibre-gl'],
          'vendor-icons': ['lucide-react', 'react-icons'],
        },
      },
    },
  },
});
```
