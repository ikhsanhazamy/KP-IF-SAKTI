#!/bin/bash
# =============================================================================
# SKRIP PEMULIHAN BASIS DATA & MEDIA (RESTORE DISASTER RECOVERY)
# =============================================================================
# Memulihkan database MySQL dari berkas cadangan .sql.gz ke dalam kontainer
# Docker produksi dan memulihkan berkas media yang tersimpan.
#
# Penggunaan:
# ./scripts/restore.sh [path_ke_file_backup.sql.gz]
#
# Contoh:
# ./scripts/restore.sh /var/backups/kp-if-sakti/db_kp_production_db_2026-09-08_020000.sql.gz
# =============================================================================

set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

COMPOSE_FILE="docker-compose.prod.yml"
if [ ! -f "$COMPOSE_FILE" ]; then
    COMPOSE_FILE="docker-compose.yml"
fi

BACKUP_FILE="$1"

# Jika tidak ada argumen, cari daftar file backup terbaru
if [ -z "$BACKUP_FILE" ]; then
    BACKUP_DIR="/var/backups/kp-if-sakti"
    if [ ! -d "$BACKUP_DIR" ]; then
        BACKUP_DIR="$ROOT_DIR/backups"
    fi

    echo -e "${YELLOW}Berkas cadangan tidak dispesifikasikan. Mencari di ${BACKUP_DIR}...${NC}"
    LATEST_BACKUP=$(ls -t "$BACKUP_DIR"/*.sql.gz 2>/dev/null | head -n 1 || true)

    if [ -z "$LATEST_BACKUP" ]; then
        echo -e "${RED}[ERROR] Tidak ditemukan berkas backup .sql.gz di ${BACKUP_DIR}.${NC}"
        echo -e "Silakan tentukan path berkas manual: ./scripts/restore.sh /path/to/backup.sql.gz"
        exit 1
    fi

    BACKUP_FILE="$LATEST_BACKUP"
    echo -e "Ditemukan berkas cadangan terbaru: ${GREEN}${BACKUP_FILE}${NC}"
fi

if [ ! -f "$BACKUP_FILE" ]; then
    echo -e "${RED}[ERROR] Berkas backup tidak ditemukan: ${BACKUP_FILE}${NC}"
    exit 1
fi

# Konfirmasi pengguna
echo -e "${RED}=================================================================${NC}"
echo -e "${RED}  PERINGATAN: PROSES RESTORE BASIS DATA AKAN DILAKUKAN!${NC}"
echo -e "${RED}  Data aktif saat ini akan ditimpa dengan data dari:${NC}"
echo -e "${YELLOW}  ${BACKUP_FILE}${NC}"
echo -e "${RED}=================================================================${NC}"
read -p "Apakah Anda yakin ingin melanjutkan proses restore? (ketik 'yes' untuk konfirmasi): " CONFIRM
if [ "$CONFIRM" != "yes" ]; then
    echo "Proses restore dibatalkan oleh pengguna."
    exit 0
fi

# Muat kredensial dari .env
if [ -f .env ]; then
    DB_NAME=$(grep -E '^DB_DATABASE=' .env | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    DB_USER=$(grep -E '^DB_USERNAME=' .env | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    DB_PASS=$(grep -E '^DB_PASSWORD=' .env | cut -d '=' -f2- | tr -d '"' | tr -d "'")
fi

DB_NAME=${DB_NAME:-kp_production_db}
DB_USER=${DB_USER:-kp_prod_user}
DB_PASS=${DB_PASS:-kp_password}

echo -e "\n${YELLOW}1. Mengimpor data MySQL ke kontainer...${NC}"
gunzip -c "$BACKUP_FILE" | docker compose -f "$COMPOSE_FILE" exec -T db mysql \
    -u"${DB_USER}" \
    -p"${DB_PASS}" \
    "${DB_NAME}"

echo -e "${GREEN}[OK] Basis data berhasil dipulihkan.${NC}"

# Cek apakah ada file backup media yang sesuai
TIMESTAMP=$(basename "$BACKUP_FILE" | grep -oE '[0-9]{4}-[0-9]{2}-[0-9]{2}_[0-9]{6}' || true)
if [ -n "$TIMESTAMP" ]; then
    DIRNAME=$(dirname "$BACKUP_FILE")
    MEDIA_ARCHIVE="$DIRNAME/media_${TIMESTAMP}.tar.gz"
    if [ -f "$MEDIA_ARCHIVE" ]; then
        echo -e "\n${YELLOW}2. Ditemukan arsip media: ${MEDIA_ARCHIVE}${NC}"
        read -p "Pulihkan juga berkas media unggahan? (y/n): " RESTORE_MEDIA
        if [ "$RESTORE_MEDIA" = "y" ] || [ "$RESTORE_MEDIA" = "Y" ]; then
            tar -xzf "$MEDIA_ARCHIVE" -C backend/storage/app/
            echo -e "${GREEN}[OK] Berkas media berhasil dipulihkan.${NC}"
        fi
    fi
fi

echo -e "\n${YELLOW}3. Membersihkan cache aplikasi Laravel...${NC}"
docker compose -f "$COMPOSE_FILE" exec -T app php artisan optimize:clear
docker compose -f "$COMPOSE_FILE" exec -T app php artisan config:cache
docker compose -f "$COMPOSE_FILE" exec -T app php artisan route:cache
docker compose -f "$COMPOSE_FILE" exec -T app php artisan view:cache

echo -e "\n${GREEN}=================================================================${NC}"
echo -e "${GREEN}  PROSES RESTORE BERHASIL DISELESAIKAN!${NC}"
echo -e "${GREEN}=================================================================${NC}"
