FROM ubuntu:xenial

RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys C300EE8C
RUN echo "deb http://ppa.launchpad.net/nginx/development/ubuntu xenial main" \
        > /etc/apt/sources.list.d/nginx-development-xenial.list

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        nano \
        ssl-cert \
        nginx

ADD configs/nginx.conf /etc/nginx/nginx.conf
ADD configs/shoplo-shop.xdev.conf /etc/nginx/sites-available/
ADD configs/ssl /etc/nginx/ssl/

RUN ln -s /etc/nginx/sites-available/shoplo-shop.xdev.conf /etc/nginx/sites-enabled/0-shoplo-shop.xdev.conf
RUN rm /etc/nginx/sites-enabled/default

RUN usermod -u 1000 www-data

EXPOSE 80
EXPOSE 443

# Default dir in bash
WORKDIR /var/www/shoplo-shop.xdev

ENTRYPOINT service nginx start && bash
