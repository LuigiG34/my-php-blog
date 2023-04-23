FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

COPY ./public/ /var/www/html/

COPY apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
