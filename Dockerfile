FROM php:8.4-apache

# System dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        intl \
        mbstring \
        pdo \
        pdo_mysql \
        mysqli \
        zip \
        xml \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache
RUN a2enmod rewrite \
    && echo "ServerName docker" >> /etc/apache2/apache2.conf

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["apache2-foreground"]