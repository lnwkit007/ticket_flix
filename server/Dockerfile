# Stage 1: Build Dependencies (PHP 8.4 + Composer)
FROM php:8.4-cli AS builder

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y --no-install-recommends git zip unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY composer.json composer.lock* ./

RUN composer install --no-dev --no-autoloader --no-scripts --no-interaction --prefer-dist --ignore-platform-req=php

COPY . .

RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php bootstrap/cache/config.php \
    && composer dump-autoload --optimize --no-dev --no-scripts \
    && php artisan package:discover

RUN rm -rf .git .github tests phpunit.xml README.md docker-compose.yml Dockerfile


# Stage 2: Hardened Runtime Environment (FrankenPHP + Alpine + PHP 8.4)
FROM dunglas/frankenphp:1-php8.4-alpine

WORKDIR /var/www/html

RUN install-php-extensions \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    intl \
    zip \
    bcmath \
    soap \
    redis \
    opcache

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && { \
        echo "expose_php = Off"; \
        echo "display_errors = Off"; \
        echo "display_startup_errors = Off"; \
        echo "log_errors = On"; \
        echo "disable_functions = exec,passthru,shell_exec,system,proc_open,popen"; \
        echo "opcache.enable=1"; \
        echo "opcache.enable_cli=1"; \
        echo "opcache.validate_timestamps=0"; \
    } > "$PHP_INI_DIR/conf.d/security-hardening.ini"

COPY --from=builder --chown=root:root /var/www/html /var/www/html

RUN chmod -R 755 /var/www/html \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

EXPOSE 8000

CMD ["frankenphp", "php-server", "--listen", ":8000", "--root", "public"]