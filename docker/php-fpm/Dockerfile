FROM php:8.3-fpm-alpine

RUN apk add --no-cache bash
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli
RUN apk add git

WORKDIR /app