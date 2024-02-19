# Utilizamos una imagen que ya incluya Apache y PHP
FROM php:apache

# Instalamos el módulo de PHP necesario para la conexión a MySQL
RUN docker-php-ext-install mysqli

# Copiamos los archivos de tu aplicación PHP al directorio de Apache
COPY ./views/registro /var/www/html

# Exponemos el puerto 80 para el tráfico web
EXPOSE 80

# Comando para iniciar Apache cuando se ejecute el contenedor
CMD ["apache2-foreground"]
