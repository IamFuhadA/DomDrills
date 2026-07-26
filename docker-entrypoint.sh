#!/bin/sh

# Cache configuration, routes, and views for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations and seeders automatically on startup
php artisan migrate --force
php artisan db:seed --force

# Start Apache in the foreground (standard entrypoint behavior)
exec apache2-foreground
