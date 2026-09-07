# ⚡ Cheatsheet Perintah Server VPS (KP-IF-SAKTI)

Kumpulan perintah cepat untuk operasional, pemeliharaan, monitoring, dan debugging sistem pada server VPS Linux.

---

## 🚀 Perintah Operasional Utama (Otomatis)

| Perintah | Deskripsi |
|---|---|
| `./scripts/deploy.sh` | Update kode terbaru, build aset, migrasi, dan optimasi cache dalam 1 langkah. |
| `./scripts/backup.sh` | Dump database MySQL & zip folder media secara manual ke `/var/backups/kp-if-sakti/`. |
| `./scripts/restore.sh` | Pulihkan basis data dari file cadangan terbaru dengan konfirmasi interaktif. |
| `sudo ./scripts/setup-vps.sh` | Skrip inisialisasi server baru (Docker, Swap, Firewall, Nginx, SSL). |

---

## 🐳 Manajemen Kontainer Docker

```bash
# Cek status kontainer yang sedang berjalan
docker compose -f docker-compose.prod.yml ps

# Melihat log aplikasi Laravel & Nginx secara real-time
docker compose -f docker-compose.prod.yml logs -f app

# Melihat log database MySQL
docker compose -f docker-compose.prod.yml logs -f db

# Restart seluruh layanan tanpa build ulang
docker compose -f docker-compose.prod.yml restart

# Hentikan seluruh kontainer
docker compose -f docker-compose.prod.yml down

# Nyalakan ulang kontainer di latar belakang
docker compose -f docker-compose.prod.yml up -d
```

---

## ⚙️ Eksekusi Perintah Artisan Laravel di Kontainer

```bash
# Masuk ke terminal Bash di dalam kontainer aplikasi
docker compose -f docker-compose.prod.yml exec app bash

# Masuk ke Laravel Tinker interaktif
docker compose -f docker-compose.prod.yml exec app php artisan tinker

# Cek status migrasi basis data
docker compose -f docker-compose.prod.yml exec app php artisan migrate:status

# Bersihkan dan refresh seluruh cache
docker compose -f docker-compose.prod.yml exec app php artisan optimize:clear
docker compose -f docker-compose.prod.yml exec app php artisan config:cache
docker compose -f docker-compose.prod.yml exec app php artisan route:cache
docker compose -f docker-compose.prod.yml exec app php artisan view:cache

# Buat ulang symbolic link storage
docker compose -f docker-compose.prod.yml exec app php artisan storage:link --force

# Cek status antrean (Queue) & job yang gagal
docker compose -f docker-compose.prod.yml exec app php artisan queue:failed
```

---

## 🗄️ Akses Basis Data MySQL

```bash
# Masuk langsung ke CLI MySQL di dalam kontainer
docker compose -f docker-compose.prod.yml exec -it db mysql -u kp_prod_user -p kp_production_db

# Cek daftar tabel database
docker compose -f docker-compose.prod.yml exec -T db mysql -u kp_prod_user -p kp_production_db -e "SHOW TABLES;"

# Cek jumlah data anggota dan PAC
docker compose -f docker-compose.prod.yml exec -T db mysql -u kp_prod_user -p kp_production_db -e "SELECT count(*) AS total_anggota FROM anggotas; SELECT count(*) AS total_pac FROM pacs;"
```

---

## 🌐 Nginx Host & Sertifikat SSL

```bash
# Uji sintaks konfigurasi Nginx
sudo nginx -t

# Reload konfigurasi Nginx tanpa downtime
sudo systemctl reload nginx

# Periksa status layanan Nginx host
sudo systemctl status nginx

# Cek log akses Nginx host
sudo tail -f /var/log/nginx/kp_access.log

# Cek log error Nginx host
sudo tail -f /var/log/nginx/kp_error.log

# Cek masa aktif sertifikat SSL Let's Encrypt
sudo certbot certificates

# Simulasi perpanjangan otomatis SSL
sudo certbot renew --dry-run
```

---

## 🛡️ Keamanan & Firewall (UFW & Fail2ban)

```bash
# Cek status firewall
sudo ufw status verbose

# Cek status proteksi brute force fail2ban
sudo fail2ban-client status sshd

# Cek penggunaan RAM dan Swap
free -h

# Cek kapasitas penyimpanan harddisk
df -h /
```
