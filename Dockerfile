FROM php:7.3-apache

RUN apt-get update && apt-get install -y \
    mariadb-client \
    libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN a2enmod rewrite

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

CMD ["apache2-foreground"]

ENTRYPOINT ["/entrypoint.sh"]