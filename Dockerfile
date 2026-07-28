# Use official PHP-Apache base image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath

# Install Node.js (needed for compiling frontend assets with Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Enable Apache ModRewrite
RUN a2enmod rewrite

# Change Apache document root to public/ directory
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install NPM dependencies and build Vite assets
RUN npm install && npm run build

# Set proper permissions for Laravel storage, bootstrap/cache & database
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/database /var/www/html/storage /var/www/html/bootstrap/cache

# Make docker-entrypoint script executable
RUN chmod +x /var/www/html/docker-entrypoint.sh

# Expose Apache Port
EXPOSE 80

# Configure entrypoint
ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]
