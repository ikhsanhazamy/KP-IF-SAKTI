#!/bin/bash
# =============================================================================
# SKRIP PENCADANGAN BASIS DATA & MEDIA (AUTOMATED DAILY BACKUP)
# =============================================================================
# Melakukan dump basis data MySQL dan pengarsipan berkas media dari kontainer
# Docker ke format arsip terkompresi (.sql.gz dan .tar.gz), serta menerapkan
# kebijakan rotasi otomatis (menghapus backup lebih dari 30 hari).
#
# Penggunaan:
# ./scripts/backup.sh
#
# Pendaftaran ke Crontab (Harian pukul 02.00 WIB):
# 0 2 * * * /var/www/KP-IF-SAKTI/scripts/backup.sh >> /var/log/kp-backup.log 2>&1
# =============================================================================

set -e

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

TIMESTAMP=$(date +"%Y-%m-%d_%H%M%S")
BACKUP_DIR="/var/backups/kp-if-sakti"

# Buat direktori cadangan jika belum ada
if [ ! -d "$BACKUP_DIR" ] || [ ! -w "$BACKUP_DIR" ]; then
    mkdir -p "$ROOT_DIR/backups"
    BACKUP_DIR="$ROOT_DIR/backups"
fi

# Tentukan berkas compose yang aktif
COMPOSE_FILE="docker-compose.prod.yml"
if [ ! -f "$COMPOSE_FILE" ]; then
    COMPOSE_FILE="docker-compose.yml"
fi

# Muat kredensial dari berkas .env
if [ -f .env ]; then
    DB_NAME=$(grep -E '^DB_DATABASE=' .env | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    DB_USER=$(grep -E '^DB_USERNAME=' .env | cut -d '=' -f2- | tr -d '"' | tr -d "'")
    DB_PASS=$(grep -E '^DB_PASSWORD=' .env | cut -d '=' -f2- | tr -d '"' | tr -d "'")
fi

DB_NAME=${DB_NAME:-kp_production_db}
DB_USER=${DB_USER:-kp_prod_user}
DB_PASS=${DB_PASS:-kp_password}

echo "[$(date '+%Y-%m-%d %H:%M:%S')] Memulai pencadangan basis data & media..."

# 1. Dump Basis Data MySQL
DB_BACKUP_FILE="$BACKUP_DIR/db_${DB_NAME}_${TIMESTAMP}.sql.gz"
docker compose -f "$COMPOSE_FILE" exec -T db mysqldump \
    -u"${DB_USER}" \
    -p"${DB_PASS}" \
    --single-transaction \
    --quick \
    --lock-tables=false \
    "${DB_NAME}" | gzip > "$DB_BACKUP_FILE"

echo "[$(date '+%Y-%m-%d %H:%M:%S')] Database berhasil dicadangkan: $DB_BACKUP_FILE ($(du -h "$DB_BACKUP_FILE" | cut -f1))"

# 2. Backup Folder Media Unggahan (Storage Public)
MEDIA_BACKUP_FILE="$BACKUP_DIR/media_${TIMESTAMP}.tar.gz"
if [ -d "backend/storage/app/public" ]; then
    tar -czf "$MEDIA_BACKUP_FILE" -C backend/storage/app public 2>/dev/null || true
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] Media storage berhasil dicadangkan: $MEDIA_BACKUP_FILE ($(du -h "$MEDIA_BACKUP_FILE" | cut -f1))"
fi

# 3. Kebijakan Retensi: Hapus cadangan lebih lama dari 30 hari
find "$BACKUP_DIR" -type f \( -name "*.sql.gz" -o -name "*.tar.gz" \) -mtime +30 -delete

echo "[$(date '+%Y-%m-%d %H:%M:%S')] Proses pencadangan selesai dengan sukses."
