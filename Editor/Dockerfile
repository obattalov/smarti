# Dockerfile
FROM php:8.1.1-cli

ENV DOCKER_DB_MODULE_URL=173.18.5.10:8001

RUN apt-get update -y && apt-get install -y zip unzip libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install

EXPOSE 8003
CMD php artisan serve --host=0.0.0.0 --port=8003