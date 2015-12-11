FROM php:5.6-fpm

RUN apt-get update && apt-get install -y \
    php5-mysql

COPY config/php.ini /usr/local/etc/php/

CMD ["php-fpm"]