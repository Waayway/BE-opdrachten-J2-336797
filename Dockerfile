FROM php:8.1-apache

# Add pdo, pdo_mysql and debug extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite