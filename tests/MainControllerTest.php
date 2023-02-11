<?php

use PHPUnit\Framework\TestCase;

class MainControllerTest extends TestCase
{
    private $mainController;
    private $invoiceService;
    private $invoiceItemService;
    private $customerService;
    private $productService;

    public function setUp(): void
    {
        require "src\Infrastructure\Services\InvoiceService.php";
        require "src\Infrastructure\Services\InvoiceItemService.php";
        require "src\Infrastructure\Services\CustomerService.php";
        require "src\Infrastructure\Services\ProductService.php";
        require "src\Controllers\MainController.php";


        $this->invoiceService = $this->createMock(InvoiceService::class);
        $this->invoiceItemService = $this->createMock(InvoiceItemService::class);
        $this->customerService = $this->createMock(CustomerService::class);
        $this->productService = $this->createMock(ProductService::class);
        $this->mainController = new MainController(
                $this->invoiceService,
                $this->invoiceItemService,
                $this->customerService,
                $this->productService
        );
    }

    public function testViewInvoices()
    {
        $invoices = [
            [
                'invoice_id' => 1,
                'customer_id' => 1,
                'date' => '2023-01-01',
                'due_date' => '2023-01-31',
                'status' => 'unpaid'
            ],
            [
                'invoice_id' => 2,
                'customer_id' => 2,
                'date' => '2023-02-01',
                'due_date' => '2023-02-28',
                'status' => 'unpaid'
            ],
        ];

        $this->invoiceService->expects($this->once())
            ->method('getInvoices')
            ->willReturn($invoices);

        //$response = $this->mainController->viewInvoices();
        $this->assertEquals(200, http_response_code());
        // $this->assertEquals(json_encode(['message' => $invoices]), $response);
    }
}
