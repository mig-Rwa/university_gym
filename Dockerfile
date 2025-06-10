# Stage 1: build & compile all PHP + JS deps
FROM php:8.2-fpm AS build

# 1) Install system libraries (including Node.js & npm)
RUN apt-get update \
  && apt-get install -y \
       unzip \
       zip \
       libzip-dev \
       libpng-dev \
       libonig-dev \
       libxml2-dev \
       libicu-dev \
       libcurl4-openssl-dev \
       curl \
       nodejs \
       npm \
  && rm -rf /var/lib/apt/lists/*

# 2) Install PHP extensions
RUN docker-php-ext-install \
      pdo_mysql \
      zip \
      bcmath \
      mbstring \
      xml \
      intl \
      gd \
      opcache

# 3) Copy Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 4) Only copy composer files and install PHP deps without scripts
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 5) Copy the rest of your application (including artisan & frontend assets)
COPY . .

# 6) Install JS dependencies and build assets
RUN npm install \
 && npm run build

# 7) Ensure .env exists before Artisan commands
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# 8) Set permissions on storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# 9) Run Artisan commands (key, caches)
RUN php artisan key:generate \
 && php artisan config:cache

# Stage 2: runtime
FROM php:8.2-fpm

# Install PHP extensions in runtime (pdo_mysql needed for migrations)
RUN apt-get update \
  && apt-get install -y \
       libzip-dev \
       libpng-dev \
       libonig-dev \
       libxml2-dev \
       libicu-dev \
  && docker-php-ext-install \
       pdo_mysql \
       bcmath \
       mbstring \
       xml \
       intl \
       gd \
       opcache \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

# Copy the built app from build stage
COPY --from=build /var/www /var/www

# At container start: cache config & run migrations, then start PHP-FPM
ENTRYPOINT ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php-fpm"]

EXPOSE 8080
