# Use PHP 7.4 since Symfony 4.4 works best with PHP 7.4
FROM php:8.2-cli

# Install required PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_mysql opcache zip

# Set the working directory
WORKDIR /var/www/symfony

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Symfony project files
COPY . /var/www/symfony


# Allow Composer to run as superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
# Install Symfony dependencies
RUN composer install
