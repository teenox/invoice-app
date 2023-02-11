<?php

class Customer
{
    private $customerId;
    private $name;
    private $address;
    private $city;
    private $state;
    private $zipcode;
    private $country;
    private $email;
    private $phone;
    private $website;
    private $fax;

    public function __construct($customerId, $name, $address, $city, $state, $zipcode, $country, $email, $phone, $website, $fax)
    {
        $this->customerId = $customerId;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
        $this->country = $country;
        $this->email = $email;
        $this->phone = $phone;
        $this->website = $website;
        $this->fax = $fax;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getFax()
    {
        return $this->fax;
    }
}