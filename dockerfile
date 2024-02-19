php:apache
RUN docker-php-ext-install mysqli
COPY  /views/registro /var/www/html
EXPOSE 80

