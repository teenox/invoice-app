<?php

require __DIR__ . "\src\Infrastructure\Database\Database.php";
require __DIR__ . "\src\Infrastructure\Utils\Validator.php";
require __DIR__ . "\src\Repositories\InvoiceRepository.php";
require __DIR__ . "\src\Repositories\InvoiceItemRepository.php";
require __DIR__ . "\src\Repositories\ProductRepository.php";
require __DIR__ . "\src\Repositories\CustomerRepository.php";
require __DIR__ . "\src\Services\InvoiceService.php";
require __DIR__ . "\src\Services\InvoiceItemService.php";
require __DIR__ . "\src\Services\CustomerService.php";
require __DIR__ . "\src\Services\ProductService.php";


$routes = [
    'home' => [
        'url' => '/',
        'method' => 'GET',
        'controller' => 'InvoiceController@index',
        'has_parameters' => false
    ],
    'create_invoice_post' => [
        'url' => '/create',
        'method' => 'POST',
        'controller' => 'InvoiceController@create',
        'has_parameters' => false
    ],
    'create_invoice' => [
        'url' => '/invoice/create',
        'method' => 'GET',
        'controller' => 'InvoiceController@createInvoice',
        'has_parameters' => false
    ],
    'view_invoices' => [
        'url' => '/invoices',
        'method' => 'GET',
        'controller' => 'InvoiceController@viewInvoices',
        'has_parameters' => false
    ],
    'view_invoice' => [
        'url' => '/invoice-view/{id}/',
        'method' => 'GET',
        'controller' => 'InvoiceController@show',
        'has_parameters' => true,
        'regex' => '/invoice-view\/(\d+)/'
    ]
];

$currentUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$database = new Database('localhost', 'root', '', 'invoice-api');
$customerRepository = new CustomerRepository($database);

$productRepository = new ProductRepository($database);
$invoiceRepository = new InvoiceRepository($database);
$invoiceItemRepository = new InvoiceItemRepository($database);
$invoiceService = new InvoiceService($invoiceRepository);
$invoiceItemService = new InvoiceItemService($invoiceItemRepository);
$customerService = new CustomerService($customerRepository);
$productService = new ProductService($productRepository);
$validator = new Validator();

foreach ($routes as $route) {
    if ($route['has_parameters']) {
        preg_match($route['regex'], $currentUrl, $matches);
        $route['url'] = '/' . $matches[0];
    }

    if ($route['url'] == $currentUrl && $route['method'] == $requestMethod) {

        $controllerAction = explode('@', $route['controller']);
        $controller = $controllerAction[0];
        $action = $controllerAction[1];
        $filePath = "src/Controllers/$controller.php";

        if (file_exists($filePath)) {
            require_once $filePath;

            $controller = new $controller($invoiceService, $invoiceItemService, $customerService, $productService, $validator);

            if ($requestMethod === 'POST') {
                $post_data = json_decode(file_get_contents("php://input"), true);
                $controller->$action($post_data);
                break;
            }

            if ($route['has_parameters']) {
                $params = explode('/', $matches[0]);
                $controller->$action($params[1]);
                break;
            }

            $controller->$action();

            break;
        }
    }
}