<?php

interface ProductServiceInterface
{
    public function createProduct($description, $taxed, $amount);
    public function create($productData);
    public function getProducts();
    public function getProduct($productId);
}

class ProductService implements ProductServiceInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct($description, $taxed, $amount)
    {
        return $this->productRepository->createProduct($description, $taxed, $amount);
    }

    public function create($productData)
    {
        return $this->productRepository->createProduct($productData['description'], $productData['taxed'], $productData['amount']);
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