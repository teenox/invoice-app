<?php

class Invoice
{
    private $invoiceId;
    private $customerId;
    private $date;
    private $dueDate;
    private $status;

    public function __construct($customerId, $date, $dueDate, $status)
    {
        $this->customerId = $customerId;
        $this->date = $date;
        $this->dueDate = $dueDate;
        $this->status = $status;
    }

    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function getStatus()
    {
        return $this->status;
    }

}