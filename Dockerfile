FROM php:8.4-apache

ARG user=www
ARG uid=100

# system dependecies
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

# MSSQL
# RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
# curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
# apt-get update && \
# ACCEPT_EULA=Y apt-get install -y msodbcsql17 odbcinst=2.3.7 odbcinst1debian2=2.3.7 unixodbc-dev=2.3.7 unixodbc=2.3.7 && \
# pecl install sqlsrv pdo_sqlsrv && \
# docker-php-ext-enable sqlsrv pdo_sqlsrv

# PHP dependencies
RUN docker-php-ext-install \
 gd \
 intl \
 mbstring \
 pdo \
 pdo_mysql \
 mysqli \
 zip



COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache
RUN a2enmod rewrite \
 && echo "ServerName docker" >> /etc/apache2/apache2.conf

# Update the default Apache site configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

 # Set the Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

WORKDIR /var/www/html

COPY . /var/www/html