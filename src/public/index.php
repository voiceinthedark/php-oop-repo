<?php

// phpinfo();

require __DIR__ . '/../app/invoice.php';
require __DIR__ . '/../app/invoiceCollection.php';
require __DIR__ . '/../app/router.php';

use App\Invoice;
use App\Router;

$route = new Router();

$route->get('/', [Invoice::class, 'index']);


$route->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));