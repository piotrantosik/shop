FROM ubuntu:xenial

RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys E5267A6C
RUN echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu xenial main" \
        > /etc/apt/sources.list.d/ondrej-php-xenial.list

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        nano \
        git \
        php7.2-cli \
        php7.2-fpm \
        php7.2-gd \
        php7.2-imap \
        php7.2-intl \
        php7.2-xmlrpc \
        php7.2-xml \
        php7.2-zip \
        php7.2-json \
        php7.2-mysqlnd \
        php7.2-readline \
        php7.2-curl \
        php7.2-dev \
        php7.2-mbstring \
        php7.2-soap \
        php7.2-imagick \
        php7.2-bcmath

ADD configs/php-cli.ini /etc/php/7.2/cli/php.ini
ADD configs/php-fpm.ini /etc/php/7.2/fpm/php.ini
ADD configs/pool-www.conf /etc/php/7.2/fpm/pool.d/www.conf

RUN usermod -u 1000 www-data

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Default dir in bash
WORKDIR /var/www/shoplo-shop.xdev

ENTRYPOINT service php7.2-fpm start && bash
