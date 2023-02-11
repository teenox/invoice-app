<?php

require __DIR__ . "\src\Infrastructure\Database\Database.php";
require __DIR__ . "\src\Infrastructure\Utils\Validator.php";
require __DIR__ . "\src\Features\Invoice\InvoiceRepository.php";
require __DIR__ . "\src\Features\InvoiceItem\InvoiceItemRepository.php";
require __DIR__ . "\src\Features\Product\ProductRepository.php";
require __DIR__ . "\src\Features\Customer\CustomerRepository.php";
require __DIR__ . "\src\Features\Customer\Customer.php";
require __DIR__ . "\src\Infrastructure\Services\InvoiceService.php";
require __DIR__ . "\src\Infrastructure\Services\InvoiceItemService.php";
require __DIR__ . "\src\Infrastructure\Services\CustomerService.php";
require __DIR__ . "\src\Infrastructure\Services\ProductService.php";


// $routes = [
//     'home' => [
//         'url' => '/invoice-api/',
//         'method' => 'GET',
//         'controller' => 'InvoiceController@index'
//     ],
//     'home_post' => [
//         'url' => '/invoice-api/create',
//         'method' => 'POST',
//         'controller' => 'InvoiceController@create'
//     ],
//     'customer_post' => [
//         'url' => '/invoice-api/customer/create',
//         'method' => 'POST',
//         'controller' => 'CustomerController@create'
//     ],
//     'customer_get' => [
//         'url' => '/invoice-api/customer/create',
//         'method' => 'GET',
//         'controller' => 'CustomerController@get'
//     ],
//     'product_post' => [
//         'url' => '/invoice-api/product/create',
//         'method' => 'POST',
//         'controller' => 'ProductController@create'
//     ],
//     'invoiceItem_post' => [
//         'url' => '/invoice-api/invoiceItem/create',
//         'method' => 'POST',
//         'controller' => 'InvoiceItemController@create'
//     ],
//     'main_post' => [
//         'url' => '/invoice-api/main/create',
//         'method' => 'POST',
//         'controller' => 'MainController@createInvoice'
//     ]
// ];

$routes = [
    'home' => [
        'url' => '/invoice-api/',
        'method' => 'GET',
        'controller' => 'MainController@index'
    ],
    'create_invoice' => [
        'url' => '/invoice-api/create',
        'method' => 'POST',
        'controller' => 'MainController@createInvoice'
    ],
    'view_invoice' => [
        'url' => '/invoice-api/invoice/',
        'method' => 'GET',
        'controller' => 'MainController@viewInvoice'
    ],
    'view_invoices' => [
        'url' => '/invoice-api/invoices',
        'method' => 'GET',
        'controller' => 'MainController@viewInvoices'
    ]
];

$currentUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$database = new Database('localhost', 'root', '', 'invoice-api');
$customerRepository = new CustomerRepository($database);

$productRepository = new ProductRepository($database);
$invoiceRepository = new InvoiceRepository($database);
$invoiceItemRepository = new InvoiceItemRepository($database);
$invoiceService = new InvoiceService( $invoiceRepository);
$invoiceItemService = new InvoiceItemService( $invoiceItemRepository);
$customerService = new CustomerService( $customerRepository);
$productService = new ProductService($productRepository);
$validator = new Validator();

foreach ($routes as $route) {
    if ($route['url'] == $currentUrl && $route['method'] == $requestMethod) {

        $controllerAction = explode('@', $route['controller']);
        $controller = $controllerAction[0];
        $action = $controllerAction[1];
        $filePath = "src/Controllers/$controller.php";

        if (file_exists($filePath)) {
            require_once $filePath;

            $controller = new $controller( $invoiceService, $invoiceItemService, $customerService, $productService ,$validator);

            if ($requestMethod === 'POST') {
                $post_data = json_decode(file_get_contents("php://input"), true);
                $controller->$action($post_data);
                break;
            } 
            
            $controller->$action();

            break;
        } else {
            // Return a 404 response if the controller file doesn't exist
            header("HTTP/1.0 404 Not Found");
            echo '404 Not Found';
            break;
        }
    }
}