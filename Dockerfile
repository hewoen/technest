FROM composer as builder
WORKDIR /app/
COPY ./ ./
RUN composer install

FROM php:8.4-apache
RUN mkdir /var/www/html/vendor
WORKDIR /var/www/html
COPY ./ ./
COPY --from=builder /app/vendor /var/www/html/vendor
RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
COPY docker_setup/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data ./
RUN php artisan storage:link