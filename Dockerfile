FROM wyveo/nginx-php-fpm:latest

COPY --from=composer /usr/bin/composer /usr/bin/composer
