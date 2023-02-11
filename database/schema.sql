DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS invoices;
DROP TABLE IF EXISTS invoice_items;

CREATE TABLE customers (
  customer_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  address VARCHAR(255),
  city VARCHAR(255),
  state VARCHAR(255),
  zipcode VARCHAR(255),
  country VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(255),
  website VARCHAR(255),
  fax VARCHAR(255)
);

CREATE TABLE products (
  product_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  description TEXT,
  taxed BIT,
  price DECIMAL(10,2)
);

CREATE TABLE invoices (
  invoice_id INT PRIMARY KEY AUTO_INCREMENT,
  customer_id INT,
  date DATE,
  due_date DATE,
  status ENUM('paid', 'unpaid', 'partial') DEFAULT 'unpaid',
  FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

CREATE TABLE invoice_items (
  invoice_item_id INT PRIMARY KEY AUTO_INCREMENT,
  invoice_id INT,
  product_id INT,
  quantity INT,
  price DECIMAL(10,2),
  FOREIGN KEY (invoice_id) REFERENCES invoices(invoice_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);