<?php
class InvoiceItemRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getInvoiceItems($invoiceId)
    {
        $query = "SELECT i.*, p.product_id as product_id, p.taxed as taxed, p.description as product_description
        FROM invoice_items i
        JOIN products p ON i.product_id = p.product_id
        where i.invoice_id = :invoice_id;";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->bindParam("invoice_id", $invoiceId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function createInvoiceItem($invoice_id, $product_id, $quantity, $amount)
    {
        $sql = 'INSERT INTO invoice_items (invoice_id, product_id, quantity, amount) VALUES (:invoice_id, :product_id, :quantity, :amount)';

        try {
            $stmt = $this->database->prepare($sql);
            $stmt->execute([
                ':invoice_id' => $invoice_id,
                ':product_id' => $product_id,
                ':quantity' => $quantity,
                ':amount' => $amount
            ]);

            return $this->database->lastInsertedId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}