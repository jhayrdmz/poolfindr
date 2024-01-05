FROM webdevops/php-nginx:8.2-alpine
# Copy composer.lock and composer.json into the working directory
COPY composer.lock composer.json /var/www/html/

RUN set -ex \
  && apk --no-cache add

RUN docker-php-ext-install mysqli pdo_mysql
ENV SERVICE_NGINX_CLIENT_MAX_BODY_SIZE=1024M
ENV PHP_UPLOAD_MAX_FILESIZE=1024M
ENV PHP_POST_MAX_SIZE=1024M
RUN mkdir -p /var/www/html
RUN mkdir -p /var/www/html/storage
RUN chmod o+w /var/www/html/storage -R
RUN echo memory_limit = 1024M >> /opt/docker/etc/php/php.ini
RUN echo upload_max_filesize = 1024M >> /opt/docker/etc/php/php.ini
RUN echo file_uploads = On >> /opt/docker/etc/php/php.ini
RUN echo post_max_size = 1024M >> /opt/docker/etc/php/php.ini
RUN echo max_execution_time = 600 >> /opt/docker/etc/php/php.ini

WORKDIR /var/www/html

COPY .env.example .env

COPY . /var/www/html

RUN composer install

#RUN php artisan migrate

RUN php artisan storage:link

# Expose port 8000
EXPOSE 8000
