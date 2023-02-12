<?php

class InvoiceItemService
{
    private $invoiceItemRepository;

    public function __construct(InvoiceItemRepository $invoiceItemRepository)
    {
        $this->invoiceItemRepository = $invoiceItemRepository;
    }

    public function createInvoiceItem($invoiceId, $productId, $quantity, $amount)
    {
        return $this->invoiceItemRepository->createInvoiceItem($invoiceId, $productId, $quantity, $amount);
    }
}