FROM php:8.1-fpm-alpine

# Install runtime deps
RUN apk add --no-cache \
    bash \
    curl \
    libzip-dev \
    oniguruma-dev

# Install build deps (KHUSUS build extension)
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    linux-headers

# PHP extensions (CI3 common)
RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    opcache

# PHP redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Hapus build deps biar image kecil
RUN apk del .build-deps

# OPcache config
COPY php/php.ini /usr/local/etc/php/conf.d/opcache.ini

# Working directory
WORKDIR /var/www/html

# Permission (CI3)
RUN chown -R www-data:www-data /var/www/html

USER www-data
