FROM php:8.2-cli

WORKDIR /app

# Install system dependencies + Node
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# Copy project
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies & build Vite assets
RUN npm install && npm run build

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan cache:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan migrate --force && \
    php -S 0.0.0.0:10000 -t public