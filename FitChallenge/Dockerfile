FROM node:18 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Étape Laravel
FROM php:8.2-fpm

WORKDIR /var/www

# Dépendances PHP
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl git \
    && docker-php-ext-install pdo pdo_mysql zip \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie Laravel
COPY . .

# Copie les assets compilés
COPY --from=frontend /app/public /var/www/public

# Installer dépendances PHP
RUN composer install

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

EXPOSE 9000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
