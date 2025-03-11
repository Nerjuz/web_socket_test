FROM php:8.4-cli

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pgsql pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /usr/src/myapp

ENV PATH=$PATH:/usr/local/bin

CMD [ "php", "./app.php" ]