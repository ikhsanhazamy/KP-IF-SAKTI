FROM php:8.2-fpm

# Install system dependencies (including Nginx & Supervisor)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    default-mysql-client \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    nginx \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions. MySQL is used by Docker Compose; SQLite stays available for PHPUnit.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

COPY docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files dulu (untuk layer caching)
# Context = root project, jadi path pakai backend/
COPY backend/composer.json backend/composer.lock ./

# Install PHP dependencies
RUN composer install --no-scripts --no-autoloader --no-interaction

# Copy seluruh isi backend
COPY backend/ .

# Generate optimized autoload
RUN composer dump-autoload --optimize

# Fix storage permissions
RUN chmod -R 775 storage bootstrap/cache

# Nginx & Supervisor config
COPY docker/nginx/default.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Remove default nginx config that may conflict
RUN rm -f /etc/nginx/sites-enabled/default \
    && ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Create frontend directory for static files
RUN mkdir -p /var/www/frontend

COPY docker/app-entrypoint.sh /usr/local/bin/app-entrypoint.sh
RUN chmod +x /usr/local/bin/app-entrypoint.sh

EXPOSE 80

CMD ["sh", "/usr/local/bin/app-entrypoint.sh"]
