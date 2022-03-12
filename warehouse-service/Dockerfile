FROM php:8.1-fpm
RUN sed -i 's/9000/9002/' /usr/local/etc/php-fpm.d/zz-docker.conf

ARG user
ARG uid

RUN apt update
RUN apt install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libxml2-dev \
    libxslt1-dev \
    libzip-dev \
    libonig-dev \
    graphviz \
    curl

RUN docker-php-ext-install gd zip pdo_mysql mbstring exif pcntl bcmath
RUN apt clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www/app

COPY . .
RUN composer install

USER $user
