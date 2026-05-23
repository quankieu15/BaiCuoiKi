FROM webdevops/php-nginx:8.2-alpine
WORKDIR /app
COPY . /app
RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev zip libzip-dev bash \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev
ENV WEB_DOCUMENT_ROOT=/app/public
ENV APP_ENV=production
ENV APP_DEBUG=false
RUN chown -R application:application /app/storage /app/bootstrap/cache
EXPOSE 80
