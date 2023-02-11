<?php

class MainController
{
    private $invoiceService;
    private $invoiceItemService;
    private $customerService;
    private $productService;

    public function __construct(
        InvoiceService $invoiceService,
        InvoiceItemService $invoiceItemService,
        CustomerService $customerService,
        ProductService $productService
    )
    {
        $this->invoiceService = $invoiceService;
        $this->invoiceItemService = $invoiceItemService;
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    public function viewInvoices()
    {
        $invoices = $this->invoiceService->getInvoices();
        require_once 'src/Views/invoices_view.php';
    }

    public function createInvoice($postData)
    {
        $customer = $postData['customer'];
        $invoice = $postData['invoice'];
        $productsData = $postData['products'];
        $customerId = $this->customerService->create($customer);

        $products = array();
        foreach ($productsData as $product) {
            $productId = $this->productService->create($product);
            $products[] = $this->productService->getProduct($productId);
        }

        $invoiceId = $this->invoiceService->createInvoice($customerId, $invoice['date'], $invoice['due_date']);

        foreach ($products as $product) {
            $this->invoiceItemService->createInvoiceItem($invoiceId, $product['product_id'], 1, $product['price']);
        }
        http_response_code(201);
        echo json_encode(['message' => $this->invoiceService->getInvoice($invoiceId)]);
    }

    public function viewInvoice($invoiceId)
    {
        return $this->invoiceService->getInvoice($invoiceId);
    }

    public function index()
    {
        http_response_code(200);
        echo json_encode(['message' => 'this is a view']);
        // return "this is a view";
    }
}