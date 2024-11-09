# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Enable Apache mod_rewrite for Laravel or other PHP frameworks
RUN a2enmod rewrite

# Install dependencies (e.g., for Laravel, PDO, etc.)
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy the PHP application files
COPY . .

# Expose port 80 for Apache
EXPOSE 80

# Start the Apache server
sudo service apache2 start

# Configure Environment Variables
DB_HOST=db
DB_PORT=3306
DB_DATABASE=my_database
DB_USERNAME=root
DB_PASSWORD=root

# Build and Run Docker Containers

docker-compose up --build
Build the frontend container with Vue.js on port 8081.
Build the backend container with PHP and Apache on port 8082.
Start a MySQL db container on port 3306.

# Access the Application
Frontend (Vue): Open a browser and go to http://localhost:8081.
Backend (PHP API): Open a browser and go to http://localhost:8082.
MySQL Database: The database is accessible on port 3306 using the credentials in the Docker Compose file.




