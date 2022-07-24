FROM php:8.0-fpm

ENV WORD_DIR=/var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install system dependencies
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
        amqp \
        bcmath \
        gmp \
        @composer \
        pgsql \
        pdo_pgsql \
        pdo_mysql \
        pcntl

RUN apt-get update && apt-get install -y
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /usr/share/doc/*

# working dir
WORKDIR ${WORD_DIR}
RUN chmod -R 777 ${WORD_DIR}