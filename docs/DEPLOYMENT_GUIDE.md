# 🚀 Panduan Lengkap Deployment Server VPS (Production Deployment Guide)

Panduan resmi, komprehensif, dan siap-pakai untuk merilis sistem **KP-IF-SAKTI (Sistem Informasi PC Fatayat NU Kabupaten Sukabumi)** ke server VPS produksi Linux (Ubuntu 22.04 / 24.04 LTS) menggunakan Docker Compose multi-container, Host Nginx Reverse Proxy, dan Sertifikat SSL Let's Encrypt.

---

## 🏛️ Arsitektur Infrastruktur Produksi

```
                             [ Pengguna Internet ]
                                       │
                               HTTPS (Port 443)
                                       ▼
                     ┌───────────────────────────────────┐
                     │     Host VPS (Ubuntu Server)      │
                     │  - Nginx Reverse Proxy            │
                     │  - SSL Let's Encrypt (Certbot)    │
                     │  - Rate Limiter (Brute-force)     │
                     │  - Firewall UFW (80, 443, 22)     │
                     └─────────────────┬─────────────────┘
                                       │ Loopback 127.0.0.1:8000
                                       ▼
  ┌────────────────────────────────────────────────────────────────────────┐
  │                        Docker Compose Network                          │
  │                                                                        │
  │  ┌───────────────────────────┐      ┌───────────────────────────────┐  │
  │  │   kp_production_app       │      │   kp_production_db            │  │
  │  │   (Port 8000 -> 80)       │      │   (MySQL 8.0 Internal)        │  │
  │  │                           │      │                               │  │
  │  │   - Nginx Web Server      │◄────►│   - Port 3306 (Tertutup Luar) │  │
  │  │   - PHP 8.2-FPM           │      │   - Volume: db_data           │  │
  │  │   - Frontend Static SPA   │      │   - Transaksi Cepat & Aman    │  │
  │  │   - Supervisor & Worker   │      │                               │  │
  │  └───────────────────────────┘      └───────────────────────────────┘  │
  │                ▲                                                       │
  │                │ Di-build sekali saat deploy                           │
  │  ┌─────────────┴─────────────┐      ┌───────────────────────────────┐  │
  │  │   kp_frontend_assets      │      │   kp_backend_assets           │  │
  │  │   (Vite + React SPA)      │      │   (Vite + Tailwind Admin)     │  │
  │  └───────────────────────────┘      └───────────────────────────────┘  │
  └────────────────────────────────────────────────────────────────────────┘
```

---

## 🖥️ Spesifikasi Server VPS yang Disarankan

| Komponen | Spesifikasi Minimum | Rekomendasi Produksi | Catatan Penting |
|---|---|---|---|
| **CPU** | 1 Core (vCPU) | 2 Core atau lebih | Proses kompilasi Vite membutuhkan CPU saat build awal. |
| **RAM** | 1 GB - 2 GB RAM | 4 GB RAM | **Wajib aktifkan Swap 2GB** jika RAM $\le$ 2GB agar tidak Out-Of-Memory. |
| **Penyimpanan** | 20 GB SSD | 40 GB NVMe SSD | Untuk basis data, riwayat backup, dan media unggahan PAC. |
| **Sistem Operasi**| Ubuntu 22.04 LTS | Ubuntu 24.04 LTS | Didukung penuh oleh skrip otomatis `setup-vps.sh`. |
| **Jaringan** | IP Publik Statis | FQDN Domain Resmi | Port 80 (HTTP), 443 (HTTPS), dan 22 (SSH) terbuka. |

---

## 🛠️ Ringkasan Alat & Skrip Otomasi

Seluruh skrip otomasi telah disiapkan di folder [`scripts/`](file:///Users/mac/Downloads/KP-IF-SAKTI/scripts):

| Berkas Skrip | Fungsi & Peran |
|---|---|
| [`scripts/setup-vps.sh`](file:///Users/mac/Downloads/KP-IF-SAKTI/scripts/setup-vps.sh) | Inisialisasi awal VPS: install Docker, aktifkan Swap 2GB, firewall UFW, Nginx, Certbot SSL. |
| [`scripts/deploy.sh`](file:///Users/mac/Downloads/KP-IF-SAKTI/scripts/deploy.sh) | Build dan deploy produksi 1-klik: build kontainer, migrasi database, dan cache Laravel. |
| [`scripts/backup.sh`](file:///Users/mac/Downloads/KP-IF-SAKTI/scripts/backup.sh) | Pencadangan otomatis database MySQL & file media dengan rotasi 30 hari. |
| [`scripts/restore.sh`](file:///Users/mac/Downloads/KP-IF-SAKTI/scripts/restore.sh) | Pemulihan darurat basis data dari file `.sql.gz` ke dalam kontainer. |
| [`docker/nginx/vps-host-nginx.conf`](file:///Users/mac/Downloads/KP-IF-SAKTI/docker/nginx/vps-host-nginx.conf) | Template virtual host Nginx dengan SSL, HTTP/2, HSTS, dan rate limiting brute force. |
| [`docker-compose.prod.yml`](file:///Users/mac/Downloads/KP-IF-SAKTI/docker-compose.prod.yml) | Konfigurasi multi-kontainer Docker produksi dengan proteksi port dan batasan log. |

---

## 📋 Langkah-Langkah Deployment Produksi (Step-by-Step)

### Langkah 1: Persiapan DNS Domain
Sebelum menjalankan skrip SSL, arahkan DNS domain Anda ke IP publik VPS:
- **Tipe A Record**: `@` $\rightarrow$ `IP_PUBLIK_VPS_ANDA`
- **Tipe A Record**: `www` $\rightarrow$ `IP_PUBLIK_VPS_ANDA`
*(Tunggu propagasi DNS sekitar 5–15 menit)*.

---

### Langkah 2: Setup Awal VPS (One-Click Setup)
Masuk ke server VPS via SSH sebagai `root`:

```bash
ssh root@IP_PUBLIK_VPS
```

Jalankan skrip inisialisasi server otomatis:
```bash
curl -fsSL https://raw.githubusercontent.com/ikhsanhazamy/KP-IF-SAKTI/main/scripts/setup-vps.sh | sudo bash
```
> [!NOTE]
> Skrip ini otomatis memperbarui sistem, memasang Docker & Docker Compose, mengonfigurasi Swap 2GB, memasang Nginx & Certbot, serta mengunci firewall UFW.

---

### Langkah 3: Unduh Repositori & Konfigurasi Environment
Masuk ke direktori kerja yang telah disiapkan:

```bash
cd /var/www/KP-IF-SAKTI
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git .
```

Salin template konfigurasi produksi:
```bash
cp .env.production.example .env
nano .env
```

Sesuaikan nilai-nilai variabel penting berikut:
```env
APP_NAME=KP-IF-SAKTI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://fatayat-sukabumi.org

# Gunakan password acak dan kuat!
MYSQL_ROOT_PASSWORD=KetikkanPasswordRootAcak123!
DB_DATABASE=kp_production_db
DB_USERNAME=kp_prod_user
DB_PASSWORD=KetikkanPasswordUserAcak123!
```

---

### Langkah 4: Jalankan Deployment (One-Click Deploy)
Jalankan skrip deployment:

```bash
chmod +x scripts/*.sh
./scripts/deploy.sh
```

Skrip ini akan secara otomatis:
1. Menjalankan Docker build untuk backend dan frontend.
2. Menghubungkan basis data MySQL 8.0.
3. Menjalankan migrasi database (`php artisan migrate --force`).
4. Menjalankan seeder user admin awal (`php artisan db:seed --class=AdminUserSeeder`).
5. Menghubungkan direktori penyimpanan (`php artisan storage:link`).
6. Mengoptimasi performa cache Laravel (`config:cache`, `route:cache`, `view:cache`).
7. Menguji kesehatan aplikasi melalui endpoint `/up`.

---

### Langkah 5: Konfigurasi Host Nginx & Sertifikat SSL Let's Encrypt

1. Buat berkas konfigurasi Nginx di host server:
```bash
sudo cp docker/nginx/vps-host-nginx.conf /etc/nginx/sites-available/kp-if-sakti.conf
```

2. Sesuaikan nama domain di dalam berkas konfigurasi:
```bash
sudo sed -i 's/fatayat-sukabumi.org/DOMAIN_ANDA.COM/g' /etc/nginx/sites-available/kp-if-sakti.conf
```

3. Dapatkan sertifikat SSL Let's Encrypt menggunakan Certbot:
```bash
sudo certbot --nginx -d DOMAIN_ANDA.COM -d www.DOMAIN_ANDA.COM
```

4. Aktifkan virtual host dan reload Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/kp-if-sakti.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

Aplikasi kini telah aktif dengan HTTPS aman di `https://DOMAIN_ANDA.COM`! 🎉

---

### Langkah 6: Mengatur Jadwal Pencadangan Otomatis (Daily Backup)
Jadwalkan pencadangan basis data dan berkas media setiap hari pukul 02.00 WIB melalui Crontab:

```bash
sudo crontab -e
```

Tambahkan baris berikut di akhir berkas:
```cron
0 2 * * * /var/www/KP-IF-SAKTI/scripts/backup.sh >> /var/log/kp-backup.log 2>&1
```

Cadangan akan tersimpan di `/var/backups/kp-if-sakti/` dengan retensi otomatis 30 hari.

---

### Langkah 7: Pembaruan Kode di Masa Depan (Update / Deploy Ulang)
Setiap kali ada pembaruan kode di GitHub, Anda cukup masuk ke VPS dan menjalankan:

```bash
cd /var/www/KP-IF-SAKTI
./scripts/deploy.sh
```
Skrip ini akan otomatis melakukan `git pull`, rebuild aset baru, menjalankan migrasi jika ada, dan merefresh cache tanpa downtime yang signifikan.

---

### Langkah 8: Pemulihan Bencana (Disaster Recovery / Restore)
Jika server mengalami kendala fatal dan perlu memulihkan data dari berkas cadangan:

```bash
# Memulihkan dari backup otomatis terbaru:
./scripts/restore.sh

# ATAU memulihkan dari berkas spesifik:
./scripts/restore.sh /var/backups/kp-if-sakti/db_kp_production_db_2026-09-08_020000.sql.gz
```

---

## 🔍 Troubleshooting & Penanganan Kendala

### 1. Error: "502 Bad Gateway" pada Nginx
- **Penyebab**: Container `kp_production_app` belum selesai booting atau port 8000 tidak merespons.
- **Solusi**: Periksa status dan log container aplikasi:
  ```bash
  docker compose -f docker-compose.prod.yml ps
  docker compose -f docker-compose.prod.yml logs --tail=100 app
  ```

### 2. Error: "Killed" saat Build Frontend / Composer (Out of Memory)
- **Penyebab**: Server kehabisan memori RAM saat kompilasi aset Vite.
- **Solusi**: Pastikan Swap Memory aktif minimal 2GB:
  ```bash
  free -h
  # Jika Swap 0, jalankan kembali langkah setup swap:
  sudo fallocate -l 2G /swapfile && sudo chmod 600 /swapfile && sudo mkswap /swapfile && sudo swapon /swapfile
  ```

### 3. File Upload Gagal / "Permission Denied" pada Storage
- **Solusi**: Perbaiki izin kepemilikan direktori storage di host:
  ```bash
  sudo chown -R www-data:www-data backend/storage backend/bootstrap/cache
  sudo chmod -R 775 backend/storage backend/bootstrap/cache
  ```

### 4. Database Connection Refused
- **Penyebab**: Kontainer MySQL belum siap menerima koneksi saat Laravel dijalankan.
- **Solusi**: Periksa healthcheck kontainer database:
  ```bash
  docker compose -f docker-compose.prod.yml logs db
  ```
