FROM php:8.2-cli

# Instala as extensões necessárias (PostgreSQL + cURL)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pgsql curl

# Copia todos os ficheiros para dentro do container
COPY . /var/www/html
WORKDIR /var/www/html

# Arranca o servidor PHP embutido
CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
