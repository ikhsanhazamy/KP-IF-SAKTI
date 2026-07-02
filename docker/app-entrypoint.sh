#!/bin/sh
set -e

if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

if [ -f .env ] && ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --force
fi

php artisan config:clear
php artisan storage:link --force

if [ "${DB_CONNECTION}" = "mysql" ] || [ "${DB_CONNECTION}" = "mariadb" ]; then
    echo "Waiting for database ${DB_HOST}:${DB_PORT:-3306}..."

    until php -r '
        $host = getenv("DB_HOST") ?: "127.0.0.1";
        $port = getenv("DB_PORT") ?: "3306";
        $user = getenv("DB_USERNAME") ?: "root";
        $pass = getenv("DB_PASSWORD") ?: "";

        try {
            new PDO("mysql:host={$host};port={$port}", $user, $pass);
            exit(0);
        } catch (Throwable $e) {
            exit(1);
        }
    '; do
        sleep 2
    done
fi

php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000
