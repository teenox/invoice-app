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
        // query the database and return an array of invoice item objects for a given invoice
    }

    public function createInvoiceItem($invoice_id, $product_id, $quantity, $price)
    {
        $sql = 'INSERT INTO invoice_items (invoice_id, product_id, quantity, price) VALUES (:invoice_id, :product_id, :quantity, :price)';

        try {
            $stmt = $this->database->prepare($sql);
            $stmt->execute([
                ':invoice_id' => $invoice_id,
                ':product_id' => $product_id,
                ':quantity' => $quantity,
                ':price' => $price
            ]);

            return $this->database->lastInsertedId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}