FROM php:7.2-fpm-alpine

WORKDIR /app

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ icu-dev \
    && apk update && apk add postgresql-dev gcc python3-dev musl-dev \
    && pecl install apcu-5.1.17 \
    && docker-php-ext-install -j$(nproc) \
       bcmath \
       opcache \
       pdo \
       pdo_mysql \
       pdo_pgsql \
       tokenizer \
   && docker-php-ext-enable \
       apcu \
       opcache

RUN apk upgrade --update && apk --no-cache add \
       coreutils \
       libltdl \
       bash \
       binutils \
       patch
   
# RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
#      && pecl install xdebug \
#      && docker-php-ext-enable xdebug \
#      && apk del pcre-dev ${PHPIZE_DEPS}     
     
COPY .docker/php/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/101-xdebug.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer     

COPY .docker/php/ /usr/local/etc/php/