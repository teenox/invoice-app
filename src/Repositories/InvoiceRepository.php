<?php

class InvoiceRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getInvoices()
    {
        $query = 'SELECT i.*,
        c.customer_id AS customer_id,
        c.name AS customer_name,
        c.company AS company_name,
        c.address AS street_address,
        c.city AS city,
        c.phone AS phone_number,
        c.fax AS fax_number,
        c.website AS website,
        c.zipcode AS zipcode,
        c.state AS state,
        c.country AS country,
        c.email AS email
        FROM invoices i 
        JOIN customers c ON i.customer_id = c.customer_id;';

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $invoices;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getInvoice($invoiceId)
    {
        $query = 'SELECT i.*,
        c.customer_id AS customer_id,
        c.name AS customer_name,
        c.company AS company_name,
        c.address AS street_address,
        c.city AS city,
        c.phone AS phone_number,
        c.fax AS fax_number,
        c.website AS website,
        c.zipcode AS zipcode,
        c.state AS state,
        c.country AS country,
        c.email AS email
        FROM invoices i 
        JOIN customers c ON i.customer_id = c.customer_id 
        where i.invoice_id = :invoice_id;';

        try {
            $stmt = $this->database->prepare($query);
            $stmt->bindParam("invoice_id", $invoiceId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error: Could not retrieve invoice with id " . $invoiceId . ". " . $e->getMessage());
        }
    }

    public function createInvoice($customerId, $invoiceDate, $dueDate, $taxRate)
    {
        $sql = 'INSERT INTO invoices (customer_id, date, due_date, tax_rate) VALUES (:customer_id, :date, :due_date, :tax_rate)';
        try {
            $stmt = $this->database->prepare($sql);
            $stmt->execute([
                ':customer_id' => $customerId,
                ':date' => $invoiceDate,
                ':due_date' => $dueDate,
                ':tax_rate' => $taxRate
            ]);

            return $this->database->lastInsertedId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}