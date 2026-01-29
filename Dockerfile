FROM php:7.4-apache

# Установка зависимостей (как раньше)
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev default-libmysqlclient-dev gcc g++ make autoconf dpkg-dev \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite expires headers

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) mysqli pdo_mysql gd

# Копируем конфиг Apache
COPY apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN ln -sf /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

