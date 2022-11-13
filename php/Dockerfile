FROM php:8.1-fpm

RUN apt-get update && apt-get install -y curl && \
    docker-php-ext-install mysqli pdo pdo_mysql  && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/mylittleserver

CMD ["php-fpm"]
