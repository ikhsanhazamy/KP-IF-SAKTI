#!/bin/sh
set -e

if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

set_env_value() {
    key="$1"
    value="$2"

    if grep -q "^${key}=" .env; then
        sed -i "s#^${key}=.*#${key}=${value}#" .env
    else
        printf '%s=%s\n' "$key" "$value" >> .env
    fi
}

if [ -f .env ]; then
    set_env_value APP_URL "${APP_URL:-http://localhost:8000}"
    set_env_value DB_CONNECTION "${DB_CONNECTION:-mysql}"
    set_env_value DB_HOST "${DB_HOST:-db}"
    set_env_value DB_PORT "${DB_PORT:-3306}"
    set_env_value DB_DATABASE "${DB_DATABASE:-kp_db}"
    set_env_value DB_USERNAME "${DB_USERNAME:-kp_user}"
    set_env_value DB_PASSWORD "${DB_PASSWORD:-kp_password}"
    set_env_value SESSION_DRIVER "${SESSION_DRIVER:-database}"
    set_env_value CACHE_STORE "${CACHE_STORE:-database}"
    set_env_value QUEUE_CONNECTION "${QUEUE_CONNECTION:-database}"
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
php artisan config:cache
php artisan serve --host=0.0.0.0 --port=8000
