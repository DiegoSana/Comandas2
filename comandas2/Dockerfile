FROM php:7.0-apache

RUN apt-get update && apt-get install -y

# MySQL
RUN apt-get install -y mysql-client libmysqlclient-dev && docker-php-ext-install mysqli

#RUN apt-get install -y php7.0-xml php7.0-mbstring

#Vim
#RUN apt-get install -y vim git

# PDO
RUN docker-php-ext-install pdo_mysql

# GD for image processing
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Enable rewrite rules (ie. to route all requests to index.php)
RUN a2enmod rewrite
