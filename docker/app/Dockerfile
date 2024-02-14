FROM php:8.3.1-fpm

WORKDIR /var/www/html/


# Essentials
RUN echo "UTC" > /etc/timezone

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql


RUN apt-get update && apt-get install -y \
    zip \
    git \
    npm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
