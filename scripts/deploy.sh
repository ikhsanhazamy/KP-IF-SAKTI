#!/bin/bash
# =============================================================================
# SKRIP DEPLOYMENT & PEMBARUAN SISTEM OTOMATIS (PRODUCTION VPS)
# =============================================================================
# Skrip ini menjalankan proses rilis produksi terpadu:
# 1. Validasi berkas environment (.env)
# 2. Build multi-container Docker (MySQL, Vite Asset Builders, Nginx+PHP)
# 3. Migrasi database otomatis
# 4. Inisialisasi storage symlink & permission
# 5. Optimasi cache produksi (Config, Route, View)
# 6. Verifikasi healthcheck endpoint
#
# Penggunaan:
# ./scripts/deploy.sh
# =============================================================================

set -e

# Warna pesan
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${BLUE}=================================================================${NC}"
echo -e "${GREEN}  Memulai Proses Deployment Produksi KP-IF-SAKTI...${NC}"
echo -e "${BLUE}=================================================================${NC}"

# 1. Pindah ke direktori root proyek
ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

# 2. Cek apakah berkas .env ada
if [ ! -f .env ]; then
    echo -e "${RED}[ERROR] Berkas .env tidak ditemukan di root proyek!${NC}"
    if [ -f .env.production.example ]; then
        echo -e "${YELLOW}Menyalin .env.production.example ke .env...${NC}"
        cp .env.production.example .env
        echo -e "${YELLOW}Silakan sesuaikan konfigurasi .env Anda lalu jalankan skrip ini kembali.${NC}"
        exit 1
    else
        echo -e "${RED}Template .env.production.example tidak ditemukan. Proses dibatalkan.${NC}"
        exit 1
    fi
fi

# 3. Cek apakah Docker Compose tersedia
if ! command -v docker &> /dev/null; then
    echo -e "${RED}[ERROR] Docker tidak terpasang di sistem ini! Jalankan ./scripts/setup-vps.sh terlebih dahulu.${NC}"
    exit 1
fi

# Tentukan berkas docker-compose yang digunakan
COMPOSE_FILE="docker-compose.prod.yml"
if [ ! -f "$COMPOSE_FILE" ]; then
    COMPOSE_FILE="docker-compose.yml"
fi
echo -e "${BLUE}Menggunakan berkas compose: ${COMPOSE_FILE}${NC}"

# 4. Ambil update kode terbaru jika ini repositori Git (Opsional)
if [ -d .git ]; then
    echo -e "\n${YELLOW}[1/6] Memeriksa pembaruan dari repositori Git...${NC}"
    git pull origin main || echo -e "${YELLOW}Catatan: Lewati git pull jika ada modifikasi lokal.${NC}"
fi

# 5. Siapkan izin direktori lokal storage Laravel
echo -e "\n${YELLOW}[2/6] Memeriksa hak akses direktori storage...${NC}"
mkdir -p backend/storage/app/public backend/storage/framework/cache backend/storage/framework/sessions backend/storage/framework/views backend/storage/logs backend/bootstrap/cache
chmod -R 775 backend/storage backend/bootstrap/cache 2>/dev/null || true

# 6. Jalankan Docker Compose Build & Up
echo -e "\n${YELLOW}[3/6] Menjalankan Docker Compose Build & Up...${NC}"
docker compose -f "$COMPOSE_FILE" build --pull
docker compose -f "$COMPOSE_FILE" up -d

echo -e "\n${YELLOW}[4/6] Menunggu container siap dan database online...${NC}"
sleep 5

# 7. Eksekusi Migrasi & Konfigurasi Laravel
echo -e "\n${YELLOW}[5/6] Menjalankan migrasi database & optimasi cache Laravel...${NC}"

# Inisialisasi storage link
docker compose -f "$COMPOSE_FILE" exec -T app php artisan storage:link --force || true

# Migrasi basis data
docker compose -f "$COMPOSE_FILE" exec -T app php artisan migrate --force

# Seeder user admin awal (hanya jika belum ada user)
docker compose -f "$COMPOSE_FILE" exec -T app php artisan db:seed --class=AdminUserSeeder --force || true

# Optimasi caching Laravel
docker compose -f "$COMPOSE_FILE" exec -T app php artisan optimize:clear
docker compose -f "$COMPOSE_FILE" exec -T app php artisan config:cache
docker compose -f "$COMPOSE_FILE" exec -T app php artisan route:cache
docker compose -f "$COMPOSE_FILE" exec -T app php artisan view:cache

# 8. Verifikasi Status Kesehatan Aplikasi
echo -e "\n${YELLOW}[6/6] Melakukan pengujian kesehatan aplikasi (Healthcheck)...${NC}"
sleep 3
if curl -s -f http://127.0.0.1:8000/up > /dev/null 2>&1; then
    echo -e "${GREEN}[OK] Endpoint Healthcheck (http://127.0.0.1:8000/up) merespons sukses (HTTP 200).${NC}"
elif curl -s -f http://localhost:8000/up > /dev/null 2>&1; then
    echo -e "${GREEN}[OK] Endpoint Healthcheck merespons sukses.${NC}"
else
    echo -e "${YELLOW}[PERINGATAN] Endpoint /up belum merespons langsung. Silakan cek logs:${NC}"
    echo -e "${BLUE}docker compose -f ${COMPOSE_FILE} logs --tail=50 app${NC}"
fi

echo -e "\n${GREEN}=================================================================${NC}"
echo -e "${GREEN}  DEPLOYMENT BERHASIL DISELESAIKAN!${NC}"
echo -e "${GREEN}=================================================================${NC}"
docker compose -f "$COMPOSE_FILE" ps
echo -e "\n${BLUE}Panduan Akses & Operasional:${NC}"
echo -e "  - Aplikasi lokal:     ${GREEN}http://localhost:8000${NC} (atau via Host Nginx domain Anda)"
echo -e "  - Cek logs aplikasi:  ${YELLOW}docker compose -f ${COMPOSE_FILE} logs -f app${NC}"
echo -e "  - Cek logs database:  ${YELLOW}docker compose -f ${COMPOSE_FILE} logs -f db${NC}"
echo -e "  - Backup database:    ${YELLOW}./scripts/backup.sh${NC}"
echo -e "${GREEN}=================================================================${NC}"
