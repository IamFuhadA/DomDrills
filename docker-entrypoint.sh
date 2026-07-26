#!/bin/sh

# Clear config, route, and view caches to force Laravel to read fresh Render env variables
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Run database migrations and seeders automatically on startup
php artisan migrate --force
php artisan db:seed --force

# Start Apache in the foreground (standard entrypoint behavior)
exec apache2-foreground
