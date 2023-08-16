# Dockerfile
FROM php:8.1.1-cli

RUN apt-get update -y && apt-get install -y zip unzip libmcrypt-dev
RUN apt-get install -y mariadb-client

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /app
ADD . /app
#COPY . /app


RUN composer install
#RUN php artisan migrate

EXPOSE 8001
CMD php artisan serve --host=0.0.0.0 --port=8001