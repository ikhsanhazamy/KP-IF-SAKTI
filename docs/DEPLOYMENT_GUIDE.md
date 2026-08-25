# 🚀 Panduan Deployment Produksi (Deployment Guide)

Panduan komprehensif untuk melakukan deployment sistem **KP-IF-SAKTI** ke server produksi (VPS Linux, Ubuntu Server 22.04/24.04 LTS) menggunakan Docker Compose maupun arsitektur Nginx Standalone.

---

## 🖥️ Spesifikasi Server yang Disarankan

| Komponen | Spesifikasi Minimum | Rekomendasi Produksi |
|---|---|---|
| **CPU** | 1 vCPU | 2 vCPU atau lebih |
| **RAM** | 2 GB RAM | 4 GB RAM (agar proses build Vite & caching lancar) |
| **Penyimpanan** | 20 GB SSD | 40 GB SSD |
| **Sistem Operasi**| Ubuntu 22.04 / 24.04 LTS | Ubuntu 24.04 LTS |
| **Network** | Port 80, 443 terbuka | Static IP publik & Domain terkonfigurasi |

---

## 🐳 Metode 1: Deployment dengan Docker Compose (Sangat Disarankan)

### 1. Persiapan Server
Perbarui sistem dan instal Docker serta Docker Compose:
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl git ufw

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Tambahkan user saat ini ke grup docker
sudo usermod -aG docker $USER
newgrp docker
```

### 2. Clone Repositori Proyek
```bash
cd /var/www
git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI
```

### 3. Konfigurasi Environment Produksi
Salin template environment untuk backend:
```bash
cp backend/.env.example backend/.env
nano backend/.env
```

Pastikan variabel-variabel kunci bernilai aman untuk produksi:
```env
APP_NAME=KP-IF-SAKTI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://fatayat-sukabumi.org

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=kp_production_db
DB_USERNAME=kp_prod_user
DB_PASSWORD=GANTI_DENGAN_PASSWORD_DATABASE_KUAT_DAN_ACAK

# Konfigurasi Webhook Google Apps Script (Opsional)
GAS_PAC_WEBHOOK_URL=https://script.google.com/macros/s/AKfycb.../exec
GAS_PAC_WEBHOOK_TOKEN=GANTI_DENGAN_TOKEN_AMAN
```

Sesuaikan juga password database pada berkas `docker-compose.yml` agar cocok dengan `backend/.env`.

### 4. Build dan Jalankan Kontainer
```bash
docker compose -f docker-compose.yml up --build -d
```

### 5. Inisialisasi Database & Optimasi Cache Laravel
```bash
# Masuk ke kontainer app backend
docker compose exec app php artisan key:generate --force
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --force # opsional untuk data awal

# Caching konfigurasi & rute untuk performa maksimal
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
```

---

## 🌐 Konfigurasi Reverse Proxy Nginx & SSL (HTTPS)

Gunakan Nginx pada host server sebagai reverse proxy ke kontainer Docker:

### 1. Buat Berkas Konfigurasi Nginx
```bash
sudo nano /etc/nginx/sites-available/fatayat-sukabumi.conf
```

Isi dengan konfigurasi berikut:
```nginx
server {
    listen 80;
    server_name fatayat-sukabumi.org www.fatayat-sukabumi.org;

    # Frontend React SPA
    location / {
        proxy_pass http://127.0.0.1:5173;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }

    # Backend API & Admin Dashboard
    location ~ ^/(api|dashboard|anggota|data-pac|kegiatan|laporan|pengaturan|login|logout|csrf-token) {
        proxy_pass http://127.0.0.1:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    client_max_body_size 10M;
}
```

Aktifkan konfigurasi:
```bash
sudo ln -s /etc/nginx/sites-available/fatayat-sukabumi.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 2. Pasang Sertifikat SSL Gratis dengan Let's Encrypt (Certbot)
```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d fatayat-sukabumi.org -d www.fatayat-sukabumi.org
```

---

## ⏰ Otomasi Backup Database Berkala (Cron Job)

Buat script backup otomatis setiap hari pukul 02:00 dini hari:

```bash
sudo nano /usr/local/bin/backup-kp-db.sh
```

Isi dengan script:
```bash
#!/bin/bash
BACKUP_DIR="/var/backups/kp-db"
DATE=$(date +"%Y-%m-%d_%H%M%S")
mkdir -p $BACKUP_DIR

# Dump dari kontainer docker MySQL
docker compose -f /var/www/KP-IF-SAKTI/docker-compose.yml exec -T db mysqldump -u kp_prod_user -pGANTI_PASSWORD kp_production_db | gzip > $BACKUP_DIR/db_backup_$DATE.sql.gz

# Hapus backup yang lebih lama dari 30 hari
find $BACKUP_DIR -type f -name "*.sql.gz" -mtime +30 -delete
```

Berikan izin eksekusi dan daftarkan ke crontab:
```bash
sudo chmod +x /usr/local/bin/backup-kp-db.sh
sudo crontab -e
# Tambahkan baris:
0 2 * * * /usr/local/bin/backup-kp-db.sh >> /var/log/kp-backup.log 2>&1
```
