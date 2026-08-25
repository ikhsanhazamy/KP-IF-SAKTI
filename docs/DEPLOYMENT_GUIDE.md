# 🚀 Panduan Deployment Produksi (Production Deployment Guide)

Panduan komprehensif untuk melakukan rilis dan pemeliharaan sistem **KP-IF-SAKTI** pada server produksi Linux (Ubuntu Server 22.04/24.04 LTS) menggunakan Docker Compose, Nginx Reverse Proxy, dan SSL Let's Encrypt.

---

## 🖥️ Spesifikasi Server yang Disarankan

| Komponen | Spesifikasi Minimum | Rekomendasi Produksi |
|---|---|---|
| **CPU** | 1 vCPU | 2 vCPU atau lebih |
| **RAM** | 2 GB RAM | 4 GB RAM (agar proses compile Vite & worker lancar) |
| **Penyimpanan** | 20 GB SSD | 40 GB NVMe SSD |
| **Sistem Operasi**| Ubuntu 22.04 LTS | Ubuntu 24.04 LTS |
| **Network** | Port 80, 443 terbuka | Static Public IP & Fully Qualified Domain Name (FQDN) |

---

## 🐳 Langkah-Langkah Deployment dengan Docker Compose

### 1. Persiapan Awal Server
Perbarui dependensi sistem dan pasang Docker Engine serta Docker Compose:

```bash
# Update repository & install paket dasar
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl git ufw fail2ban

# Pasang Docker & Docker Compose Plugin
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Tambahkan user non-root ke grup docker
sudo usermod -aG docker $USER
newgrp docker

# Konfigurasi Firewall UFW
sudo ufw allow OpenSSH
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable
```

---

### 2. Unduh Repositori Proyek
```bash
cd /var/www
sudo git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git
cd KP-IF-SAKTI
```

---

### 3. Konfigurasi Environment Produksi
Salin template `.env.example` ke `.env` pada backend:

```bash
cp backend/.env.example backend/.env
nano backend/.env
```

Sesuaikan nilai-nilai kunci berikut:

```env
APP_NAME=KP-IF-SAKTI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://fatayat-sukabumi.org

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=kp_production_db
DB_USERNAME=kp_prod_user
DB_PASSWORD=GANTI_DENGAN_PASSWORD_DATABASE_KUAT_DAN_ACAK

# Driver Sessions, Cache, & Queue
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Webhook Google Apps Script (Opsional)
GOOGLE_APPS_SCRIPT_WEBHOOK_URL=https://script.google.com/macros/s/AKfycb.../exec
GOOGLE_APPS_SCRIPT_WEBHOOK_TOKEN=GANTI_DENGAN_TOKEN_AMAN
```

Pastikan variabel database pada `docker-compose.yml` cocok dengan kredensial di atas.

---

### 4. Build dan Jalankan Multi-Container
Jalankan proses kompilasi aset frontend dan jalankan kontainer di latar belakang (*detached mode*):

```bash
docker compose up --build -d
```

Periksa status seluruh kontainer:
```bash
docker compose ps
```

---

### 5. Inisialisasi Database & Optimasi Cache Laravel
Jalankan migrasi database dan optimasi konfigurasi di dalam kontainer `app`:

```bash
# Generate application key & jalankan migrasi
docker compose exec app php artisan key:generate --force
docker compose exec app php artisan migrate --force

# Buat symbolic link storage berkas publik
docker compose exec app php artisan storage:link

# Optimasi caching untuk performa tinggi
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
```

---

## 🌐 Konfigurasi Host Reverse Proxy Nginx & SSL (HTTPS)

Gunakan Nginx pada host server sebagai gerbang utama untuk mengarahkan lalu lintas internet ke kontainer Docker:

### 1. Buat Berkas Konfigurasi Virtual Host
```bash
sudo nano /etc/nginx/sites-available/fatayat-sukabumi.conf
```

Isi dengan konfigurasi lengkap berikut:

```nginx
server {
    listen 80;
    server_name fatayat-sukabumi.org www.fatayat-sukabumi.org;

    # Sembunyikan versi Nginx untuk keamanan
    server_tokens off;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Batas ukuran upload foto
    client_max_body_size 10M;

    # Reverse proxy ke App Container (Port 8000)
    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_cache_bypass $http_upgrade;
    }
}
```

Aktifkan konfigurasi Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/fatayat-sukabumi.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

### 2. Pasang Sertifikat SSL Gratis (Let's Encrypt / Certbot)
```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d fatayat-sukabumi.org -d www.fatayat-sukabumi.org
```

Certbot akan otomatis memperbarui sertifikat SSL sebelum masa berlakunya habis (90 hari). Anda dapat menguji proses pembaruan otomatis dengan:
```bash
sudo certbot renew --dry-run
```

---

## ⏰ Otomasi Pencadangan Basis Data (Daily Backup Cron)

Buat script pencadangan database otomatis setiap hari pukul 02:00 WIB:

```bash
sudo nano /usr/local/bin/backup-kp-db.sh
```

Isi dengan skrip berikut:
```bash
#!/bin/bash
BACKUP_DIR="/var/backups/kp-db"
DATE=$(date +"%Y-%m-%d_%H%M%S")
mkdir -p $BACKUP_DIR

# Dump database dari container MySQL Docker
docker compose -f /var/www/KP-IF-SAKTI/docker-compose.yml exec -T db mysqldump -u kp_prod_user -pGANTI_PASSWORD kp_production_db | gzip > $BACKUP_DIR/db_backup_$DATE.sql.gz

# Hapus cadangan yang berusia lebih dari 30 hari
find $BACKUP_DIR -type f -name "*.sql.gz" -mtime +30 -delete

echo "[$(date)] Backup basis data berhasil disimpan ke $BACKUP_DIR/db_backup_$DATE.sql.gz"
```

Berikan izin eksekusi dan daftarkan ke Crontab:
```bash
sudo chmod +x /usr/local/bin/backup-kp-db.sh
sudo crontab -e
# Tambahkan baris di akhir:
0 2 * * * /usr/local/bin/backup-kp-db.sh >> /var/log/kp-backup.log 2>&1
```

---

## 🔄 Pemulihan Bencana & Restore Database (Disaster Recovery)

Jika terjadi kendala dan Anda ingin memulihkan database dari file cadangan `.sql.gz`:

```bash
# 1. Ekstrak file backup
gunzip -c /var/backups/kp-db/db_backup_YYYY-MM-DD_HHMMSS.sql.gz > /tmp/restore.sql

# 2. Impor ke container database MySQL
docker compose exec -T db mysql -u kp_prod_user -pGANTI_PASSWORD kp_production_db < /tmp/restore.sql

# 3. Bersihkan file sementara
rm /tmp/restore.sql
```

---

## 📊 Pemantauan Log & Kesehatan Sistem (Monitoring)

- **Cek Log Backend Laravel**: `docker compose exec app tail -f storage/logs/laravel.log`
- **Cek Log Web Server Nginx**: `docker compose exec app tail -f /var/log/nginx/error.log`
- **Cek Status Service Supervisor & Queue Worker**: `docker compose exec app supervisorctl status`
- **Cek Health Check Endpoint**: `curl -I https://fatayat-sukabumi.org/up`
