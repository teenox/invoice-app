<?php

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct($name, $description, $taxed, $price)
    {
        return $this->productRepository->createProduct($name, $description, $taxed, $price);
    }

    public function create($productData)
    {
        return $this->productRepository->createProduct($productData['name'], $productData['description'], $productData['taxed'], $productData['price']);
    }

    public function getProducts()
    {
        return $this->productRepository->getProducts();
    }

    public function getProduct($productId)
    {
        return $this->productRepository->getProduct($productId);
    }
}