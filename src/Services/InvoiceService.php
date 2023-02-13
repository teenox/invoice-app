<?php

interface InvoiceServiceInterface
{
    public function createInvoice($customeId, $InvoiceDate, $dueDate, $taxRate);
    public function getInvoice($invoice_id);
    public function getInvoices();
}

class InvoiceService implements InvoiceServiceInterface
{
    private $customerRepository;
    private $productRepository;
    private $invoiceRepository;
    private $invoiceItemRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function createInvoice($customeId, $InvoiceDate, $dueDate, $taxRate)
    {
        return $this->invoiceRepository->createInvoice($customeId, $InvoiceDate, $dueDate, $taxRate);
    }

    public function getInvoice($invoice_id)
    {
        return $this->invoiceRepository->getInvoice($invoice_id);
    }

    public function getInvoices()
    {
        return $this->invoiceRepository->getInvoices();
    }
}