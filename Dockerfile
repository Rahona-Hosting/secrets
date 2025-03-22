FROM serversideup/php:8.3-cli AS builder

USER root

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions sockets excimer excimer gd

USER www-data

WORKDIR /var/www/html

COPY --chown=www-data:www-data composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

COPY --chown=www-data:www-data package.json package-lock.json ./
RUN npm ci

COPY --chown=www-data:www-data . .

RUN composer install --no-dev --optimize-autoloader \
    && npm run build


FROM serversideup/php:8.3-fpm-nginx

ENV AUTORUN_ENABLED=true
ENV PHP_OPCACHE_ENABLE=true

USER root

RUN install-php-extensions sockets gd bcmath excimer

USER www-data

WORKDIR /var/www/html

COPY --from=builder --chown=www-data:www-data /var/www/html /var/www/html
