FROM php:8.4-alpine

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
