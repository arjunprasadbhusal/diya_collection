FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    npm \
    libpq-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN npm install
RUN npm run build

EXPOSE 10000

CMD sh -c "
php artisan config:cache &&
php artisan migrate --force &&
php artisan storage:link || true &&
php artisan serve --host=0.0.0.0 --port=\${PORT:-10000}
"