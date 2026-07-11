FROM php:8.4-apache

WORKDIR /app

ENV PORT=10000 \
    CACHE_STORE=file \
    QUEUE_CONNECTION=database

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    npm \
    libpq-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip opcache
RUN a2enmod rewrite expires headers deflate

RUN printf '%s\n' \
    'opcache.enable=1' \
    'opcache.enable_cli=1' \
    'opcache.memory_consumption=128' \
    'opcache.interned_strings_buffer=16' \
    'opcache.max_accelerated_files=20000' \
    'opcache.validate_timestamps=0' \
    'opcache.save_comments=1' \
    'realpath_cache_size=4096K' \
    'realpath_cache_ttl=600' \
    > /usr/local/etc/php/conf.d/production.ini

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
    '    <IfModule mod_expires.c>' \
    '        ExpiresActive On' \
    '        ExpiresByType text/css "access plus 1 month"' \
    '        ExpiresByType application/javascript "access plus 1 month"' \
    '        ExpiresByType image/jpeg "access plus 1 month"' \
    '        ExpiresByType image/png "access plus 1 month"' \
    '        ExpiresByType image/webp "access plus 1 month"' \
    '        ExpiresByType image/svg+xml "access plus 1 month"' \
    '    </IfModule>' \
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

CMD ["sh","-c","php artisan optimize:clear || true; php artisan migrate --force || true; php artisan db:seed --force || true; php artisan storage:link || true; php artisan optimize || true; php artisan queue:work database --sleep=1 --tries=3 --timeout=60 & apache2-foreground"]
