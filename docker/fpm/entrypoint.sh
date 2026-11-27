#!/bin/sh
set -eu

cd /var/www/html

if [ -z "${APP_KEY:-}" ]; then
    [ "${APP_ENV:-}" = preview ] || { echo "APP_KEY is not set" >&2; exit 1; }
    APP_KEY="$(php artisan key:generate --show)"
    export APP_KEY
fi

mkdir -p \
    "$(dirname "$DB_DATABASE")" \
    bootstrap/cache \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

[ -f "$DB_DATABASE" ] || touch "$DB_DATABASE"

php artisan migrate --force
php artisan optimize
php artisan storage:link 2>/dev/null || true

exec php-fpm --nodaemonize
