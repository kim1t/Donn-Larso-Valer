#!/bin/sh
set -eu

cd /var/www/html

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
