<?php

class InvoiceItem {
    private $invoiceItemId;
    private $invoiceId;
    private $productId;
    private $quantity;
    private $price;

    public function __construct($invoiceItemId, $invoiceId, $productId, $quantity, $price)
    {
        $this->invoiceItemId = $invoiceItemId;
        $this->invoiceId = $invoiceId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getInvoiceItemId()
    {
        return $this->invoiceItemId;
    }

    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

}