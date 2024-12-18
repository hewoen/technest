FROM php:8.4-apache
WORKDIR /var/www/html
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
COPY docker_setup/000-default.conf /etc/apache2/sites-available/000-default.conf
