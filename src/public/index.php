<?php
require_once __DIR__ . '/../app/autoloader.php';

session_start();
setcookie('username', 'firas', time() + 3600);

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEWS_PATH', __DIR__ . '/../views');

use app\controllers\HomeController;
use app\controllers\InvoiceController;
use app\Router;




$route = new Router();

$route->get('/', [HomeController::class, 'index'])
      ->get('/invoice', [InvoiceController::class, 'index'])
      ->get('/invoice/create', [InvoiceController::class, 'create'])
      ->post('/invoice/create', [InvoiceController::class, 'store'])
      ->post('/upload', [HomeController::class, 'upload']);

$route->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

// echo exec('whoami');
