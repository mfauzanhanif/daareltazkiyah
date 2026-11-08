#!/bin/bash
set -e

# Adapt Apache port to Railway dynamic $PORT
if [ -n "$PORT" ]; then
    sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
    sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf
fi

# Symbolic link for public storage
php artisan storage:link --force || true

# Production caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ensure single MPM active
a2dismod mpm_event mpm_worker 2>/dev/null || true

# Auto run migrations
php artisan migrate --force

exec "$@"

