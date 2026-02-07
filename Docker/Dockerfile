FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones de PHP necesarias (como mysqli para BD)
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    && docker-php-ext-install mysqli pdo_mysql zip

# Instalar Composer 2.9.5 exactamente
COPY --from=composer/composer:2.9.5-bin /composer /usr/bin/composer

WORKDIR /var/www/html