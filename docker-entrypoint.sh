#!/bin/sh

# Ensure SQLite file exists if SQLite is being used
if [ ! -f /var/www/html/database/database.sqlite ]; then
    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite
fi

# Ensure full read/write permissions BEFORE artisan commands
chown -R www-data:www-data /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache

# Clear config, route, and view caches to force Laravel to read fresh Render env variables
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Run database migrations and seeders automatically on startup
php artisan migrate --force
php artisan db:seed --force

# Ensure www-data webserver user owns the database directory and files for SQLite write permissions
chown -R www-data:www-data /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache in the foreground (standard entrypoint behavior)
exec apache2-foreground
