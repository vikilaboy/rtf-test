#ARG PHP_EXTENSIONS="amqp bcmath gd intl xdebug yaml apcu pdo_mysql igbinary redis"

# Base image
FROM thecodingmachine/php:8.1-v4-fpm

# Image Labels
LABEL maintainer="El Nino <victor@niculae.net>"

# Some default parameters
ENV TERM=xterm
ENV APP_DIR=/var/www/html
ENV STARTUP_COMMAND_1="php artisan queue:work --tries=3 &"

# Injecting assets
ADD etc /etc

WORKDIR ${APP_DIR}
