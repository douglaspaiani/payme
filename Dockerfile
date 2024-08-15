# Dockerfile
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    nginx \
    supervisor

# Instalar extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Instalar Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar arquivos
COPY . .

# Instalar dependências do Laravel
RUN composer install

# Copiar arquivos de configuração do nginx
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

# Definir permissões de pastas
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expor a porta
EXPOSE 80

# Iniciar o supervisord e o nginx
CMD ["sh", "-c", "php artisan migrate && php-fpm"]
