<div align="center">

# 🌿 KP-IF-SAKTI
### Sistem Informasi PC Fatayat NU Kabupaten Sukabumi

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![React](https://img.shields.io/badge/React-18.x-61DAFB?style=flat-square&logo=react&logoColor=black)](https://react.dev)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

<p align="center">
  Sistem informasi manajemen data organisasi, pemetaan wilayah Pimpinan Anak Cabang (PAC), agenda kegiatan, dan administrasi keanggotaan <strong>PC Fatayat NU Kabupaten Sukabumi</strong>.
</p>

> 🎓 *Proyek Kerja Praktik (KP) Program Studi Teknik Informatika — **Informatika SAKTI (IF SAKTI)**.*

</div>

---

## 🚀 Quick Start (Docker)

Cara tercepat menjalankan aplikasi secara lokal dengan Docker Compose:

```bash
# 1. Clone repositori
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI

# 2. Siapkan konfigurasi environment backend
cp backend/.env.example backend/.env

# 3. Jalankan container (Backend Laravel, Frontend React, & MySQL 8)
docker compose up --build
```

Akses aplikasi di browser:
* 🌐 **Website Publik**: [http://localhost:5173](http://localhost:5173)
* 🔐 **Admin Dashboard**: [http://localhost:8000](http://localhost:8000) *(Login: `admin@fatayatnu.or.id` / `password`)*

> 💡 *Untuk panduan setup manual di komputer host tanpa Docker, silakan baca **[Panduan Development](docs/DEVELOPMENT_GUIDE.md)**.*

---

## ✨ Fitur Utama

* **🌐 Website Publik (React SPA)**: Landing page profil, direktori agenda kegiatan dengan filter kategori, peta interaktif sebaran 47 PAC (MapLibre GL), dan formulir pengajuan pembentukan PAC baru.
* **🛡️ Dashboard Admin (Laravel)**: Manajemen data PAC, biodata anggota/kader, publikasi agenda kegiatan, pusat ekspor laporan (PDF, Excel, CSV), serta backup/restore database (MySQL & SQLite).
* **⚡ Integrasi Eksternal**: Webhook Google Apps Script untuk sinkronisasi asinkron data form PAC ke Google Sheets.

---

## 🛠️ Tech Stack

* **Frontend**: React 18, Vite 5, Tailwind CSS 4, shadcn/ui, MapLibre GL
* **Backend**: Laravel 12 (PHP 8.2), Blade Templates, DomPDF
* **Database**: MySQL 8.0 & SQLite 3
* **DevOps & CI/CD**: Docker, Docker Compose, GitHub Actions

---

## 📚 Dokumentasi Teknis

Dokumentasi arsitektur dan spesifikasi teknis lengkap tersedia di folder [`docs/`](docs/):

* 🌐 **[Dokumentasi REST API](docs/API_DOCUMENTATION.md)** — Spesifikasi endpoint `/api/*`, format JSON, query parameter, dan rate limiting.
* 🗄️ **[Skema Basis Data & ERD](docs/DATABASE_SCHEMA.md)** — Diagram relasi entitas (ERD) dan kamus data tabel.
* 🏛️ **[Arsitektur Sistem](docs/ARCHITECTURE.md)** — Desain arsitektur hybrid dan alur sequence pengajuan form.
* 🚀 **[Panduan Deployment Produksi](docs/DEPLOYMENT_GUIDE.md)** — Panduan rilis VPS Linux, Nginx reverse proxy, SSL Let's Encrypt, dan cron backup.
* 💻 **[Panduan Development & Debugging](docs/DEVELOPMENT_GUIDE.md)** — Setup host lokal, testing PHPUnit, dan troubleshooting.

---

## 👥 Tim Pengembang

<div align="center">

| Kontributor | Peran & Tanggung Jawab Utama | GitHub |
| :--- | :--- | :---: |
| **LM. Irsal Shydiq** | **Project Manager (PM) & UI/UX Designer** | [![GitHub](https://img.shields.io/badge/GitHub-irsalshydiq-181717?style=flat-square&logo=github)](https://github.com/irsalshydiq) |
| **Ikhsan Hazamy** | **Frontend Developer** | [![GitHub](https://img.shields.io/badge/GitHub-ikhsanhazamy-181717?style=flat-square&logo=github)](https://github.com/ikhsanhazamy) |
| **Nurdiansyah Pratama** | **Backend Developer** | [![GitHub](https://img.shields.io/badge/GitHub-predator45-181717?style=flat-square&logo=github)](https://github.com/predator45) |

</div>

> 🤝 *Profil lengkap dan panduan alur kontribusi dapat dibaca pada **[CONTRIBUTORS.md](CONTRIBUTORS.md)** dan **[CONTRIBUTING.md](CONTRIBUTING.md)**.*

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **[MIT License](LICENSE)** © 2026 Tim Kerja Praktik IF SAKTI & Kontributor KP-IF-SAKTI.
