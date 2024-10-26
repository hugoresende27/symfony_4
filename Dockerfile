# Use PHP 8.2 CLI as the base image
FROM php:8.2-fpm


# Install required PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libsqlite3-dev \
    libcurl4-openssl-dev \
    librabbitmq-dev \  
    zip \
    unzip \
    git \
    wget \
    && docker-php-ext-install intl pdo pdo_mysql opcache zip pdo_sqlite bcmath sockets \
    && pecl install amqp-1.11.0 \
    && docker-php-ext-enable amqp \
    && rm -rf /var/lib/apt/lists/*







# Install Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Set the working directory
WORKDIR /var/www/html

# Copy Composer from the Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Symfony project files
COPY . /var/www/html

# Allow Composer to run as superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN echo 'date.timezone = Europe/Lisbon \n\
memory_limit = 512M' 

# # Install project dependencies
# RUN composer install --no-interaction --optimize-autoloader

# # Expose port 8000 for the Symfony server
# EXPOSE 8000

# # Command to run Symfony server
# CMD ["symfony", "server:start", "--no-tls", "--port=8000", "--dir=/var/www/html"]
