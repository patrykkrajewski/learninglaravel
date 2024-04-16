FROM php:8.3

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        curl \
        libicu-dev \
        libzip-dev \
        zip \
        nodejs \
        npm \
    && docker-php-ext-install intl opcache pdo pdo_mysql zip mysqli \
    && pecl install apcu \
    && docker-php-ext-enable apcu

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html
COPY script.sh /var/www/html/script.sh

# Install Composer dependencies
RUN composer install

# Install Node dependencies
RUN npm install
# Install Vite globally
RUN npm install vite

RUN npm install laravel-vite-plugin

# Add Vite to PATH
ENV PATH="/var/www/html/node_modules/.bin:${PATH}"

# Check Vite installation
RUN vite --version

EXPOSE 8000

CMD ["php-fpm"]
