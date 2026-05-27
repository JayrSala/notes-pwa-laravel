FROM php:8.2-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    unzip zip curl libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_sqlite

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN touch database/database.sqlite

RUN chmod -R 777 storage bootstrap/cache

RUN php artisan optimize:clear

RUN apt-get install -y nodejs npm
RUN npm install
RUN npm run build

EXPOSE 10000

CMD php artisan migrate --force && php artisan config:clear && php artisan cache:clear && php artisan serve --host=0.0.0.0 --port=10000