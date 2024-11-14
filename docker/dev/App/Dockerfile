FROM php:8.3.3-fpm-alpine3.18

# Copy php config
COPY conf.d /usr/local/etc/php/conf.d

# Packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf icu-dev bash

# Postgres
RUN apk add --no-cache libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Intl
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Non root user
ENV PUID=1000
ENV PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set user
USER www-data

# Files
COPY ./ /app
WORKDIR /app

# Run php-fpm
CMD php-fpm

# Expose port
EXPOSE 9000