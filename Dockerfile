FROM --platform=$BUILDPLATFORM node:24-alpine3.24 AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN --mount=type=cache,target=/root/.npm npm ci
COPY resources resources
COPY vite.config.js vite.config.js
RUN npm run build

FROM --platform=$BUILDPLATFORM golang:1.27-alpine3.24 AS hivemind
ARG TARGETOS
ARG TARGETARCH
RUN --mount=type=cache,target=/go/pkg/mod \
    --mount=type=cache,target=/root/.cache/go-build \
    GOOS=$TARGETOS GOARCH=$TARGETARCH CGO_ENABLED=0 go install github.com/DarthSim/hivemind@v1.1.0 \
    && cp "$(find /go/bin -type f -name hivemind)" /hivemind

FROM --platform=$BUILDPLATFORM composer:2.11 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN --mount=type=cache,target=/tmp/cache \
    composer install \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --prefer-dist \
        --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative --ignore-platform-reqs

FROM php:8.5-fpm-alpine3.24 AS final

RUN apk upgrade --no-cache \
    && apk add --no-cache nginx \
    && rm -rf /var/cache/apk/* /tmp/*

COPY --from=hivemind /hivemind /usr/local/bin/hivemind
COPY docker/fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY docker/fpm/php-fpm-pool.conf /usr/local/etc/php-fpm.d/zz-app.conf
COPY docker/fpm/php-opcache.ini /usr/local/etc/php/conf.d/zz-opcache.ini
COPY docker/fpm/nginx.conf /etc/nginx/nginx.conf
COPY docker/fpm/Procfile /etc/Procfile
COPY --chmod=0755 docker/fpm/entrypoint.sh /entrypoint.sh

WORKDIR /var/www/html

COPY --from=vendor --chown=www-data:www-data /app /var/www/html
COPY --from=frontend --chown=www-data:www-data /app/public/build /var/www/html/public/build

RUN mkdir -p \
        /data \
        /var/lib/nginx/logs \
        /var/www/html/storage/framework/cache \
        /var/www/html/storage/framework/sessions \
        /var/www/html/storage/framework/views \
        /var/www/html/storage/logs \
        /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /data /var/lib/nginx /var/www/html/storage /var/www/html/bootstrap/cache \
    && rm -f /var/www/html/public/hot

USER www-data
EXPOSE 8080

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/data/database.sqlite

CMD ["/usr/local/bin/hivemind", "/etc/Procfile"]
