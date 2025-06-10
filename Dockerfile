# -------- Build Stage --------
# -------- Build Stage --------
FROM php:8.2-fpm as build

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        curl \
        nodejs \
        npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application code
COPY . .

# Install Node dependencies and build assets
RUN npm install && npm run build

# -------- Production Stage --------
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# Set working directory
WORKDIR /var/www

# Copy built application from previous stage
COPY --from=build /var/www /var/www

# Expose port 8080 and start PHP built-in server
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
