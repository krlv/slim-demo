FROM php:8.0-fpm-alpine

RUN docker-php-source extract \
    && apk add --update --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && pecl install xdebug \
    && docker-php-ext-enable \
       redis \
       xdebug \
    && docker-php-ext-install \
       pdo \
       pdo_mysql \
    && docker-php-source delete \
    && apk del .build-deps

#RUN sed -i 's$127.0.0.1:9000$/var/run/php-fpm.sock$g' /usr/local/etc/php-fpm.d/www.conf \
#    && sed -i 's/;listen.mode = 0660/listen.mode = 0666/g' /usr/local/etc/php-fpm.d/www.conf