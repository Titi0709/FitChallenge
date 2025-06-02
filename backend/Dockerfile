FROM php:8.2-fpm

WORKDIR /var/www

# Extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers Laravel
COPY . .

# Installer les dépendances
RUN composer install

# Donner les bons droits
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

EXPOSE 9000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]

