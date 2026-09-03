# Build the application
FROM php:8.4-fpm

# System dependencies and PHP extensions
RUN apt-get update \
    && apt-get remove -y mariadb-server mariadb-client \
    && apt-get install -y \
    git \
    libssl-dev \
    default-mysql-client \
    libmcrypt-dev \
    libicu-dev \
    libpq-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev  \
    libpng-dev \
    zlib1g-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    zip \
    wget \
    gnupg2 \
    curl

# Install PHP extensions
RUN docker-php-ext-install \
    gd \
    intl \
    mbstring \
    pdo \
    pdo_mysql \
    mysqli \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Working Directory
WORKDIR /var/www/html

EXPOSE 8000