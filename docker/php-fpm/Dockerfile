FROM php:5.6-fpm

RUN apt-get update && apt-get install -y \
    php5-mysql

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql

COPY config/php.ini /usr/local/etc/php/

CMD ["php-fpm"]