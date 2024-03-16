# Use the official PHP 8.3 image as a parent image
FROM php:8.3

# Set working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
        curl \
        libicu-dev \
        libzip-dev \
        zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql zip mysqli \
    && pecl install apcu \
    && docker-php-ext-enable apcu


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
# Copy existing application directory contents
COPY . /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 8000
CMD ["php-fpm"]


