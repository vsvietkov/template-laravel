FROM php:8.3-fpm-alpine AS base

COPY --from=composer:2.8.1 /usr/bin/composer /usr/bin/composer
# PHP extensions installation - https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql mbstring zip

COPY /infrastructure/php/php.ini $PHP_INI_DIR/conf.d/custom.ini

FROM base AS development

RUN apk add --no-cache bash make
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

ARG XDEBUG_ENABLED
COPY /infrastructure/php/xdebug.ini /tmp/xdebug.ini
RUN if [ "$XDEBUG_ENABLED" = "true" ]; then \
    install-php-extensions xdebug-3.3.2 && \
    mv /tmp/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini; \
fi
