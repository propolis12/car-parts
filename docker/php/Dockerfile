FROM composer:2 AS composer


FROM php:8.3-fpm-alpine


# systémové knižnice a PHP ext
RUN apk add --no-cache \
bash git unzip icu-dev libzip-dev oniguruma-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install -j$(nproc) intl pdo_mysql bcmath zip opcache


# opcache (dev friendly)
RUN { \
echo "opcache.enable=1"; \
echo "opcache.enable_cli=1"; \
echo "opcache.validate_timestamps=1"; \
echo "opcache.memory_consumption=128"; \
echo "opcache.max_accelerated_files=10000"; \
} > /usr/local/etc/php/conf.d/opcache.ini


# composer binárka
COPY --from=composer /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html
