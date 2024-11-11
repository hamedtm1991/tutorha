ARG PHP_EXTENSIONS="apcu bcmath opcache pcntl pdo_mysql redis zip sockets imagick gd exif soap remoteip json curl"
ARG APACHE_EXTENSIONS="remoteip"
FROM registry.abrbit.com/thecodingmachine/php:8.3-v4-apache-node22

ENV TEMPLATE_PHP_INI=production
ENV APACHE_EXTENSION_REMOTEIP=1
ENV PHP_EXTENSION_GD=1
ENV PHP_EXTENSION_CURL=1
ENV PHP_INI_MEMORY_LIMIT=8g
ENV PHP_INI_MAX_EXECUTION_TIME=300

USER root

COPY --chown=www-data:www-data . .

RUN chmod 777 /var/www/html/storage -R
RUN mkdir /var/www/html/public/build
RUN chmod 777 /var/www/html/public/build -R
RUN composer install --optimize-autoloader --ignore-platform-reqs

ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=false
RUN npm set progress=false
RUN npm config set depth 0
RUN npm install
RUN npm run build && rm -rf node_modules



COPY --chown=www-data:www-data . /var/www/html/
RUN chmod 777 /var/www/html/storage/ -R

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

ENV APACHE_RUN_USER=www-data \
    APACHE_RUN_GROUP=www-data
