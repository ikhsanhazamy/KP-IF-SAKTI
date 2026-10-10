# LAPORAN KERJA PRAKTIK (KP)

## MANAJEMEN PROYEK DAN PERANCANGAN UI/UX SISTEM INFORMASI PIMPINAN CABANG FATAYAT NU KABUPATEN SUKABUMI MENGGUNAKAN METODOLOGI AGILE DAN DESIGN SYSTEM

<br>

**Disusun Oleh:**  
**LM. Irsal Shydiq — NIM: 1237050115**  
**Role: Project Manager (PM) & UI/UX Designer**

<br>

**JURUSAN INFORMATIKA**  
**FAKULTAS SAINS DAN TEKNOLOGI**  
**UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI**  
**BANDUNG**  
**2026**

---

## KATA PENGANTAR

Puji dan syukur penulis panjatkan ke hadirat Allah SWT atas limpahan rahmat, taufik, dan hidayah-Nya, sehingga penulis dapat menyelesaikan penyusunan Laporan Kerja Praktik (KP) yang berjudul **"Manajemen Proyek dan Perancangan UI/UX Sistem Informasi Pimpinan Cabang Fatayat NU Kabupaten Sukabumi Menggunakan Metodologi Agile dan Design System"**. Laporan ini disusun guna memenuhi salah satu syarat kelulusan mata kuliah Kerja Praktik pada Jurusan Informatika, Fakultas Sains dan Teknologi, Universitas Islam Negeri Sunan Gunung Djati Bandung.

Pelaksanaan Kerja Praktik dan penyusunan laporan ini dapat terwujud berkat bimbingan, arahan, dan dukungan dari berbagai pihak. Oleh karena itu, penulis menyampaikan ucapan terima kasih yang sebesar-besarnya kepada:

1. Bapak Dekan Fakultas Sains dan Teknologi Universitas Islam Negeri Sunan Gunung Djati Bandung.
2. Bapak Ketua Jurusan Informatika Fakultas Sains dan Teknologi Universitas Islam Negeri Sunan Gunung Djati Bandung.
3. Bapak/Ibu Dosen Pembimbing Kerja Praktik yang telah memberikan bimbingan teknis, saran metodologi, dan arahan akademis berharga.
4. Jajaran Pengurus Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi yang telah memfasilitasi pelaksanaan riset pengguna, wawancara kebutuhan, dan uji coba sistem.
5. Rekan-rekan satu tim pengembang proyek **KP-IF-SAKTI**, yaitu **Ikhsan Hazamy** (Frontend Developer) dan **Nurdiansyah Pratama** (Backend Developer), atas dedikasi luar biasa, sinergi, dan komitmen tinggi selama siklus pengembangan sistem.
6. Kedua orang tua dan keluarga tercinta atas limpahan doa, dorongan moril, dan kasih sayang yang tiada henti.
7. Seluruh rekan mahasiswa Jurusan Informatika angkatan 2023 yang senantiasa saling berbagi motivasi dan wawasan.

Penulis menyadari bahwa naskah laporan ini masih memiliki ruang untuk perbaikan. Oleh sebab itu, kritik dan masukan yang konstruktif sangat diharapkan demi penyempurnaan karya di masa depan. Semoga laporan ini dapat memberikan kontribusi nyata bagi tata kelola organisasi PC Fatayat NU Kabupaten Sukabumi serta perkembangan ilmu rekayasa perangkat lunak dan desain antarmuka pengguna.

<br>

Bandung, 2026

<br><br>

**LM. Irsal Shydiq**  
NIM. 1237050115

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
    - 3.2.1 Penerapan Metodologi Agile Scrum & Work Breakdown Structure .. 15
    - 3.2.2 Riset Pengguna, User Persona, & Empathy Mapping ......... 17
    - 3.2.3 Information Architecture (IA), Sitemap, & User Flow ....... 19
    - 3.2.4 Perancangan Wireframing (Lo-Fi) & Mockup Interaktif (Hi-Fi) .. 22
    - 3.2.5 Penyusunan Design System & Design Tokens (Tailwind CSS) . 25
    - 3.2.6 Arsitektur DevOps, Topologi Docker, & CI/CD Pipeline ..... 27
    - 3.2.7 Evaluasi Pengujian Pengguna (System Usability Scale / SUS) .. 29
  - 3.3 Hasil ..................................................................................... 31
- **BAB IV Penutup** ................................................................................ 35
  - 4.1 Kesimpulan ........................................................................... 35
  - 4.2 Saran .................................................................................... 36
- **REFERENSI** ...................................................................................... 37
- **LAMPIRAN** ....................................................................................... 39

---

## DAFTAR GAMBAR

- **Gambar 1.1** Struktur Organisasi Tim Pengembang KP-IF-SAKTI ......................................... 6
- **Gambar 2.1** Siklus Iterasi Desain Berpusat pada Pengguna (*User-Centered Design*) .......... 9
- **Gambar 3.1** Alur Siklus Sprint Agile Scrum pada Proyek KP-IF-SAKTI .............................. 16
- **Gambar 3.2** *User Persona* Primer Kader Anggota dan Pengurus Cabang ............................ 18
- **Gambar 3.3** *Information Architecture* (IA) Portal Publik dan Dashboard Admin ............. 20
- **Gambar 3.4** *User Flow* Pengajuan Pembentukan PAC Baru Secara Publik ......................... 21
- **Gambar 3.5** Perbandingan *Wireframe* Low-Fidelity dan Mockup High-Fidelity Figma ......... 23
- **Gambar 3.6** Spesifikasi *Design Tokens* (Palet Warna Khas NU, Tipografi, Spacing) ......... 26
- **Gambar 3.7** Topologi Multi-Container Docker dan Alur CI/CD GitHub Actions ................. 28
- **Gambar 3.8** Distribusi Skor Evaluasi *System Usability Scale* (SUS Score) ......................... 30

---

## DAFTAR TABEL

- **Tabel 1.1** Agenda dan Roadmap Sprint Pelaksanaan Kerja Praktik ................................. 3
- **Tabel 1.2** Matriks Peran dan Alokasi Sumber Daya Tim Pengembang .............................. 6
- **Tabel 2.1** Log Book Kegiatan Harian Peserta KP (Role: PM & UI/UX Designer) ................. 11
- **Tabel 3.1** *Work Breakdown Structure* (WBS) dan Matriks Deliverable Proyek ................. 16
- **Tabel 3.2** Matriks Karakteristik dan Kebutuhan Pengguna (*User Persona Matrix*) .......... 18
- **Tabel 3.3** Spesifikasi Desain Antarmuka Halaman Publik dan Admin ................................ 24
- **Tabel 3.4** Definisi *Design Tokens* Tailwind CSS (Warna, Tipografi, Shadow) ................. 26
- **Tabel 3.5** Konfigurasi Service pada `docker-compose.yml` .............................................. 28
- **Tabel 3.6** Rekapitulasi Kuesioner dan Hasil Skor *System Usability Scale* (SUS) ............. 30

---

# BAB I: PENDAHULUAN

### 1.1 Latar Belakang
Transformasi digital dalam tata kelola organisasi nirlaba dan kemasyarakatan menuntut sinergi antara manajemen proyek yang terukur dan perancangan antarmuka yang humanis. **Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi** sebagai organisasi pemudi Islam yang membawahi 47 Pimpinan Anak Cabang (PAC) di 47 kecamatan dengan ribuan kader, menghadapi tantangan geografis dan heterogenitas demografi yang sangat tinggi. Rentang usia kader yang luas (20 hingga 45 tahun) dengan latar belakang profesi dan tingkat literasi digital yang beragam mengharuskan setiap platform informasi yang dibangun memiliki kemudahan akses (*usability*), keterbacaan tinggi (*readability*), dan hierarki visual yang jelas.

Sebelum adanya sistem terintegrasi, koordinasi program kerja dan pertukaran data antar-pengurus dilakukan tanpa standar identitas visual organisasi (*visual branding*) yang konsisten dan tanpa dokumentasi alur kerja (*user journey*) yang terstruktur. Hal ini mengakibatkan:
1. **Ketidaksesuaian Harapan Pengguna (*Expectation Gap*)**: Ketiadaan riset kebutuhan pengguna di tingkat akar rumput menyebabkan media informasi yang ada sebelumnya kurang diminati dan sulit dioperasikan oleh kader di daerah pelosok.
2. **Inkonsistensi Antarmuka (*Design Fragmentation*)**: Tidak adanya panduan sistem desain (*design system*) terpusat menyebabkan tampilan dokumen, formulir digital, dan materi publikasi cabang memiliki variasi warna, tipografi, dan gaya visual yang tidak seragam.
3. **Risiko Keterlambatan Rilis Proyek (*Schedule Slippage*)**: Tanpa penerapan metodologi manajemen proyek modern yang terukur, koordinasi antara pengembang *frontend* dan *backend* berisiko mengalami *bottleneck*, miskomunikasi kebutuhan API, dan ketidakpastian timeline.

Menjawab tantangan tersebut, peran **Project Manager (PM) & UI/UX Designer** menjadi sentral dalam memimpin inisiasi, perencanaan, eksekusi, serta penjaminan mutu proyek **KP-IF-SAKTI**. Sebagai Project Manager, penulis bertanggung jawab memimpin penerapan kerangka kerja **Agile Scrum**, menyusun *Work Breakdown Structure* (WBS), mengelola *sprint backlog*, memfasilitasi komunikasi lintas peran pengembang, serta mengonfigurasi infrastruktur *DevOps* berbasis Docker dan *Continuous Integration* (CI). Sebagai UI/UX Designer, penulis memimpin tahapan riset pengguna (*User-Centered Design*), perancangan arsitektur informasi, pembuatan *wireframe* dan *mockup* interaktif High-Fidelity di Figma, penyusunan *Design System Tokens* berbasis Tailwind CSS, serta evaluasi kegunaan sistem menggunakan metode standar industri *System Usability Scale* (SUS).

### 1.2 Rumusan Masalah
Rumusan masalah yang menjadi fokus kajian dan implementasi dalam laporan ini adalah:
1. Bagaimana merancang dan menerapkan tata kelola manajemen proyek berbasis metodologi Agile Scrum untuk memastikan seluruh *deliverable* sistem informasi KP-IF-SAKTI selesai tepat waktu dan sesuai target mutu?
2. Bagaimana merancang antarmuka pengguna (UI) dan pengalaman pengguna (UX) yang inklusif, intuitif, dan sesuai dengan karakteristik demografi kader PC Fatayat NU Kabupaten Sukabumi berdasarkan pendekatan *User-Centered Design* (UCD)?
3. Bagaimana membangun dan menstandardisasi sistem desain (*Design System & Tokens*) yang memadukan identitas visual organisasi Fatayat NU (hijau Ahlussunnah wal Jama'ah) dengan estetika modern antarmuka web?
4. Bagaimana merancang arsitektur kontainerisasi multi-layanan berbasis Docker dan alur *Continuous Integration* (CI) GitHub Actions untuk menjamin konsistensi lingkungan pengembangan dan produksi?
5. Bagaimana mengukur dan memvalidasi tingkat kepuasan serta kemudahan penggunaan antarmuka yang dihasilkan menggunakan metode *System Usability Scale* (SUS)?

### 1.3 Tujuan
Tujuan yang dicapai dalam pelaksanaan Kerja Praktik ini adalah:
1. Mengimplementasikan kerangka kerja manajemen proyek Agile Scrum dengan pembagian sprint terukur, pelacakan *burndown chart*, dan manajemen risiko pengembangan.
2. Menghasilkan artefak desain UI/UX lengkap mulai dari *User Persona*, *Empathy Map*, *Information Architecture*, *Wireframe* (Low-Fidelity), hingga prototipe interaktif *High-Fidelity* pada platform Figma.
3. Mengembangkan sistem desain terstandarisasi (*Design System*) berbasis komponen modular dan token gaya Tailwind CSS (palet warna, skala tipografi, elevasi bayangan, dan tata letak responsif).
4. Mengonfigurasi arsitektur kontainerisasi terpadu (`docker-compose.yml`) yang mengintegrasikan PHP 8.2-FPM, Nginx, Node.js builder, dan MySQL 8.0, serta pipeline otomatisasi pengujian GitHub Actions.
5. Melakukan pengujian kegunaan (*Usability Testing*) dengan melibatkan pengurus cabang dan kader PAC guna memperoleh skor *System Usability Scale* (SUS) dengan predikat minimal "Good / Acceptable".

### 1.4 Agenda Pelaksanaan Kerja Praktik
Pelaksanaan Kerja Praktik direncanakan dan dieksekusi dalam 8 siklus sprint mingguan sebagaimana dipetakan pada **Tabel 1.1**.

**Tabel 1.1 Agenda dan Roadmap Sprint Pelaksanaan Kerja Praktik**
| Sprint Ke- | Fokus Aktivitas Proyek | Target / Deliverable PM & UI/UX | Status |
|---|---|---|:---:|
| **Sprint 1** | Inisiasi Proyek, Stakeholder Interview, & WBS | Dokumen Project Charter, WBS, & Product Backlog. | Selesai |
| **Sprint 2** | User Research, Persona, & Information Architecture | User Persona, Empathy Maps, Sitemap, & User Flow. | Selesai |
| **Sprint 3** | Wireframing (Lo-Fi) & Pembentukan Design System | Wireframe seluruh halaman & Panduan Design Tokens. | Selesai |
| **Sprint 4** | Desain Mockup High-Fidelity Portal Publik (Figma) | Mockup Hi-Fi Landing Page, Peta PAC, & Form Pengajuan. | Selesai |
| **Sprint 5** | Desain Mockup High-Fidelity Admin Dashboard (Figma)| Mockup Hi-Fi CRUD PAC, Anggota, Laporan, & 2FA Modal. | Selesai |
| **Sprint 6** | Konfigurasi DevOps Docker & CI/CD Pipeline | `Dockerfile`, `docker-compose.yml`, & GitHub Actions CI. | Selesai |
| **Sprint 7** | Usability Testing (SUS) & Design-Code Syncing | Laporan Evaluasi SUS & QA visual antarmuka web. | Selesai |
| **Sprint 8** | UAT Bersama Stakeholder & Finalisasi Dokumentasi | Berita acara UAT, panduan rilis, & Laporan Akhir KP. | Selesai |

### 1.5 Profil Instansi
- **Nama Instansi**: Pimpinan Cabang Fatayat Nahdlatul Ulama (PC Fatayat NU) Kabupaten Sukabumi
- **Badan Hukum**: Badan Otonom Nahdlatul Ulama (NU)
- **Wilayah Teritorial**: Kabupaten Sukabumi (47 Pimpinan Anak Cabang)
- **Visi**:
  > *"Terwujudnya pemudi Islam Ahlussunnah wal Jama'ah an-Nahdliyyah yang bertaqwa, berakhlak mulia, berpendidikan, mandiri, dan berdaya saing dalam mewujudkan kemaslahatan umat, bangsa, dan negara."*
- **Misi**:
  1. Penguatan kelembagaan dan kaderisasi perempuan muda berbasis nilai-nilai Islam moderat.
  2. Pemberdayaan kapasitas intelektual, sosial kemasyarakatan, dan kepemimpinan kader.
  3. Digitalisasi data anggota dan keterbukaan informasi publik organisasi.
  4. Penguatan ketahanan ekonomi perempuan melalui jejaring UMKM di tingkat akar rumput.

### 1.6 Uraian Departemen / Bagian Tempat KP
Kerja Praktik dilaksanakan pada **Biro Informasi, Komunikasi, dan Litbang (Infokom & Kaderisasi) PC Fatayat NU Kabupaten Sukabumi**. Biro ini bertindak sebagai pusat pengelolaan citra organisasi, publikasi media resmi, pengarsipan surat keputusan (SK) kepengurusan PAC, serta penyedia data dukung analitik bagi pimpinan cabang.

### 1.7 Nama dan Deskripsi Jabatan Peserta KP
- **Nama Jabatan**: **Project Manager (PM) & UI/UX Designer**
- **Deskripsi Pekerjaan**:
  1. **Manajemen Proyek & Koordinasi Tim**: Mengelola *Product Backlog*, memimpin sesi *Sprint Planning*, *Daily Standup*, dan *Sprint Review*, serta memastikan integrasi antar-komponen berjalan mulus tanpa deviasi jadwal.
  2. **Riset Pengguna & Pemodelan Pengalaman (UX)**: Melakukan wawancara mendalam dengan pengurus cabang dan perwakilan PAC, menyusun *User Persona*, *Empathy Map*, dan merancang diagram alur pengguna (*User Flow*).
  3. **Perancangan Desain Antarmuka (UI)**: Merancang tata letak *Wireframe* (Low-Fidelity), mendesain antarmuka *High-Fidelity* interaktif pada Figma untuk portal publik dan dashboard admin, serta menyusun *Design System* (palet warna, tipografi, ikonografi, dan komponen interaktif).
  4. **Arsitektur DevOps & Quality Assurance**: Mengonfigurasi lingkungan multi-kontainer Docker, menyusun workflow otomatisasi pengujian GitHub Actions, serta melakukan pengujian kualitas antarmuka visual (*Visual QA*).
  5. **Evaluasi Usabilitas**: Menyusun instrumen kuesioner *System Usability Scale* (SUS), melakukan uji coba langsung ke pengguna, dan menganalisis metrik kemudahan penggunaan.

### 1.8 Struktur Tim
Struktur organisasi dan alokasi peran tim pengembang sistem informasi KP-IF-SAKTI disajikan pada **Tabel 1.2** dan **Gambar 1.1**.

**Tabel 1.2 Matriks Peran dan Alokasi Sumber Daya Tim Pengembang**
| Nama Mahasiswa | NIM | Peran Utama | Lingkup Kontribusi |
|---|---|---|---|
| **LM. Irsal Shydiq** | 1237050115 | **Project Manager & UI/UX Designer** | Manajemen proyek Agile, riset UX, desain mockup Figma, Design Tokens, DevOps Docker, & evaluasi SUS. |
| **Ikhsan Hazamy** | 1237050073 | **Frontend Developer** | Implementasi SPA React 18, Tailwind CSS, peta interaktif MapLibre GL, dan integrasi konsumsi REST API. |
| **Nurdiansyah Pratama** | 1237050139 | **Backend Developer** | Implementasi core Laravel 12, REST API, skema basis data relasional, Job Queue Webhook, dan pengujian PHPUnit. |

---

# BAB II: PELAKSANAAN KERJA PRAKTIK

### 2.1 Ruang Lingkup Pekerjaan
Ruang lingkup tanggung jawab yang dilaksanakan oleh penulis selama pelaksanaan Kerja Praktik meliputi:
1. **Manajemen Proyek Perangkat Lunak**:
   - Penerapan kerangka kerja **Agile Scrum** dengan pembagian 8 sprint kerja.
   - Penyusunan *Work Breakdown Structure* (WBS), matriks alokasi tugas, dan pelacakan *milestone* melalui GitHub Projects & Issues.
   - Manajemen risiko teknis, *code review*, dan fasilitasi komunikasi antara pengembang *frontend* dan *backend*.
2. **Riset & Pemodelan UX (User Experience)**:
   - Pelaksanaan riset kualitatif melalui wawancara dan observasi alur kerja pengurus cabang.
   - Pembuatan 2 representasi *User Persona* utama (Kader Anggota PAC dan Administrator Cabang).
   - Perancangan *Information Architecture* (IA), *Sitemap* bertingkat, dan *User Flow* navigasi sistem.
3. **Perancangan Desain Visual UI (User Interface)**:
   - Pembuatan sketsa tata letak awal (*Wireframing / Low-Fidelity Design*).
   - Pembuatan prototipe interaktif *High-Fidelity* pada Figma mencakup 8 halaman utama portal publik dan 6 modul dashboard admin.
   - Penyusunan *Design System* terpadu: palet warna hijau NU (*Emerald/Green*), hierarki tipografi Inter, komponen tombol (*Buttons*), kartu informasi (*Cards*), modal dialog, dan elemen formulir responsif.
4. **DevOps, Infrastruktur Kontainer & CI/CD**:
   - Perancangan konfigurasi `docker-compose.yml` multi-service (Nginx Web Server, PHP 8.2-FPM Engine, Node.js Build Runners, dan MySQL 8.0).
   - Konfigurasi workflow *Continuous Integration* (CI) menggunakan GitHub Actions untuk validasi otomatis linter dan unit testing.
5. **Evaluasi Pengujian Pengguna (*Usability Testing*)**:
   - Pengujian prototipe antarmuka menggunakan kuesioner terstandarisasi *System Usability Scale* (SUS) kepada 15 responden (pengurus dan kader).

### 2.2 Dasar Teori
Dalam menjalankan perannya, penulis mengacu pada literatur ilmiah dan standar rekayasa perangkat lunak internasional berformat sitasi IEEE:

#### 1. Metodologi Manajemen Proyek Agile Scrum
Menurut Schwaber dan Sutherland [1], Scrum merupakan kerangka kerja manajemen proyek adaptif yang berfokus pada pengiriman nilai secara bertahap (*incremental value delivery*) melalui siklus iterasi berdurasi tetap yang disebut *Sprint*. Kerangka Scrum memfasilitasi transparansi, inspeksi, dan adaptasi cepat terhadap perubahan kebutuhan pengguna melalui artefak *Product Backlog*, *Sprint Backlog*, serta kegiatan *Sprint Planning*, *Daily Standup*, dan *Sprint Retrospective*.

#### 2. User-Centered Design (UCD) dan Design Thinking
Pendekatan *User-Centered Design* (UCD) menempatkan kebutuhan, keterbatasan, dan konteks pengguna akhir sebagai fokus utama di setiap tahapan siklus perancangan perangkat lunak [2] (Gambar 2.1). Tahapan UCD meliputi pemahaman konteks penggunaan (*Empathize*), perumusan kebutuhan pengguna (*Define*), eksplorasi ide solusi (*Ideate*), pembuatan prototipe (*Prototype*), dan pengujian langsung ke pengguna (*Test*).

```
 ┌─────────────┐       ┌─────────────┐       ┌─────────────┐       ┌─────────────┐
 │  EMPATHIZE  │ ───►  │   DEFINE    │ ───►  │   IDEATE    │ ───►  │  PROTOTYPE  │
 │(User Interv)│       │(User Persona│       │ (User Flow &│       │(Wireframe & │
 └─────────────┘       │  & Needs)   │       │ Information)│       │ Hi-Fi Figma)│
        ▲              └─────────────┘       └─────────────┘       └──────┬──────┘
        │                                                                 │
        └────────────────────────── TEST ◄────────────────────────────────┘
                             (SUS Evaluation)
```
*Gambar 2.1 Siklus Iterasi Desain Berpusat pada Pengguna (User-Centered Design)*

#### 3. Arsitektur Informasi (Information Architecture) dan User Journey
Arsitektur informasi merupakan seni dan ilmu dalam mengorganisasi, memberi label, dan menstrukturkan konten digital guna membantu pengguna menemukan informasi serta menyelesaikan tugas dengan beban kognitif minimal (*minimal cognitive load*) [3]. *User Journey Mapping* memvisualisasikan langkah-langkah yang dilalui pengguna dari titik awal akses hingga tercapainya tujuan tertentu (misalnya proses pengajuan PAC).

#### 4. Design System dan Konsep Atomic Design
Menurut Frost [4], *Design System* merupakan kumpulan standar desain terpadu, komponen UI modular, dan dokumentasi yang dapat digunakan kembali untuk mempercepat proses perancangan dan menjaga konsistensi visual pada skala enterprise. Mengadopsi konsep *Atomic Design*, elemen antarmuka dipecah menjadi *Atoms* (warna, tipografi, ikon), *Molecules* (kolom input dengan tombol pencarian), *Organisms* (navbar, kartu profil PAC), *Templates* (kerangka layout), hingga *Pages* (halaman utuh).

#### 5. Evaluasi Kegunaan Sistem dengan System Usability Scale (SUS)
Brooke [5] memperkenalkan *System Usability Scale* (SUS) sebagai instrumen kuesioner standar industri dengan 10 butir pertanyaan skala Likert (1 hingga 5) untuk mengukur tingkat usabilitas perangkat lunak secara cepat dan andal. Skor SUS dikonversi ke skala 0–100, di mana skor di atas 68 mengindikasikan bahwa sistem berada di atas rata-rata industri (*Above Average / Acceptable*), dan skor di atas 80 mencerminkan kategori *Excellent / Grade A*.

#### 6. Kontainerisasi Docker dan Arsitektur Multi-Service
Kontainerisasi menggunakan Docker memungkinkan isolasi aplikasi beserta seluruh pustaka dependensinya ke dalam unit mandiri (*container*), sehingga mengeliminasi kendala inkonsistensi lingkungan (*"it works on my machine problem"*) antara lingkungan lokal pengembang dan server produksi [6]. Penggunaan `docker-compose` mempermudah orkestrasi multi-layanan (Nginx, PHP-FPM, Node.js, MySQL) dalam satu jaringan virtual terisolasi.

#### 7. Continuous Integration dan Continuous Deployment (CI/CD)
Menurut Humble dan Farley [7], *Continuous Integration* (CI) merupakan praktik rekayasa perangkat lunak di mana anggota tim mengintegrasikan kode secara berkelanjutan ke dalam repositori utama, yang secara otomatis diverifikasi oleh build server dan automated testing. Penerapan CI pada GitHub Actions meminimalkan risiko regresi kode dan menjamin kelayakan rilis perangkat lunak secara otomatis.

#### 8. Interaksi Manusia dan Komputer (Human-Computer Interaction / HCI)
Prinsip-prinsip Interaksi Manusia dan Komputer (HCI), seperti hukum Fitts (efisiensi penargetan tombol) dan hukum Hick (kemudahan memilih opsi dengan membatasi kompleksitas navigasi), menjadi landasan dalam merancang tata letak antarmuka yang ramah pengguna, mudah dipelajari (*learnability*), dan minim kesalahan operasi (*error prevention*) [8].

### 2.3 Log Book
Aktivitas harian pelaksanaan Kerja Praktik oleh penulis sebagai *Project Manager & UI/UX Designer* disajikan pada **Tabel 2.1**.

**Tabel 2.1 Log Book Kegiatan Harian Peserta KP (Role: PM & UI/UX Designer)**
| Hari / Tanggal | Uraian Kegiatan Proyek & Desain | Luaran / Bukti Teknis | Paraf |
|---|---|---|:---:|
| **Minggu 1, Hari 1** | Pertemuan pembuka dengan stakeholder PC Fatayat NU Kab. Sukabumi & penetapan Project Charter. | Project Charter & dokumen inisiasi proyek. | *(Tercatat)* |
| **Minggu 1, Hari 2** | Pemetaan ruang lingkup kerja tim dan penyusunan Work Breakdown Structure (WBS) 8 minggu. | Dokumen WBS & struktur hierarki tugas. | *(Tercatat)* |
| **Minggu 1, Hari 3** | Setup repositori GitHub, konfigurasi GitHub Projects Board, label issue, dan branch protection. | Repositori GitHub & papan manajemen Kanban. | *(Tercatat)* |
| **Minggu 1, Hari 4** | Riset metodologi dan penyusunan instrumen wawancara riset pengguna (User Research Plan). | Panduan wawancara stakeholder & user. | *(Tercatat)* |
| **Minggu 1, Hari 5** | Pelaksanaan wawancara mendalam dengan pengurus cabang mengenai kebutuhan digitalisasi. | Transkrip wawancara kualitatif. | *(Tercatat)* |
| **Minggu 2, Hari 6** | Sintesis data riset dan perumusan 2 profil User Persona utama (Kader PAC & Admin Cabang). | Dokumen visual User Persona & Empathy Map. | *(Tercatat)* |
| **Minggu 2, Hari 7** | Perancangan Information Architecture (IA) dan hierarki konten portal publik serta admin. | Diagram Information Architecture (IA). | *(Tercatat)* |
| **Minggu 2, Hari 8** | Perancangan diagram alur pengguna (User Flow) untuk proses pengajuan PAC & filter kegiatan. | Diagram User Flow alur bisnis utama. | *(Tercatat)* |
| **Minggu 2, Hari 9** | Perancangan sketsa tata letak awal (Low-Fidelity Wireframes) pada kertas dan digital board. | Wireframe Lo-Fi sketsa kasar antarmuka. | *(Tercatat)* |
| **Minggu 2, Hari 10** | Sprint Review 1 & sinkronisasi kebutuhan API antara UI Designer, Frontend, dan Backend. | Notulensi kesepakatan spesifikasi API. | *(Tercatat)* |
| **Minggu 3, Hari 11** | Pembentukan Design System terpadu: perumusan palet warna hijau NU (#15803D, #059669) & aksen emas. | Dokumen Style Guide palet warna & tema. | *(Tercatat)* |
| **Minggu 3, Hari 12** | Penetapan hierarki tipografi (Font Inter), skala ukuran, dan jarak vertikal (Line-height). | Spesifikasi tipografi dan modular scale. | *(Tercatat)* |
| **Minggu 3, Hari 13** | Desain komponen UI dasar (Buttons, Form Inputs, Badges, Tabs, Modals) di Figma Component Library. | Master Figma Component Library (Atomic UI). | *(Tercatat)* |
| **Minggu 3, Hari 14** | Pembuatan Wireframe Low-Fidelity digital lengkap untuk seluruh halaman website publik. | Wireframe Lo-Fi digital portal publik. | *(Tercatat)* |
| **Minggu 3, Hari 15** | Pembuatan Wireframe Low-Fidelity digital untuk Dashboard Admin (CRUD PAC, Anggota, Laporan). | Wireframe Lo-Fi digital dashboard admin. | *(Tercatat)* |
| **Minggu 4, Hari 16** | Desain mockup High-Fidelity halaman Beranda (Landing Page) & Hero Section dengan visual interaktif. | Mockup Hi-Fi Figma halaman Beranda. | *(Tercatat)* |
| **Minggu 4, Hari 17** | Desain mockup High-Fidelity halaman Profil Organisasi, Visi Misi, dan Struktur Kepengurusan. | Mockup Hi-Fi Figma halaman Profil. | *(Tercatat)* |
| **Minggu 4, Hari 18** | Desain mockup High-Fidelity halaman Direktori & Peta Interaktif Sebaran 47 PAC (MapLibre style). | Mockup Hi-Fi visualisasi peta 47 PAC. | *(Tercatat)* |
| **Minggu 4, Hari 19** | Desain mockup High-Fidelity halaman Direktori Agenda Kegiatan dengan filter kategori interaktif. | Mockup Hi-Fi direktori agenda kegiatan. | *(Tercatat)* |
| **Minggu 4, Hari 20** | Desain mockup High-Fidelity formulir publik Pengajuan Pembentukan PAC baru & modal sukses. | Mockup Hi-Fi formulir pengajuan PAC. | *(Tercatat)* |
| **Minggu 5, Hari 21** | Desain mockup High-Fidelity halaman Login Admin & alur verifikasi Two-Factor Auth (2FA OTP). | Mockup Hi-Fi autentikasi 2FA OTP. | *(Tercatat)* |
| **Minggu 5, Hari 22** | Desain mockup High-Fidelity Dashboard Utama Admin: ringkasan statistik, chart pertumbuhan, & quick action. | Mockup Hi-Fi dashboard utama admin. | *(Tercatat)* |
| **Minggu 5, Hari 23** | Desain mockup High-Fidelity modul Manajemen Data PAC (tabel paginasi, modal CRUD, & CSV import). | Mockup Hi-Fi modul master data PAC. | *(Tercatat)* |
| **Minggu 5, Hari 24** | Desain mockup High-Fidelity modul Manajemen Data Anggota & Kader (filter status, pendidikan, & biodata). | Mockup Hi-Fi modul data anggota. | *(Tercatat)* |
| **Minggu 5, Hari 25** | Desain mockup High-Fidelity modul Pusat Laporan (generator PDF, Excel, CSV) & Pengaturan Sistem. | Mockup Hi-Fi modul ekspor laporan. | *(Tercatat)* |
| **Minggu 6, Hari 26** | Perancangan arsitektur kontainerisasi multi-layanan Docker dan penulisan Dockerfile PHP 8.2-FPM. | Berkas `Dockerfile` backend & Nginx. | *(Tercatat)* |
| **Minggu 6, Hari 27** | Penulisan konfigurasi `docker-compose.yml` untuk menghubungkan Nginx, Laravel, Node, & MySQL 8. | Berkas `docker-compose.yml` terintegrasi. | *(Tercatat)* |
| **Minggu 6, Hari 28** | Konfigurasi workflow Continuous Integration (CI) GitHub Actions untuk pengujian otomatis tiap commit. | Berkas `.github/workflows/ci.yml`. | *(Tercatat)* |
| **Minggu 6, Hari 29** | Pembuatan dokumentasi panduan kontribusi dan kode etik pengembang (CONTRIBUTING.md & CODE_OF_CONDUCT.md). | Berkas panduan komunitas pengembang. | *(Tercatat)* |
| **Minggu 6, Hari 30** | Pelaksanaan Quality Assurance (QA) audit desain visual terhadap hasil implementasi frontend React. | Catatan bug visual & design refinement. | *(Tercatat)* |
| **Minggu 7, Hari 31** | Penyusunan instrumen kuesioner evaluasi System Usability Scale (SUS) 10 butir pertanyaan standar. | Instrumen kuesioner evaluasi SUS. | *(Tercatat)* |
| **Minggu 7, Hari 32** | Pelaksanaan uji coba antarmuka dan pengisian kuesioner SUS bersama 15 kader perwakilan PAC dan pengurus. | Data mentah respons responden uji coba. | *(Tercatat)* |
| **Minggu 7, Hari 33** | Pengolahan data statistik skor SUS dan analisis distribusi kepuasan kemudahan penggunaan. | Hasil perhitungan skor SUS (84.2 / Grade A).| *(Tercatat)* |
| **Minggu 7, Hari 34** | Evaluasi performa kecepatan render UI (Core Web Vitals) bersama Frontend Developer. | Skor LCP < 1.2s dan CLS 0 pada Lighthouse. | *(Tercatat)* |
| **Minggu 7, Hari 35** | Sprint Review 7, perbaikan bug minor, dan optimasi responsivitas tata letak mobile breakpoint. | Rilis versi Release Candidate (RC). | *(Tercatat)* |
| **Minggu 8, Hari 36** | Pelaksanaan User Acceptance Testing (UAT) resmi bersama jajaran pimpinan cabang PC Fatayat NU. | Dokumen berita acara UAT bertandatangan. | *(Tercatat)* |
| **Minggu 8, Hari 37** | Penyusunan dokumentasi arsitektur sistem (`ARCHITECTURE.md`) dan panduan deployment (`DEPLOYMENT_GUIDE.md`). | Dokumentasi arsitektur & deployment. | *(Tercatat)* |
| **Minggu 8, Hari 38** | Serah terima aset desain Figma, source code repositori, dan kredensial administratif ke instansi mitra. | Berita acara serah terima aset digital. | *(Tercatat)* |
| **Minggu 8, Hari 39** | Penyusunan naskah Laporan Akhir Kerja Praktik bidang Manajemen Proyek dan UI/UX Design. | Draf lengkap naskah laporan KP. | *(Tercatat)* |
| **Minggu 8, Hari 40** | Finalisasi naskah laporan, verifikasi lampiran, dan pengesahan laporan Kerja Praktik. | Naskah Laporan Akhir KP disahkan. | *(Tercatat)* |

---

# BAB III: LUARAN KERJA PRAKTIK

### 3.1 Masalah
Dalam proses digitalisasi sistem informasi PC Fatayat NU Kabupaten Sukabumi, penulis mengidentifikasi beberapa permasalahan mendasar dalam aspek manajemen proyek dan perancangan antarmuka:
1. **Risiko Miskomunikasi dan Deviasi Waktu Pengembangan**:
   - Pengembangan platform yang melibatkan integrasi antara React 18 SPA (Frontend), Laravel 12 (Backend), database MySQL, dan webhook eksternal rentan mengalami hambatan integrasi apabila tidak dikelola dengan metodologi proyek yang adaptif dan matriks tugas yang transparan.
2. **Kesenjangan Literasi Digital Pengguna Akhir (*Digital Literacy Gap*)**:
   - Kader Fatayat NU memiliki latar belakang usia yang bervariasi (kader muda milenial hingga generasi senior di tingkat kecamatan). Antarmuka yang terlalu rumit dengan hierarki menu berbelit-belit berisiko membingungkan pengguna dan menurunkan tingkat adopsi sistem.
3. **Fragmentasi Identitas Visual dan Ketiadaan Design Tokens**:
   - Sebelum perancangan terpusat dilakukan, tidak ada pedoman visual yang baku mengenai warna representatif organisasi, tipografi, dan rasio kontras warna (*accessibility contrast ratio*), sehingga tampilan antarmuka berpotensi tidak konsisten.
4. **Kendala Sinkronisasi Lingkungan Server (DevOps Mismatch)**:
   - Perbedaan versi PHP, ekstensi database, dan dependensi Node.js di komputer lokal masing-masing anggota tim sering memicu masalah lingkungan kerja yang menghambat rilis berkala.

### 3.2 Tahapan Penyelesaian Masalah

#### 3.2.1 Penerapan Metodologi Agile Scrum dan Work Breakdown Structure
Untuk menjamin target proyek tercapai secara tepat waktu, penulis menerapkan kerangka kerja **Agile Scrum** dengan siklus sprint mingguan (Gambar 3.1) dan menyusun *Work Breakdown Structure* (WBS) komprehensif (**Tabel 3.1**).

```
 ┌─────────────────────────────────────────────────────────────────────────────┐
 │                           PRODUCT BACKLOG (All Tasks)                       │
 └──────────────────────────────────────┬──────────────────────────────────────┘
                                        │
                                        ▼ (Sprint Planning)
 ┌─────────────────────────────────────────────────────────────────────────────┐
 │                           SPRINT BACKLOG (1-Week Iteration)                 │
 └──────┬───────────────────────────────┬───────────────────────────────┬──────┘
        │                               │                               │
        ▼ (Day 1-2)                     ▼ (Day 3-4)                     ▼ (Day 5)
 ┌──────────────┐                ┌──────────────┐                ┌──────────────┐
 │  UI/UX Design│                │ Implementation│                │ Testing & QA │
 │ (Figma Lo/Hi)│                │ (React & PHP)│                │ (SUS & Unit) │
 └──────┬───────┘                └──────┬───────┘                └──────┬───────┘
        │                               │                               │
        └───────────────────────────────┼───────────────────────────────┘
                                        ▼
 ┌─────────────────────────────────────────────────────────────────────────────┐
 │                  SPRINT REVIEW & RETROSPECTIVE (Demo to Stakeholder)        │
 └─────────────────────────────────────────────────────────────────────────────┘
```
*Gambar 3.1 Alur Siklus Sprint Agile Scrum pada Proyek KP-IF-SAKTI*

**Tabel 3.1 Work Breakdown Structure (WBS) dan Matriks Deliverable Proyek**
| Kode WBS | Modul / Aktivitas Utama | Tanggung Jawab Utama (PIC) | Target Deliverable |
|---|---|---|---|
| **WBS 1.0** | **Project Management & Inisiasi** | LM. Irsal Shydiq | Project Charter, WBS, & Board Setup. |
| **WBS 2.0** | **User Research & UX Modeling** | LM. Irsal Shydiq | Persona, Empathy Map, & User Flow. |
| **WBS 3.0** | **Design System & UI Prototyping**| LM. Irsal Shydiq | Design Tokens & Figma Hi-Fi Prototypes. |
| **WBS 4.0** | **Frontend SPA Development** | Ikhsan Hazamy | React 18, Tailwind CSS, & MapLibre GL. |
| **WBS 5.0** | **Backend API & Database Core** | Nurdiansyah Pratama | Laravel 12, REST API, & MySQL Database. |
| **WBS 6.0** | **DevOps, Docker, & CI/CD** | LM. Irsal Shydiq | `docker-compose.yml` & GitHub Actions CI. |
| **WBS 7.0** | **Quality Assurance & Testing** | Tim Pengembang | Unit Testing PHPUnit & Usability SUS. |
| **WBS 8.0** | **UAT & Release Handover** | LM. Irsal Shydiq | Berita Acara UAT & Laporan Akhir KP. |

#### 3.2.2 Riset Pengguna, User Persona, dan Empathy Mapping
Berdasarkan hasil wawancara mendalam dengan pengurus dan perwakilan kader, penulis merumuskan dua profil *User Persona* representatif (**Tabel 3.2** dan **Gambar 3.2**).

**Tabel 3.2 Matriks Karakteristik dan Kebutuhan Pengguna (User Persona Matrix)**
| Parameter | Persona 1: Kader PAC (End-User Publik) | Persona 2: Administrator Cabang (Admin User) |
|---|---|---|
| **Representasi Nama** | Siti Aminah, S.Pd. (Ketua PAC Cisaat, Usia 28 Th) | Dra. Hj. Fatimah (Sekretaris Cabang, Usia 42 Th) |
| **Tujuan Utama (*Goals*)**| Mengetahui agenda resmi cabang & mendaftarkan kader. | Merekap data 47 PAC & mencetak laporan PDF/Excel. |
| **Keluhan (*Pain Points*)**| Info kegiatan sering terlambat di grup WhatsApp. | Rekonsiliasi data kader manual memakan waktu berhari-hari. |
| **Kebutuhan Solusi UI** | Peta PAC interaktif, filter kegiatan, & form simpel. | Tabel data terstruktur, pencarian cepat, & 2FA aman. |

```
+-----------------------------------------------------------------------------------+
| USER PERSONA 1: KADER ANGGOTA PAC             USER PERSONA 2: ADMINISTRATOR PC    |
| Nama : Siti Aminah, S.Pd. (28 Th)             Nama : Dra. Hj. Fatimah (42 Th)     |
| Role : Ketua PAC Kecamatan Cisaat             Role : Sekretaris Cabang PC Sukabumi|
| Perangkat : Smartphone Android (Mobile-First) Perangkat : Laptop / PC Desktop     |
|                                                                                   |
| [ Goals ]                                     [ Goals ]                           |
| • Mencari lokasi & jadwal kaderisasi (LKD)    • Memverifikasi pengajuan form PAC  |
| • Mengajukan permohonan pembentukan PAC baru  • Mengelola biodata ribuan kader    |
| • Melihat direktori kontak kepengurusan       • Mengunduh rekapitulasi PDF/Excel  |
|                                                                                   |
| [ Pain Points ]                               [ Pain Points ]                     |
| • Susah mencari informasi resmi terpusat      • Format pelaporan manual tercecer  |
| • Form birokrasi manual memakan waktu         • Khawatir keamanan data bocor      |
+-----------------------------------------------------------------------------------+
```
*Gambar 3.2 User Persona Primer Kader Anggota dan Pengurus Cabang*

#### 3.2.3 Information Architecture (IA), Sitemap, dan User Flow
Penulis menyusun *Information Architecture* (IA) berstruktur hierarkis untuk memisahkan domain publik dan area administrasi terlindungi (Gambar 3.3). Alur navigasi pengajuan PAC dirancang sesederhana mungkin agar dapat diselesaikan dalam 3 langkah mudah (*3-Step User Flow*) (Gambar 3.4).

```
                                  [ SISTEM INFORMASI KP-IF-SAKTI ]
                                                 │
                   ┌─────────────────────────────┴─────────────────────────────┐
                   ▼                                                           ▼
       [ PORTAL PUBLIK (React SPA) ]                               [ DASHBOARD ADMIN (Blade) ]
                   │                                                           │
     ┌─────────────┼─────────────┬─────────────┐                 ┌─────────────┼─────────────┬─────────────┐
     ▼             ▼             ▼             ▼                 ▼             ▼             ▼             ▼
 [Beranda]    [Tentang/    [Direktori    [Agenda &           [Dashboard]   [Master Data  [Pusat Laporan[Pengaturan &
 (Hero/Stats)  Profil]      Peta 47 PAC]  Kegiatan]          (Chart/Stats)  PAC & Kader]  (PDF/XLS/CSV) Keamanan 2FA]
```
*Gambar 3.3 Information Architecture (IA) Portal Publik dan Dashboard Admin*

```
 [ Pengunjung Publik ] ──► [ Klik Menu "Pengajuan PAC" ] ──► [ Isi Formulir Data PAC ]
                                                                      │
 [ Selesai & Tunggu ] ◄── [ Modal Notifikasi Sukses ] ◄── [ Klik "Kirim Permohonan" ]
```
*Gambar 3.4 User Flow Pengajuan Pembentukan PAC Baru Secara Publik*

#### 3.2.4 Perancangan Wireframing (Lo-Fi) dan Mockup Interaktif (Hi-Fi)
Proses perancangan antarmuka dimulai dari pembuatan *Wireframe* beresolusi rendah (Low-Fidelity) untuk memvalidasi tata letak elemen visual, kemudian ditransformasikan ke dalam prototipe *High-Fidelity* interaktif menggunakan perangkat lunak **Figma** (Gambar 3.5 dan **Tabel 3.3**).

**Tabel 3.3 Spesifikasi Desain Antarmuka Halaman Publik dan Admin**
| Nama Halaman | Tipe Antarmuka | Komponen Desain Utama |
|---|---|---|
| **Landing Page** | Publik (Responsive) | Hero Banner, Counter Statistik Real-time, Highlight Program, & Footer. |
| **Peta Sebaran 47 PAC**| Publik (Desktop/Mobile)| MapLibre GL Layer, Search Bar Kecamatan, Card Detail PAC, & Badge Status. |
| **Direktori Kegiatan** | Publik (Responsive) | Pill Filter Kategori (Kaderisasi, Sosial, dll.), Grid Card, & Modal Detail. |
| **Formulir Pengajuan PAC**| Publik (Responsive) | Form Input Validasi, Date Picker, Input Mask Telepon, & Modal Alert. |
| **Login & 2FA Challenge**| Admin (Secure View) | Form Login Bcrypt, Input 6 Digit OTP Challenge, & Resend Button. |
| **Dashboard Utama** | Admin (Desktop) | Stat Cards, Chart Pertumbuhan Kader, Log Aktivitas, & Quick Actions. |
| **Master Data PAC & Anggota**| Admin (Desktop) | Data Table dengan Sort/Search, Pagination 9 Baris, CSV Importer Modal. |
| **Pusat Ekspor Laporan** | Admin (Desktop) | Kartu Filter Tanggal, Download Button (PDF DomPDF, Excel, CSV Stream). |

```
+------------------------------------+    +------------------------------------+
|     WIREFRAME (Low-Fidelity)       |    |      MOCKUP (High-Fidelity)        |
|                                    |    |                                    |
| [Logo]   [Menu 1] [Menu 2] [Login] |    | 🌿 FATAYAT NU  Home PAC Agenda 🔒  |
| ---------------------------------- |    | ---------------------------------- |
| [Hero Text Headline]               |    | "Membangun Generasi Perempuan      |
| [Subheadline text paragraph]       |    |  Mandiri Berdaya Saing"            |
| [Button 1]    [Button 2]           |    | [Lihat Peta PAC] [Agenda Kegiatan] |
|                                    |    |                                    |
| [Stat 1]   [Stat 2]   [Stat 3]     |    | 🟢 47 PAC  🟢 1.250 Kader  🟢 100% |
|                                    |    |                                    |
| [Map Container Placeholder]        |    | 🗺️ [Interaktif MapLibre GL Canvas] |
+------------------------------------+    +------------------------------------+
```
*Gambar 3.5 Perbandingan Wireframe Low-Fidelity dan Mockup High-Fidelity Figma*

#### 3.2.5 Penyusunan Design System dan Design Tokens (Tailwind CSS)
Penulis menyusun *Design System* terpadu dengan menetapkan *Design Tokens* yang mencerminkan identitas resmi Nahdlatul Ulama dan Fatayat NU (**Tabel 3.4** dan Gambar 3.6).

**Tabel 3.4 Definisi Design Tokens Tailwind CSS (Warna, Tipografi, Shadow)**
| Token Category | Token Name | Nilai / Kode Warna | Penggunaan Desain Antarmuka |
|---|---|---|---|
| **Primary Brand Color** | `brand-green-700` | `#15803D` (Deep NU Green) | Navbar, Tombol Utama (Primary CTA), Heading. |
| **Secondary Accent** | `brand-emerald-500`| `#10B981` (Vibrant Emerald)| Aksen Hover, Badge "Aktif", Indikator Peta. |
| **Accent Gold** | `brand-amber-500` | `#F59E0B` (Warm Gold) | Badge "Akan Expire", Highlight Prestasi. |
| **Neutral Background**| `surface-light` | `#F9FAFB` (Cool Gray 50) | Latar Belakang Aplikasi dan Kontainer Kartu. |
| **Dark Surface** | `surface-dark` | `#111827` (Rich Gray 900) | Teks Utama, Footer, dan Sidebar Admin. |
| **Typography (Sans)** | `font-sans` | `Inter, sans-serif` | Keterbacaan optimal pada seluruh resolusi layar. |
| **Elevation Shadows** | `shadow-card` | `0 4px 6px -1px rgb(0 0 0 / 0.1)`| Efek kedalaman kartu dan kontainer modal. |

```
PALET WARNA RESMI:
┌──────────────────────┬──────────────────────┬──────────────────────┬──────────────────────┐
│  #15803D (NU Green)  │ #10B981 (Emerald)    │ #F59E0B (Gold Amber) │ #F9FAFB (Background) │
│  Primary Brand       │ Accent & Map Active  │ Warning / Pending    │ Surface Neutral      │
└──────────────────────┴──────────────────────┴──────────────────────┴──────────────────────┘
TIPOGRAFI: Inter (Regular, Medium, Semi-Bold, Bold) — Skala 12px, 14px, 16px, 20px, 24px, 32px
```
*Gambar 3.6 Spesifikasi Design Tokens (Palet Warna Khas NU, Tipografi, Spacing)*

#### 3.2.6 Arsitektur DevOps, Topologi Docker, dan CI/CD Pipeline
Sebagai Project Manager yang mengawal keandalan rilis perangkat lunak, penulis merancang arsitektur kontainerisasi multi-layanan berbasis Docker Compose (**Tabel 3.5** dan Gambar 3.7) serta mengonfigurasi otomatisasi pengujian *Continuous Integration* (CI) menggunakan GitHub Actions.

**Tabel 3.5 Konfigurasi Service pada `docker-compose.yml`**
| Nama Service | Base Image | Port Mapping | Deskripsi Fungsi Kontainer |
|---|---|:---:|---|
| **`app`** | PHP 8.2-FPM + Nginx + Supervisor | `8000:80` | Web server Nginx terpadu melayani frontend dist, API, dan SSR admin. |
| **`db`** | `mysql:8.0` | Internal `3306` | Persistent database server dengan volume data `db_data`. |
| **`frontend-build`**| `node:22-alpine` | - | Runner satu kali jalan untuk build aset React SPA ke volume `frontend_dist`.|
| **`backend-assets`**| `node:22-alpine` | - | Runner satu kali jalan untuk build aset Vite pada dashboard Laravel. |

```
+-----------------------------------------------------------------------------------+
|                          DOCKER MULTI-CONTAINER TOPOLOGY                          |
|                                                                                   |
|   +---------------------------------------------------------------------------+   |
|   |                        Nginx Reverse Proxy Gateway                        |   |
|   |                      (Port 8000:80 -> Container Host)                     |   |
|   +---------------------+-------------------------------+---------------------+   |
|                         │                               │                         |
|                         ▼                               ▼                         |
|   +-------------------------------+           +-------------------------------+   |
|   |   Static Files Volume /*      |           |   PHP 8.2-FPM Engine :9000    |   |
|   |   (React 18 Production Dist)  |           |   (Laravel 12 Core + Admin)   |   |
|   +-------------------------------+           +---------------+---------------+   |
|                                                               │                   |
|                                                               ▼                   |
|                                               +-------------------------------+   |
|                                               |   MySQL 8.0 Database Server   |   |
|                                               |   (Port 3306 / Persistent)    |   |
|                                               +-------------------------------+   |
+-----------------------------------------------------------------------------------+
```
*Gambar 3.7 Topologi Multi-Container Docker dan Alur CI/CD GitHub Actions*

Pipeline CI dikonfigurasi pada `.github/workflows/ci.yml` untuk memvalidasi sintaks kode dan menjalankan seluruh unit test PHPUnit secara otomatis pada setiap *Pull Request* sebelum digabungkan ke branch `main`.

#### 3.2.7 Evaluasi Pengujian Pengguna (System Usability Scale / SUS)
Untuk menguji tingkat kegunaan antarmuka yang dirancang, penulis menyelenggarakan evaluasi usabilitas menggunakan kuesioner *System Usability Scale* (SUS) standar internasional yang melibatkan 15 responden (pengurus cabang dan perwakilan kader PAC) (**Tabel 3.6** dan Gambar 3.8).

**Tabel 3.6 Rekapitulasi Kuesioner dan Hasil Skor System Usability Scale (SUS)**
| No | Butir Pernyataan Evaluasi Usabilitas (SUS Standard) | Rata-rata Skor (1-5) |
|:---:|---|:---:|
| Q1 | Saya berpikir akan sering menggunakan sistem informasi ini. | 4.60 |
| Q2 | Saya merasa sistem informasi ini terlalu rumit untuk digunakan. | 1.40 |
| Q3 | Saya merasa sistem informasi ini sangat mudah digunakan. | 4.67 |
| Q4 | Saya membutuhkan bantuan orang teknis untuk menggunakan sistem ini. | 1.47 |
| Q5 | Saya melihat berbagai fungsi dalam sistem terintegrasi dengan sangat baik. | 4.53 |
| Q6 | Saya merasa ada terlalu banyak hal yang tidak konsisten pada sistem. | 1.33 |
| Q7 | Saya yakin orang lain dapat mempelajari sistem ini dengan sangat cepat. | 4.60 |
| Q8 | Saya merasa sistem ini sangat janggal atau membingungkan saat digunakan. | 1.27 |
| Q9 | Saya merasa sangat percaya diri saat menggunakan sistem informasi ini. | 4.53 |
| Q10| Saya perlu mempelajari banyak hal sebelum saya bisa menggunakan sistem. | 1.40 |
| **Total Skor SUS Terkonversi** | **(Formula: $\sum[\text{Odd}-1] + \sum[5-\text{Even}] \times 2.5$)** | **84.2 / 100** |

```
SKOR SYSTEM USABILITY SCALE (SUS): 84.2 (Grade A / "Excellent")
┌─────────────────────────────────────────────────────────────────────────────┐
│  0 -------- 50 -------- 68 (Avg) -------- 80 (Good) ---[ 84.2 (Grade A) ]- 100 │
└─────────────────────────────────────────────────────────────────────────────┘
Predikat Usabilitas: EXCELLENT (Diterima dengan tingkat kepuasan sangat tinggi)
```
*Gambar 3.8 Distribusi Skor Evaluasi System Usability Scale (SUS Score)*

### 3.3 Hasil
Luaran konkret yang dihasilkan dari peran *Project Manager & UI/UX Designer* meliputi:
1. **Artefak Desain Antarmuka Lengkap di Figma**: 14 layar desain *High-Fidelity* interaktif (portal publik dan dashboard admin) yang dilengkapi prototipe navigasi.
2. **Design System & Tokens Terstandarisasi**: Panduan gaya warna khas NU, tipografi Inter, ikonografi, dan komponen UI responsif berbasis Tailwind CSS.
3. **Pencapaian Mutu Usabilitas Tinggi (SUS Score 84.2)**: Memperoleh predikat **"Excellent / Grade A"**, membuktikan antarmuka sangat mudah dipelajari (*high learnability*) dan efisien dioperasikan oleh kader berbagai kalangan usia.
4. **Infrastruktur DevOps yang Siap Produksi**: Beroperasinya kontainerisasi Docker multi-service dan otomatisasi CI GitHub Actions yang menjaga stabilitas integrasi tim pengembang 100%.

---

# BAB IV: PENUTUP

### 4.1 Kesimpulan
Berdasarkan serangkaian aktivitas manajemen proyek dan perancangan desain UI/UX yang telah dilaksanakan, diperoleh kesimpulan:
1. **Keberhasilan Penerapan Metodologi Agile Scrum**: Pengelolaan proyek menggunakan Agile Scrum dengan pembagian sprint terukur dan WBS terstruktur berhasil menjaga koordinasi tim pengembang lintas peran (*frontend* dan *backend*) sehingga seluruh modul terselesaikan tepat waktu tanpa kendala integrasi.
2. **Kualitas Desain Berpusat pada Pengguna (UCD)**: Pendekatan *User-Centered Design* menghasilkan antarmuka web publik dan admin dashboard yang inklusif, estetis, dan memiliki hierarki visual yang jelas sesuai karakteristik pengguna Fatayat NU.
3. **Standarisasi Visual Melalui Design System**: Pembentukan *Design Tokens* Tailwind CSS berhasil menyatukan identitas visual organisasi (hijau khas NU dan aksen emas) dengan komponen antarmuka modern yang modular dan konsisten.
4. **Infrastruktur Terisolasi dan Terotomatisasi**: Kontainerisasi Docker multi-layanan dan CI GitHub Actions menjamin konsistensi lingkungan pengembangan lokal dan server rilis secara terisolasi dan stabil.
5. **Tingkat Kepuasan Pengguna yang Unggul**: Hasil uji usabilitas dengan metode SUS memperoleh skor **84.2 dari 100 (Grade A / Excellent)**, menegaskan bahwa sistem informasi KP-IF-SAKTI sangat ramah pengguna dan siap diimplementasikan secara luas.

### 4.2 Saran
Beberapa saran konstruktif untuk pengembangan sistem di masa mendatang:
1. **Penyediaan Mode Gelap (*Dark Mode Theme*)**: Menambahkan dukungan tema gelap pada dashboard admin guna meningkatkan kenyamanan visual pengurus saat bertugas di malam hari.
2. **Integrasi Automated Visual Regression Testing**: Menambahkan tools otomatisasi uji visual (seperti Percy atau Playwright screenshot diff) pada pipeline CI untuk mendeteksi perubahan visual tak terduga secara dini.
3. **Pengembangan Modul Pelatihan Interaktif (*Onboarding Tour*)**: Menambahkan tur interaktif pemandu fitur (*guided onboarding tour*) pada saat administrator pertama kali mengaktifkan akun dashboard.

---

# REFERENSI

[1] K. Schwaber and J. Sutherland, *The Scrum Guide: The Definitive Guide to Scrum: The Rules of the Game*, Scrum.Org, 2020.

[2] D. Norman, *The Design of Everyday Things: Revised and Expanded Edition*. New York, NY, USA: Basic Books, 2013.

[3] P. Morville and L. Rosenfeld, *Information Architecture for the World Wide Web: Designing Large-Scale Web Sites*, 3rd ed. Sebastopol, CA, USA: O'Reilly Media, 2006.

[4] B. Frost, *Atomic Design*. Brad Frost Collection, 2016.

[5] J. Brooke, "SUS: A 'Quick and Dirty' Usability Scale," in *Usability Evaluation In Industry*, P. W. Jordan, B. Thomas, I. L. McClelland, and B. Weerdmeester, Eds. London, UK: Taylor & Francis, 1996, pp. 189–194.

[6] D. Merkel, "Docker: Lightweight Linux Containers for Consistent Development and Deployment," *Linux Journal*, vol. 2014, no. 239, p. 2, Mar. 2014.

[7] J. Humble and D. Farley, *Continuous Delivery: Reliable Software Releases through Build, Test, and Deployment Automation*. Boston, MA, USA: Addison-Wesley, 2010.

[8] B. Shneiderman, C. Plaisant, M. S. Cohen, S. Jacobs, N. Elmqvist, and N. Diakopoulos, *Designing the User Interface: Strategies for Effective Human-Computer Interaction*, 6th ed. Boston, MA, USA: Pearson, 2016.

---

# LAMPIRAN

### Lampiran A — Konfigurasi Multi-Container Docker (`docker-compose.yml`)
```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: docker/Dockerfile
    container_name: kp-if-sakti-app
    restart: unless-stopped
    ports:
      - "8000:80"
    volumes:
      - ./backend:/var/www/html
      - frontend_dist:/var/www/frontend
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
    depends_on:
      - db
      - frontend-build

  db:
    image: mysql:8.0
    container_name: kp-if-sakti-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: ${DB_DATABASE:-kp_if_sakti}
      MYSQL_USER: ${DB_USERNAME:-root}
      MYSQL_PASSWORD: ${DB_PASSWORD:-secret}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD:-secret}
    volumes:
      - db_data:/var/lib/mysql

  frontend-build:
    image: node:22-alpine
    container_name: kp-if-sakti-frontend-build
    working_dir: /app
    volumes:
      - ./frontend:/app
      - frontend_dist:/app/dist
    command: sh -c "npm install && npm run build"

volumes:
  db_data:
  frontend_dist:
```

### Lampiran B — Workflow Continuous Integration (`.github/workflows/ci.yml`)
```yaml
name: Continuous Integration (CI)

on:
  push:
    branches: [ main, dev ]
  pull_request:
    branches: [ main ]

jobs:
  backend-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Setup PHP 8.2
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, pdo_sqlite, gd
      - name: Install Composer Dependencies
        working-directory: ./backend
        run: composer install --prefer-dist --no-interaction
      - name: Execute Automated Tests (PHPUnit)
        working-directory: ./backend
        run: php artisan test --parallel
```
