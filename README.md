# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

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

![Screenshot 2024-11-09 at 4 05 47 PM (2)](https://github.com/user-attachments/assets/ddffe505-48b5-43bf-b678-a5a8f55fb2df)

![Screenshot 2024-11-09 at 4 05 55 PM (2)](https://github.com/user-attachments/assets/2134373e-25ba-4f2d-adf4-7e4ff5bd62cf)
![Screenshot 2024-11-09 at 4 05 59 PM (2)](https://github.com/user-attachments/assets/01642bf1-67b5-48f5-8e0f-997d84cb0308)






