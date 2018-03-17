FROM ubuntu:xenial

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        nano \
        git \
        build-essential \
        libssl-dev \
        apt-transport-https

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

ENV NVM_DIR /usr/local/nvm

# NVM Manager
RUN curl https://raw.githubusercontent.com/creationix/nvm/v0.33.4/install.sh | bash \
    && source $NVM_DIR/nvm.sh \
    && nvm install node

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y --no-install-recommends yarn

# Default dir in bash
WORKDIR /var/www/shoplo-shop.xdev

ENTRYPOINT bash
