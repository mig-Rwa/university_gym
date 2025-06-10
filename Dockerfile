# -------- Build Stage --------
FROM composer:2.7 AS build

# Install system dependencies and Node
RUN apt-get update \
    && apt-get install -y git unzip libpng-dev libonig-dev libxml2-dev zip curl nodejs npm

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

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip

# Set working directory
WORKDIR /var/www

# Copy built application from previous stage
COPY --from=build /var/www /var/www

# Expose port 8080 and start PHP built-in server
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
