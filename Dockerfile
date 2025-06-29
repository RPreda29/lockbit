FROM php:8.2-cli

# Instala as extensões necessárias (PostgreSQL + PDO + cURL)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pgsql pdo_pgsql curl

# Copia os ficheiros para o container
COPY . /var/www/html
WORKDIR /var/www/html

# Inicia o servidor embutido do PHP
CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
