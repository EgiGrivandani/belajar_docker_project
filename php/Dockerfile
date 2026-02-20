FROM php:8.1-fpm-alpine

# --------------------
# System & build deps
# --------------------
RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    oniguruma-dev \
    libzip-dev

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    linux-headers

# --------------------
# PHP extensions
# --------------------
RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    opcache

# Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Cleanup build deps
RUN apk del .build-deps

# --------------------
# Composer
# --------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --------------------
# App setup
# --------------------
WORKDIR /var/www/app

# Install dependencies (cache-friendly)
COPY app/composer.json ./
RUN composer install --no-dev --optimize-autoloader

# Copy application source
COPY app/ ./

# Permission
RUN chown -R www-data:www-data /var/www/app

# Runtime user
USER www-data