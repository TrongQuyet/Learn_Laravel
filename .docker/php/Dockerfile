FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -s https://getcomposer.org/installer | php

RUN mv composer.phar /usr/local/bin/composer
