<?php

class Product {
    private $productId;
    private $description;
    private $taxed;
    private $amount;

    public function __construct($productId, $description, $taxed, $amount)
    {
        $this->productId = $productId;
        $this->description = $description;
        $this->taxed = $taxed;
        $this->amount = $amount;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isTaxed()
    {
        return $this->taxed;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}