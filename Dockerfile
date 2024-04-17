FROM php:8.3

WORKDIR /var/www/html

# Update and install necessary packages
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

# Clean up APT when done
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files to the container
COPY . /var/www/html
COPY script.sh /var/www/html/script.sh

# Set script.sh as executable
RUN chmod +x /var/www/html/script.sh

# Install Composer dependencies
RUN composer install

# Install Node.js dependencies and Vite
RUN npm install \
    && npm install -g vite \
    && npm install laravel-vite-plugin

# Add Vite to PATH
ENV PATH="/var/www/html/node_modules/.bin:${PATH}"

# Check Vite installation
RUN vite --version

EXPOSE 8000

# Command to run when starting the container
CMD ["/bin/bash", "/var/www/html/script.sh"]
