# Usa una imagen base oficial de PHP con Composer
FROM composer:latest

# Instala dependencias del sistema necesarias para Laravel
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

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Asigna permisos a la carpeta storage y bootstrap
RUN chmod -R 755 storage && chmod -R 755 bootstrap

# Expone el puerto 8000
EXPOSE 8000

# Comando por defecto para ejecutar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
