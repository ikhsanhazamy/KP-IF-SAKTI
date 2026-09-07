#!/bin/bash
# =============================================================================
# SKRIP INISIALISASI & SETUP SERVER VPS OTOMATIS (UBUNTU 22.04 / 24.04 LTS)
# =============================================================================
# Gunakan skrip ini pada VPS yang baru di-install untuk menyiapkan seluruh
# dependensi: Docker, Docker Compose, Swap, Firewall, Nginx, & SSL Certbot.
#
# Cara Menjalankan:
# curl -fsSL https://raw.githubusercontent.com/ikhsanhazamy/KP-IF-SAKTI/main/scripts/setup-vps.sh | sudo bash
# ATAU jika sudah di dalam repositori:
# chmod +x scripts/setup-vps.sh && sudo ./scripts/setup-vps.sh
# =============================================================================

set -e

# Warna output terminal
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${BLUE}=================================================================${NC}"
echo -e "${GREEN}  Memulai Inisialisasi Server VPS untuk KP-IF-SAKTI...${NC}"
echo -e "${BLUE}=================================================================${NC}"

# 1. Pastikan dijalankan sebagai root atau sudo
if [ "$EUID" -ne 0 ]; then
    echo -e "${RED}[ERROR] Skrip ini harus dijalankan dengan hak akses root (sudo).${NC}"
    exit 1
fi

REAL_USER=${SUDO_USER:-$USER}

# 2. Update paket sistem operasi
echo -e "\n${YELLOW}[1/7] Memperbarui indeks paket sistem...${NC}"
apt-get update && apt-get upgrade -y
apt-get install -y \
    curl \
    git \
    ufw \
    fail2ban \
    ca-certificates \
    gnupg \
    lsb-release \
    unzip \
    htop \
    tar \
    gzip

# 3. Setup Swap Memory (Mencegah Crash Out-of-Memory pada VPS 1GB/2GB RAM)
echo -e "\n${YELLOW}[2/7] Memeriksa konfigurasi Swap Memory...${NC}"
SWAP_TOTAL=$(free -m | awk '/^Swap:/ {print $2}')
if [ "$SWAP_TOTAL" -lt 1024 ]; then
    echo -e "${BLUE}Swap terdeteksi kurang dari 1GB. Membuat swapfile 2GB...${NC}"
    fallocate -l 2G /swapfile || dd if=/dev/zero of=/swapfile bs=1M count=2048
    chmod 600 /swapfile
    mkswap /swapfile
    swapon /swapfile
    if ! grep -q '/swapfile' /etc/fstab; then
        echo '/swapfile none swap sw 0 0' >> /etc/fstab
    fi
    sysctl vm.swappiness=10
    if ! grep -q 'vm.swappiness' /etc/sysctl.conf; then
        echo 'vm.swappiness=10' >> /etc/sysctl.conf
    fi
    echo -e "${GREEN}Swap 2GB berhasil diaktifkan.${NC}"
else
    echo -e "${GREEN}Swap memory sudah mencukupi (${SWAP_TOTAL}MB).${NC}"
fi

# 4. Pasang Docker Engine & Docker Compose Terbaru
echo -e "\n${YELLOW}[3/7] Memasang Docker Engine & Docker Compose Plugin...${NC}"
if ! command -v docker &> /dev/null; then
    install -m 0755 -d /etc/apt/keyrings
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg --yes
    chmod a+r /etc/apt/keyrings/docker.gpg

    echo \
      "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
      $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
      tee /etc/apt/sources.list.d/docker.list > /dev/null

    apt-get update
    apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
    systemctl enable docker
    systemctl start docker
    echo -e "${GREEN}Docker berhasil dipasang.${NC}"
else
    echo -e "${GREEN}Docker sudah terpasang: $(docker --version)${NC}"
fi

# Berikan izin user non-root mengakses docker
usermod -aG docker "$REAL_USER"

# 5. Pasang Web Server Host Nginx & Certbot SSL
echo -e "\n${YELLOW}[4/7] Memasang Nginx Host & Certbot SSL...${NC}"
apt-get install -y nginx certbot python3-certbot-nginx
systemctl enable nginx
systemctl start nginx

# 6. Konfigurasi Firewall UFW & Keamanan Fail2ban
echo -e "\n${YELLOW}[5/7] Mengonfigurasi Firewall UFW & Fail2ban...${NC}"
ufw default deny incoming
ufw default allow outgoing
ufw allow OpenSSH
ufw allow 80/tcp
ufw allow 443/tcp
ufw --force enable

systemctl enable fail2ban
systemctl start fail2ban
echo -e "${GREEN}Firewall aktif (Port SSH, 80, 443 terbuka).${NC}"

# 7. Siapkan Direktori Kerja & Backup
echo -e "\n${YELLOW}[6/7] Menyiapkan direktori kerja proyek dan cadangan...${NC}"
mkdir -p /var/www/KP-IF-SAKTI
mkdir -p /var/backups/kp-if-sakti
chown -R "$REAL_USER":"$REAL_USER" /var/www/KP-IF-SAKTI
chown -R "$REAL_USER":"$REAL_USER" /var/backups/kp-if-sakti

echo -e "\n${YELLOW}[7/7] Verifikasi instalasi...${NC}"
docker --version
docker compose version
nginx -v

echo -e "\n${GREEN}=================================================================${NC}"
echo -e "${GREEN}  SETUP VPS SELESAI DENGAN SUKSES!${NC}"
echo -e "${GREEN}=================================================================${NC}"
echo -e "Langkah selanjutnya untuk deploy proyek:"
echo -e "  1. Masuk sebagai user: ${BLUE}su - ${REAL_USER}${NC}"
echo -e "  2. Clone repositori ke direktori kerja:"
echo -e "     ${BLUE}cd /var/www/KP-IF-SAKTI${NC}"
echo -e "     ${BLUE}git clone https://github.com/ikhsanhazamy/KP-IF-SAKTI.git .${NC}"
echo -e "  3. Konfigurasi berkas environment:"
echo -e "     ${BLUE}cp .env.production.example .env && nano .env${NC}"
echo -e "  4. Jalankan script deploy otomatis:"
echo -e "     ${BLUE}chmod +x scripts/*.sh && ./scripts/deploy.sh${NC}"
echo -e "${GREEN}=================================================================${NC}"
