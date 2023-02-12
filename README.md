# Invoice Application

This application is a simple invoice application that allows you to create and manage invoices.

Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

Prerequisites
What things you need to install the software and how to install them:

PHP >= 7.0
Web server (Apache, Nginx, etc.)
MySQL
Composer
Installing
Clone the repository to your local machine using git clone https://github.com/teenox/invoice_app.git
Navigate to the project directory using cd invoice_app
Run composer install to install all the dependencies
Create a database for the application and configure the database credentials in the .env file
Run php bin/console doctrine:migrations:migrate to create the database tables
Start the development server using php -S localhost:8000 -t public
Visit http://localhost:8000 in your browser to see the application in action.