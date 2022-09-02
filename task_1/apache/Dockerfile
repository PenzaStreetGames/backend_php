FROM php:8.0-apache
WORKDIR /var/www/html/
COPY . .
RUN docker-php-ext-install mysqli
EXPOSE 80