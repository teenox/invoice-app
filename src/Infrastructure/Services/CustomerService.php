<?php

class CustomerService
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function createCustomer($name, $address, $city, $state, $zipcode, $country, $email, $phone, $website, $fax)
    {
        return $this->customerRepository->createCustomer($name, $address, $city, $state, $zipcode, $country, $email, $phone, $website, $fax);
    }

    public function create($customerData)
    {
        return $this->customerRepository->createCustomer($customerData['name'], $customerData['address'], $customerData['city'], $customerData['state'], $customerData['zipcode'], $customerData['country'], $customerData['email'], $customerData['phone'], $customerData['website'], $customerData['fax']);
    }

    public function getCustomer($id)
    {
        return $this->customerRepository->getCustomer($id);
    }

}