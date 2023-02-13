<?php

class Validator
{
    public function validate($data)
    {
        $errors = [];

        if (!isset($data['name'])) {
            $errors[] = 'No name entered';
        }
        if (!isset($data['company'])) {
            $errors[] = 'No company name entered';
        }
        if (!isset($data['address'])) {
            $errors[] = 'No address entered';
        }
        if (!isset($data['fax'])) {
            $errors[] = 'No fax entered';
        }
        if (!isset($data['phone'])) {
            $errors[] = 'No name entered';
        }
        if (!isset($data['website'])) {
            $errors[] = 'No website entered';
        }
        if (!isset($data['zipcode'])) {
            $errors[] = 'No zipcode entered';
        }
        if (!isset($data['email'])) {
            $errors[] = 'No email entered';
        }
        if (!isset($data['state'])) {
            $errors[] = 'No state entered';
        }
        if (!isset($data['country'])) {
            $errors[] = 'No country entered';
        }
        if (!isset($data['name'])) {
            $errors[] = 'No name entered';
        }
        if (!isset($data['due_date']) || !strtotime($data['due_date'])) {
            $errors[] = 'Invalid due date';
        }
        if (!isset($data['date']) || !strtotime($data['date'])) {
            $errors[] = 'Invalid due date';
        }
        return $errors;
    }

}