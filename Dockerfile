FROM php:8.2-apache

# Instalar extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite para URLs amigáveis
RUN a2enmod rewrite

# Definir diretório de trabalho
WORKDIR /var/www/html

# Garantir que o Apache possa gravar nos diretórios necessários
RUN chown -R www-data:www-data /var/www/html
