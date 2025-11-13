ARG PHP_VERSION=8.3
ARG COMPOSER_VERSION=2.4

### COMPOSER ###
FROM composer:${COMPOSER_VERSION} AS composer

### PHP-FPM ###
FROM php:${PHP_VERSION}-fpm-alpine AS php-fpm

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
COPY --from=ghcr.io/shyim/gnu-libiconv:v3.14 /gnu-libiconv-1.15-r3.apk /gnu-libiconv-1.15-r3.apk

RUN apk add --no-cache \
      unzip \
      wget \
      sudo \
      bash \
      supervisor \
      npm \
      aws-cli \
      # build tools and headers needed to compile PHP extensions
      build-base \
      autoconf \
      automake \
      libtool \
      linux-headers \
      pkgconfig \
      # postgres client & headers
      postgresql-dev \
      # common dev libs for gd/intl etc
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
      zlib-dev \
      icu-dev \
      openssl-dev \
      # optionally: runtime libs
      libpq

RUN apk add --no-cache --allow-untrusted /gnu-libiconv-1.15-r3.apk
RUN rm /gnu-libiconv-1.15-r3.apk
RUN install-php-extensions  \
    bcmath \
    gd \
    intl \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    curl \
    dom \
    fileinfo \
    filter \
    hash \
    mbstring \
    openssl \
    pcre \
    session \
    xml \
    redis \
    opcache \
    zip \
    exif
RUN export COMPOSER_PROCESS_TIMEOUT=9000
EXPOSE 9000

COPY docker/php-fpm/dev/php.ini $PHP_INI_DIR/php.ini

# SETUP PHP-FPM CONFIG SETTINGS (max_children / max_requests)
RUN echo 'pm.max_children = 15' >> /usr/local/etc/php-fpm.d/zz-docker.conf && \
    echo 'pm.max_requests = 500' >> /usr/local/etc/php-fpm.d/zz-docker.conf

COPY ./docker/php-fpm/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]
