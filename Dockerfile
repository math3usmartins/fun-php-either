FROM php:8-cli-alpine

COPY --from=composer:2.8.0 /usr/bin/composer /usr/bin/composer

ARG WWW_DATA_UID
ARG WWW_DATA_GID

RUN apk --no-cache add shadow

RUN usermod -u ${WWW_DATA_UID} www-data \
    && groupmod -g ${WWW_DATA_GID} www-data
