FROM php:8.2-apache
RUN apt update && apt upgrade
RUN docker-php-ext-install pdo_mysql 
RUN a2enmod rewrite
# COPY . /var/www/html
EXPOSE 80