FROM php:8.2-apache

# 1. Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libpng-dev \
    && docker-php-ext-install mysqli pdo_mysql zip gd

# 2. Activar mod_rewrite de Apache (crucial para Laravel)
RUN a2enmod rewrite

# 3. Cambiar el DocumentRoot de Apache a la carpeta public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Instalar Composer 2.9.5
COPY --from=composer/composer:2.9.5-bin /composer /usr/bin/composer

WORKDIR /var/www/html