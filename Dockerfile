FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    npm \
    libpq-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

# .env.example लाई .env बनाउने
RUN cp .env.example .env

# Dummy APP_KEY बनाउने
RUN php -r "file_put_contents('.env', str_replace('APP_KEY=', 'APP_KEY=base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=', file_get_contents('.env')));"

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

EXPOSE 10000

CMD sh -c "php artisan config:clear && php artisan storage:link || true && php artisan serve --host=0.0.0.0 --port=$PORT"