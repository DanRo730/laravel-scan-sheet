# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Habilita mod_rewrite en Apache
RUN a2enmod rewrite

# Copia los archivos al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Da permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala las dependencias PHP (sin las de desarrollo)
RUN composer install --no-dev --optimize-autoloader

# Expone el puerto 80
EXPOSE 80

# Ejecuta Apache en primer plano
CMD ["apache2-foreground"]
