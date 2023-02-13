<?php

class InvoiceController
{
    private $invoiceService;
    private $invoiceItemService;
    private $customerService;
    private $productService;
    private $validator;

    public function __construct(
        InvoiceService $invoiceService,
        InvoiceItemService $invoiceItemService,
        CustomerService $customerService,
        ProductService $productService,
        Validator $validator
    )
    {
        $this->invoiceService = $invoiceService;
        $this->invoiceItemService = $invoiceItemService;
        $this->customerService = $customerService;
        $this->productService = $productService;
        $this->validator = $validator;
    }

    public function createInvoice()
    {
        $invoices = $this->invoiceService->getInvoices();
        require_once 'src/Views/CreateInvoice.php';
    }

    public function create($postData)
    {   
        if (!$this->validator->validate($postData)) {
            http_response_code(400);
            echo 'Bad Request: Invalid data provided';
            exit;
        }

        $customer = $postData['customer'];
        $invoice = $postData['invoice'];
        $productsData = $postData['products'];
        $customerId = $this->customerService->create($customer);

        $products = array();
        foreach ($productsData as $product) {
            $productId = $this->productService->create($product);
            $products[] = $this->productService->getProduct($productId);
        }

        $invoiceId = $this->invoiceService->createInvoice($customerId, $invoice['date'], $invoice['due_date'],$invoice['tax_rate']);

        foreach ($products as $product) {
            $this->invoiceItemService->createInvoiceItem($invoiceId, $product['product_id'], 1, $product['amount']);
        }
        
        $invoiceItems = $this->invoiceItemService->getInvoiceItems($invoiceId);
        $invoiceCreated = $this->invoiceService->getInvoice($invoiceId);
        
        $response = array();
        $response['status'] = 'success';
        $response['message'] = [$invoiceCreated,$invoiceItems];

        echo json_encode($response);
        exit;
    }

    public function viewInvoice($invoiceId)
    {
        return $this->invoiceService->getInvoice($invoiceId);
    }

    public function index()
    {
        $invoices = $this->invoiceService->getInvoices();
        require_once 'src/Views/Index.php';
    }

    public function show($id){

        $invoice = $this->invoiceService->getInvoice($id);

        $customer = $this->customerService->getCustomer($invoice['customer_id']);

        $invoiceItems = $this->invoiceItemService->getInvoiceItems($invoice['invoice_id']);

        $products = [];

        foreach ($invoiceItems as $invoiceItem) {
            $product = $this->productService->getProduct($invoiceItem['product_id']);
            $products[] = $product;
        }

        include 'src/Views/ShowInvoice.php';
    }
}