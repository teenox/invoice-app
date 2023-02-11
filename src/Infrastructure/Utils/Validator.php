<?php
// Define the invoice validator
class Validator
{
    public function validate($data)
    {
        $errors = [];
        if (!isset($data['customer_id']) || !is_numeric($data['customer_id'])) {
            $errors[] = 'Invalid customer ID';
        }
        if (!isset($data['amount']) || !is_numeric($data['amount'])) {
            $errors[] = 'Invalid amount';
        }
        if (!isset($data['invoice_date']) || !strtotime($data['invoice_date'])) {
            $errors[] = 'Invalid invoice date';
        }
        return $errors;
    }

    public function validateInvoice($data)
    {
        $errors = [];

        if (!isset($data['date']) || !strtotime($data['date'])) {
            $errors[] = 'Invalid invoice date';
        }
        if (!isset($data['due_date']) || !strtotime($data['due_date'])) {
            $errors[] = 'Invalid due date';
        }
        return $errors;
    }

    public function validateCustomer($data)
    {
        $errors = [];
        if (!isset($data['name'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['address'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['city'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['state'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['country'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['email'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['phone'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['website'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['fax'])) {
            $errors[] = 'Name is empty';
        }
        return $errors;
    }

    public function validateInvoiceItem($data)
    {
        $errors = [];
        if (!isset($data['customer_id']) || !is_numeric($data['customer_id'])) {
            $errors[] = 'Invalid customer ID';
        }
        if (!isset($data['amount']) || !is_numeric($data['amount'])) {
            $errors[] = 'Invalid amount';
        }
        if (!isset($data['invoice_date']) || !strtotime($data['invoice_date'])) {
            $errors[] = 'Invalid invoice date';
        }
        return $errors;
    }

    public function validateProduct($data)
    {
        $errors = [];
        if (!isset($data['name'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['description'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['taxed'])) {
            $errors[] = 'Name is empty';
        }
        if (!isset($data['price'])) {
            $errors[] = 'Name is empty';
        }
        return $errors;
    }
}