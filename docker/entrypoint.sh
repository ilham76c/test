#!/bin/sh
set -e

cd /var/www/html

# Ensure Laravel directories exist
mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Set permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Start Apache
exec "$@"
