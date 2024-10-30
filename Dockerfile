FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    git \
    curl \
    npm \
    default-mysql-client \
    && docker-php-ext-install zip pdo_mysql

ARG USER_ID=1000
ARG GROUP_ID=1000
RUN a2enmod rewrite
USER ${UID}:${GID}
WORKDIR /var/www/html

COPY . /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]