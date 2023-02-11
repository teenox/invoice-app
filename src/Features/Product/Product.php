<?php

class Product {
    private $productId;
    private $name;
    private $description;
    private $taxed;
    private $price;

    public function __construct($productId, $name, $description, $taxed, $price)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->description = $description;
        $this->taxed = $taxed;
        $this->price = $price;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isTaxed()
    {
        return $this->taxed;
    }

    public function getPrice()
    {
        return $this->price;
    }
}