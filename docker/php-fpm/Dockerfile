FROM php:8.3-fpm-alpine

RUN apk add --no-cache bash
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli
RUN apk add git
RUN apk add --no-cache icu-dev postgresql-dev libzip-dev g++ make
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo_pgsql pgsql intl

WORKDIR /app