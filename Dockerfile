FROM php:8.4-apache

WORKDIR /app

ENV PORT=10000

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    npm \
    libpq-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip
RUN a2enmod rewrite

RUN sed -ri -e 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && printf '%s\n' \
    '<VirtualHost *:10000>' \
    '    ServerName diya-collection.onrender.com' \
    '    DocumentRoot /app/public' \
    '    DirectoryIndex index.php index.html' \
    '' \
    '    <Directory /app/public>' \
    '        Options FollowSymLinks' \
    '        AllowOverride All' \
    '        Require all granted' \
    '    </Directory>' \
    '' \
    '    ErrorLog ${APACHE_LOG_DIR}/error.log' \
    '    CustomLog ${APACHE_LOG_DIR}/access.log combined' \
    '</VirtualHost>' \
    > /etc/apache2/sites-available/000-default.conf \
    && printf '%s\n' \
    '<Directory /app/public>' \
    '    Options FollowSymLinks' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/laravel-public.conf \
    && a2enconf laravel-public

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN npm ci
RUN npm run build

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

CMD ["sh","-c","php artisan optimize:clear || true; php artisan migrate --force || true; php artisan storage:link || true; php artisan config:cache || true; apache2-foreground"]
