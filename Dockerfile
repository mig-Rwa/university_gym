# Stage 1: install dependencies & build
FROM php:8.2-fpm AS build

# Install system deps + PHP extensions
RUN apt-get update \
  && apt-get install -y unzip zip libzip-dev \
  && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy only composer files first (cache layer)
COPY composer.json composer.lock ./

# Install PHP deps without running scripts
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy the rest of the app (so artisan exists)
COPY . .

# Manually run Laravel’s post-autoload scripts
RUN php artisan package:discover --ansi \
  && php artisan key:generate \
  && php artisan config:cache

# Stage 2: runtime
FROM php:8.2-fpm

WORKDIR /var/www

# Copy built app from the build stage
COPY --from=build /var/www /var/www

# Expose your port and start the server
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
