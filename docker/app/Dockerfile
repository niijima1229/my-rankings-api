FROM php:8.1-fpm
COPY php.ini /usr/local/etc/php/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

RUN apt update \
	&& apt-get install -y zlib1g-dev mariadb-client vim libzip-dev \
	&& docker-php-ext-install zip pdo_mysql 

WORKDIR /var/www