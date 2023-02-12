<?php

class InvoiceItem {
    private $invoiceItemId;
    private $invoiceId;
    private $productId;
    private $quantity;
    private $amount;

    public function __construct($invoiceItemId, $invoiceId, $productId, $quantity, $amount)
    {
        $this->invoiceItemId = $invoiceItemId;
        $this->invoiceId = $invoiceId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->amount = $amount;
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

    public function getAmount()
    {
        return $this->amount;
    }

}