FROM php:8-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev iputils-ping wget gnupg apt-utils git zip unzip \
    libmagickwand-dev --no-install-recommends
#RUN pecl install imagick
#RUN docker-php-ext-enable imagick
RUN docker-php-ext-install pdo_mysql

# Install nodejs and composer
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
RUN apt-get install -y nodejs
RUN npm install -g yarn
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Disable warning about running commands as root/super user
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=no" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=19000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini

ENV PHP_IDE_CONFIG=serverName=Docker

# Custom php.ini
COPY "docker/php.ini" "/usr/local/etc/php/conf.d/php.ini"

COPY ./docker/Entrypoint.sh /
RUN chmod +x /Entrypoint.sh

ENTRYPOINT ["/Entrypoint.sh"]
CMD ["php-fpm"]
