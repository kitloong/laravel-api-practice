FROM php:7.4.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev iputils-ping \
    libmagickwand-dev --no-install-recommends
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN docker-php-ext-install pdo_mysql

# Install nodejs and composer
RUN apt-get install -y wget gnupg apt-utils
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
RUN apt-get install -y nodejs git zip unzip
RUN npm install -g yarn
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Disable warning about running commands as root/super user
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
	&& echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
	&& echo "xdebug.remote_port=19000" >> /usr/local/etc/php/conf.d/xdebug.ini \
	&& echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini

ENV PHP_IDE_CONFIG=serverName=Docker

RUN mkdir -p /usr/local/rms/evt/tmail/tems_space/evt_tool/massRegist/list/
RUN chmod -R 0777 /usr/local/rms/evt/tmail/tems_space/evt_tool

# Custom php.ini
COPY "php.ini" "/usr/local/etc/php/conf.d/php.ini"

COPY Entrypoint.sh /
RUN chmod +x /Entrypoint.sh

ENTRYPOINT ["/Entrypoint.sh"]
CMD ["php-fpm"]
