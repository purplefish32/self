FROM debian:jessie

RUN apt-get update && apt-get install -y \
    git curl php5-cli php5-json php5-intl

RUN curl -sS https://getcomposer.org/installer | php

RUN mv composer.phar /usr/local/bin/composer

#ADD entrypoint.sh /entrypoint.sh
#http://www.slideshare.net/denderello/dockerizing-symony-applications-symfony-live-berlin-2014
