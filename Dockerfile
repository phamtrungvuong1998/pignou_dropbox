FROM wyveo/nginx-php-fpm:latest

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=node:latest /usr/local/bin/node /usr/local/bin/

COPY --from=node:latest /usr/local/lib/node_modules /usr/local/lib/node_modules

ENV PATH /usr/local/lib/node_modules/npm/bin:$PATH
