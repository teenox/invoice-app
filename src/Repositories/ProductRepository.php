<?php

class ProductRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getProducts()
    {
        $query = "SELECT * FROM products";
        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getProduct($productId)
    {
        $query = "SELECT * FROM products WHERE product_id = :product_id";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->bindParam("product_id", $productId);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error: Could not retrieve product with id " . $productId . ". " . $e->getMessage());
        }
    }

    public function createProduct($description, $taxed, $amount)
    {
        $query = "INSERT INTO products (description, taxed, amount)
                  VALUES  (:description, :taxed, :amount)";
        try {
            $stmt = $this->database->prepare($query);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':taxed', $taxed);
            $stmt->bindValue(':amount', $amount);

            $stmt->execute();

            return $this->database->lastInsertedId();
        } catch (PDOException $e) {
            throw new Exception("Error: Could not retrieve create product" . $e->getMessage());
        }
    }

}