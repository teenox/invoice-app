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
        try {
            $stmt = $this->database->prepare("SELECT * FROM invoices");
            $stmt->execute();
            $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $invoices;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getInvoice($invoiceId)
    {
        try {
            $stmt = $this->database->prepare("SELECT * FROM invoices WHERE invoice_id = :invoice_id");
            $stmt->bindParam("invoice_id", $invoiceId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error: Could not retrieve invoice with id " . $invoiceId . ". " . $e->getMessage());
        }
    }

    public function createInvoice($customerId, $invoiceDate, $dueDate)
    {
        $sql = 'INSERT INTO invoices (customer_id, date, due_date) VALUES (:customer_id, :date, :due_date)';
        try {
            $stmt = $this->database->prepare($sql);
            $stmt->execute([
                ':customer_id' => $customerId,
                ':date' => $invoiceDate,
                ':due_date' => $dueDate
            ]);

            return $this->database->lastInsertedId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}