<?php

interface CustomerRepositoryInterface
{
    public function getCustomers();
    public function getCustomer($customerId);
    public function createCustomer($name, $company, $address, $city, $state, $zipcode, $country, $email, $phone, $website, $fax);
}

class CustomerRepository implements CustomerRepositoryInterface
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getCustomers()
    {
        $query = "SELECT * FROM customers";
        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function getCustomer($customerId)
    {
        $query = "SELECT * FROM customers WHERE customer_id = :customer_id";
        try {
            $stmt = $this->database->prepare($query);
            $stmt->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function createCustomer($name, $company, $address, $city, $state, $zipcode, $country, $email, $phone, $website, $fax)
    {
        $query = "INSERT INTO customers (name, company, address, city, state, zipcode, country, email, phone, website, fax) 
              VALUES (:name, :company, :address, :city, :state, :zipcode, :country, :email, :phone, :website, :fax)";
        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([
                'name' => $name,
                'company' => $company,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'zipcode' => $zipcode,
                'country' => $country,
                'email' => $email,
                'phone' => $phone,
                'website' => $website,
                'fax' => $fax
            ]);
            return $this->database->lastInsertedId();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }

    }
}