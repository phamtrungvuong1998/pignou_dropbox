FROM wyveo/nginx-php-fpm:latest

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=node:latest /usr/local/bin/node /usr/local/bin/
