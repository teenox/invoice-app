<?php

class CustomerRepository
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getCustomers()
    {
        $stmt = $this->database->prepare("SELECT * FROM customers");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCustomer($customerId)
    {
        $stmt = $this->database->prepare("SELECT * FROM customers WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createCustomer($name, $address, $city, $state, $zipcode, $country, $email, $phone, $website, $fax)
    {
        $query = "INSERT INTO customers (name, address, city, state, zipcode, country, email, phone, website, fax) 
              VALUES (:name, :address, :city, :state, :zipcode, :country, :email, :phone, :website, :fax)";
        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([
                'name' => $name,
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