# ──────────────────────────────────────────────────────────────
# Stage 1: build & compile all PHP + JS deps
# ──────────────────────────────────────────────────────────────
FROM php:8.2-fpm AS build

# Install system libraries
RUN apt-get update \
  && apt-get install -y \
       unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
       libcurl4-openssl-dev nodejs npm \
  && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
      pdo_mysql zip bcmath mbstring xml intl gd opcache

# Bring in Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Install PHP deps without scripts
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy your app & build assets
COPY . .
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# ──────────────────────────────────────────────────────────────
 # Stage 2: runtime
FROM php:8.2-fpm

WORKDIR /var/www

COPY --from=build /var/www /var/www

# Use a simple, single-quoted JSON array for the startup command:
ENTRYPOINT ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php-fpm"]

EXPOSE 8080
