# Invoice Application

This application is a simple invoice application that allows you to create and manage invoices.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites
What things you need to install the software and how to install them:

- PHP >= 7.0
- Web server (Apache, Nginx, etc.)
- MySQL

## Installing
1. Clone the repository to your local machine using git clone https://github.com/teenox/invoice_app.git
2. Navigate to the project directory using cd invoice_app
3. Create a database for the application and configure the database credentials in the `index.php` file on line 52.
4. Run the Database table queries in Database/schema
5. Navigate to the project root director and start the development server using `php -S localhost:8000`
6. Visit http://localhost:8000 in your browser to see the application in action.

## Design patten implemented
I decided to implement the Repository and Service patterns in my invoice application to improve the overall structure of the code. This approach enhances maintainability and scalability of the application, while also facilitating testing and reuse of code.

The use of the Repository and Service patterns in an invoice application provides numerous benefits that help to ensure a clean and maintainable codebase. Firstly, the Repository pattern separates the database access code from the rest of the application, making it easier to maintain and test. The Service layer then provides an additional layer of abstraction between the repository and the rest of the application, ensuring that business logic is separate from database logic. The clear separation of concerns provided by these patterns makes it easier to test the application and also facilitates the reuse of code across the application. Additionally, the Repository and Service patterns make it easier to scale the application as the repository can be easily replaced with a more efficient implementation and the service layer can be extended to handle new business requirements. The Service layer can also enforce business rules and ensure data consistency, while the Repository pattern can be optimized for performance. This flexible architecture makes it easier to maintain, test, and extend the invoice application over time.
