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

 # 6) Install JS deps and build assets
 RUN npm install \
  && npm run build \
  && echo "=== public/build contents ===" \
  && ls -R public/build \
  && echo "=== end build contents ==="
 RUN npm install \
 && npm run build \
  && echo "=== POST-BUILD: listing public folder ===" \
  && ls -R public \
  && echo "=== POST-BUILD: listing public/build folder (if it exists) ===" \
  && ls -R public/build || echo "public/build not found" \
  && echo "=== END OF BUILD DUMP ==="
 
# 7) Ensure .env exists before Artisan commands
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# 8) Set permissions on storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# 9) Run Artisan commands (key, caches)
RUN php artisan key:generate \
 && php artisan config:cache


RUN php artisan migrate --force || true

# Stage 2: runtime
FROM php:8.2-fpm

WORKDIR /var/www

# Copy built app from build stage
COPY --from=build /var/www /var/www

# Expose port and start server
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
