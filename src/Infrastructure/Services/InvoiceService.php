<?php

class InvoiceService
{
    private $customerRepository;
    private $productRepository;
    private $invoiceRepository;
    private $invoiceItemRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }


    public function getInvoiceDetails($invoiceId)
    {
        // retrieve an invoice, customer, and invoice items from the database
    }

    public function updateInvoice($invoiceId, $invoiceItems)
    {
        // update an invoice in the database
    }

    public function createInvoice($customer_id, $date, $due_date)
    {
        return $this->invoiceRepository->createInvoice($customer_id, $date, $due_date);
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